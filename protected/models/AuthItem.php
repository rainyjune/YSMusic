<?php

/**
 * This is the model class for table "tbl_auth_item".
 *
 * The followings are the available columns in table 'tbl_auth_item':
 * @property string $name
 * @property integer $type
 * @property string $description
 * @property string $bizrule
 * @property string $data
 *
 * The followings are the available model relations:
 * @property TblUser[] $tblUsers
 * @property TblAuthItemchild[] $tblAuthItemchildren
 * @property TblAuthItemchild[] $tblAuthItemchildren1
 */
class AuthItem extends CActiveRecord
{

	/**
	 * Returns the static model of the specified AR class.
	 * @return AuthItem the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_auth_item';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, type', 'required'),
			array('type', 'numerical', 'integerOnly'=>true),
			array('type', 'in', 'range'=>array(0,1,2)),
			array('name', 'length', 'max'=>64),
			array('name', 'unique'),
			array('description, bizrule, data', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('name, type, description, bizrule, data', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'authAssignment' => array(self::HAS_MANY, 'AuthAssignment', 'itemname'),
			'users' => array(self::MANY_MANY, 'User', 'tbl_auth_assignment(itemname, userid)'),
			'authItemchildren' => array(self::HAS_MANY, 'AuthItemChild', 'child'),
			'authItemchildren1' => array(self::HAS_MANY, 'AuthItemChild', 'parent'),
		);
	}

	public static function getRoles()
	{
		$roles=Yii::app()->authManager->getRoles();
		foreach($roles as &$v)
			$v=$v->description;
		return $roles;
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'name' => 'Name',
			'type' => 'Type',
			'description' => 'Description',
			'bizrule' => 'Business Rule',
			'data' => 'Data',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('name',$this->name,true);
		$criteria->compare('type',$this->type);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('bizrule',$this->bizrule,true);
		$criteria->compare('data',$this->data,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public static function getLowerItems($id)
	{
		$model=self::model()->findByPk($id);
		$type=$model->type;
		$lowerItemModel=self::model()->findAll('type<='.$type.' AND name!="'.$id.'"');
		$newArray=array();
		foreach($lowerItemModel as $v)
		{
			/*
			if($v->type==0)
				$newArray['operations'][]=$v;
			elseif($v->type==1)
				$newArray['tasks'][]=$v;
			else
				$newArray['roles'][]=$v;
			*/
		}
		return $lowerItemModel;
	}
	protected function afterDelete()
	{
		parent::afterDelete();
		AuthAssignment::model()->deleteAll('itemname="'.$this->name.'"');
		AuthItemChild::model()->deleteAll('parent="'.$this->name.'" OR child="'.$this->name.'"');
	}
}
