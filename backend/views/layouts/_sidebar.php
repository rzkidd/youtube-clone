<?php

use yii\bootstrap5\Nav;
?>
<aside class="shadow border-end border-secondary">
    <div class="d-flex flex-column align-items-center my-4">
        <div class="rounded-circle w-50 bg-secondary ratio ratio-1x1"></div>
        <div class="mt-3 text-center">
            <div class="fw-bold fs-6 text-light">Your Channel</div>
            <div class="text-muted"><?= Yii::$app->user->identity->username ?></div>
        </div>
    </div>
    <?= Nav::widget([
        'options' => [
            'class' => 'd-flex flex-column nav-pills'
        ],
        'items' => [
            [
                'label' => '
                <div class="d-flex align-items-center">
                    <i class="fa-solid fa-table-columns fs-4 me-3"></i> Dashboard
                </div>',
                'url' => ['site/index'],
                'encode' => false
            ],
            [
                'label' => '
                <div class="d-flex align-items-center">
                    <i class="fa-solid fa-video fs-4 me-3"></i> Videos
                </div>',
                'url' => ['/video/index'],
                'encode' => false
            ]
        ]
    ]) ?>
</aside>