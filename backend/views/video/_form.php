<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Video $model */
/** @var yii\bootstrap5\ActiveForm $form */
?>

<div class="video-form">

    <?php $form = ActiveForm::begin([
        'options' => [
            'enctype' => 'multipart/form-data'
        ]
    ]); ?>

    <div class="row">
        <div class="col-sm-8">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        
            <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

            <label for="thumbnail" class="form-label"><?= $model->getAttributeLabel('thumbnail') ?></label>
            <div class="input-group mb-3">
                <input type="file" class="form-control" id="thumbnail" name="thumbnail">
                <label class="input-group-text" for="thumbnail">Browse</label>
            </div>
        
            <?= $form->field($model, 'tags')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-4">
            <div class="ratio ratio-16x9">
                <video src="<?= $model->getVideoLink() ?>" allowfullscreen controls poster="<?= $model->getThumbnailLink() ?>"></video>
            </div>
            <div class="my-3">
                <div class="text-muted">Video Link</div>
                <a href="<?= $model->getVideoLink() ?>">Open Video</a>
            </div>
            <div class="mb-3">
                <div class="text-muted">Video Name</div>
                <div><?= $model->video_name ?></div>
            </div>
            <?= $form->field($model, 'status')->dropDownList($model->getStatusLabels()) ?>
        </div>
    </div>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
