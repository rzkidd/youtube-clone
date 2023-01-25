<?php

use common\models\VideoLike;
use yii\helpers\Url;

?>
<a href="<?= Url::to(['/video/like', 'video_id' => $model->video_id]) ?>" class="text-decoration-none text-light" data-method="post" data-pjax='1'>
    <span class="likes border-end ps-3 pe-2 py-2">
        <?= $model->liked() ? '<i class="fa-solid fa-thumbs-up"></i>' : '<i class="fa-regular fa-thumbs-up"></i>' ?>
        <?= $model->getLikes()->andWhere(['type' => VideoLike::TYPE_LIKE])->count() ?>
    </span>
</a>
<a href="<?= Url::to(['/video/dislike', 'video_id' => $model->video_id]) ?>" class="text-decoration-none text-light" data-method="post" data-pjax='1'>
    <span class="dislikes pe-3 ps-2 py-2">
        <?= $model->disliked() ? '<i class="fa-solid fa-thumbs-down"></i>' : '<i class="fa-regular fa-thumbs-down"></i>' ?>
        <?= $model->getLikes()->andWhere(['type' => VideoLike::TYPE_DISLIKE])->count() ?>
    </span>
</a>