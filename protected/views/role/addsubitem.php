<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'auth-item-child-addsubitem-form',
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'child'); ?>
		<?php echo $form->textField($model,'child'); ?>
		<?php echo $form->error($model,'child'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
