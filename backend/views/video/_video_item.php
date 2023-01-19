<?php

/** @var common\models\Video $model */

use yii\helpers\StringHelper;
use yii\helpers\Url;

?>

<div class="video-row d-flex align-items-center position-relative" style="min-width: 400px; max-width: 700px;">
    <a href="<?= Url::to(['/video/update', 'video_id' => $model->video_id]) ?>" class="text-decoration-none text-light">
        <div class="flex-shrink-0 me-3" style="width: 120px;">
            <div class="ratio ratio-16x9">
                <video src="<?= $model->getVideoLink() ?>" allowfullscreen poster="<?= $model->getThumbnailLink() ?>"></video>
            </div>
        </div>
    </a>
    <div class="flex-grow-1 ms-3">
        <a href="<?= Url::to(['/video/update', 'video_id' => $model->video_id]) ?>" class="video-title text-decoration-none text-light">
            <div class="w-100 "><?= $model->title ?></div>
        </a>
        <div class="video-description text-muted mb-3"><?= ($model->description) ? StringHelper::truncateWords($model->description, 10) : 'Add description' ?></div>
        <div class="video-options d-flex flex-row justify-content-between w-25 fs-5 position-absolute">
            <a href="<?= Url::toRoute(['/video/update', 'video_id' => $model->video_id]) ?>" class="text-muted " data-bs-toggle="tooltip" data-bs-placement="bottom" title="Details"><i class="fa-solid fa-pencil"></i></a>
            <a href="<?= $model->getVideoLink() ?>" class="text-muted " data-bs-toggle="tooltip" data-bs-placement="bottom" title="View on YouTube"><i class="fa-brands fa-youtube"></i></a>
            <a href="<?= Url::toRoute(['/video/delete', 'video_id' => $model->video_id]) ?>" data-method="post" data-confirm="Permanently delete this video?" class="text-muted " data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete"><i class="fa-regular fa-trash-can"></i></a>
        </div>
    </div>
</div>