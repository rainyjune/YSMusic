<?php
$this->menu=array(
	array('label'=>'Public Profile', 'url'=>array('index')),
	array('label'=>'Account Admin', 'url'=>array('admin')),
);
?>
<?php if(Yii::app()->user->hasFlash('profileSaved')):?>
<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('profileSaved');?>
</div>
<?php endif;?>

<?php echo $this->renderPartial('application.views.userProfile._form', array('model'=>$model)); ?>
