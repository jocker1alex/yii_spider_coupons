<?php

/* @var $this yii\web\View */

use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'Markets';

?>

<div class="site-markets">
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
            'attribute' => 'title',
            'format' => 'raw',
            'value' => function ($market) {
                return Html::a(
                    $market->title,
                    ['site/coupons', 'market' => $market->id],
                    ['cursor' => 'pointer']
                );
            },                        
            'label' => 'Market',
        ],
        [
            'attribute' => 'url',
            'format' => 'raw',
            'value' => function ($market) {
                return Html::a(
                    $market->url,
                    $market->url, 
                    ['cursor' => 'pointer', 'target' => '_blank',]
                );
            },                        
            'label' => 'Web-adress',
            'enableSorting' => false,
        ],
    ],
]) ?>

    </div>
</div>
