<?php 
use yii\helpers\StringHelper;
use yii\helpers\Url;
/** 
 * @var \common\models\Video $model
 * @var \common\models\Video $videos
 */

?>

<div class="row text-white mt-3 mx-3">
    <div class="col-md-9">
        <video src="<?= $model->getVideoLink() ?>" poster="<?= $model->getThumbnailLink() ?>" class="rounded w-100" controls></video>
        <h4><?= $model->title ?></h4>

        <div class="d-flex p-0 pt-2 align-items-center ">
            <div style="width: 45px;" class="me-3">
                <div class="rounded-circle w-100 bg-secondary ratio ratio-1x1"></div>
            </div>
            <div>
                <div class="fs-5"><?= $model->createdBy->username ?></div>
                <div class="text-muted">1M subcribers</div>
            </div>
            <button type="button" class="btn btn-light rounded-pill mx-3">Subscribe</button>
            <div class="video-likes d-flex justify-content-between ms-auto">
                <a href="#" class="text-decoration-none text-light">
                    <span class="likes border-end ps-3 pe-2 py-2">
                        <i class="fa-regular fa-thumbs-up"></i> 2.2K 
                    </span>
                </a>
                <a href="#" class="text-decoration-none text-light">
                    <span class="dislikes pe-3 ps-2 py-2">
                        <i class="fa-regular fa-thumbs-down"></i> 
                    </span>
                </a>
            </div>
        </div>

        <div class="w-100 rounded-3 description-box mt-2 p-3">
            <div class="d-flex fw-bold">
                <div class="me-3">123 views</div>
                <div><?= Yii::$app->formatter->asRelativeTime($model->created_at) ?></div>
            </div>
            <div class="mt-2"><?= $model->description ?></div>
        </div>
    </div>
    <div class="col-md-3">
        <?php foreach($videos as $video) : ?>
        <div class="bg-transparent text-light border-0 d-flex flex-row mt-2" >
            <a href="<?= Url::to(['/video/view', 'video_id' => $video->video_id]) ?>">
                <div class="ratio ratio-16x9 rounded" style="width: 150px;">
                    <video src="<?= $video->getVideoLink() ?>" poster="<?= $video->getThumbnailLink() ?>" class="rounded"></video>
                </div>
            </a>
            <div class=" px-3">
                <div>
                    <h6 class="card-title" style="font-size: 0.875rem;"><?= StringHelper::truncateWords($video->title, 7) ?></h6>
                    <div class="card-text text-muted mt-1" style="font-size: 0.75rem;"><?= $video->createdBy->username ?></div>
                    <div class="card-text text-muted" style="font-size: 0.75rem;">
                        <span>123 views &middot</span>    
                        <?= Yii::$app->formatter->asRelativeTime($video->created_at) ?>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>