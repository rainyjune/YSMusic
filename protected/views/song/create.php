<?php
$this->breadcrumbs=array(
	'Songs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Song', 'url'=>array('index'),'visible'=>Yii::app()->user->name=='admin'),
	array('label'=>'Manage Song', 'url'=>array('admin'),'visible'=>Yii::app()->user->name=='admin'),
	array('label'=>'Back to Playlist', 'url'=>array('/playlist/view','id'=>$_GET['playlist'])),
);
?>

<h1>Create Song</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'playlist'=>$playlist)); ?>
