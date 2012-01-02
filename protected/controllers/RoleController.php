<?php

class RoleController extends Controller
{

	public $layout='//layouts/column2';

	public function actionIndex()
	{
	}

	public function actionAddsubitem($id)
	{
		$model=new AuthItemChild;
		$auth=Yii::app()->authManager;
		// uncomment the following code to enable ajax-based validation
		if(isset($_POST['ajax']) && $_POST['ajax']==='auth-item-child-addsubitem-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		if(isset($_POST['AuthItemChild']))
		{
			$model->attributes=$_POST['AuthItemChild'];
			if($model->validate())
			{
				$auth->addItemChild($id,$model->child);
				Yii::app()->user->setFlash('addSubitem','Add subitem successfully.');	
				$this->redirect(array('role/admin','id'=>$id));
			}
		}
		$this->render('addsubitem',array('model'=>$model));
	}

	public function actionAdmin($id)
	{
		$auth=Yii::app()->authManager;
		echo '<pre>';
		var_dump($auth->getAuthItem($id)->description);
		$dataProvider=new CActiveDataProvider('AuthItemChild',array(
			'criteria'=>array(
				'condition'=>"parent='$id'",
			)
		));
		$this->render('admin',array('dataProvider'=>$dataProvider,'id'=>$id));
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}
