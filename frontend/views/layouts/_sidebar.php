<?php

use yii\bootstrap5\Nav;
?>
<aside class="shadow border-end border-secondary">
    
    <?= Nav::widget([
        'options' => [
            'class' => 'd-flex flex-column nav-pills'
        ],
        'items' => [
            [
                'label' => '
                <div class="row align-items-center">
                    <div class="col-md-2">
                        <i class="fa-sharp fa-solid fa-house fs-5"></i>
                    </div>
                    <div class="col-auto">
                        Home
                    </div>
                </div>
                ',
                'url' => ['/video'],
                'encode' => false
            ],
            [
                'label' => '
                <div class="row align-items-center">
                    <div class="col-md-2">
                        <i class="fa-solid fa-clock-rotate-left fs-5"></i>
                    </div>
                    <div class="col-auto">
                        History
                    </div>
                </div>
                ',
                'url' => ['/history'],
                'encode' => false
            ]
        ]
    ]) ?>
</aside>