<?php

class UsersController extends AppController {
	
	public function index() {
		$this->redirect('/users/login');
	}
	
	public function register() {
		if ($this->Auth->loggedIn()) {
			$this->redirect('/posts');
		}
		
		if ($this->request->is('post')) {
			if ($this->User->save($this->request->data)) {
				$this->view = 'login';
				$this->Session->setFlash(__($this->request->data['User']['username'].'注册成功'));
				$this->set('username', $this->request->data('User.username'));
			}
			else {
				$this->Session->setFlash(__('注册失败'));
			}
		}
	}

    public function login() {
		if ($this->Auth->loggedIn()) {
			$this->redirect('/posts/index');
		}
		
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                $this->redirect('/posts');
            } else {
                $this->Session->setFlash(__('登录失败'));
            }
        }
		$this->set('username', $this->request->data('User.username'));
    }

    public function logout() {
		$this->Session->setFlash(__('已注销'));
		$this->Auth->logout();
        $this->redirect('/users/login');
    }
	
}
