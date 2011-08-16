<?php

class Topic extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * This method is required by all child classes of CActiveRecord.
	 * @return CActiveRecord the static model class
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
		return 'topic';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('title','length','max'=>255),
			array('forum_id, user_id, title, created_at', 'required'),
			array('forum_id, user_id, hits, sticky, posts_count, locked', 'numerical', 'integerOnly'=>true),
		);
	}


	// -----------------------------------------------------------
	// Uncomment the following methods to override them if needed
	
	public function relations()
	{
		return array(
			'forum' => array(self::BELONGS_TO, 'Forum', 'forum_id'),
			'posts' => array(self::HAS_MANY, 'Post', 'topic_id'),
			'author' => array(self::BELONGS_TO, 'User', 'user_id'),
			'posts_count' => array(self::STAT, 'Post', 'topic_id'),
			'last_post' => array(self::HAS_ONE, 'Post', 'topic_id', 'order' => 'created_at DESC'),
			
			/*'author' => array(self::BELONGS_TO, 'User', 'user_id'),
			'forum' => array(self::BELONGS_TO, 'Forum', 'forum_id'),
			'replied_by' => array(self::BELONGS_TO, 'User', 'replied_by'),*/
		);
	}

	/*public function attributeLabels()
	{
		return array(
			'authorID'=>'Author',
		);
	}

	public function protectedAttributes()
	{
		return array();
	}*/
	
	public function getSticky() {
		return $this->sticky == 1 ? true : false;
	}
	
	public function setSticky($value) {
		$this->sticky = ($value == true) ? 1 : 0;
	}
	
	protected function beforeSave() {
		if(parent::beforeSave()) {
			$now = date('Y-m-d H:i:s');
			if($this->isNewRecord) {
				$this->created_at = $now;
			}
			$this->updated_at = $now;
			return true;
		}
		return false;
	}

}
