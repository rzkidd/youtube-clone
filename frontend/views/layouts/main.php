<?php
/** @var \yii\web\View $this */
/** @var string $content */

use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
$this->beginContent('@frontend/views/layouts/base.php');
?>
<main class="d-flex">
    <?= $this->render('_sidebar') ?>
    <div class="content-wrapper p-3">
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>
<?php $this->endContent() ?> 