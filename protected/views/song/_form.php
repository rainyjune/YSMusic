<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'song-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'order_in_playlist'); ?>
		<?php echo $form->textField($model,'order_in_playlist'); ?>
		<?php echo $form->error($model,'order_in_playlist'); ?>
	</div>

	<div class="row">
		<?php echo $form->hiddenField($model,'playlist_id',array('value'=>!empty($model->playlist_id)?$model->playlist_id:$playlist->id)); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'url'); ?>
		<?php echo $form->textField($model,'url',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'url'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'lyric'); ?>
		<?php echo $form->textArea($model,'lyric',array('rows'=>10, 'cols'=>62)); ?>
		<?php echo $form->error($model,'lyric'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>10, 'cols'=>62)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
