<?php
/**
 * This is the model class for table "tbl_user_profile".
 *
 * The followings are the available columns in table 'tbl_user_profile':
 * @property integer $user_id
 * @property string $name 
 * @property string $email
 * @property string $blog
 * @property string $description
 *
 * The followings are the available model relations:
 * @property TblUser $user
 */
class UserProfile extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return UserProfile the static model class
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
		return 'tbl_user_profile';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'length', 'max'=>128),
			array('email', 'length', 'max'=>128),
			array('email', 'email'),
			array('blog', 'length', 'max'=>255),
			array('blog', 'url'),
			array('description', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('user_id, name, email, blog, description', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
		);
	}

	/**
	 * This is invoked before the record is saved.
	 * @return boolean whether the record should be saved.
	 */
	protected function beforeSave()
	{
		if(parent::beforeSave())
		{
			if($this->isNewRecord)
				$this->user_id=Yii::app()->user->id;
			return true;
		}
		else
			return false;
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'user_id' => 'User ID',
			'name' => 'Name',
			'email' => 'Email(Public visible)',
			'blog' => 'Website/Blog',
			'description' => 'Description',
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

		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('blog',$this->blog,true);
		$criteria->compare('description',$this->description,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
