<?php

/* @var $this yii\web\View */

use yii\grid\GridView;
use yii\helpers\Html;
use newerton\fancybox\FancyBox;

$this->title = 'Coupons: ' . $titleMarket;

echo $dataProvader
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
            'attribute' => 'picture',
            'format' => 'raw',
            'value' => function($coupon){
                return Html::a(
                    Html::img($coupon->picture, [
                        'alt'=>$coupon->brand,
                        'style' => 'width:30px;',
                    ]),
                    $coupon->picture,
                    ['rel' => 'fancybox']
                );
            },
            'enableSorting' => false,
        ],
        'market.title:text:Market',
        'summary:text:Summary',
        'brand:text:Brand',
        [
            'attribute' => 'description',
            'format' => 'text',
            'value' => 'description',
        ],
        'expiry:text:Expiry',
    ],
]) ?>
<?= FancyBox::widget([
    'target' => 'a[rel=fancybox]',
    'mouse' => false,
    'config' => [
        'maxWidth' => '90%',
        'maxHeight' => '90%',
        'playSpeed' => 7000,
        'padding' => 0,
        'fitToView' => false,
        'width' => '70%',
        'height' => '70%',
        'autoSize' => false,
        'closeClick' => true,
        'openEffect' => 'elastic',
        'closeEffect' => 'elastic',
        'arrows' => false,
        'closeBtn' => false,
        'openOpacity' => true,
    ]
]); ?>

    </div>
</div>