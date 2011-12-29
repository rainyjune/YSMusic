<?php
$this->menu=array(
	array('label'=>'List Playlist', 'url'=>array('index'),'visible'=>Yii::app()->user->name=='admin'),
	array('label'=>'Create Playlist', 'url'=>array('create'),'visible'=>Yii::app()->user->name=='admin'),
	array('label'=>'Update Playlist', 'url'=>array('update', 'id'=>$model->id),'visible'=>!Yii::app()->user->isGuest && $model->user_id==Yii::app()->user->id),
	array('label'=>'Add Song to the list', 'url'=>array('/song/create', 'playlist'=>$model->id),'visible'=>!Yii::app()->user->isGuest && $model->user_id==Yii::app()->user->id),
	array('label'=>'Delete Playlist', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?'),'visible'=>Yii::app()->user->name=='admin'),
	array('label'=>'Manage Playlist', 'url'=>array('admin'),'visible'=>Yii::app()->user->name=='admin'),
);
?>

<h1><?php echo $model->name; ?></h1>

<?php
if($dataProvider){
	$this->widget('zii.widgets.CListView',array(
		'dataProvider'=>$dataProvider,
		'itemView'=>'_view_song',
	));
}
