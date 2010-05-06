<?php

class PostController extends CController
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
	 * Shows a particular posts.
	 */
	public function actionView()
	{
		$this->render('view',array('posts'=>$this->loadPosts()));
	}

	/**
	 * Creates a new posts.
	 * If creation is successful, the browser will be redirected to the 'show' page.
	 */
	public function actionCreate() {
		
		if(isset($_POST['Post'])) {
			
			$user = User::model()->find('username = :username', array('username' => Yii::app()->user->name));
			$session = Yii::app()->session;

			$topic = Topic::model()->findByPk($session['topic_id']);
			$forum = Forum::model()->findByPk($session['forum_id']);
			
			/*$transaction = Post::model()->dbConnection->beginTransaction();
			try {
			*/
				
				$now = date('Y-m-d H:i:s');
				
				$post = new Post();
				$post->user_id = $user->id;
				$post->topic_id = $session['topic_id'];
				$post->forum_id = $session['forum_id'];
				$post->body = $_POST['Post']['body'];
				// TODO: fix me
				$post->body_html = $post->body;				
				$post->created_at = $now;
				$post->updated_at = $now;
				
				if(!$post->save()) {
					var_dump('<pre>', $post->getErrors());
				}
				
				if(!$user->save()) {
					var_dump('<pre>', $user->getErrors());
				}

				$topic->updated_at = $now;
				/*$topic->replied_at = $now;
				$topic->replied_by = $user->id;
				$topic->last_post_id = $post->id;*/
				if(!$topic->save()) {
					var_dump('<pre>', $topic->getErrors());
				}

				/*$transaction->commit();

			} catch(Exception $e) {
				$transaction->rollBack();
				throw new CHttpException(500, 'Failed to save post');
			}*/
			
			$url = $this->createUrl('topic/view', array(
				'id' => $session['topic_id'], 
				'#' => "post-{$post->id}"
			));
			$this->redirect($url);
			
		}
		
	}

	/**
	 * Updates a particular posts.
	 * If update is successful, the browser will be redirected to the 'show' page.
	 */
	public function actionEdit()
	{
		$posts=$this->loadPosts();
		if(isset($_POST['Posts']))
		{
			$posts->setAttributes($_POST['Posts']);
			if($posts->save())
				$this->redirect(array('show','id'=>$posts->id));
		}
		$this->render('edit', array('posts'=>$posts));
	}

	/**
	 * Deletes a particular posts.
	 * If deletion is successful, the browser will be redirected to the 'list' page.
	 */
	public function actionDelete()
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadPosts()->delete();
			$this->redirect(array('list'));
		}
		else
			throw new CHttpException(500,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all postss.
	 */
	public function actionList()
	{
		$pages = $this->paginate(Post::model()->count(), self::PAGE_SIZE);
		$criteria = $this->getListCriteria($pages);
		$criteria->order = "t.created_at DESC";
		$postsList = Post::model()->with('author', 'forum', 'topic')->findAll($criteria);

		$this->render('list',array(
			'postsList'=>$postsList,
			'pages'=>$pages));
	}

	/**
	 * Manages all postss.
	 */
	public function actionAdmin()
	{
		$this->processAdminCommand();

		$pages=$this->paginate(Post::model()->count(), self::PAGE_SIZE);
		$postsList=Post::model()->findAll($this->getListCriteria($pages));

		$this->render('admin',array(
			'postsList'=>$postsList,
			'pages'=>$pages));
	}
	
	public function actionFeed() {
		
		Yii::import('application.lib.*');
		require_once('Zend/Feed.php');
		
		$posts = Post::model()->with('author')->findAll(array(
			'order' => 'post.created_at DESC',
			'limit' => 20,
			));
		//die(var_dump($posts));
		
		$data = array(
			'title' => Yii::app()->params['title']." Feed",
			'link' => Yii::app()->request->baseUrl,
			'charset' => 'utf-8',
			);
			
		foreach($posts as $post) {
			$entry = array(
				'title' => $post->body,
				'link' => CHtml::normalizeUrl(array('posts/show', 'id' => $post->id)),
				'description' => $post->body,
				'lastUpdate' => $post->created_at,
				);
			$data['entries'][] = $entry;
		}
		
		$feed = Zend_Feed::importArray($data);
		$feed->send();
	}

	/**
	 * Loads the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 */
	protected function loadPosts()
	{
		if(isset($_GET['id']))
			$posts=Post::model()->findbyPk($_GET['id']);
		if(isset($posts))
			return $posts;
		else
			throw new CHttpException(500,'The requested posts does not exist.');
	}

	/**
	 * @param CPagination the pagination information
	 * @return CDbCriteria the query criteria for Posts list.
	 * It includes the ORDER BY and LIMIT/OFFSET information.
	 */
	protected function getListCriteria($pages)
	{
		$criteria=new CDbCriteria;
		$columns=Post::model()->tableSchema->columns;
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
		return CHtml::link(Post::model()->getAttributeLabel($column),$url);
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

			if(($posts=Post::model()->findbyPk($_POST['id']))!==null)
			{
				$posts->delete();
				// reload the current page to avoid duplicated delete actions
				$this->refresh();
			}
			else
				throw new CHttpException(500,'The requested posts does not exist.');
		}
	}
}
