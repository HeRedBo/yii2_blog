<?php

namespace backend\models;
use yii\web\IdentityInterface;
use Yii;

/**
 * This is the model class for table "{{%user_backend}}".
 *
 * @property integer $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $email
 * @property string $created_at
 * @property string $updated_at
 */
class UserBackend extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_backend}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at'], 'safe'],
            [['username', 'password_hash', 'email'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['email'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '自增id',
            'username' => '用户名',
            'auth_key' => '签名key',
            'password_hash' => '登录密码',
            'email' => '用户邮箱',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
        ];
    }

     /**
      * 根据user_backend 表主见获取用户
      * @inheritdoc
      */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }

     /**
      * @inheritdoc
      * 根据access_token获取用户，我们暂时先不实现，我们在文章 http://www.manks.top/yii2-restful-api.html 有过实现，如果你感兴趣的话可以看看
      */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }


    /**
     * @inheritdoc
     * 获取用户标志 Yii::$app->user->id;
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * 获取auth_key
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * 验证 auth_key
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * 生产密码 
     * @param string  $password 明文密码
     */
    public  function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    public function generateAuthKey()
    {
        $this->auth_key  = Yii::$app->security->generateRandomString();
    }
}
