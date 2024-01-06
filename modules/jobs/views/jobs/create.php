<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\jobs\models\Jobs $model */

$this->title = Yii::t('app', 'Create New');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Jobs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jobs-create">

    <p>
        <?= Html::a('<i class="fa fa-chevron-left"></i> ' . Yii::t('app', 'Go Back'), ['index'], ['class' => 'btn btn-primary']) ?>
    </p>
    
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>