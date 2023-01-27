<?php

use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\helpers\Url;

NavBar::begin([
    'brandLabel' => '<div class="d-flex align-items-center"><i class="fa-brands fa-youtube me-2" style="color: red; font-size: 30px"></i>' . Yii::$app->name . '</div>',
    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        'class' => 'navbar navbar-expand-md navbar-dark shadow',

    ],
    'innerContainerOptions' => [
        'class' => 'container-fluid ms-5'
    ]
]);

if (Yii::$app->user->isGuest){
    $menuItems = [
        [
            'label' => '
            <div class="row justify-content-between">
                <div class="col-md-2">
                    <i class="fa-regular fa-user"></i>
                </div>
                <div class="col-auto">Sign In</div>
            </div>
            ', 
            'url' => ['/site/login'], 
            'options' => [
                'id' => 'create_nav',
                'class' => 'px-2 d-flex'
            ],
            'linkOptions' => [
                'class' => 'border border-primary border-1 rounded py-2 px-3 align-self-center text-primary'
            ],
            'encode' => false
        ],
    ];
} else {
    $menuItems = [
        [
            'label' => '<i class="fa-solid fa-video"></i> CREATE', 
            'url' => ['/video/create'], 
            'options' => [
                'id' => 'create_nav',
                'class' => ' px-2 d-flex'
            ],
            'linkOptions' => [
                'class' => 'border border-secondary border-1 rounded py-2 px-3 align-self-center fw-bold text-light'
            ],
            'encode' => false
        ],
    ];

    $menuItems[] = [
        'label' => '<div class="rounded-circle w-100 bg-secondary ratio ratio-1x1"></div>',
        'items' => [
            '<div class="d-flex align-items-center px-3 py-2">
                <div class="rounded-circle bg-secondary ratio ratio-1x1 me-2" style="width: 55px"></div>
                <div class="">' . Yii::$app->user->identity->username . '</div>
            </div>',
            '<div class="dropdown-divider bg-secondary"></div>',
            [
                'label' => '
                <div class="row">
                    <div class="col-md-2">
                        <i class="fa-regular fa-user"></i>
                    </div>
                    <div class="col-auto">Your channel</div>
                </div>
                ', 
                'url' => ['#'],
                'encode' => false
            ],
            [
                'label' => '
                <div class="row">
                    <div class="col-md-2">
                        <i class="fa-brands fa-youtube"></i>
                    </div>
                    <div class="col-auto">Youtube</div>
                </div>
                ', 
                'url' => Yii::$app->params['frontendUrl'],
                'encode' => false
            ],
            [
                'label' => '
                <div class="row">
                    <div class="col-md-2">
                        <i class="fa-solid fa-arrow-right-to-bracket"></i>
                    </div>
                    <div class="col-auto">Sign out</div>
                </div>
                ', 
                'url' => ['/site/logout'], 
                'linkOptions' => [
                    'data-method' => 'post',
                ],
                'encode' => false
            ],
        ],
        'encode' => false,
        'options' => [
            'style' => 'width: 50px',
            'class' => 'position-relative',
            'id' => 'profile_icon'
        ],
        'dropdownOptions' => [
            'class' => 'end-0 dropdown-menu-dark border border-secondary',
            'style' => 'width: 250px'
        ]
    ];
}
?>
    <form action="<?= Url::to(['video/search']) ?>" class="input-group w-50 mx-auto search" id="search-bar">
        <input type="text" class="form-control bg-transparent border-secondary px-3 text-light" placeholder="Search" 
            name="keyword" value="<?= Yii::$app->request->get('keyword') ?>">
        <button class="input-group-text px-4 border-secondary" style="background-color: var(--hover-bg-lighter);"><i class="fa-solid fa-magnifying-glass text-light"></i></button>
    </form>
<?php
echo Nav::widget([
    'options' => ['class' => 'navbar-nav mb-2 mb-md-0'],
    'items' => $menuItems,
]);

NavBar::end();
?>