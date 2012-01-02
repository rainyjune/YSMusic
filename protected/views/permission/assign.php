<?php
$this->breadcrumbs=array(
	'Permissions'=>array('index'),
	'Assignment'=>array('assignment'),
	'test'
);
?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'assignment-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $user->username;?>
		<?php //echo $form->labelEx($model,'password'); ?>
		<?php //echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>128)); ?>
		<?php //echo $form->error($model,'password'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'itemname'); ?>
		<?php echo $form->dropDownList($model,'itemname',AuthItem::getRoles()); ?>
		<?php echo $form->error($model,'itemname'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
