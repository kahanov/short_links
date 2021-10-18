<?php
/* @var $this yii\web\View */

/* @var $model \kahanov\short_links\core\forms\CreateForm */

use yii\helpers\Html;
use kartik\form\ActiveForm;

kahanov\short_links\Asset::register($this);

$this->title = Yii::t('app', 'Сервис коротких ссылок');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page short_links">
    <div class="page__content">
        <h1 class="page__title"><?= Html::encode($this->title) ?></h1>
        <div class="page__hint">
            <div class="page__hint_row">
                <?= Yii::t('app', 'Какое то описание') ?>
            </div>
        </div>
        <?php $form = ActiveForm::begin([
            'id' => 'link-form',
            'type' => ActiveForm::TYPE_HORIZONTAL,
            'enableClientValidation' => true,
            'enableAjaxValidation' => false,
            'formConfig' => [
                'labelSpan' => 4,
            ],
        ]); ?>
        <div class="row">
            <div class="col-lg-10 page__center-block">
                <div class="col-md-10">
                    <?= $form->
                    field($model, 'url', [
                        'template' => "{label}\n<div class='col-md-8'>{input}\n{hint}\n{error}</div>",
                    ])->
                    textInput() ?>
                </div>
                <div class="col-md-2">
                    <?= Html::submitButton(Yii::t('app', 'Укоротить') . '<div class="button-submit__preloader"></div>', ['class' => 'button-submit']) ?>
                </div>
            </div>
        </div>
        <div class="short_links__result">
            <div class="row short_links__container">
                <div class="col-sm-6">
                    <span class="short_links__long-url"></span>
                </div>
                <div class="col-sm-3">
                    <span class="short_links__short-url"></span>
                </div>
                <div class="col-sm-3">
                    <?= Html::a(Yii::t('app', 'Копировать'), 'javascript:void(0)', ['class' => 'btn btn-success', 'id' => 'short_links-copy']) ?>
                </div>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
