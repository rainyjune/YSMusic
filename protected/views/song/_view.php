<div class="view">

	<?php echo CHtml::encode($data->name); ?>

	<b><?php echo CHtml::encode($data->getAttributeLabel('url')); ?>:</b>
	<?php echo CHtml::encode($data->url); ?>
	<br />

	<?php echo CHtml::encode($data->description); ?>
	<br />

</div>
