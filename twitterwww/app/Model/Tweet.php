<?php
class Tweet extends AppModel {
	
	/*public $findMethods = array('home' => true);
	
	protected _findHome($state, $query, $results = array()) {
		
	}*/
	
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'fields' => array('id', 'name', 'username', 'email', 'public')
		)
	);
	
	public $validate = array(
		'content' => array(
			array(
				'rule' => array('maxLength', 140),
				'message' => 'つぶやきは140文字以下で入力してください。'
			),
			array(
				'rule' => array('minLength', 15),
				'message' => 'つぶやきは15文字以上で入力してください。'
			)
		)
	);
}