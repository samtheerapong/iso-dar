<?php

use kartik\helpers\Html;
use yii\bootstrap5\Nav;
use yii\helpers\Url;

?>
<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">

    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <!-- <li class="nav-item d-none d-sm-inline-block">
            <a href="<?= \yii\helpers\Url::home() ?>" class="nav-link"><?= Yii::t('app', 'Home') ?></a>
        </li> -->
        <li class="nav-item d-none d-sm-inline-block">
            <a href="<?= Url::toRoute('/site/index') ?>" class="nav-link"> <?= Yii::t('app', 'Home') ?></a>
        </li>

        <li class="nav-item d-none d-sm-inline-block">
            <a href="<?= Url::toRoute('/engineer/rp/create') ?>" class="nav-link"> <?= Yii::t('app', 'Request') ?></a>
        </li>

       
      
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <?php
        if (Yii::$app->user->isGuest) {
            // echo Html::tag('li', Html::a(Yii::t('app', 'Register'), ['/site/signup'], ['class' => 'nav-link']));
            echo Html::tag('li', Html::a(Yii::t('app', 'Login'), ['/site/login'], ['class' => 'nav-link']));
        } else {
            $nameToDisplay = Yii::$app->user->identity->thai_name ?: Yii::$app->user->identity->username;
            $menuItems = [
                [
                    'label' => Yii::t('app', 'Configuration'),
                    'visible' => in_array(Yii::$app->user->identity->username, ['admin', 'theerapong']),
                    'items' => [
                        [
                            'label' => Yii::t('app', 'Auto Number'),
                            'visible' => in_array(Yii::$app->user->identity->username, ['admin']),
                            'url' => ['/auto-number/index'],
                        ],
                        [
                            'label' => Yii::t('app', 'Profile'),
                            'url' => ['/user/view', 'id' => Yii::$app->user->identity->id],
                        ],
                        [
                            'label' => Yii::t('app', 'Users'),
                            'url' => ['/user/index'],
                        ],
                    ],
                ],
                [
                    'label' => Yii::$app->language == 'th-TH' ? 'TH' : 'EN',
                    'url' => Url::current(['language' => Yii::$app->language == 'th-TH' ? 'en-US' : 'th-TH']),
                    'linkOptions' => ['class' => 'active'],
                ],
                [
                    'label' => "( $nameToDisplay )",
                    'items' => [
                        ['label' => Yii::t('app', 'Logout'), 'url' => ['/site/logout'], 'linkOptions' => ['class' => 'logout-link', 'data-method' => 'post']],
                    ],
                ],
            ];
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav ml-auto'],
                'items' => $menuItems,
            ]);
        }
        ?>

        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                <i class="fas fa-th-large"></i>
            </a>
        </li>
    </ul>

</nav>