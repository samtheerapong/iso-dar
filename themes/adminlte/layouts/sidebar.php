<?php

use yii\helpers\Url;
?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= Url::toRoute('/site/index') ?>" class="brand-link">
        <img src="<?= Yii::getAlias('@web/') ?>images/nfc-logo.png" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light"><?= Yii::$app->name ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">


        <!-- SidebarSearch Form -->
        <!-- href be escaped -->
        <div class="form-inline  mt-2 pb-1 d-flex">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <?php
            echo \hail812\adminlte\widgets\Menu::widget([
                'items' => [

                    [
                        'label' => Yii::t('app', 'QC'),
                        'header' => true,
                        'options' => ['class' => 'nav nav-pills nav-sidebar flex-column'],
                    ],
                    [
                        'label' => Yii::t('app', 'NCR '),
                        'iconStyle' => 'fa', 'iconStyle' => 'fa', 'icon' => 'fa-solid fa-circle-chevron-down text-yellow',
                        'items' => [
                            ['label' => Yii::t('app', 'NCR'),'url' => ['/ncr/ncr/index'], 'iconStyle' => 'fa', 'icon' => 'fa-solid fa-location-crosshairs'],
                            ['label' => Yii::t('app', 'Reply'),'url' => ['/ncr/ncr-reply/index'], 'iconStyle' => 'fa', 'icon' => 'fa-solid fa-reply'],
                            ['label' => Yii::t('app', 'Protection'),'url' => ['/ncr/ncr-protection/index'], 'iconStyle' => 'fa', 'icon' => 'fa-solid fa-shield'],
                            ['label' => Yii::t('app', 'Closing'),'url' => ['/ncr/ncr-closing/index'], 'iconStyle' => 'fa', 'icon' => 'fa-solid fa-circle-check'],
                            [
                                'label' => Yii::t('app', 'Export'),
                                'iconStyle' => 'fa', 'iconStyle' => 'fa', 'icon' => 'fa-solid fa-download text-green',
                                'items' => [
                                    ['label' => Yii::t('app', 'NCR'),          'url' => ['/ncr/export/export-ncr'], 'iconStyle' => 'fa', 'icon' => 'fa-solid fa-file-export'],
                                    ['label' => Yii::t('app', 'Reply'),   'url' => ['/ncr/export/export-reply'], 'iconStyle' => 'fa', 'icon' => 'fa-solid fa-file-export'],
                                    ['label' => Yii::t('app', 'Protection'),       'url' => ['/ncr/export/export-protection'], 'iconStyle' => 'fa', 'icon' => 'fa-solid fa-file-export'],
                                    ['label' => Yii::t('app', 'Closing'),   'url' => ['/ncr/export/export-closing'], 'iconStyle' => 'fa', 'icon' => 'fa-solid fa-file-export'],
                                ],
                            ],
                        ],
                    ],
                    
                    // Systems
                    [
                        'label' => Yii::t('app', 'Data Files'),
                        'header' => true
                    ],
                    [
                        'label' => Yii::t('app', 'Companies Settings'),
                        'iconStyle' => 'fa', 'iconStyle' => 'fa', 'icon' => 'fa-solid fa-cog text-yellow',
                        'items' => [

                            ['label' => Yii::t('app', 'User'),          'url' => ['/user/index'], 'iconStyle' => 'fa', 'icon' => 'fa-regular fa-user-plus'],
                            ['label' => Yii::t('app', 'Profile'),       'url' => ['/user/profile'], 'iconStyle' => 'fa', 'icon' => 'fa-solid fa-user-edit'],
                            ['label' => Yii::t('app', 'Auto Number'),   'url' => ['/auto-number/index'], 'iconStyle' => 'fa', 'icon' => 'fa-solid fa-code'],
                        ],
                    ],
                ],
            ]);
            ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>