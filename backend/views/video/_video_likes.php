<?php 
/** @var \common\models\Video $model */

use common\models\VideoLike;

$likes = $model->getLikes()->andWhere(['type' => VideoLike::TYPE_LIKE])->count();
$dislikes = $model->getLikes()->andWhere(['type' => VideoLike::TYPE_DISLIKE])->count();
$percentage = ($model->getLikes()->count()) ? 
                    ($likes / $model->getLikes()->count()) * 100
                    : 0;
?>

<div class="d-flex flex-column text-end position-relative like-dislike">
    <div class=" mb-2">
        <?= $percentage . '%' ?>
    </div>
    <div class="text-muted mb-2"><?= $model->getLikes()->andWhere(['type' => VideoLike::TYPE_LIKE])->count() ?> like(s)</div>
    <div class="progress bg-secondary" style=" height: 4px;">
        <div class="progress-bar bg-light" style="width: <?= $percentage . '%' ?>;" role="progressbar" aria-valuenow="<?= $percentage ?>" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
    <div class="hover-like-dislike w-100 p-3 position-absolute bottom-100 start-0 rounded mb-2 border border-secondary" style="background-color: var(--hover-bg-color); transform: scale(0);">
        <div class="d-flex justify-content-between">
            <div>
                <i class="fa-regular fa-thumbs-up"></i>
                <?= $likes ?>
            </div>
            <div>
                <i class="fa-regular fa-thumbs-down text-muted"></i>
                <?= $dislikes ?>
            </div>
        </div>
    </div>
</div>