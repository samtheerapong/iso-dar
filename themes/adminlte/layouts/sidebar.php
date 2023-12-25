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

                    // Engineering
                    [
                        'label' => Yii::t('app', 'Engineering'),
                        'header' => true
                    ],
                    [
                        'label' => Yii::t('app', 'Repair'),
                        'iconStyle' => 'fa', 'iconStyle' => 'fa', 'icon' => 'fa-solid fa-circle-play text-yellow',
                        'items' => [
                            ['label' => Yii::t('app', 'Requester'),     'url' => ['/engineer/rp/index'], 'iconStyle' => 'fa', 'icon' => 'fa-regular fa-circle-plus'],
                            ['label' => Yii::t('app', 'List'),          'url' => ['/engineer/rp-list/index'], 'iconStyle' => 'fa', 'icon' => 'fa-solid fa-circle-plus'],
                            ['label' => Yii::t('app', 'Approval'),      'url' => ['/engineer/rp-approve/index'], 'iconStyle' => 'fa', 'icon' => 'fa-solid fa-circle-plus'],
                        ]

                    ],

                    [
                        'label' => Yii::t('app', 'Work Order'),
                        'iconStyle' => 'fa', 'iconStyle' => 'fa', 'icon' => 'fa-solid fa-circle-play text-yellow',
                        'items' => [
                            ['label' => Yii::t('app', 'Worker'),        'url' => ['/engineer/wo/index'], 'iconStyle' => 'fa', 'icon' => 'fa-regular fa-circle-plus'],
                            ['label' => Yii::t('app', 'List'),          'url' => ['/engineer/wo-list/index'], 'iconStyle' => 'fa', 'icon' => 'fa-solid fa-circle-plus'],
                            ['label' => Yii::t('app', 'Approval'),      'url' => ['/engineer/wo-approve/index'], 'iconStyle' => 'fa', 'icon' => 'fa-solid fa-circle-plus'],
                            // ['label' => Yii::t('app', 'Actor'), 'url' => ['/engineer/actor/index'], 'iconStyle' => 'fa', 'icon' => 'fa-regular fa-circle-plus'],
                        ]

                    ],

                    // Systems
                    [
                        'label' => Yii::t('app', 'Data Files'),
                        'header' => true
                    ],

                    [
                        'label' => Yii::t('app', 'Product Settings'),
                        'iconStyle' => 'fa', 'iconStyle' => 'fa', 'icon' => 'fa-solid fa-cog text-yellow',
                        'items' => [
                            ['label' => Yii::t('app', 'Locations'),     'url' => ['/nfc/location/index'], 'iconStyle' => 'fa', 'icon' => 'fa-regular fa-circle-chevron-right'],
                            ['label' => Yii::t('app', 'Departments'),   'url' => ['/nfc/department/index'], 'iconStyle' => 'fa', 'icon' => 'fa-regular fa-circle-chevron-right'],
                            ['label' => Yii::t('app', 'Units'),         'url' => ['/nfc/unit/index'], 'iconStyle' => 'fa', 'icon' => 'fa-regular fa-circle-chevron-right'],
                            ['label' => Yii::t('app', 'Parts'),         'url' => ['/nfc/part/index'], 'iconStyle' => 'fa', 'icon' => 'fa-regular fa-circle-chevron-right'],
                            ['label' => Yii::t('app', 'Part Docs'),     'url' => ['/nfc/part-doc/index'], 'iconStyle' => 'fa', 'icon' => 'fa-regular fa-circle-chevron-right'],
                            ['label' => Yii::t('app', 'Part Groups'),   'url' => ['/nfc/part-group/index'], 'iconStyle' => 'fa', 'icon' => 'fa-regular fa-circle-chevron-right'],
                            ['label' => Yii::t('app', 'Part Types'),    'url' => ['/nfc/part-type/index'], 'iconStyle' => 'fa', 'icon' => 'fa-regular fa-circle-chevron-right'],
                            ['label' => Yii::t('app', 'Warehouses'),    'url' => ['/nfc/warehouse/index'], 'iconStyle' => 'fa', 'icon' => 'fa-regular fa-circle-chevron-right'],
                        ],
                    ],
                    [
                        'label' => Yii::t('app', 'Engineer Settings'),
                        'iconStyle' => 'fa', 'iconStyle' => 'fa', 'icon' => 'fa-solid fa-cog text-yellow',
                        'items' => [
                            ['label' => Yii::t('app', 'Technicians'),   'url' => ['/engineer/technician/index'], 'iconStyle' => 'fa', 'icon' => 'fa-regular fa-circle-chevron-right'],
                            ['label' => Yii::t('app', 'Priorities'),    'url' => ['/engineer/priority/index'], 'iconStyle' => 'fa', 'icon' => 'fa-regular fa-circle-chevron-right'],
                            ['label' => Yii::t('app', 'Urgencies'),     'url' => ['/engineer/urgency/index'], 'iconStyle' => 'fa', 'icon' => 'fa-regular fa-circle-chevron-right'],
                            ['label' => Yii::t('app', 'Categories'),    'url' => ['/engineer/category/index'], 'iconStyle' => 'fa', 'icon' => 'fa-regular fa-circle-chevron-right'],
                            ['label' => Yii::t('app', 'Statuses'),      'url' => ['/engineer/status/index'], 'iconStyle' => 'fa', 'icon' => 'fa-regular fa-circle-chevron-right'],
                            ['label' => Yii::t('app', 'Machines'),      'url' => ['/engineer/machine/index'], 'iconStyle' => 'fa', 'icon' => 'fa-regular fa-circle-chevron-right'],
                            ['label' => Yii::t('app', 'Work Types'),    'url' => ['/engineer/work-type/index'], 'iconStyle' => 'fa', 'icon' => 'fa-regular fa-circle-chevron-right'],
                            // ['label' => Yii::t('app', 'team'), 'url' => ['/engineer/team/index'], 'iconStyle' => 'fa', 'icon' => 'fa-regular fa-circle-chevron-right'],
                            // ['label' => Yii::t('app', 'upload'), 'url' => ['/engineer/upload/index'], 'iconStyle' => 'fa', 'icon' => 'fa-regular fa-circle-chevron-right'],
                        ]
                    ],

                    [
                        'label' => Yii::t('app', 'Companies Settings'),
                        'iconStyle' => 'fa', 'iconStyle' => 'fa', 'icon' => 'fa-solid fa-cog text-yellow',
                        'items' => [

                            ['label' => Yii::t('app', 'User'),          'url' => ['/user/index'], 'iconStyle' => 'fa', 'icon' => 'fa-regular fa-user-plus'],
                            ['label' => Yii::t('app', 'Profile'),       'url' => ['/user/profile'], 'iconStyle' => 'fa', 'icon' => 'fa-solid fa-user-edit'],
                            ['label' => Yii::t('app', 'Auto Number'),   'url' => ['/auto-number/index'], 'iconStyle' => 'fa', 'icon' => 'fa-solid fa-code'],
                            // [
                            //     'label' => Yii::t('app', 'Configuration'),
                            //     'iconStyle' => 'fa', 'iconStyle' => 'fa', 'icon' => 'fa-solid fa-cogs',
                            //     'items' => [
                            //         ['label' => Yii::t('app', 'Profile'), 'url' => ['/user/profile'], 'iconStyle' => 'fa', 'icon' => 'fa-solid fa-user-edit'],
                            //     ]
                            // ],
                        ]
                    ],
                ],
            ]);
            ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>