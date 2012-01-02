<?php
/*
echo '<pre>';
var_dump($data->authItemchildren1);
exit;
*/
$checkBoxList=array();
$theChildrens=$data->authItemchildren1;
foreach($theChildrens as $v)
	$checkBoxList[$v->child]=$v->childRelation->description;
?>
<div class="view">
	<b><?php echo CHtml::checkBox('tasks[]',in_array($data->name,$children),array('id'=>$data->name,'value'=>$data->name)); echo CHtml::encode($data->description); ?>:</b>
		<p><?php echo CHtml::checkBoxList('operations[]',$children,$checkBoxList,array('separator'=>'&nbsp;'));?></p>
</div>
