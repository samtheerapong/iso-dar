<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\ncr\models\NcrReply $model */

$this->title = Yii::t('app', 'Create Ncr Reply');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ncr Replies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ncr-reply-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
