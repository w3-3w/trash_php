<?php
class RanksController extends AppController {
	public $components = array('RequestHandler');
	
    public function rank($id = null, $rank = 0) {
		if ($id === null) {
			$this->set(array('message' => 'illegal', '_serialize' => array('message')));
		}
		else {
			if (! $this->Rank->isRanked($id, $this->Auth->user('id'))) {
				$data = array();
				$data['Rank']['user_id'] = $this->Auth->user('id');
				$data['Rank']['post_id'] = $id;
				$data['Rank']['rank'] = $rank;
				if ($this->Rank->save($data)) {
					$this->set(array('message' => 'success', 'avg_rank' => $this->Rank->avgRank($id), '_serialize' => array('message', 'avg_rank')));
				}
				else {
					$this->set(array('message' => 'fail', '_serialize' => array('message')));
				}
			}
			else {
				$this->set(array('message' => 'duplicate', '_serialize' => array('message')));
			}
		}
    }
	
}