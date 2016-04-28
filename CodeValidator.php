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
        if (!InviteCode::findOne(['code' => $model->$attribute, 'status' => InviteCode::STATUS_NOT_USE])) {
            $this->addError($model, $attribute, \Yii::t('app', 'This invite code is can\'t use'));
        }
    }
}