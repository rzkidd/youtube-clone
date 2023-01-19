<?php

use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Video $model */

$this->title = 'Video details';
$this->params['breadcrumbs'][] = ['label' => 'Videos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'video_id' => $model->video_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="video-update text-light me-5 ms-3">

    <?php $form = ActiveForm::begin([
            'options' => [
                'enctype' => 'multipart/form-data',
            ],
            'fieldClass' => ActiveField::class,
            'fieldConfig' => [
                'inputOptions' => [
                    'class' => 'form-control text-light bg-transparent border-secondary input-field'
                ]
            ]
        ]); ?>  

    <div class="sub-header d-flex justify-content-between py-2 position-sticky top-0">
        <h3><?= Html::encode($this->title) ?></h3>
        <div class="d-flex align-items-center">
            <a href="#" class="text-decoration-none me-3 fw-bold">UNDO CHANGES</a>
            <div class="form-group">
                <?= Html::submitButton('SAVE', ['class' => 'btn btn-primary text-dark fw-bold', 'id' => 'update-video-submit']) ?>
            </div>
        </div>
    </div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

    <?php ActiveForm::end(); ?>

</div>
