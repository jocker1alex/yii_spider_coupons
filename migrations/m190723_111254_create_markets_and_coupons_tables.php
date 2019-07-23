<?php

use yii\db\Migration;

/**
 * Handles the creation of tables markets and coupons.
 */
class m190723_111254_create_markets_and_coupons_tables extends Migration
{
    public function safeUp()
    {
        $this->createTable('markets', [
            'id'    => 'pk',
            'title' => 'string(100) DEFAULT NULL',
            'url'   => 'string(2000) DEFAULT NULL',
            'exist' => 'tinyint(1) NOT NULL DEFAULT 1',
            'scan'  => 'tinyint(1) NOT NULL DEFAULT 0',
           ],
           'ENGINE=InnoDB DEFAULT CHARSET=utf8'
        );

        $this->createTable('coupons', [
            'id'          => 'pk',
            'id_market'   => 'integer NOT NULL DEFAULT 0',
            'summary'     => 'string(100) DEFAULT NULL',
            'brand'       => 'string(100) DEFAULT NULL',
            'description' => 'string(2000) DEFAULT NULL',
            'expiry'      => 'string(50) DEFAULT NULL',
            'picture'     => 'string(2000) DEFAULT NULL',
            'exist'       => 'tinyint(1) NOT NULL DEFAULT 1'
           ],
           'ENGINE=InnoDB DEFAULT CHARSET=utf8'
        );

        $this->createIndex('id_market', 'coupons', 'id_market');

        $this->addForeignKey('FK_spider_coupons_spider_markets',
            'coupons',
            'id_market',
            'markets',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropTable('markets');

        $this->dropTable('coupons');
    }
}
