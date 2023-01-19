<?php

use common\models\Video;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\CheckboxColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Channel content';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="video-index container">

    <h1 class="text-light fs-4 fw-bold"><?= Html::encode($this->title) ?></h1>

    <!-- <p>
        <?= Html::a('Create Video', ['create'], ['class' => 'btn btn-success']) ?>
    </p> -->


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'class' => CheckboxColumn::class,
                'header' => Html::checkBox('selection_all', false, [
                    'class' => 'select-on-check-all form-check-input'
                ]),
                'checkboxOptions' => [
                    'class' => 'form-check-input'
                ]
            ],
            [
                'attribute' => 'title',
                'label' => 'Video',
                'content' => function ($model) {
                        return $this->render('_video_item', ['model' => $model]);
                    },
            ],
            [
                'attribute' => 'status',
                'label' => 'Visibility',
                'content' => function ($model) {
                        return '<i class="fa-regular fa-eye-slash text-muted"></i> ' . $model->getStatusLabels()[$model->status];
                    }
            ],
            //'has_thumbnail:boolean',
            //'video_name',
            [
                'attribute' => 'created_at',
                'label' => 'Date',
                'format' => 'date',
                'content' => function ($model) {
                    return '<div>' . Yii::$app->formatter->asDate($model->created_at) . '<span class="d-block text-muted" style="font-size: 0.9rem">Uploaded</span></div>';
                }
            ],
            // 'updated_at:datetime',
            //'created_by',
            // [
            //     'class' => ActionColumn::class,
            //     'options' => [
            //         'class' => 'd-flex align-items-center'
            //     ],
            //     'urlCreator' => function ($action, Video $model, $key, $index, $column) {
            //         return Url::toRoute([$action, 'video_id' => $model->video_id]);
            //     },
            //     'buttons' => [
            //         'delete' => function ($url) {
            //             return Html::a('<i class="fa-regular fa-trash-can"></i>', $url, [
            //                 'data-method' => 'post',
            //                 'data-confirm' => 'Permanently delete this video?',
            //                 'class' => 'text-muted'
            //             ]);
            //         }
            //     ],
            //     'visibleButtons' => [
            //         'update' => false,
            //         'view' => false,
            //         'delete' => true,
            //     ],
            // ],
        ],
        'options' => [
            'class' => 'mt-5'
        ],
        'summaryOptions' => [
            'class' => 'd-none'
        ],
        'tableOptions' => [
            'class' => 'table  text-muted',
            'id' => 'table_video'
        ],
        'rowOptions' => [
            'class' => 'text-light'
        ],
        'filterRowOptions' => [
            'class' => 'text-muted'
        ]
    ]); ?>


</div>
