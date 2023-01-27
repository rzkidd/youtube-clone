<?php

use yii\widgets\ListView;

/** @var yii\data\ActiveDataProvider $dataProvider  */
?>
<?= ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => (Yii::$app->requestedRoute == 'video/search') ? '_search_result' : '_video_item',
    'itemOptions' => [
        'class' => (Yii::$app->requestedRoute == 'video/search') ? 'mb-3 px-0' : 'col-md-3 mb-5'
    ],
    'options' => [
        'class' => (Yii::$app->requestedRoute == 'video/search') ? 'row mx-auto mt-5 pt-2 border-top border-secondary' : 'row',
        'style' => (Yii::$app->requestedRoute == 'video/search') ? 'width: 90%;' : ''
    ],
    'layout' => '{items}{pager}'
]); ?>