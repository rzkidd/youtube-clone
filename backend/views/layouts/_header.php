<?php

use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

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
$menuItems = [
    [
        'label' => 'CREATE', 
        'url' => ['/video/create'], 
        'options' => [
            'id' => 'create_nav',
            'class' => ' px-2 d-flex'
        ],
        'linkOptions' => [
            'class' => 'border border-secondary border-1 rounded py-2 px-3 align-self-center fw-bold text-light'
        ]
    ],
];
// if (Yii::$app->user->isGuest) {
//     $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
// } else {
// $menuItems[] = [
//     'label' => 'Logout (' . Yii::$app->user->identity->username . ')', 
//     'url' => ['/site/logout'], 
//     'linkOptions' => [
//         'data-method' => 'post'
//     ]
// ];
$menuItems[] = [
    'label' => '<div class="rounded-circle w-100 bg-secondary ratio ratio-1x1"></div>',
    'items' => [
        '<div class="d-flex align-items-center px-3">
            <div class="rounded-circle bg-secondary ratio ratio-1x1 me-2" style="width: 55px"></div>
            <div class="">Nama Channel</div>
        </div>',
        '<div class="dropdown-divider"></div>',
        [
            'label' => 'Sign out', 
            'url' => ['/site/logout'], 
            'linkOptions' => [
                'data-method' => 'post',
            ]
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
// }
echo Nav::widget([
    'options' => ['class' => 'navbar-nav ms-auto mb-2 mb-md-0'],
    'items' => $menuItems,
]);

NavBar::end();
?>