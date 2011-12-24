<?php
/**
 * This is the model class for table "tbl_playlist".
 *
 * The followings are the available columns in table 'tbl_playlist':
 * @property integer $id
 * @property integer $user_id
 * @property string $name
 * @property integer $create_date
 * @property integer $update_date
 */
class Playlist extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Playlist the static model class
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
		return 'tbl_playlist';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
			array('name', 'length', 'max'=>180),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, name, create_date, update_date', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
			'song' => array(self::HAS_MANY, 'Song', 'playlist_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'User ID',
			'name' => 'Name',
			'create_date' => 'Create Date',
			'update_date' => 'Update Date',
		);
	}

	/**
	 * set or update create/update timestamp
	 *
	 */
	protected function beforeSave()
	{
		if(parent::beforeSave())
		{
			if($this->isNewRecord)
			{
				$this->user_id=Yii::app()->user->id;
				$this->create_date=time();
			}
			else
				$this->update_date=time();
			return true;	
		}
		else
			return false;
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('create_date',$this->create_date);
		$criteria->compare('update_date',$this->update_date);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
