<?php

class TopicForm extends CFormModel {
	
	public $title;
	public $body;
	
	/*public function rules() {
		return array(
			array('title, body', 'required'),
			);
	}*/
	
	public function attributeLabels() {
		return array(
			'title' => 'Title',
			'body' => 'Body',
			);
	}
	
}

?>