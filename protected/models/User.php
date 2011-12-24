<?php
/**
 * This is the model class for table "tbl_user".
 * @author rainyjune <dreamneverfall@gmail.com>
 *
 * The followings are the available columns in table 'tbl_user':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $email
 */
class User extends CActiveRecord
{
	/**
	 * @var string Confirm Password
	 */
	public $password_confirmation;

	/**
	 * Returns the static model of the specified AR class.
	 * @return User the static model class
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
		return 'tbl_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password, email', 'required'),
			array('username', 'length', 'min'=>3, 'max'=>128),
			array('username','unique'),
			array('email', 'length', 'max'=>128),
			array('email','email'),
			array('email','unique'),
			array('password', 'length', 'max'=>40),
			array('password', 'compare', 'compareAttribute'=>'password_confirmation', 'on'=>'signup'),
			array('password_confirmation', 'required', 'on'=>'signup'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, username, email', 'safe', 'on'=>'search'),
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
			'profile'=>array(self::HAS_ONE,'UserProfile','user_id'),
			'playlist'=>array(self::HAS_MANY,'Playlist','user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => 'Username',
			'password' => 'Password',
			'password_confirmation' => 'Confirm Password',
			'email' => 'Email Address',
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
				$this->password=md5($this->password);
			return true;
		}
		else
			return false;
	}

	/**
	 * validate password string
	 * @param string $password
	 * @return boolean
	 */
	public function validatePassword($password)
	{
		return md5($password)===$this->password;
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

		$criteria->compare('id',$this->id);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('email',$this->email,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
