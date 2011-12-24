<?php
$this->breadcrumbs=array(
	'Songs'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Song', 'url'=>array('index')),
	array('label'=>'Create Song', 'url'=>array('create')),
	array('label'=>'Update Song', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Song', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Song', 'url'=>array('admin')),
);
?>

<h1>View Song #<?php echo $model->id; ?></h1>
<audio src="<?php echo $model->url;?>" controls="controls" autoplay="autoplay"></audio>
