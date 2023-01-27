<?php

use yii\widgets\ListView;

/** @var yii\data\ActiveDataProvider $dataProvider  */
?>
<?= ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => (Yii::$app->requestedRoute == 'video/search' || Yii::$app->requestedRoute == 'video/history') ? '_search_result' : '_video_item',
    'itemOptions' => [
        'class' => (Yii::$app->requestedRoute == 'video/search' || Yii::$app->requestedRoute == 'video/history') ? 'mb-3 px-0' : 'col-md-3 mb-5'
    ],
    'options' => [
        'class' => (Yii::$app->requestedRoute == 'video/search' || Yii::$app->requestedRoute == 'video/history') ? 'row mx-auto mt-5 pt-2 border-top border-secondary' : 'row',
        'style' => (Yii::$app->requestedRoute == 'video/search' || Yii::$app->requestedRoute == 'video/history') ? 'width: 90%;' : ''
    ],
    'layout' => '{items}'
]); ?>