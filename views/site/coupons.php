<?php

/* @var $this yii\web\View */

use yii\grid\GridView;
use yii\helpers\Html;
use newerton\fancybox\FancyBox;

$this->title = 'Coupons: ' . $titleMarket;

?>

<div class="site-coupons">
    <div class="">
        <h1><?=$this->title?></h1>
    </div>
    <div class="body-content">

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => ''],
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'enableSorting' => false,
                    'attribute'     => 'picture',
                    'format'        => 'raw',
                    'value'         => function($coupon)
                    {
                        return Html::a(Html::img($coupon->picture,
                            [
                                'alt'   => $coupon->brand,
                                'style' => 'width:30px;',
                            ]),
                            $coupon->picture,
                            ['rel' => 'fancybox']
                        );
                    },
                ],
                'market.title:text:Market',
                'summary:text:Summary',
                'brand:text:Brand',
                'description:text:description',
                'expiry:text:Expiry',
            ],
        ]) ?>

        <?= FancyBox::widget([
            'mouse'  => false,
            'target' => 'a[rel=fancybox]',
            'config' => [
                'width'       => '70%',
                'height'      => '70%',
                'arrows'      => false,
                'padding'     => 0,
                'autoSize'    => false,
                'closeBtn'    => false,
                'maxWidth'    => '90%',
                'maxHeight'   => '90%',
                'playSpeed'   => 7000,
                'fitToView'   => false,
                'closeClick'  => true,
                'openEffect'  => 'elastic',
                'closeEffect' => 'elastic',
                'openOpacity' => true,
            ]
        ]); ?>

    </div>
</div>