<?php 
/** @var $model \common\model\Video */

use yii\helpers\StringHelper;
use yii\helpers\Url;

?>

<div class="card bg-transparent text-light border-0" style="width: 18rem; ">
    <a href="<?= Url::to(['/video/view', 'video_id' => $model->video_id]) ?>">
        <div class="ratio ratio-16x9 rounded" style="height: 170px;">
            <video src="<?= $model->getVideoLink() ?>" poster="<?= $model->getThumbnailLink() ?>" class="rounded"></video>
        </div>
    </a>
        <!-- <img src="<?= $model->getThumbnailLink() ?>" alt="" class="rounded"> -->
        <div class="card-body d-flex p-0 pt-2">
            <div style="width: 50px;" class="me-3">
                <div class="rounded-circle w-100 bg-secondary ratio ratio-1x1"></div>
            </div>
            <div>
                <a href="<?= Url::to(['/video/view', 'video_id' => $model->video_id]) ?>" class="text-decoration-none text-light">
                    <h6 class="card-title"><?= StringHelper::truncateWords($model->title, 5) ?></h6>
                </a>
                <div class="card-text text-muted"><?= $model->createdBy->username ?></div>
                <div class="card-text text-muted">
                    <span><?= $model->getViews()->count() ?> views &middot</span>    
                    <?= Yii::$app->formatter->asRelativeTime($model->created_at) ?>
                </div>
            </div>
        </div>
</div>

