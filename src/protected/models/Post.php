<?php

class Post extends CActiveRecord
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
		return 'post';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('user_id, topic_id, body, created_at, forum_id', 'required'),
			array('id, user_id, topic_id, forum_id', 'numerical', 'integerOnly'=>true),
		);
	}

	public function relations()
	{
		return array(
			'author' => array(self::BELONGS_TO, 'User', 'user_id'),
			'topic' => array(self::BELONGS_TO, 'Topic', 'topic_id'),
			'forum' => array(self::BELONGS_TO, 'Forum', 'forum_id'),
		);
	}
	
	public function scopes() {
		return array(
			'recently' => array(
				'order' => 'created_at DESC',
				'limit' => 5,
			),
		);
	}

	public function getBodyHtml() {
		
		$highlighter = new CTextHighlighter();
		$highlighter->language = 'php';
		//$highlighter->showLineNumbers = true;
		
		$html = $this->body_html;
		
		$replacements = array();
		
		preg_match_all('/<\?php.*?\?>/imus', $html, $matches);
		foreach($matches[0] as $match) {
			$match = trim($match);
			$replacements['{'.md5(key($replacements).microtime()).'}'] = $highlighter->highlight($match);
			$html = str_replace($match, key($replacements), $html);
		}

		preg_match_all('/<code>(.*?)<\/code>/imus', $html, $matches);
		foreach($matches[1] as $match) {
			$match = trim($match);
			$replacements['{'.md5(key($replacements).microtime()).'}'] = $highlighter->highlight($match);
			$html = str_replace($match, key($replacements), $html);
		}
		
		//var_dump($replace);
		
		/* Emphasized Text */
		//$html = preg_replace('!&lt;code&gt;(.*?)&lt;/code&gt;!imus', '<code>$1</code>', $html);
		
		// Normalize Newlines
		$html = str_replace("\r", "\n", $html);
		$html = preg_replace("!\n\n+!", "\n", $html);
		
		// Escaped (Safe) by Default
		//$html = htmlentities($html, ENT_QUOTES, 'UTF-8');
		
		// Make Paragraphs
		$lines = explode("\n", $html);
		foreach($lines as $key => $line) {
			$lines[$key] = "<p>{$line}</p>";
		}
		$html = implode("\n", $lines);
		
		foreach($replacements as $key => $replace) {
			$replace = wordwrap($replace);
			
			$html = str_replace($key, $replace, $html);
		}
		
		// Replace links
		
		//$pattern = '/(http|https):\/\/(([A-Z0-9][A-Z0-9_-]*)(\.[A-Z0-9][A-Z0-9_-]*)+)/i';
		/*$pattern = '/(([\w]+:)?\/\/)?(([\d\w]|%[a-fA-f\d]{2,2})+(:([\d\w]|%[a-fA-f\d]{2,2})+)?@)?([\d\w][-\d\w]{0,253}[\d\w]\.)+[\w]{2,4}(:[\d]+)?(\/([-+_~.\d\w]|%[a-fA-f\d]{2,2})*)*(\?(&amp;?([-+_~.\d\w]|%[a-fA-f\d]{2,2})=?)*)?(#([-+_~.\d\w]|%[a-fA-f\d]{2,2})*)?/';

		$replacement = '<a href="\\0">\\0</a>';
		$html = preg_replace($pattern, $replacement, $html);
		var_dump(preg_replace($pattern, $replacement, $html));
		*/
		
		// Strip tags
		//$html = strip_tags($html, '<p><a><em><strong><cite><code><ul><ol><li><dl><dt><dd><pre><span>');
		
		return $html;
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

	/*public function attributeLabels()
	{
		return array(
			'authorID'=>'Author',
		);
	}

	public function protectedAttributes()
	{
		return array();
	}
	*/
}