<?php
$this->breadcrumbs=array(
	'Permissions'=>array('index'),
	$this->_authItemType[$model->type]['label']=>array($this->_authItemType[$model->type]['url']),
	$_GET['id'],
);
$this->menu=array(
	array('label'=>'Add subitem','url'=>array('addSubItem','id'=>$_GET['id'])),
);
$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'name',
		'description',
		'bizrule',
		'data',
	)));
$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=>$children,
	'columns'=>array(
		'child',
		array(
			'class'=>'CButtonColumn',
			'template'=>'{update} {delete}',
			'buttons'=>array(
				'update'=>array(
					'url'=>'Yii::app()->createUrl("permission/update",array("id"=>$data->child))',
				),
				'delete'=>array(
					'label'=>'Remove from task',
					'url'=>'Yii::app()->createUrl("permission/removeChild",array("parent"=>$data->parent,"child"=>$data->child))',
					'click'=>'function(){return confirm("This item will remove from the task.Are you sure?");}',
				),
			),
		),
	)
));
