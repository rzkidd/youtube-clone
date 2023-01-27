<?php 
/** @var $model \common\model\Video */

use yii\helpers\StringHelper;
use yii\helpers\Url;

?>

<div class="card bg-transparent text-light border-0" >
    <a href="<?= Url::to(['/video/view', 'video_id' => $model->video_id]) ?>" class="text-decoration-none text-light">
        <div class="ratio ratio-16x9 rounded" style="width: 100%;">
            <video src="<?= $model->getVideoLink() ?>" poster="<?= $model->getThumbnailLink() ?>" class="rounded"></video>
        </div>
        <div class="card-body d-flex p-0 pt-2 mb-3">
            <div>
                <!-- <a href="<?= Url::to(['/video/view', 'video_id' => $model->video_id]) ?>" class="text-decoration-none text-light"> -->
                    <h6 class="card-title"><?= StringHelper::truncateWords($model->title, 5) ?></h6>
                <!-- </a> -->
                <div class="card-text text-muted" style="font-size: 0.875rem;">
                    <span><?= $model->getViews()->count() ?> views &middot</span>    
                    <?= Yii::$app->formatter->asRelativeTime($model->created_at) ?>
                </div>
            </div>
        </div>
    </a>
</div>

