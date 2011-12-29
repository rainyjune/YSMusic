<h1><?php echo $id;?></h1>
<?php
$this->menu=array(
	array('label'=>'Add subitem','url'=>array('addsubitem','id'=>$_GET['id']))
);
?>

<?php
$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
	'summaryText'=>'',
));
