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

    <div class="row">
        <div class="col-sm-8">
            <?= $form->field($model, 'title', [
                'inputOptions' => [
                    'placeholder' => 'Add a title that describes your video'
                ]
            ])->textInput(['maxlength' => true]) ?>

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
                <div class="thumbnail-container d-flex">
                    <button type="button" class="btn btn-transparent btn-file text-muted border-secondary thumbnail-input position-relative ratio ratio-16x9 w-25" id="thumbnail-preview" style="border-style: dashed; cursor: default;">
                        <div class="thumbnail-upload d-flex flex-column justify-content-center align-items-center py-3">
                            <i class="fa-regular fa-image fs-4"></i>
                            Upload thumbnail
                            <?= $thumbnail = $form->field($model, 'thumbnail', [
                                'template' => '
                                    {input}
                                ',
                                'inputOptions' => [
                                    'type' => 'file',
                                    'name' => 'thumbnail',
                                    'id' => 'thumbnail-input'
                                ],
                                'options' => [
                                    'class' => 'mb-0'
                                ]
                            ]);
                            ?>
                            <!-- <input type="file" name="thumbnail" id="thumbnail-input"> -->
                        </div>
                        <div class="thumbnail-options d-flex flex-row justify-content-center align-items-center w-100 bg-dark rounded bg-opacity-75" style="transform: scale(0); z-index: 999;">
                            <a class="text-muted thumbnail-delete" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete"><i class="fa-regular fa-trash-can fs-4"></i></a>
                        </div>
                    </button>
                    <button type="button" class="btn btn-transparent p-0 ratio ratio-16x9 w-25 ms-3 thumbnail-provided border border-5 border-light">
                        <img src="<?= $model->getThumbnailLink() ?>" class="rounded w-100 ">
                    </button>
                </div>
                <?= Html::error($model, 'thumbnail', [
                    'class' => 'text-danger mt-1',
                    'style' => 'font-size: 0.875rem'
                ]) ?>
            </div>
        
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
                    <video src="<?= $model->getVideoLink() ?>" allowfullscreen controls poster="<?= $model->getThumbnailLink() ?>" class="rounded-top video-preview"></video>
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
                        <div><?= $model->title ?></div>
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

</div>
