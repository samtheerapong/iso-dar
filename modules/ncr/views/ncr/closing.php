<?php

use yii\helpers\Html;
use kartik\grid\GridView;

?>
<div class="rp-list-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => [$searchModel],
        'summary' => '',
        'columns' => [
            // [
            //     'class' => 'yii\grid\SerialColumn',
            //     'contentOptions' => ['class' => 'text-center', 'style' => 'width:45px;'],
            // ],
           'id',
           
        ],
    ]); ?>
</div>