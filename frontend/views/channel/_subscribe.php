<?php

use yii\helpers\Url;

/**
 * @var \common\models\User $channel
 */

?>

<?php if ($channel->id === Yii::$app->user->id) :?>

    <a href="<?= Yii::$app->params['backendUrl'] ?>" 
        class="btn btn-primary text-black rounded-pill mx-3">
        Customize channel
    </a>

<?php else : ?>

    <a href="<?= Url::to(['channel/subscribe', 'username' => $channel->username]) ?>" 
        class="btn <?= ($channel->isSubscribed(Yii::$app->user->id)) ? 'btn-secondary' : 'btn-light' ?> rounded-pill mx-3" 
        data-method="post" 
        data-pjax="1"
        <?= $channel->isSubscribed(Yii::$app->user->id) ? 'data-confirm="Unsubscribe from ' . $channel->username . '?"' : ''?>>
        <?= ($channel->isSubscribed(Yii::$app->user->id)) ? 
            '<i class="fa-regular fa-bell"></i> Subscribed' 
            : 'Subscribe' ?>
        
    </a>

<?php endif ?>