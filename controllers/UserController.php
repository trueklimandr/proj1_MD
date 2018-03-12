<?php
/**
 * Created by PhpStorm.
 * User: klimandr
 * Date: 02.03.18
 * Time: 13:29
 */
namespace app\controllers;

use yii\base\Module;
use yii\rest\ActiveController;
use app\models\User;
use Yii;
use yii\web\HttpException;
use app\services\UserService;
use app\services\AccessTokenService;

class UserController extends ActiveController
{
    public $modelClass = User::class;
    private $userService;
    private $accessTokenService;

    public function __construct(
        string $id,
        Module $module,
        UserService $userService,
        AccessTokenService $accessTokenService,
        array $config = []
    ) {
        parent::__construct($id, $module, $config);
        $this->userService = $userService;
        $this->accessTokenService = $accessTokenService;
    }

    /**
     * Do authorization.
     * @return array|null|\yii\db\ActiveRecord created token and userId in model AccessToken or null
     * @throws HttpException if there is no such user
     * @throws \yii\base\Exception
     */
    public function actionAuthorize()
    {
        $request = Yii::$app->request;
        $response = Yii::$app->getResponse();
        $user = $this->userService->findUserByEmail($request->getBodyParam('email'));

        if ($user == null) {
            throw new HttpException(401,'Unauthorized. Check your login');
        }

        if (!$this->userService->validateUserPassword(
            $user,
            $request->getBodyParam('password')
        )) {
            throw new HttpException(401,'Unauthorized. Check your login/password');
        }

        $modelOfToken = $this->accessTokenService->findAccessTokenByUserId($user);
        $finalModelOfToken = $this->
        accessTokenService->
        makeModelWithToken($user, $modelOfToken);

        if ($finalModelOfToken->save()) {
            $response->setStatusCode(201);
        } elseif (!$finalModelOfToken->hasErrors()) {
            throw new HttpException(500,'Unknown server error');
        }
        return (isset($finalModelOfToken)) ? $finalModelOfToken : null;
    }
}
