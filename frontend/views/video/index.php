<?php

use yii\widgets\ListView;

/** @var yii\data\ActiveDataProvider $dataProvider  */
?>
<?= ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_video_item',
    'itemOptions' => [
        'class' => 'col-md-3 mb-5'
    ],
    'options' => [
        'class' => 'row'
    ],
    'layout' => '{items}{pager}'
]); ?>