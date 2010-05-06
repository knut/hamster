<?php

class TopicController extends Controller
{
	const PAGE_SIZE=10;

	/**
	 * @var string specifies the default action to be 'list'.
	 */
	public $defaultAction='list';

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
	 * Shows a particular topics.
	 */
	public function actionView() {
		//$topic = $this->loadTopic();

	//	var_dump($topic->forum_id);
	
		if(isset($_GET['id'])) {
			$topic = Topic::model()->with('forum', 'posts')->findByPk((int)$_GET['id']);
		}
		
		if($topic === null) {
			throw new CHttpException(500, 'The requested topic does not exist.');
		}
		
		//die(var_dump($topic->forum->name))
		
		// set current topic_id
		$session = Yii::app()->session;
		$session['topic_id'] = $topic->id;
		$session['forum_id'] = $topic->forum->id;
		
		// update hits
		// TODO: only if not already read it within the same session
		
		/*if(!isset($session['viewed_topics'])) {
			$session['viewed_topics'] = array();
		}*/
		
		
		if(isset($session['viewed_topics'][$topic->id])) {
			
			$topic->hits++;
			if(!$topic->save()) {
				var_dump($topic->getErrors());
			}
			
			$session['viewed_topics'][$topic->id] = true;
			
		}
		
		//die(var_dump(Yii::app()->session['topic_id'], $session['forum_id'], Yii::app()->session['viewed_topics']));

		$this->render('view', array('topic' => $topic));
	}

	/**
	 * Creates a new topic.
	 * If creation is successful, the browser will be redirected to the 'show' page.
	 */
	public function actionCreate() {
		
		// find forum
		if(isset($_GET['id'])) {
			$forum = Forum::model()->findByPk((int)$_GET['id']);
		}
		if(!isset($forum)) {
			throw new CHttpException(500, 'The requested forum does not exist.');
		}
		
		$form = new TopicForm();
		
		if(isset($_POST['TopicForm'])) {
			
			if($form->validate()) {
				
				
				
				//die(var_dump(Yii::app()->user->name));
				
				$user = User::model()->find('username = :username', array('username' => Yii::app()->user->name));
				if($user === null) {
					throw new Exception(500, 'You need to login to create a new topic');
				}
				
			
				
				/*$transaction = Topic::model()->dbConnection->beginTransaction();
				try {
				*/
					
					//die(var_dump($_POST['TopicForm']));
					
					$topic = new Topic();
					$topic->forum_id = $forum->id;
					$topic->user_id = $user->id;
					$topic->title = $_POST['TopicForm']['title'];
					$topic->hits = 1;
					$topic->sticky = 0;
					$topic->locked = 0;
					$topic->created_at = date('Y-m-d H:i:s');
					$topic->updated_at = date('Y-m-d H:i:s');					
					
					if(!$topic->save()) {
						die(var_dump('<pre>', $topic->getErrors()));
					}
					
					$post = new Post();
					$post->user_id = $user->id;
					$post->topic_id = $topic->id;
					$post->body = $_POST['TopicForm']['body'];
					// TODO: fix rendering?
					$post->body_html = $post->body;
					$post->created_at = date('Y-m-d H:i:s');
					$post->forum_id = $forum->id;
					
					if(!$post->save()) {
						var_dump('<pre>', $post->getErrors());
					}
					
					/*$user->posts_count++;
					if(!$user->save()) {
						var_dump('<pre>', $user->getErrors());
					}
					
					$forum->topics_count++;
					if(!$forum->save()) {
						var_dump('<pre>', $forum->getErrors());
					}*/
					
					//$transaction->commit();
					
				/*} catch(Exception $e) {
					$transaction->rollBack();
					throw new CHttpException(500, 'Failed to save topic');
				}*/
				
				$this->redirect(array('view', 'id' => $topic->id ));

			}
			
			/*if($user->save()) {
				//var_dump("user saved");
				
				//$this->redirect(array('show', 'id' => $users->id ));
				
			} else {
				var_dump($user->getErrors());
			}*/
			
		}
			
			
			//die(var_dump($_POST['TopicForm']));
			
			/*$topic = new Topic();
			if(isset($_POST['Topics']))
			{
				$topic->attributes=$_POST['Topics'];
				if($topic->save())
					$this->redirect(array('show','id'=>$topic->id));
			}*/
			
		$this->render('create', array('form' => $form, 'forum' => $forum));

	}

	/**
	 * Updates a particular topics.
	 * If update is successful, the browser will be redirected to the 'show' page.
	 */
	public function actionEdit()
	{
		$topics=$this->loadTopic();
		if(isset($_POST['Topics']))
		{
			$topics->setAttributes($_POST['Topics']);
			if($topics->save())
				$this->redirect(array('show','id'=>$topics->id));
		}
		$this->render('edit',array('topics'=>$topics));
	}

	/**
	 * Deletes a particular topics.
	 * If deletion is successful, the browser will be redirected to the 'list' page.
	 */
	public function actionDelete()
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadTopic()->delete();
			$this->redirect(array('list'));
		}
		else
			throw new CHttpException(500,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all topicss.
	 */
	public function actionList()
	{
		$pages=$this->paginate(Topics::model()->count(), self::PAGE_SIZE);
		$topicsList=Topics::model()->findAll($this->getListCriteria($pages));

		$this->render('list',array(
			'topicsList'=>$topicsList,
			'pages'=>$pages));
	}

	/**
	 * Manages all topicss.
	 */
	public function actionAdmin()
	{
		$this->processAdminCommand();

		$pages=$this->paginate(Topics::model()->count(), self::PAGE_SIZE);
		$topicsList=Topics::model()->findAll($this->getListCriteria($pages));

		$this->render('admin',array(
			'topicsList'=>$topicsList,
			'pages'=>$pages));
	}

	/**
	 * Loads the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 */
	protected function loadTopic()
	{
		if(isset($_GET['id'])) {
			$topic = Topic::model()->with('posts')->findbyPk($_GET['id']);
		}
		//die(var_dump($topic));
		if(isset($topic))
			return $topic;
		else
			throw new CHttpException(500,'The requested topic does not exist.');
	}
	
	protected function loadPosts() {
		if(isset($_GET['id'])) { // topic id is defined
			$posts = Post::model()->with('author')->findAll('topic_id = :topic_id', array(':topic_id' => $_GET['id']));			
		}
		if(isset($posts)) {
			return $posts;
		}
		// TODO
	}
	
	protected function loadForum() {
		/*if(isset($_GET['id'])) {
			$forum = Forum::model()->findAllBySql('SELECT * FROM forums WHERE ');
		}*/
		return array();
	}

	/**
	 * @param CPagination the pagination information
	 * @return CDbCriteria the query criteria for Topics list.
	 * It includes the ORDER BY and LIMIT/OFFSET information.
	 */
	protected function getListCriteria($pages)
	{
		$criteria=new CDbCriteria;
		$columns=Topics::model()->tableSchema->columns;
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
		return CHtml::link(Topics::model()->getAttributeLabel($column),$url);
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

			if(($topics=Topics::model()->findbyPk($_POST['id']))!==null)
			{
				$topics->delete();
				// reload the current page to avoid duplicated delete actions
				$this->refresh();
			}
			else
				throw new CHttpException(500,'The requested topics does not exist.');
		}
	}
}
