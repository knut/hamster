<?php

class ForumController extends CController
{
	const PAGE_SIZE = 10;

	/**
	 * @var string specifies the default action to be 'list'.
	 */
	public $defaultAction = 'list';

	/**
	 * Specifies the action filters.
	 * This method overrides the parent implementation.
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method overrides the parent implementation.
	 * It is only effective when 'accessControl' filter is enabled.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('deny',  // deny access to create, update, delete operations for guest users
				'actions'=>array('create','update','delete'),
				'users'=>array('?'),
			),
			array('allow', // allow access to admin operation for admin user
				'actions'=>array('admin'),
				'users'=>array('admin'),
			),
			array('deny',  // deny access to admin operation for all users
				'actions'=>array('admin'),
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Shows a particular forum.
	 */
	public function actionView() {
		
		$forum = $this->loadforum();
		//var_dump($forum->topics[0]->last_post);
		
		$this->render('view', array('forum' => $forum));//, 'topics' => $this->loadtopics()));
	}

	/**
	 * Creates a new forum.
	 * If creation is successful, the browser will be redirected to the 'show' page.
	 */
	public function actionCreate()
	{
		$forum=new forum;
		if(isset($_POST['forum']))
		{
			$forum->attributes=$_POST['forum'];
			if($forum->save())
				$this->redirect(array('show','id'=>$forum->id));
		}
		$this->render('create',array('forum'=>$forum));
	}

	/**
	 * Updates a particular forum.
	 * If update is successful, the browser will be redirected to the 'show' page.
	 */
	public function actionUpdate()
	{
		$forum=$this->loadforum();
		if(isset($_POST['forum']))
		{
			$forum->setAttributes($_POST['forum']);
			if($forum->save())
				$this->redirect(array('show','id'=>$forum->id));
		}
		$this->render('update',array('forum'=>$forum));
	}

	/**
	 * Deletes a particular forum.
	 * If deletion is successful, the browser will be redirected to the 'list' page.
	 */
	public function actionDelete()
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadforum()->delete();
			$this->redirect(array('list'));
		}
		else
			throw new CHttpException(500,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all forums.
	 */
	public function actionList() {
		
		/*$forums = Forum::model()->with('topics_count')->findAll(array(
			'select' => 'id, name, description, posts_count',
			'order' => 'position',
			));*/
			
		$forums = Forum::model()->with('topics_count', 'posts_count', 'last_post')->findAll();
		
		//die(var_dump($forums[0]->last_post));
		
		//die(var_dump($forums[0]->topics_count, $forums[0]->posts_count));
		
		//Topic::model()->with('last_post');
		
		/*foreach($forums as $forum) {
			$topics = Topic::model()->with('last_post')->findBySql('SELECT * FROM topics WHERE forum_id = :forum_id ORDER BY replied_at DESC LIMIT 1', array(':forum_id' => $forum->id));
			var_dump($topics);
		}*/
		
		//die(var_dump($forums[2]->last_post));
		
		
		
		// SELECT replied_at, replied_by, last_post_id FROM topics WHERE forum_id = 1 ORDER BY replied_at DESC LIMIT 1;
				
		//var_dump($forums[2]->topics[0]->attributes);
		
		/*$last_posts = Post::model()->findAll(array(
			
			));
		
		SELECT *
		FROM posts
		GROUP BY topic_id
		ORDER BY updated_at
		LIMIT 0 , 30*/
		
		
		/*$this->render('list', array(
			'forums' => $forums,
			//'last_posts' => $last_posts
		));*/
		
		$pages = $this->paginate(forum::model()->count(), self::PAGE_SIZE);
		//$forumList = Forum::model()->findAll($this->getListCriteria($pages));
		$this->render('list', array('forums'=>$forums, 'pages'=>$pages));
	}

	/**
	 * Manages all forums.
	 */
	public function actionAdmin()
	{
		$this->processAdminCommand();

		$pages=$this->paginate(forum::model()->count(), self::PAGE_SIZE);
		$forumList=forum::model()->findAll($this->getListCriteria($pages));

		$this->render('admin',array(
			'forumList'=>$forumList,
			'pages'=>$pages));
	}

	/**
	 * Loads the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 */
	protected function loadforum()
	{
		if(isset($_GET['id'])) {
			$forum = Forum::model()->with('topics')->findbyPk($_GET['id']);
		}
			
		if(isset($forum))
			return $forum;
		else
			throw new CHttpException(500,'The requested forum does not exist.');
	}

	protected function loadtopics() {
		if(isset($_GET['id'])) {
			$topics = Topic::model()->with('author')->findAll('forum_id = :forum_id', array(':forum_id' => $_GET['id']));
			//$topics = Topic::model()->findAllBySql('SELECT * FROM topics WHERE forum_id = :forum_id', array(':forum_id' => (int)$_GET['id']));
		}
		return $topics;
	}

	/**
	 * @param CPagination the pagination information
	 * @return CDbCriteria the query criteria for forum list.
	 * It includes the ORDER BY and LIMIT/OFFSET information.
	 */
	protected function getListCriteria($pages)
	{
		$criteria=new CDbCriteria;
		$columns=forum::model()->tableSchema->columns;
		if(isset($_GET['sort']) && isset($columns[$_GET['sort']]))
		{
			$criteria->order=$columns[$_GET['sort']]->rawName;
			if(isset($_GET['desc']))
				$criteria->order.=' DESC';
		}
		$criteria->limit=$pages->pageSize;
		$criteria->offset=$pages->currentPage*$pages->pageSize;
		return $criteria;
	}

	/**
	 * Generates the header cell for the specified column.
	 * This method will generate a hyperlink for the column.
	 * Clicking on the link will cause the data to be sorted according to the column.
	 * @param string the column name
	 * @return string the generated header cell content
	 */
	protected function generateColumnHeader($column)
	{
		$params=$_GET;
		if(isset($params['sort']) && $params['sort']===$column)
		{
			if(isset($params['desc']))
				unset($params['desc']);
			else
				$params['desc']=1;
		}
		else
		{
			$params['sort']=$column;
			unset($params['desc']);
		}
		$url=$this->createUrl('list',$params);
		return CHtml::link(forum::model()->getAttributeLabel($column),$url);
	}

	/**
	 * Executes any command triggered on the admin page.
	 */
	protected function processAdminCommand()
	{
		if(isset($_POST['command'], $_POST['id']) && $_POST['command']==='delete')
		{
			if(Yii::app()->user->isGuest)
				Yii::app()->user->loginRequired();

			if(($forum=forum::model()->findbyPk($_POST['id']))!==null)
			{
				$forum->delete();
				// reload the current page to avoid duplicated delete actions
				$this->refresh();
			}
			else
				throw new CHttpException(500,'The requested forum does not exist.');
		}
	}
}
