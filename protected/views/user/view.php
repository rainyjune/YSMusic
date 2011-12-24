<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List User', 'url'=>array('index')),
	array('label'=>'Create User', 'url'=>array('create')),
	array('label'=>'Update User', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete User', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage User', 'url'=>array('admin')),
);
?>

<h1>
	<?php 
	echo $model->username; 
	if($model->profile->name)
		echo '('.$model->profile->name.')';
	?>
</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		array(
			'label'=>'Name',
			'value'=>$model->profile->name,
			'visible'=>$model->profile->name,
		),
		array(
			'label'=>'Email',
			'value'=>$model->profile->email,
			'visible'=>$model->profile->email,
		),
		array(
			'label'=>'WebSite/Blog',
			'value'=>CHtml::link($model->profile->blog,$model->profile->blog),
			'type'=>'html',
			'visible'=>$model->profile->blog,
		),
		array(
			'label'=>'description',
			'value'=>$model->profile->description,
			'visible'=>$model->profile->description,
		),
		array(
			'label'=>'Member Since',
			'value'=>date('M j, Y',$model->regdate)
		),
	),
)); ?>
