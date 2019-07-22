<?php

namespace app\models;

use yii\db\ActiveRecord;

class Coupon extends ActiveRecord
{
    public static function tableName()
    {
        return 'coupons';
    }

    public function getMarket()
    {
        return $this->hasOne(Market::className(), ['id' => 'id_market']);
    }
}