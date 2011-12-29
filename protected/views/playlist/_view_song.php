<div class="view">

	<?php echo CHtml::link(CHtml::encode($data->name),array('song/view','id'=>$data->id)); ?>

	<span style="float:right;" ><?php echo CHtml::link('Download',CHtml::encode($data->url)); ?></span>
	<br />

	<?php echo CHtml::encode($data->description); ?>
	<br />

</div>
