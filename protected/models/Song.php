<?php
/**
 * This is the model class for table "tbl_song".
 *
 * The followings are the available columns in table 'tbl_song':
 * @property integer $id
 * @property string $name
 * @property integer $order_in_playlist
 * @property integer $playlist_id
 * @property string $url
 * @property string $lyric
 * @property string $description
 */
class Song extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Song the static model class
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
		return 'tbl_song';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, url', 'required'),
			array('order_in_playlist', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>250),
			array('url', 'length', 'max'=>255),
			array('lyric, description, playlist_id', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, order_in_playlist, playlist_id, url, lyric', 'safe', 'on'=>'search'),
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
			'playlist' => array(self::BELONGS_TO, 'Playlist', 'playlist_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'order_in_playlist' => 'Order In Playlist',
			'playlist_id' => 'Playlist ID',
			'url' => 'URL',
			'lyric' => 'Lyric',
			'description'=>'Description',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('order_in_playlist',$this->order_in_playlist);
		$criteria->compare('playlist_id',$this->playlist_id);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('lyric',$this->lyric,true);
		$criteria->compare('description',$this->description,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
