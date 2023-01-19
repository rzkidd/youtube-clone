<?php

use backend\assets\TagsInputAsset;
use yii\bootstrap5\ActiveField;
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Video $model */
/** @var yii\bootstrap5\ActiveForm $form */

TagsInputAsset::register($this);
?>

<div class="video-form">

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

    <div class="row">
        <div class="col-sm-8">
            <?= $form->field($model, 'title', [
                'inputOptions' => [
                    'placeholder' => 'Add a title that describes your video'
                ]
            ])->textInput(['maxlength' => true]) ?>
        
            <?php if(isset($model->errors['title'])): ?>
            <div class="mb-3">
                <?php foreach($model->errors['title'] as $error) : ?>
                <div class="invalid-feedback mb-1"><?= $error ?></div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

            <?= $form->field($model, 'description', [
                'inputOptions' => [
                    'placeholder' => 'Tell viewers about your video'
                ]
            ])->textarea(['rows' => 6]) ?>

            <?php if(isset($model->errors['description'])): ?>
            <div class="mb-3">
                <?php foreach($model->errors['description'] as $error) : ?>
                <div class="invalid-feedback mb-1"><?= $error ?></div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

            <div class="mb-3">
                <label for="thumbnail-input" class="form-label d-block"><?= $model->getAttributeLabel('thumbnail') ?></label>
                <div class="form-text mb-2">
                    Select or upload a picture that shows what's in your video. A good thumbnail stands out and draws viewers' attention.
                </div>
                <button class="btn btn-transparent btn-file text-muted border-secondary thumbnail-input">
                    <div class="d-flex flex-column justify-content-center align-items-center py-3">
                        <i class="fa-regular fa-image fs-4"></i>
                        Upload thumbnail
                        <input type="file" name="thumbnail" id="thumbnail-input">
                    </div>
                </button>
            </div>
            
            <?php if(isset($model->errors['thumbnail'])): ?>
            <div class="mb-3">
                <?php foreach($model->errors['thumbnail'] as $error) : ?>
                <div class="invalid-feedback mb-1"><?= $error ?></div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        
            <?= $form->field($model, 'tags', [
                // 'options'
                'inputOptions' => [
                    'data-role' => 'tagsinput',
                    'placeholder' => 'Add tag'
                ]
            ])->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-4">
            <div class="card-video card p-0 mb-3">
                <div class="ratio ratio-16x9">
                    <video src="<?= $model->getVideoLink() ?>" allowfullscreen controls poster="<?= $model->getThumbnailLink() ?>" class="rounded-top"></video>
                </div>
                <div class="px-3">
                    <div class="my-3 d-flex align-items-center justify-content-between">
                        <div>
                            <div class="text-muted">Video Link</div>
                            <a href="<?= $model->getVideoLink() ?>">Open Video</a>
                        </div>
                        <a href="#" id="copy-icon" class="fs-3 text-muted" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Copy" data-link="<?= $model->getVideoLink() ?>"><i class="fa-regular fa-clipboard "></i></a>
                    </div>
                    <div class="mb-3">
                        <div class="text-muted">Video Name</div>
                        <div><?= $model->video_name ?></div>
                    </div>
                </div>
            </div>
            <?= $form->field($model, 'status')->label('Visibility')->dropDownList($model->getStatusLabels(), [
                'class' => 'form-select border-secondary input-field',
                // 'options' => [
                //     'Unlisted' => ['class' => 'text-dark']
                // ]
            ]) ?>
        </div>
    </div>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
