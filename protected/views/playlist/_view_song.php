<div class="view">

	<?php echo CHtml::link(CHtml::encode($data->name),array('song/view','id'=>$data->id)); ?>

	<b><?php echo CHtml::encode($data->getAttributeLabel('url')); ?>:</b>
	<?php echo CHtml::encode($data->url); ?>
	<br />

	<?php echo CHtml::encode($data->description); ?>
	<br />

</div>
