<?php
$this->breadcrumbs=array(
	'Permissions'=>array('permission/index'),
	ucfirst($this->action->id),
);
$this->menu=array(
	array('label'=>'Add item','url'=>array('add','type'=>$this->action->id)),
);
?>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$dataProvider,
	'columns'=>array(
		'name',
		'description',
		array(
			'class'=>'CButtonColumn',
			'template'=>'{update} {delete}',
			'buttons'=>array(
				'update'=>array(
					'url'=>'Yii::app()->createUrl("permission/update",array("id"=>$data->name))',
				),
			),
		),
	),
));
?>
