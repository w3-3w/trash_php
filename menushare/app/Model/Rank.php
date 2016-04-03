<?php
class Rank extends AppModel {
    public $validate = array(
        'rank' => array(
			array(
				'rule' => array('comparison', '>=', 1),
				'message' => '评分必须大于等于1'
			),
			array(
				'rule' => array('comparison', '<=', 5),
				'message' => '评分必须小于等于5'
			)
        ),
		'post_id' => array(
			'rule' => 'notEmpty',
			'message' => '必须指定文章ID'
		)
    );
	
	public function avgRank($postId) {
		$result = $this->find('first', array(
			'conditions' => array(
				'Rank.post_id' => $postId
			),
			'fields' => array('AVG(Rank.rank) AS avg_rank')
		));
		return sprintf("%.1f", round($result[0]['avg_rank'], 1));
	}
	
	public function isRanked($postId, $userId) {
		return ($this->find('count', array(
			'conditions' => array(
				'Rank.post_id' => $postId,
				'Rank.user_id' => $userId
			)
		)) > 0);
	}

}

