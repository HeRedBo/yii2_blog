<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%blog}}".
 *
 * @property string $id
 * @property string $title
 * @property string $content
 * @property string $created_at
 * @property string $update_at
 */
class Blog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%blog}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content'], 'required'],
            [['content'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['title'], 'string', 'max' => 255],
            ['title', 'required', 'message' => '请填写标题'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '自增id',
            'title' => '文章标题',
            'content' => '文章内容',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
        ];
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
