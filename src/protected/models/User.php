<?php

class User extends CActiveRecord {
	
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
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		return array(
			array('username','length','max'=>50),
			array('email','length','max'=>255),
			array('password_hash','length','max'=>32),
			array('display_name','length','max'=>100),
			array('login_key','length','max'=>32),
			array('website','length','max'=>255),
			array('openid_url','length','max'=>255),
			array('username, email, password_hash, created_at, admin, posts_count, last_seen_at, login_key, login_key_expires_at, activated', 'required'),
			array('id, admin, posts_count, activated', 'numerical', 'integerOnly'=>true),
		);
	}

	public function relations() {
		return array(
			'posts' => array(self::HAS_MANY, 'Post', 'user_id', 'order' => 'created_at DESC', 'limit' => 20),
			'posts_count' => array(self::STAT, 'Post', 'user_id'),
			'topics' => array(self::HAS_MANY, 'Topic', 'user_id', 'order' => 'created_at DESC', 'limit' => 20),
			'topics_count' => array(self::STAT, 'Topic', 'user_id'),
		);
	}

	public function getName() {
		if(!empty($this->display_name)) {
			return $this->display_name;
		} else {
			return $this->username;
		}
	}
	
	public function getPostsCountText() {
		if($this->posts_count == 0) {
			return "0 posts";
		}
		if($this->posts_count == 1) {
			return "1 post";
		}
		return $this->posts_count." posts";
	}
	
	public function getNiceCreatedAt() {
		return date('M j, Y g:ia');
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
	
}