<?php
class UsersController extends AppController {
	
	public $uses = array('User', 'Follow', 'Tweet');
	
	public function index() {
		$this->redirect(ROOT_URL.'/tweet/index');
	}
	
	public function register() {
		if ($this->Auth->loggedIn()) $this->redirect(ROOT_URL.'/tweets/index');
		
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->view = 'registered';
				$this->set('user', $this->request->data['User']['username']);
			}
			else {
				$this->Session->setFlash('登録失敗');
			}
		}
	}
	
	public function login() {
		if ($this->Auth->loggedIn()) $this->redirect(ROOT_URL.'/tweets/index');
		
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				//查询已登录用户自己所follow的用户ID列表，存入Session
				$result = $this->Follow->find('all', array(
					'conditions' => array(
						'Follow.user_id' => AuthComponent::user('id')
					),
					'fields' => array('Follow.user_id_follows AS user_id')
				));
				$followList = array();
				foreach ($result as $item) $followList[$item['Follow']['user_id']] = 1;
				$this->Session->write('User.followList', $followList);
				
				//查询已登录用户的follow数、tweet数（注意不包括被follow数），存入Session
				$this->Session->write('User.followCount', $this->Follow->find('count', array(
					'conditions' => array(
						'Follow.user_id' => AuthComponent::user('id')
					)
				)));
				$this->Session->write('User.tweetCount', $this->Tweet->find('count', array(
					'conditions' => array(
						'Tweet.user_id' => AuthComponent::user('id')
					)
				)));
				
				$this->redirect(ROOT_URL.'/tweets/index');
			}
			else {
				$this->Session->setFlash('ログイン失敗');
			}
		}
	}
	
	public function logout() {
		$this->Session->delete('User.followList');
		$this->Session->delete('User.followCount');
		$this->Session->delete('User.tweetCount');
		
		$this->Auth->logout();
		$this->Session->setFlash('ログアウトしました。');
		
		$this->redirect(ROOT_URL.'/users/login');
	}
	
	public function followList($id = null, $mode = 'follow', $page = 1) {
		$this->view = 'user_list';
		
		//获得用户信息相关数据
		if ($id == null) {
			$id = AuthComponent::user('id');
			$this->set('user', AuthComponent::user());
			$this->set('followCount', $this->Session->read('User.followCount'));
			$this->set('tweetCount', $this->Session->read('User.tweetCount'));
		}
		else {
			$user = $this->User->find('first', array(
				'conditions' => array(
					'User.id' => $id
				)
			));
			$this->set('user', $user['User']);
			
			$this->set('followCount', $this->Follow->find('count', array(
				'conditions' => array(
					'Follow.user_id' => $id
				)
			)));
			$this->set('tweetCount', $this->Tweet->find('count', array(
				'conditions' => array(
					'Tweet.user_id' => $id
				)
			)));
		}

		$this->set('followedCount', $this->Follow->find('count', array(
			'conditions' => array(
				'Follow.user_id_follows' => $id
			)
		)));
		
		$this->set('mode', ($mode != 'followed') ? 'follow' : $mode);
		
		//获得该用户所follow或被follow的用户ID列表
		if ($id == AuthComponent::user('id') && $mode != 'followed') {
			$followList = $this->Session->read('User.followList');
		}
		else {
			$result = $this->Follow->find('all', array(
				'conditions' => array(
					'Follow.'.(($mode != 'followed') ? 'user_id' : 'user_id_follows') => $id
				),
				'fields' => array(($mode != 'followed') ? 'Follow.user_id_follows AS user_id' : 'user_id')
			));
			$followList = array();
			foreach ($result as $item) $followList[$item['Follow']['user_id']] = 1;
		}
		
		//查询用户信息
		$this->set('userList', $this->User->find('all', array(
			'conditions' => array(
				'User.id' => array_keys($followList)
			),
			'order' => 'User.id DESC',
			'limit' => 10,
			'page' => $page
		)));
		
		$this->set('page', $page);
	}
	
	public function userList($keyword = '', $page = 1) {
		
		$this->set('mode', 'search');
		$this->set('keyword', $keyword);
		$this->set('page', $page);
		
		if (strlen($keyword) >= 4) {
			//查询用户信息
			$this->set('userList', $this->User->find('all', array(
				'conditions' => array(
					'OR' => array(
						array(
							'User.username LIKE' => "%$keyword%"
						),
						array(
							'User.name LIKE' => "%$keyword%"
						)
					)
				),
				'limit' => 10,
				'page' => $page
			)));
		}
		else {
			$this->Session->setFlash('キーワードは4文字以上で検索してください。');
			$this->set('userList', array());
		}
		
	}
	
	public function searchUser() {
		if (isset($this->request->query['keyword'])) {
			if (strlen($this->request->query['keyword']) >= 4) {
				$this->redirect(ROOT_URL.'/users/userList/'.$this->request->query['keyword']);
			}
			else {
				$this->Session->setFlash('キーワードは4文字以上で検索してください。');
			}
		}
	}
	
	public function follow($id = null) {
		if ($id != null && $id != AuthComponent::user('id') && ! array_key_exists($id, $this->Session->read('User.followList'))) {
			if ($this->Follow->save(array('user_id' => AuthComponent::user('id'), 'user_id_follows' => $id)))
				$this->Session->write('User.followCount', $this->Session->read('User.followCount') + 1);
				$this->Session->write('User.followList.'.$id, 1);
		}
		$this->redirect(isset($this->request->query['redirect']) ? ROOT_URL.$this->request->query['redirect'] : ROOT_URL.'/tweets/index');
	}
	
	public function unfollow($id = null) {
		if ($id != null && array_key_exists($id, $this->Session->read('User.followList'))) {
			if ($this->Follow->deleteAll(array('user_id' => AuthComponent::user('id'), 'user_id_follows' => $id)))
				$this->Session->write('User.followCount', $this->Session->read('User.followCount') - 1);
				$this->Session->delete('User.followList.'.$id);
		}
		$this->redirect(isset($this->request->query['redirect']) ? ROOT_URL.$this->request->query['redirect'] : ROOT_URL.'/tweets/index');
	}
}