<?php

namespace yiier\inviteCode;

use yii\db\Exception;
use yiier\inviteCode\models\InviteCode;
use Yii;

/**
 * author     : forecho <caizh@chexiu.cn>
 * createTime : 2016/4/27 16:46
 * description:
 */
class GCodeController extends \yii\console\Controller
{

    public function actionIndex($num = 100, $userId = 0)
    {
        $rows = [];
        $time = time();
        foreach (range(0, $num) as $value) {
            $rows[$value]['code'] = Yii::$app->security->generateRandomString();
            $rows[$value]['user_id'] = $userId;
            $rows[$value]['created_at'] = $time;
            $rows[$value]['updated_at'] = $time;
        }
        if (!static::saveAll(InviteCode::tableName(), $rows)) {
            throw new Exception(33007);
        }
    }

    public static function saveAll($tableName, $rows = [])
    {
        return Yii::$app->db->createCommand()
            ->batchInsert($tableName, array_keys(array_values($rows)[0]), $rows)
            ->execute();
    }
}