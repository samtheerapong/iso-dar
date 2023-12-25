<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\nfc\models\PartDoc $model */

$this->title = Yii::t('app', 'Create Part Doc');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Part Docs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="part-doc-create">
    <p>
        <?= Html::a('<i class="fas fa-circle-left"></i> ' . Yii::t('app', 'Go Back'), ['index'], ['class' => 'btn btn-primary']) ?>
    </p>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>