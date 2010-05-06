<?php

class UserController extends CController {
	
	const PAGE_SIZE = 50;

	/**
	 * @var string specifies the default action to be 'list'.
	 */
	public $defaultAction='list';

	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xEBF4FB,
			),
		);
	}

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
				'actions'=>array('update','delete'),
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
	 * Shows a particular users.
	 */
	public function actionView() {
		$user = $this->loadUsers();
		//var_dump($user);
		$this->render('view', array('user' => $user));
	}

	/**
	 * Creates a new users.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate() {
		
		$form = new SignupForm();
		
		// collect user input data
		if(isset($_POST['SignupForm'])) {
			$form->attributes = $_POST['SignupForm'];
			//var_dump($_POST);
			//var_dump($form);
			
			// validate user input and redirect to previous page if valid
			if($form->validate()) {
				
				// TODO: validate passwords
				
				$now = date('Y-m-d H:i:s');
				
				$user = new User();
				//$user->attributes = $_POST['SignupForm'];
				$user->username = $_POST['SignupForm']['username'];
				$user->email = $_POST['SignupForm']['email'];
				$user->password_hash = md5($_POST['SignupForm']['password']);
				$user->display_name = $_POST['SignupForm']['display_name'];
				$user->created_at = $now;
				$user->admin = 0;
				$user->posts_count = 0;
				$user->last_seen_at = $now;
				$user->activated = 0;
				$user->login_key = md5($user->password_hash + $user->email);
				$user->login_key_expires_at = date('Y-m-d H:i:s', strtotime('+1 day'));
				
				
				//if(isset($_POST['Users'])) {
					/*$users->attributes = array(
						
						
					); ;*/
					//var_dump($users);
					
					if($user->validate()) {
						
						if($user->save(false)) {
							
							$identity = new UserIdentity($user->username, $_POST['SignupForm']['password']);
							/*$identity->authenticate();
							switch($identity->errorCode)
							{
								case UserIdentity::ERROR_NONE:
									$duration=$this->rememberMe ? 3600*24*30 : 0; // 30 days
									Yii::app()->user->login($identity,$duration);
									break;
								case UserIdentity::ERROR_USERNAME_INVALID:
									$this->addError('username','Username is incorrect.');
									break;
								default: // UserIdentity::ERROR_PASSWORD_INVALID
									$this->addError('password','Password is incorrect.');
									break;
							}*/
							Yii::app()->user->login($identity);				
							$this->redirect(array('view', 'id' => $user->id));
							
						} else {
							var_dump($user->getErrors());
						}
						
					} else {
						var_dump($user->getErrors());
					}
					
					
				//}
				
				
				
				
				
				//var_dump($user);
				
				//$this->redirect(Yii::app()->user->returnUrl);
			}
		}
		// display the login form
		$this->render('create', array('form' => $form));
		
		/*$users=new User;
		if(isset($_POST['Users']))
		{
			$users->attributes=$_POST['Users'];
			if($users->save())
				$this->redirect(array('show','id'=>$users->id));
		}
		$this->render('create',array('users'=>$users));*/
	}

	/**
	 * Updates a particular users.
	 * If update is successful, the browser will be redirected to the 'show' page.
	 */
	public function actionEdit()
	{
		// if not admin, only update your own account information
		
		/*$form = new SignupForm();
		// collect user input data
		if(isset($_POST['SignupForm'])) {
			$form->attributes = $_POST['SignupForm'];
			// validate user input and redirect to previous page if valid
			if($form->validate()) {
		
		if($form->validate()) {*/
		
		$notice = "";
		
		$users = $this->loadUsers();
		if(isset($_POST['User'])) {
			
			/*if(isset($_POST['User']['display_name'])) {
				
				
				
			}
			
			
			var_dump($_POST);
			*/
			
			$users->setAttributes($_POST['User']);
			
			if($users->validate()) {
				if($users->save()) {
					$notice = "Your settings have been saved.";
					//$this->redirect(array('update', 'id' => $users->id));
				}
			} else {
				//var_dump($users->getErrors());
			}
			
			
			
		}
		
		$this->render('edit', array('users' => $users, 'notice' => $notice));
	}

	/**
	 * Deletes a particular users.
	 * If deletion is successful, the browser will be redirected to the 'list' page.
	 */
	public function actionDelete()
	{
		/*if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadUsers()->delete();
			$this->redirect(array('list'));
		}
		else
			throw new CHttpException(500,'Invalid request. Please do not repeat this request again.');*/
			
		throw new CHttpException(500,'No user should be deleted.');
	}

	/**
	 * Lists all userss.
	 */
	public function actionList()
	{
		$pages = $this->paginate(User::model()->count(), self::PAGE_SIZE);
		$criteria = $this->getListCriteria($pages);
		$criteria->order = "username";
		$usersList = User::model()->with('posts_count')->findAll($criteria);

		$this->render('list',array(
			'usersList'=>$usersList,
			'pages'=>$pages));
	}
	
	public function actionFeed() {
		
		//die(var_dump($_GET));
		
		
		
		Yii::import('application.vendors.*');
		require_once('Zend/Feed.php');
		
		$posts = Post::model()->with('author')->findAll(array(
			'where' => 'posts.user_id = :user_id',
			'order' => 'posts.created_at DESC',
			'limit' => 20,
			), array(
			':user_id' => 123123132,
			));
		//die(var_dump($posts));
		
		/*$data = array(
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
		$feed->send();*/
		
	}

	/**
	 * Manages all userss.
	 */
	public function actionAdmin()
	{
		$this->processAdminCommand();

		$pages=$this->paginate(User::model()->count(), self::PAGE_SIZE);
		$usersList=User::model()->findAll($this->getListCriteria($pages));

		$this->render('admin',array(
			'usersList'=>$usersList,
			'pages'=>$pages));
	}

	/**
	 * Loads the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 */
	protected function loadUsers()
	{
		if(isset($_GET['id']))
			$users=User::model()->findbyPk($_GET['id']);
		if(isset($users))
			return $users;
		else
			throw new CHttpException(500,'The requested users does not exist.');
	}

	/**
	 * @param CPagination the pagination information
	 * @return CDbCriteria the query criteria for Users list.
	 * It includes the ORDER BY and LIMIT/OFFSET information.
	 */
	protected function getListCriteria($pages)
	{
		$criteria=new CDbCriteria;
		$columns=User::model()->tableSchema->columns;
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
		return CHtml::link(User::model()->getAttributeLabel($column),$url);
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

			if(($users=User::model()->findbyPk($_POST['id']))!==null)
			{
				$users->delete();
				// reload the current page to avoid duplicated delete actions
				$this->refresh();
			}
			else
				throw new CHttpException(500,'The requested users does not exist.');
		}
	}
}
