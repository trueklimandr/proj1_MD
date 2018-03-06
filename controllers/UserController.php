<?php
/**
 * Created by PhpStorm.
 * User: klimandr
 * Date: 02.03.18
 * Time: 13:29
 */
namespace app\controllers;

use yii\rest\ActiveController;
use app\models\User;
use app\models\AccessToken;
use Yii;
use yii\web\ServerErrorHttpException;

class UserController extends ActiveController
{
    public $modelClass = User::class;

    public function actionGettoken()
    {
        /* @var $model \yii\db\ActiveRecord */
        $model = new AccessToken();

        $request = Yii::$app->request;

        $response = Yii::$app->getResponse();

        $user = User::find()
            ->where(['email' => $request->getBodyParam('email')])
            ->one();

        if ($user != null) {
            $model2 = AccessToken::find()
                ->where(['userId' => $user->userId])
                ->one();
            if (
            Yii::$app->getSecurity()->validatePassword(
                $request->getBodyParam('password'),
                $user->password)
            ) {
                if ($model2 == null) {
                    $model->token = password_hash(
                        random_int(10000, 100000),
                        PASSWORD_DEFAULT
                    );
                    $model->userId = $user->userId;
                    $model_final = $model;
                } elseif ($model2->userId == $user->userId) {
                    $model2->token = password_hash(
                        random_int(10000, 100000),
                        PASSWORD_DEFAULT
                    );
                    $model_final = $model2;
                } else {
                    $response->setStatusCode(500);
                    return null;
                }
                if ($model_final->save()) {
                    $response->setStatusCode(201);
                } elseif (!$model->hasErrors()) {
                    throw new ServerErrorHttpException('Failed to create the object for unknown reason.');
                }
            } else {
                $response->setStatusCode(401);
            }
        } else {
            $response->setStatusCode(401);
        }
        return (isset($model_final)) ? $model_final : null;
    }
}
