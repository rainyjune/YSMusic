<?php
/**
 * Get all children item of a item
 * @param string $id
 * @return array
 */
function getItemChildrenRecursively($id)
{
	static $items;
	$auth=Yii::app()->authManager;
	$children=$auth->getItemChildren($id);
	foreach($children as $k=>$v)
	{
		if($auth->getItemChildren($v->name))
			getItemChildrenRecursively($v->name);
		else
			$items[]=$v->name;
	}
	return $items;
}

/**
 * RBAC Controller
 * @author ChenKang <kangchen@sohu-inc.com>
 *
 */
class PermissionController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
	/** 
	 * @var CAuthItem 
	 */
	private $_model;
	public $_authItemType=array(array('label'=>'Operations','url'=>'operations'),array('label'=>'Tasks','url'=>'tasks'),array('label'=>'Roles','url'=>'roles'));

	/**
	 * Index page
	 * @ignore tested
	 */
	public function actionIndex()
	{
		$auth=Yii::app()->authManager;
		$this->render('index');
	}

	/**
	 * Show all roles.
	 * @ignore tested
	 */
	public function actionRoles()
	{
		$this->render('roles',array(
			'dataProvider'=>$this->loadDataProvider(2),
		));
	}

	/**
	 * Show all tasks
	 * @ignore tested
	 */
	public function actionTasks()
	{
		$this->render('tasks',array(
			'dataProvider'=>$this->loadDataProvider(1),
		));
	}

	/**
	 * Create auth item  
	 * @param string $type (roles|tasks|operations)
	 * @ignore tested
	 */
	public function actionAdd($type)
	{
		$model=new AuthItem;
		$relation=array('roles'=>2,'tasks'=>1,'operations'=>0);
		$auth=Yii::app()->authManager;
		$this->performAjaxValidation($model);
		if(isset($_POST['AuthItem']))
		{
			$model->attributes=$_POST['AuthItem'];
			if($model->validate())
			{
				if($auth->createAuthItem($model->name,$model->type,$model->description,$model->bizrule))
					$this->redirect(array('permission/'.$type));
			}
		}
		else
			$model->type=$relation[$type];
		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Show all operations
	 * @ignore tested
	 */
	public function actionOperations()
	{
		$this->render('operations',array(
			'dataProvider'=>$this->loadDataProvider(0),
		));
	}

	/**
	 * Show a form to assign authitem to user,user by (r=permission/assignment&roleId=admin,eg.)
	 * @param string $id
	 * @ignore tested
	 */
	public function actionAssign($id)
	{

		$user=User::model()->findByPk($id);
		$model=AuthAssignment::model()->findByAttributes(array('userid'=>$id));
		if(isset($_POST['AuthAssignment']))
		{
			$model->attributes=$_POST['AuthAssignment'];
			if($model->save())
				$this->redirect(array('assignment'));
		}
		$this->render('assign',array(
			'model'=>$model,
			'user'=>$user,
			'roles'=>Yii::app()->authManager->getRoles(),
		));	
	}
	
	/**
	 * Revoke all auth items from a user. 
	 * @param integer $id userid
	 * @ignore tested
	 */
	public function actionRevoke($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			AuthAssignment::model()->deleteAll('userid=:userid',array(':userid'=>$id));

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(array('index'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}
	/**
	 * Deletes a particular auth item.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadAuthItemModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}
	/**
	 * Deletes a particular auth item.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param string $parent the ID of the parent item
	 * @param string $child the ID of the child item
	 */
	public function actionRemoveChild($parent,$child)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			Yii::app()->authManager->removeItemChild($parent,$child);
			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('viewTasks','id'=>$parent));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}
	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='auth-item-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	
	/**
	 * Show all authenticated users with their roles.
	 * @param string $roleId
	 * @ignore tested
	 */
	public function actionAssignment($roleId=NULL)
	{
		$dataProvider=new CActiveDataProvider('AuthAssignment',array(
			'criteria'=>array(
				'with'=>array('user'),
			)
		));
		if($roleId)
		{
			$dataProvider=new CActiveDataProvider('AuthAssignment',array(
				'criteria'=>array(
					'condition'=>'itemname="'.$roleId.'"',
					'with'=>array('user'),
				)
			));
		}
		$this->render('assignment',array('dataProvider'=>$dataProvider));
	}

	public function actionViewRole($id)
	{
		$auth=Yii::app()->authManager;
		$role=$auth->getAuthItem($id);	
		$children=$auth->getItemChildren($id);
		$children=array_keys($children);
		$allAuthItems=$auth->getAuthItems();
		$allItemsDataProvider=new CActiveDataProvider("AuthItem",array(
			'criteria'=>array(
				'condition'=>'type=1',
				'with'=>array('authItemchildren1'),
			),
		));
		if(isset($_POST['viewRole']))
		{
			AuthItemChild::model()->deleteAllByAttributes(array('parent'=>$id));
			$newTasks=$_POST['tasks'];
			$newOperations=$_POST['operations'];
			foreach($newTasks as $newTask)
			{
				$newTaskOperations=array_keys($auth->getItemChildren($newTask));
				$newOperations=array_diff($newOperations,$newTaskOperations);
			}
			foreach($newTasks as $v)
				$auth->addItemChild($id,$v);
			foreach($newOperations as $_v)
				$auth->addItemChild($id,$_v);
			$this->redirect(array('permission/roles'));
		}
		$this->render('viewRole',array(
			'allItemsDataProvider'=>$allItemsDataProvider,
			'role'=>$role,
			'children'=>$children,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadAuthItemModel($id);

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['AuthItem']))
		{
			$model->attributes=$_POST['AuthItem'];
			if($model->save())
				$this->redirect(array('index'));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadAuthItemModel($id)
	{
		$model=AuthItem::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Show a task's subitems.
	 * @param string $id itemname
	 * @ignore tested
	 */
	public function actionViewTasks($id)
	{
		
		$authItem=$this->loadModel($id);
		$children=new CActiveDataProvider('AuthItemChild', array(
			'criteria'=>array(
				'condition'=>'parent="'.$id.'"',
				'with'=>array('childRelation'),
				),
			'pagination'=>array(
				'pageSize'=>20,
				),
		));
		$this->render('view',array(
			'model'=>$authItem,
			'children'=>$children,
		));
	}


	public function actionAddSubItem($id)
	{
		$auth=Yii::app()->authManager;
		$children=$auth->getItemChildren($id);
		$allOperations=$auth->getOperations();
		$availOperations=array();
		foreach($allOperations as $k=>$v)
		{
			if(!isset($children[$k]))
				$availOperations[$k]=empty($v->description)?$k:$v->description;
		}
		$model=new AuthItemChild;
		if(isset($_POST['AuthItemChild']))
		{
			$model->attributes=$_POST['AuthItemChild'];
			if($model->validate())
			{
				$model->parent=$id;
				$auth->addItemChild($id,$model->child);
				// form inputs are valid, do something here
				$this->redirect(array('permission/viewTasks','id'=>$id));
			}
		}
		$this->render('addSubItem',array(
			'operations'=>$availOperations,
			'model'=>$model,
		));
	}

	public function loadDataProvider($type)
	{
		$dataProvider=new CActiveDataProvider('AuthItem',array(
			'criteria'=>array(
				'condition'=>'type='.(int)$type,
			)
		));
		return $dataProvider;	
	}
	public function loadModel()
	{
		$auth=Yii::app()->authManager;
		if($this->_model===null)	
		{
			if(isset($_GET['id']))
				$this->_model=$auth->getAuthItem($_GET['id']);
			if($this->_model===null)
				throw new CHttpException(404,'The requested page does not exist.');
		}
		return $this->_model;
	}
}
