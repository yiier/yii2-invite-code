<?php
/**
 * author     : forecho <caizhenghai@gmail.com>
 * createTime : 2016/4/28 10:30
 * description:
 */
namespace yiier\inviteCode\models;

use Yii;
use yii\helpers\ArrayHelper;

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
    const STATUS_USE = 1;
    const STATUS_NOT_USE = 0;

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

    /**
     * @param null $userId
     * @return array
     */
    public static function getNotUseCode($userId = null)
    {
        $model = self::find()->where(['status' => self::STATUS_NOT_USE])->filterWhere(['user_id' => $userId])->all();
        if ($model) {
            return ArrayHelper::getColumn($model, 'code');
        }
        return [];
    }

    /**
     * @param $code
     * @param $userId
     * @param int $assignCodeNum
     * @return int
     */
    public static function useCode($code, $userId, $assignCodeNum = 0)
    {
        $use = self::updateAll(
            ['status' => self::STATUS_USE, 'user_id' => $userId, 'updated_at' => time()],
            ['status' => self::STATUS_NOT_USE, 'code' => $code]
        );
        if ($use && $assignCodeNum) {
            if ($model = self::find()->where(['status' => self::STATUS_NOT_USE, 'user_id' => null])->limit($assignCodeNum)->all()) {
                $ids = ArrayHelper::getColumn($model, 'id');
                return self::updateAll(['user_id' => $userId, 'updated_at' => time()], ['id' => $ids]);
            }

        }
        return $use;
    }

}
