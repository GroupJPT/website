<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model {

    public $name;
    public $surname;
    public $parish_id;
    public $email;
    public $password;

    public function rules() {
        return [
            ['name', 'required'],

            ['surname', 'required'],

            ['parish_id', 'required'],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Este email já está a ser utilizado.'],

            ['password', 'required'],
            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],
        ];
    }

    public function signup() {

        if ($this->validate()) {
            $user = new User();

            $user->name = $this->name;
            $user->surname = $this->surname;
            $user->email = $this->email;
            $user->parish_id = $this->parish_id;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            $user->save(false);

            $auth = Yii::$app->authManager;
            $userRole = $auth->getRole('User');
            $auth->assign($userRole, $user->getId());

            return $user;
        }

        return null;
    }
}
