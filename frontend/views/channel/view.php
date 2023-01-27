<?php 
use yii\helpers\Url;
use yii\widgets\ListView;
use yii\widgets\Pjax;

/**
 * @var \common\models\User $channel
 * @var \yii\web\View $this
 */
?>

<div class="container-fluid border-bottom border-secondary">
    <div class="bg-secondary w-100" style="height: 25vh;"></div>
    <div class="d-flex align-items-center justify-content-between mx-auto mt-3" style="width: 80%;">
        <div class="d-flex align-items-center">
            <div style="width: 80px;" class="me-3">
                <div class="rounded-circle w-100 bg-secondary ratio ratio-1x1"></div>
            </div>
            <div>
                <h3 class="fs-3">
                    <a href="<?= Url::to(['channel/view', 'username' => $channel->username]) ?>" class="text-decoration-none text-light"> 
                        <?= $channel->username ?> 
                    </a>
                </h3>
                <div class="text-muted"><?= $channel->getSubscriber()->count() ?> subcribers</div>
            </div>
        </div>
        <?php Pjax::begin() ?>
            <?= $this->render('_subscribe', [
                    'channel' => $channel
                ]) ?>
        <?php Pjax::end() ?>
    </div>

    <!-- nav -->
    <ul class="channel-nav nav mx-auto mt-3 sticky-top" style="width: 80%;">
        <li class="nav-item">
            <a class="nav-link active text-muted px-4" aria-current="page" href="#">HOME</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-muted px-4" href="#">VIDEOS</a>
        </li>
    </ul>

</div>

<?= ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_video_item',
    'itemOptions' => [
        'class' => 'col mb-3 pb-3 px-2'
    ],
    'options' => [
        'class' => 'row row-cols-5 mt-3 mx-auto',
        'style' => 'width: 80%;'
    ],
    'layout' => '{items}{pager}'
]); ?>