<?php
class PostsController extends AppController {
	
	public $uses = array('Post', 'Rank');
	
    public function index($page = 1) {
		$pageCount = ceil($this->Post->find('count') / MENUSHARE_PAGING);
		if (! is_numeric($page)) {
			$page = 1;
		}
		elseif ($page > $pageCount) {
			$page = $pageCount;
		}
		else {
			$page = floor($page);
		}
		
		$this->set('page', $page);
		$this->set('pageCount', $pageCount);
		if ($page <= $pageCount) {
			$posts = $this->Post->postList($page);
			foreach ($posts as $no => $post) {
				$posts[$no]['Rank']['avg_rank'] = $this->Rank->avgRank($post['Post']['id']);
			}
			$this->set('posts', $posts);
		}
		else {
			$this->set('posts', array());
		}
    }

    public function view($id = null) {
        if (($id === null) || (! $this->Post->idExists($id))) {
			$this->redirect('/posts/index');
		}
		else {
			$this->Post->id = $id;
			$this->set('post', $this->Post->read());
			$this->Post->view($id);
			$this->set('isRanked', $this->Rank->isRanked($id, $this->Auth->user('id')));
			$this->set('avgRank', $this->Rank->avgRank($id));
		}
    }

    public function add() {
        if ($this->request->is('post')) {
			$goodImg = array();
			foreach ($this->request->data['Image'] as $no => $img) {
				//ここは、イメージがデータベースに保存しているではなく、SinaAppEngineの提供したサービスを使っているため、CakePHPのバレデーション機能が使えません
				//こう書くしかない
				if ((is_uploaded_file($img['tmp_name'])) && ($img['size'] <= MENUSHARE_MAXIMAGESIZE) && (in_array($img['type'], array('image/jpeg', 'image/pjpeg'))) && (count($goodImg) <= MENUSHARE_MAXIMAGES))
					$goodImg[] = $no;
			}
			if (count($goodImg) >= 1) {
				$this->request->data('Post.img_count', count($goodImg));
				if ($this->Post->save($this->request->data)) {
					//存图片
					$saeStorage = new SaeStorage('mm2l1xjy5n', 'm4hw5li1m5jhkhzx5h32iwylk1h0mk034zm04lyh'); //初始化SAE Storage对象，使用ACCESSKEY和SECRETKEY
					foreach ($goodImg as $imgNo => $no) {
						$saeStorage->upload('postimages', $this->Post->id.'_'.$imgNo.'.jpg', $this->request->data['Image'][$no]['tmp_name']);
					}
					
					$this->Session->setFlash(__('发表成功'));
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('发表失败'));
				}
			}
			else {
				$this->Session->setFlash(__('图片不合要求'));
			}
        }
		$this->set('title', $this->request->data('Post.title'));
		$this->set('content', $this->request->data('Post.content'));
    }
	
}