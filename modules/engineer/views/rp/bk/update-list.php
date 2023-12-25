<?php

use yii\helpers\Html;


$this->title = Yii::t('app', 'List') . ' : ' . $model->request_title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Request'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->repair_code, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="list">

    <p>
        <?= Html::a('<i class="fas fa-chevron-left"></i> ' . Yii::t('app', 'Go Back'), ['index'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= $this->render('_form-list', [
        'model' => $model,
        'modelsList' => $modelsList,
    ]) ?>

</div>