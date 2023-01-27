<?php 
/** @var $model \common\model\Video */

use yii\helpers\StringHelper;
use yii\helpers\Url;

?>

<div class="bg-transparent text-light border-0 d-flex flex-row mt-2" >
    <a href="<?= Url::to(['/video/view', 'video_id' => $model->video_id]) ?>">
        <div class="ratio ratio-16x9 rounded" style="width: 360px;">
            <video src="<?= $model->getVideoLink() ?>" poster="<?= $model->getThumbnailLink() ?>" class="rounded"></video>
        </div>
    </a>
    <div class=" px-3">
        <div>
            <a href="<?= Url::to(['/video/view', 'video_id' => $model->video_id]) ?>" class="text-decoration-none text-light">
                <h3 class="card-title "><?= StringHelper::truncateWords($model->title, 7) ?></h3>
            </a>
            <div class="card-text text-muted">
                <span><?= $model->getViews()->count() ?> views &middot</span>    
                <?= Yii::$app->formatter->asRelativeTime($model->created_at) ?>
            </div>
            <div class="card-text text-muted my-3 d-flex align-items-center">
                <div style="width: 30px;" class="me-2">
                    <div class="rounded-circle w-100 bg-secondary ratio ratio-1x1"></div>
                </div>
                <a href="<?= Url::to(['/channel/view', 'username' => $model->createdBy->username]) ?>" class="text-decoration-none text-muted">
                    <?= $model->createdBy->username ?>
                </a>
            </div>
            <div class="card-text text-muted mt-1"><?= StringHelper::truncateWords($model->description, 15) ?></div>
        </div>
    </div>
</div>