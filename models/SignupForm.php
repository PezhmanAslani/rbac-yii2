<?php

namespace app\models;

use Yii;
use yii\base\Model;

class SignupForm extends Model
{
    public $username;
    public $password;
    public $email;
    public $phone_number;

    public function rules()
    {
        return [
            [['username', 'password', 'email'], 'required'],
            ['email', 'email'],
            ['username', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This username has already been taken.'],
            ['email', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This email address has already been taken.'],
            ['password', 'string'],
            ['phone_number', 'string'],
        ];
    }

    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->phone_number = $this->phone_number;
        $user->setPassword($this->password); // Assuming you have setPassword() in User model
        $user->generateAuthKey(); // Assuming you have generateAuthKey() in User model

        if ($user->save()) {
            // Generate tokens after saving the user
            $user->access_token = Yii::$app->security->generateRandomString();
            $user->refresh_token = Yii::$app->security->generateRandomString();
            $user->save(false); // Save tokens

            // Assign role to the user
            $auth = Yii::$app->authManager;
            $role = $auth->getRole('user'); // Replace 'user' with the actual role name
            if ($role) {
                $auth->assign($role, $user->getId());
            }

            return $user;
        }

        return null;
    }
}