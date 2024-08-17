<?php
namespace app\components;

use Yii;
use yii\base\Component;
use app\models\User;

class TokenAuthComponent extends Component
{
    public function init()
    {
        parent::init();

        // Check token before the application processes the request
        $this->checkToken();
    }

    protected function checkToken()
    {
        $request = Yii::$app->request;
        $token = $request->getHeaders()->get('Authorization');

        if ($token) {
            $user = User::findIdentityByAccessToken($token);
            if ($user) {
                Yii::$app->user->login($user);
            } else {
                Yii::$app->response->statusCode = 401;
                Yii::$app->response->data = ['error' => 'Invalid token'];
                Yii::$app->end();
            }
        }
    }
}
