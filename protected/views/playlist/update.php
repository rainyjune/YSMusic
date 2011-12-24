<?php
$this->breadcrumbs=array(
	'Playlists'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Playlist', 'url'=>array('index')),
	array('label'=>'Create Playlist', 'url'=>array('create')),
	array('label'=>'View Playlist', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Playlist', 'url'=>array('admin')),
);
?>

<h1>Update Playlist <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>