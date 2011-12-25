<?php
$this->menu=array(
	array('label'=>'Public Profile', 'url'=>array('index')),
	array('label'=>'Account Admin', 'url'=>array('admin')),
);
?>

<?php echo $this->renderPartial('application.views.userProfile._form', array('model'=>$model)); ?>
