<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property int $id
 * @property string $user_name
 * @property string $password
 * @property int $role
 * @property int $id_instansi
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * @inheritdoc
     */
    public $authKey = 'dsfdfmjvhsdfgn21554477';

    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'role', 'id_instansi'], 'integer'],
            [['username'], 'string', 'max' => 7],
            [['password'], 'string', 'max' => 14],
            [['id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'User Name',
            'password' => 'Password',
            'role' => 'Role',
            'id_instansi' => 'Id Instansi',
        ];
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->authKey;
    }

    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    public static function findByUsername($username)
    {
        //mencari user login berdasarkan username dan hanya dicari 1.
        $user = static::find()->where(['username'=>$username])->one(); 
        // if(count($user)){
        if($user){
            return new static($user);
        }
        return null;
    }

    public function validatePassword($password) {
        return $this->password ===  ($password);
    }


}
