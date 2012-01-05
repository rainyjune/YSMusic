<?php
	$this->menu=array(
		array('label'=>'List User', 'url'=>array('index'),'visible'=>Yii::app()->user->name=='admin'),
		array('label'=>'Create User', 'url'=>array('create'),'visible'=>Yii::app()->user->name=='admin'),
		array('label'=>'Update User', 'url'=>array('update', 'id'=>$model->id),'visible'=>Yii::app()->user->name=='admin'),
		array('label'=>'Delete User', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?'),'visible'=>Yii::app()->user->name=='admin'),
		array('label'=>'Manage User', 'url'=>array('admin'),'visible'=>Yii::app()->user->name=='admin'),
		array('label'=>'My Playlist','url'=>array('playlist/view','id'=>!empty($model->playlist)?$model->playlist[0]->id:''),'visible'=>(!Yii::app()->user->isGuest && isset($model->playlist))),
		array('label'=>'Add Playlist','url'=>array('playlist/create'),'visible'=>(empty($model->playlist) && $_GET['id']==Yii::app()->user->id)),
	);
?>
<h1>
	<?php 
	echo $model->username; 
	if(isset($model->profile) && $model->profile->name)
		echo '('.$model->profile->name.')';
	?>
</h1>

<?php
$attributes=array();
if(!empty($model->profile))
{
	$attributes=array(
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
	);
}
array_push($attributes,array( 'label'=>'Member Since', 'value'=>date('M j, Y',$model->regdate)));
$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>$attributes,
)); 

if($dataProvider):?>
<h4>Playlist:<?php echo $model->playlist[0]->name;?></h4>
<?php
	$this->widget('zii.widgets.CListView',array(
		'dataProvider'=>$dataProvider,
		'itemView'=>'application.views.playlist._view_song',
	));
?>
<?php endif;?>
