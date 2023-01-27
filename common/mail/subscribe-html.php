<?php 
use yii\helpers\Html;
use yii\helpers\Url;
/**
 * @var \common\models\User $channel
 * @var \common\models\User $user
 */
?>

<p>Hello <?= $channel->username ?></p>
<p>User <?= Html::a($user->username, Url::to(['/channel/view', 'username' => $user->username], true)) ?> has subscribed to your channel.</p>
<br>
<p>Youtube Team</p>