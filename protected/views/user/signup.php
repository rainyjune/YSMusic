<?php
$this->menu=array(
	array('label'=>'List User', 'url'=>array('index')),
	array('label'=>'Manage User', 'url'=>array('admin')),
);
?>

<h1>Sign up for YSMusic</h1>

<?php echo $this->renderPartial('_signup', array('model'=>$model)); ?>
