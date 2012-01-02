<?php 
$this->breadcrumbs=array(
	'Permission'=>array('permission/index'),
	'Roles'=>array('permission/roles'),
	$_GET['id'],
);
Yii::app()->clientScript->registerScript('viewRole', "
$('input[name=\"tasks[]\"]').each(function(){
	if($(this).is(':checked')){
		$(this).parent().next().find('input').attr('checked','checked');
	}
}).click(function(){
	var isChecked=$(this).is(':checked');	
	$(this).parent().next().find('input').attr('checked',isChecked);
});
");
echo CHtml::beginForm();

$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$allItemsDataProvider,
	'itemView'=>'_viewRole',
	'viewData'=>array(
		'children'=>$children,
	),
));
?>
<div class="row submit">
	<?php echo CHtml::hiddenField('viewRole','1');?>
	<?php echo CHtml::submitButton('Submit');?>
</div>
<?php echo CHtml::endForm(); ?>
