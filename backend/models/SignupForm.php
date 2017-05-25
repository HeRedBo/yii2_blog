<?php

namespace backend\models;


use yii\base\Model;
use backend\models\UserBackend;


class SignupForm extends Model
{
	public $username;
	public $email;
	public $password;

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
     * 后天添加用户方法、
     * 
     * @return true|false 添加成功后者失败
     */
    public function signup()
    {
    	if(!$this->validate())
    		return true;

    	$user = new UserBackend();
    	$user->username  = $this->username;
    	$user->email = $this->email;
    	// 设置密码
    	$user->setPassword($this->password);
    	// 生产 "remeber me " 认证key 
    	$user->generateAuthKey();

    	// save(false)的意思是：不调用UserBackend的rules再做校验并实现数据入库操作
        // 这里这个false如果不加，save底层会调用UserBackend的rules方法再对数据进行一次校验，因为我们上面已经调用Signup的rules校验过了，这里就没必要在用UserBackend的rules校验了
        return $user->save(false);
    }
}
