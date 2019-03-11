<?php
/**
 * @var Address $address
 */
?>
<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'address-form',
    'enableAjaxValidation' => false,
)); ?>
<?php foreach (['street', 'suite', 'city', 'zipcode','lat','lng'] as $attr): ?>
    <div class="row mx-2">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><?= $address->attributeLabels()[$attr] ?></span>
            </div>
            <?= $form->textField($address, $attr, ['class' => 'form-control']) ?>
            <?= $form->error($address, $attr) ?>
        </div>
    </div>
<?php endforeach; ?>

<div class="row">
    <?= CHtml::submitButton($address->isNewRecord? 'create' : 'save', ['class' => 'btn btn-success w-100']) ?>
</div>
<?php $this->endWidget(); ?>
