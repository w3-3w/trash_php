<?php
class TweetsController extends AppController {
	
	public $uses = array('User', 'Follow', 'Tweet');
	
	public function index($page = 1) {
		
		//投稿框相关数据
		$this->set('showSendPanel', true);
		$this->set('myLastTweet', $this->Tweet->find('first', array(
			'conditions' => array(
				'Tweet.user_id' => AuthComponent::user('id')
			),
			'fields' => array('Tweet.content', 'Tweet.post_time'),
			'order' => 'Tweet.post_time DESC'
		)));
		
		//获得该用户所follow的用户ID列表
		$followList = $this->Session->read('User.followList');
		
		//主页tweet相关数据
		$this->set('tweets', $this->Tweet->find('all', array(
			'conditions' => array(
				'OR' => array(
					array(
						'Tweet.user_id' => array_keys($followList),
						'User.public' => 1
					),
					array(
						'Tweet.user_id' => AuthComponent::user('id')
					)
				)
			),
			'order' => 'Tweet.post_time DESC',
			'limit' => 10,
			'page' => $page
		)));
		$this->set('page', $page);
		
		//获得用户信息相关数据
		$this->set('user', AuthComponent::user());
		$this->set('followCount', $this->Session->read('User.followCount'));
		$this->set('followedCount', $this->Follow->find('count', array(
			'conditions' => array(
				'Follow.user_id_follows' => AuthComponent::user('id')
			)
		)));
		$this->set('tweetCount', $this->Session->read('User.tweetCount'));
	}
	
	public function user($id = null, $page = 1) {
		
		if ($id == null) $id = AuthComponent::user('id');
		$this->view = 'index';
		
		//投稿框相关数据
		$this->set('showSendPanel', false);
		
		//获得用户信息相关数据
		$public = true;
		if ($id == AuthComponent::user('id')) {
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
			$public = $user['User']['public'] == 1;
		}
		$this->set('followedCount', $this->Follow->find('count', array(
			'conditions' => array(
				'Follow.user_id_follows' => $id
			)
		)));
		
		//该用户的tweet相关数据
		$this->set('tweets', $public ? $this->Tweet->find('all', array(
			'conditions' => array(
				'Tweet.user_id' => $id
			),
			'order' => 'Tweet.post_time DESC',
			'limit' => 10,
			'page' => $page
		)) : array());
		$this->set('page', $page);
		
	}
	
	public function send() {
		if ($this->request->is('post')) {
			$this->Tweet->create();
			$tweet = $this->request->data;
			$tweet['Tweet']['post_time'] = date('Y-m-d H:i:s');
			if ($this->Tweet->save($tweet))
				$this->Session->write('User.tweetCount', $this->Session->read('User.tweetCount') + 1);
			else
				$this->Session->setFlash('投稿失敗');
		}
		
		$this->redirect(ROOT_URL.'/tweets/index');
	}
	
	public function delete($id = null) {
		if ($id) {
			$result = $this->Tweet->find('first', array(
				'conditions' => array(
					'Tweet.id' => $id
				)
			));
			$result = $result['Tweet']['user_id'];
			if ($result == AuthComponent::user('id')) {
				if ($this->Tweet->delete($id)) $this->Session->write('User.tweetCount', $this->Session->read('User.tweetCount') - 1);
			}
		}
		$this->redirect(isset($this->request->query['redirect']) ? ROOT_URL.$this->request->query['redirect'] : ROOT_URL.'/tweets/index');
	}
	
}