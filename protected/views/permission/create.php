<?php
$this->breadcrumbs=array(
	'Permission'=>array('permission/index'),
	ucfirst($_GET['type'])=>array('permission/'.$_GET['type']),
);

?>

<h1>Create AuthItem</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
