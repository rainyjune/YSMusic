<div class="form">

<?php
$this->menu=array(
	array('label'=>'Public Profile', 'url'=>array('index')),
	array('label'=>'Account Admin', 'url'=>array('admin')),
);
?>

<?php if(Yii::app()->user->hasFlash('passwordSaved')): ?>
	<div class="flash-success">
		<?php echo Yii::app()->user->getFlash('passwordSaved');?>
	</div>
<?php endif;?>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'passwd-form-admin-form',
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<div class="row">
		<?php echo $form->labelEx($model,'old_password'); ?>
		<?php echo $form->passwordField($model,'old_password'); ?>
		<?php echo $form->error($model,'old_password'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'new_password'); ?>
		<?php echo $form->passwordField($model,'new_password'); ?>
		<?php echo $form->error($model,'new_password'); ?>
		<?php echo $form->passwordField($model,'new_password_confirmation'); ?>
		<?php echo $form->error($model,'new_password_confirmation'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
