<?php

class AccountController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionProfile()
	{
		$model=new UserProfile;
		$this->render('../userProfile/update',array('model'=>$model));
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
	public function actionAdmin()
	{
		$model=new PasswdForm;
		// uncomment the following code to enable ajax-based validation
		if(isset($_POST['ajax']) && $_POST['ajax']==='passwd-form-admin-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		if(isset($_POST['PasswdForm']))
		{
			$model->attributes=$_POST['PasswdForm'];
			if($model->validate())
			{
				User::model()->updateByPk(Yii::app()->user->id,array('password'=>md5($model->new_password)));
				$this->redirect(array('admin'));
			}
		}
		$this->render('admin',array('model'=>$model));
	}
}
