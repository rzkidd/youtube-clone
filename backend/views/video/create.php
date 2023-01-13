<?php

use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Video $model */

$this->title = 'Create Video';
$this->params['breadcrumbs'][] = ['label' => 'Videos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="video-create text-light">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if(isset($model->errors['video'])): ?>
        <div class="">
            <?php foreach($model->errors['video'] as $error) : ?>
            <div class="alert alert-danger mb-1"><?= $error ?></div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <div class="d-flex flex-column justify-content-center align-items-center mt-5">
        <div class="icon-upload rounded-circle d-flex justify-content-center align-items-center ">
            <i class="fa-solid fa-upload text-dark" ></i>
        </div>
        <div class="mt-3 text-center">
            <p>Drag and drop video files to upload</p>
            <p class="text-muted">Your videos will be private until you publish them.</p>
        </div>

        <?php ActiveForm::begin([
            'options' => ['enctype' => 'multipart/form-data']
        ]); ?>
        <button class="btn btn-primary btn-file">
            Select Files
            <input type="file" name="video" id="video-input">
        </button>
        <?php ActiveForm::end(); ?>
    </div>

</div>
