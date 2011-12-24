<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('order_in_playlist')); ?>:</b>
	<?php echo CHtml::encode($data->order_in_playlist); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('playlist_id')); ?>:</b>
	<?php echo CHtml::encode($data->playlist_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('url')); ?>:</b>
	<?php echo CHtml::encode($data->url); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lyric')); ?>:</b>
	<?php echo CHtml::encode($data->lyric); ?>
	<br />


</div>