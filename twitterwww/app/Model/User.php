<?php
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

class User extends AppModel {
	
	public $hasMany = array(
		'Tweet' => array(
			'className' => 'Tweet',
			'foreignKey' => 'user_id',
			'order' => 'Tweet.post_time DESC',
			'limit' => 1,
			'dependent' => true
		)/*,
		'Follows' => array(
			'className' => 'Follow',
			'foreignKey' => 'user_id',
			'fields' => array('user_id_follows AS user_id'),
			'limit' => 10,
			'dependent' => true
		)
		'Followed' => array(
			'className' => 'Follow',
			'foreignKey' => 'user_id_follows',
			'fields' => array('user_id'),
			'limit' => 10,
			'dependent' => true
		)*/
	);
	
	public $validate = array(
		'name' => array(
			'rule' => array('between', 4, 20),
			'message' => '名前は4文字以上20文字以内で入力してください。'
		),
		'username' => array(
			array(
				'rule' => 'isUnique',
				'message' => '入力したユーザーは既に存在しています。'
			),
			array(
				'rule' => array('between', 4, 20),
				'message' => 'ユーザー名は4文字以上20文字以内で入力してください。'
			),
			array(
				'rule' => '/^\\w+$/',
				'message' => 'ユーザー名は[a-z]、[A-Z]、[0-9]、[_]で入力してください。'
			)
		),
		/*'password' => array(
			array(
				'rule' => array('between', 60, 60),
				'messgae' => 'パスワードに誤りがあります。'
			)
		),*/
		'mail_address' => array(
			array(
				'rule' => 'notEmpty',
				'message' => 'メールアドレスを入力してください。'
			),
			array(
				'rule' => array('maxLength', 100),
				'message' => 'メールアドレスは100文字以内で入力してください。'
			),
			array(
				'rule' => array('email', true),
				'message' => 'メールアドレスで入力してください。'
			)
		),
		'public' => array(
			'rule' => '/0|1/',
			'message' => '公開設定に誤りがあります。'
		)
	);
	
	public function beforeSave($options = array()) {
		$this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
		return true;
	}
}