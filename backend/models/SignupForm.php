<?php

namespace backend\models;
use yii\web\IdentityInterface;
use backend\models\UserBackend;
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
class signForm extends \yii\db\ActiveRecord implements IdentityInterface
{
	public $username;
	public $email;
	public $passworld;

	protected $created_at;
	protected $updated_at;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
        	// 对username的值进行两边去空格过滤
            ['username', 'filter', 'filter' => 'trim'],
            // required表示必须的，也就是说表单提交过来的值必须要有, message 是username不满足required规则时给的提示消息
            ['username', 'required', 'message' => '用户名不可以为空'],
             // unique表示唯一性，targetClass表示的数据模型 这里就是说UserBackend模型对应的数据表字段username必须唯一
            ['username', 'unique', 'targetClass' => '\backend\models\UserBackend', 'message' => '用户名已存在.'],
            // string 字符串，这里我们限定的意思就是username至少包含2个字符，最多255个字符
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required', 'message' => '邮箱不可以唯恐'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\backend\models\UserBackend', 'message' => 'email已经被设置了.'],
            ['password', 'required', 'message' => '密码不可以为空'],
            ['password', 'string', 'min' => 6, 'tooShort' => '密码至少填写6位'],   
            [['created_at', 'updated_at'], 'safe'],
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


    public function beforeSave($insert)
    {
        if(parent::beforeSave($insert))
        {
            if($this->isNewRecord)
            {
                
                $this->created_at= date('Y-m-d H:i:s');
                $this->updated_at= date('Y-m-d H:i:s');
            } 
            else
            {
                $this->updated_at= date('Y-m-d H:i:s');
            }
            return true;
        }
        else
            return false;
    }

    
}
