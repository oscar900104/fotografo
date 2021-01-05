<?php
namespace frontend\models;

use common\models\User;
use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $role;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Ese nombre de usuario ya existe.'],
            ['username', 'string', 'min' => 2, 'max' => 255],
          
            ['role', 'required'],
            ['role', 'integer'],

//            ['email', 'filter', 'filter' => 'trim'],
//            ['email', 'required'],
//            ['email', 'email'],
//            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Este correo ya existe.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {
            return User::create($this->attributes);
        }

        return null;
    }
      /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'username' => 'Nombre de usuario',
            'role' => 'Rol',
            'password' => 'Contraseña',
            
        ];
    }
}
