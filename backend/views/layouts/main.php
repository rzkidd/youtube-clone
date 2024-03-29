<?php
/** @var \yii\web\View $this */
/** @var string $content */

use backend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
$this->beginContent('@backend/views/layouts/base.php');
?>
<main class="d-flex" >
    <?= $this->render('_sidebar') ?>
    <div class="content-wrapper p-3" style="<?= (Yii::$app->requestedRoute == 'site/index') ? 'background-color: var(--bg-darker);' : '' ?>">
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>
<?php $this->endContent() ?> 