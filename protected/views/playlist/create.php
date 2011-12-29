<?php
$this->breadcrumbs=array(
	'Playlists'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Playlist', 'url'=>array('index'),'visible'=>Yii::app()->user->name=='admin'),
	array('label'=>'Manage Playlist', 'url'=>array('admin'),'visible'=>Yii::app()->user->name=='admin'),
);
?>

<h1>Create Playlist</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
