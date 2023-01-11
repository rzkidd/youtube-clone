<?php

use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

NavBar::begin([
    'brandLabel' => Yii::$app->name,
    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        'class' => 'navbar navbar-expand-md navbar-dark shadow',

    ],
    'innerContainerOptions' => [
        'class' => 'container-fluid'
    ]
]);
$menuItems = [
    ['label' => 'Create', 'url' => ['/video/create']],
];
if (Yii::$app->user->isGuest) {
    $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
} else {
    $menuItems[] = [
        'label' => 'Logout (' . Yii::$app->user->identity->username . ')', 
        'url' => ['/site/logout'], 
        'linkOptions' => [
            'data-method' => 'post'
        ]
    ];
}
echo Nav::widget([
    'options' => ['class' => 'navbar-nav ms-auto mb-2 mb-md-0'],
    'items' => $menuItems,
]);

NavBar::end();
?>