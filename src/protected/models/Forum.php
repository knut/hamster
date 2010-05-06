<?php

class Forum extends CActiveRecord
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
		return 'forum';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('name','length','max'=>255),
			array('name, description, topics_count, posts_count, position, created, modified', 'required'),
			array('topics_count, posts_count, position', 'numerical', 'integerOnly'=>true),
		);
	}

	public function relations() {
		return array(
			
			//'last_topic' => array(self::HAS_ONE, 'Topic', 'forum_id', 'order' => 'replied_at DESC'),
			// SELECT replied_at, replied_by, last_post_id FROM topics WHERE forum_id = 1 ORDER BY replied_at DESC LIMIT 1; 
			'last_post' => array(self::HAS_ONE, 'Post', 'forum_id', 'order' => 't.created_at DESC'),
			'topics' => array(self::HAS_MANY, 'Topic', 'forum_id', 'order' => 'sticky DESC, t.updated_at DESC'),
			'topics_count' => array(self::STAT, 'Topic', 'forum_id'),
			'posts_count' => array(self::STAT, 'Post', 'forum_id'),
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
	
}