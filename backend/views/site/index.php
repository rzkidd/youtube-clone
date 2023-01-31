<?php 

/**
 * @var \common\models\Video $latestVideo
 * @var integer $viewsCount
 * @var integer $subscribersCount
 */

use yii\helpers\StringHelper;

$duration = explode(',' ,Yii::$app->formatter->asDuration(time() - $latestVideo->created_at));
$strDuration = $duration[0] . $duration[1];
?>

<h1 class="text-light fs-4 fw-bold mb-3">Channel dashboard</h1>
<div class="row">
    <div class="col-md-4">
        <div class="card w-100 p-3 text-light border-secondary" style="background-color: var(--bg-color);">
            <h5 class="card-title fw-bold">Latest video performance</h5>
            <div class="ratio ratio-16x9 rounded my-3 position-relative dashboard-video">
                <img src="<?= $latestVideo->getThumbnailLink() ?>" alt="" class="rounded">
                <div class="title-overlay position-absolute text-light"><?= StringHelper::truncateWords($latestVideo->title, 5) ?></div>
            </div>

            <p class="card-text text-muted">First <?= $strDuration ?> :</p>
            <div class="d-flex justify-content-between">
                <div class="card-text">Views</div>
                <div class="card-text"><?= $latestVideo->getViews()->count() ?></div>
            </div>
            <div class="d-flex justify-content-between pt-2">
                <div class="card-text">Likes</div>
                <div class="card-text"><?= $latestVideo->getLikes()->count() ?></div>
            </div>
        </div>
        
    </div>
    <div class="col-md-4">
        <div class="card w-100 p-3 text-light border-secondary" style="background-color: var(--bg-color);">
            <h5 class="card-title fw-bold">Channel analytics</h5>
            <div class="pb-3 border-bottom border-secondary">
                Current subscribers
                <p class="fs-1"><?= $subscribersCount ?></p>
            </div>
            
            <div class="pt-2 pb-3 border-bottom border-secondary">
                <span class="fw-bold">Summary</span>
                <div class="d-flex justify-content-between mt-2">
                    <p class="card-text">Views</p>
                    <p class="card-text"><?= $viewsCount ?></p>
                </div>
            </div>
            
        </div>
        
    </div>
</div>