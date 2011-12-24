<?php
$this->breadcrumbs=array(
	'Playlists'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Playlist', 'url'=>array('index')),
	array('label'=>'Create Playlist', 'url'=>array('create')),
	array('label'=>'Update Playlist', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Playlist', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Playlist', 'url'=>array('admin')),
);
?>

<h1><?php echo $model->name; ?></h1>

<?php
$this->widget('zii.widgets.CListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view_song',
));
