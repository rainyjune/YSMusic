<?php

class AccountController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';


	// Uncomment the following methods and override them if needed
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow', // allow authenticated user to perform 'index', 'admin' actions
				'actions'=>array('index','admin'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'index' and 'admin' actions
				'actions'=>array('admin','index'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionIndex()
	{
		$id=Yii::app()->user->id;
		$model=UserProfile::model()->findByPk($id);
		if($model===null)
			$model=new UserProfile;
		$this->performAjaxValidation($model);
		if(isset($_POST['UserProfile']))
		{
			$model->attributes=$_POST['UserProfile'];
			if($model->save())
			{
				Yii::app()->user->setFlash('profileSaved','Your profile Saved.');
				$this->refresh();
			}
		}
		$this->render('index',array('model'=>$model));
	}

	public function actionAdmin()
	{
		$model=new PasswdForm;
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
				if(User::model()->updateByPk(Yii::app()->user->id,array('password'=>md5($model->new_password))))
				{
					Yii::app()->user->setFlash('passwordSaved','Your new password Saved.');
					$this->refresh();
				}
			}
		}
		$this->render('admin',array('model'=>$model));
	}
	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-profile-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
