<?php
/**
 * @var User $user
 */
?>
<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'user-form',
    'enableAjaxValidation' => false,
)); ?>

<?php foreach (['name', 'username', 'phone', 'website'] as $attr): ?>
    <div class="row mx-2">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><?= $user->attributeLabels()[$attr] ?></span>
            </div>
            <?= $form->textField($user, $attr, ['class' => 'form-control']) ?>
            <?= $form->error($user, $attr) ?>
        </div>
    </div>
<?php endforeach; ?>
<div class="row mx-2">
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text"><?= $user->attributeLabels()['email'] ?></span>
        </div>
        <?= $form->emailField($user, 'email', ['class' => 'form-control']) ?>
        <?= $form->error($user, 'email') ?>
    </div>
</div>

<div class="row">
    <div class="col-12 col-sm-12">
        <?= CHtml::submitButton($user->isNewRecord ? 'create' : 'save', ['class' => 'btn btn-success w-100']) ?>
    </div>
</div>
<?php $this->endWidget(); ?>


<?php if (!$user->isNewRecord): ?>
    <div class="row my-2">

        <div class="col-6 col-sm-6">
            <?php if ($user->address_id != null): ?>
                <a class="text-center" href="<?=Yii::app()->baseUrl?>/address/update/id/<?= $user->address_id ?>">
                    <button class="btn btn-success w-100">
                        <i class="fas fa-map-marked"></i>
                        Update Address
                    </button>
                </a>
            <?php else: ?>
                <a class="text-center" href="<?=Yii::app()->baseUrl?>/address/create/id/<?= $user->id ?>">
                    <button class="btn btn-warning w-100">
                        <i class="fas fa-map-marked"></i>
                        Create Address
                    </button>
                </a>
            <?php endif; ?>
        </div>

        <div class="col-6 col-sm-6">
            <?php if ($user->company_id != null): ?>
                <a class="text-center" href="<?=Yii::app()->baseUrl?>/company/update/id/<?= $user->company_id ?>">
                    <button class="btn btn-success w-100">
                        <i class="fas fa-suitcase"></i>
                        Update Company
                    </button>
                </a>
            <?php else: ?>
                <a class="text-center" href="<?=Yii::app()->baseUrl?>/company/create/id/<?= $user->id ?>">
                    <button class="btn btn-warning w-100">
                        <i class="fas fa-suitcase"></i>
                        Create Company
                    </button>
                </a>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>
