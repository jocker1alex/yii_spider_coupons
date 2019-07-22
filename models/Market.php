<?php

namespace app\models;

use yii\db\ActiveRecord;

class Market extends ActiveRecord
{
    public static function tableName()
    {
        return 'markets';
    }

    public function getCoupons()
    {
        return $this->hasMany(Coupon::className(), ['id_market' => 'id']);
    }
}