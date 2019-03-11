<?php
/**
 * @var Company $company
 */
?>
<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'company-form',
    'enableAjaxValidation' => false,
)); ?>
<?php foreach (['name', 'catchPhrase', 'bs'] as $attr): ?>
    <div class="row mx-2">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><?= $company->attributeLabels()[$attr] ?></span>
            </div>
            <?= $form->textField($company, $attr, ['class' => 'form-control']) ?>
        </div>
    </div>
<?php endforeach; ?>

<div class="row">
    <?= CHtml::submitButton($company->isNewRecord? 'create' : 'save', ['class' => 'btn btn-success w-100']) ?>
</div>
<?php $this->endWidget(); ?>
