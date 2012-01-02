<?php
$this->breadcrumbs=array(
	'Permission',
);
$this->menu=array(
	array('label'=>'Roles','url'=>array('roles')),
	array('label'=>'Tasks','url'=>array('tasks')),
	array('label'=>'Operations','url'=>array('operations')),
	array('label'=>'Assignment','url'=>array('assignment')),
);
?>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>

<p>A role consists of tasks, a task consists of operations, and an operation is a permission that is atomic. For example, we can have a system with administrator role which consists of post management task and user management task. The user management task may consist of create user, update user and delete user operations.</p>
<p>For more flexibility, Yii also allows a role to consist of other roles or operations, a task to consist of other tasks, and an operation to consist of other operations.</p>
