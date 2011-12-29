<?php
$this->breadcrumbs=array(
	'Role',
);?>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$dataProvider,
	'columns'=>array(
		'name',
		'description',
		array(
			'class'=>'CLinkColumn',
			'header'=>'SubItems',
			'label'=>'SubItems Management',
			'urlExpression'=>'Yii::app()->createUrl("role/admin",array("id"=>$data->name))',
		),
		array(
			'class'=>'CLinkColumn',
			'header'=>'Owned Users',
			'label'=>'User Management',
			'url'=>array('test/index','id'=>1),
		),
		array(
			'class'=>'CButtonColumn',
			'template'=>'{update} {delete}',
			'buttons'=>array(
				'update'=>array(
					'url'=>'Yii::app()->createUrl("authItem/update",array("id"=>$data->name))',
				),
			),
		),
	),
));
?>
