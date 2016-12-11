<?php
/**
 * author     : forecho <caizhenghai@gmail.com>
 * createTime : 2016/4/28 10:55
 * description:
 */

namespace yiier\inviteCode;


use yii\validators\Validator;
use yiier\inviteCode\models\InviteCode;

class CodeValidator extends Validator
{
    public function validateAttribute($model, $attribute)
    {
        if ($inviteCode = InviteCode::findOne(['code' => $model->$attribute])) {
            if ($inviteCode->status == InviteCode::STATUS_USE) {
                $this->addError($model, $attribute, \Yii::t('app', 'This invite code been used'));
            }
        } else {
            $this->addError($model, $attribute, \Yii::t('app', 'This invite code is can\'t use'));
        }
    }
}
