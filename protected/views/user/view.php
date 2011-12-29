<?php
if(Yii::app()->user->name=='admin')
{
	$this->menu=array(
		array('label'=>'List User', 'url'=>array('index')),
		array('label'=>'Create User', 'url'=>array('create')),
		array('label'=>'Update User', 'url'=>array('update', 'id'=>$model->id)),
		array('label'=>'Delete User', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
		array('label'=>'Manage User', 'url'=>array('admin')),
	);
}
elseif(!Yii::app()->user->isGuest)
{
	$this->menu=array(
		array('label'=>'My Playlist','url'=>array('playlist/view','id'=>!empty($model->playlist)?$model->playlist[0]->id:''),'visible'=>isset($model->playlist)),
		array('label'=>'Add Playlist','url'=>array('playlist/create'),'visible'=>(empty($model->playlist) && $_GET['id']==Yii::app()->user->id)),
	);
}
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
if(isset($model->profile))
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
<h4><?php echo $model->playlist[0]->name;?></h4>
<?php
	$this->widget('zii.widgets.CListView',array(
		'dataProvider'=>$dataProvider,
		'itemView'=>'application.views.playlist._view_song',
	));
?>
<?php endif;?>
