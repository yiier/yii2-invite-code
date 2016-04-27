<?php

namespace yiier\inviteCode\models;

use Yii;

/**
 * This is the model class for table "{{%invite_code}}".
 *
 * @property integer $id
 * @property string $code
 * @property integer $user_id
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class InviteCode extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%invite_code}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code'], 'required'],
            [['user_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['code'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'code' => Yii::t('app', 'Code'),
            'user_id' => Yii::t('app', 'User ID'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}
