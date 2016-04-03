<?php
class Post extends AppModel {
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'fields' => array('id', 'username')
		)
	);
	
	/*public $hasMany = array(
		'Rank' => array(
			'className' => 'Rank',
			'foreignKey' => 'post_id',
			'dependent' => true,
			'finderQuery' => 'SELECT AVG(Rank.rank) AS avg_rank FROM ranks AS Rank WHERE Rank.post_id = {$__cakeID__$}'
		)
	);*/
	
    public $validate = array(
        'title' => array(
            'rule' => 'notEmpty'
        ),
        'content' => array(
            'rule' => 'notEmpty'
        )
    );

	public function view($postId) {
		//ここのfieldの戻り値のチェックはやはり必要ないかと思います。
		$this->save(array('Post.id' => $postId, 'Post.views' => $this->field('Post.views', array('Post.id' => $postId)) + 1));
	}
	
	public function postList($page) {
		return $this->find('all', array(
			'order' => 'Post.post_time DESC',
			'limit' => MENUSHARE_PAGING,
			'page' => $page
		));
	}
	
	public function idExists($postId) {
		return ($this->find('count', array(
			'conditions' => array(
				'Post.id' => $postId
			)
		)) > 0);
	}
}

