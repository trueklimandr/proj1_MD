<?php
/**
 * Created by PhpStorm.
 * User: klimandr
 * Date: 07.03.18
 * Time: 10:46
 */

namespace app\services;

use app\models\AccessToken;
use \app\models\User;
use Yii;

class AccessTokenService
{
    /**
     * @param \app\models\User $user
     * @return array|null
     */
    public function findAccessTokenByUserId(User $user)
    {
        return AccessToken::find()
            ->where(['userId' => $user->userId])
            ->one();
    }

    /**
     * @param User $user
     * @param AccessToken|null $model2
     * @return AccessToken|null
     * @throws \yii\base\Exception
     */
    public function makeModelWithToken(User $user, $model2)
    {
        if ($model2 == null) {
            $model = new AccessToken();
            $model->token = Yii::$app->security->generateRandomString();
            $model->userId = $user->userId;
            $model_final = $model;
        } elseif ($model2->userId == $user->userId) {
            $model2->token = Yii::$app->security->generateRandomString();
            $model_final = $model2;
        }
        return (isset($model_final)) ? $model_final : null;
    }
}
