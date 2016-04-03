<?php
class SecretsController extends AppController {
	
    public function index() {
		$this->set('px', isset($this->request->query['px']) ? $this->request->query['px'] : '20');
		$this->set('py', isset($this->request->query['py']) ? $this->request->query['py'] : '20');
		$this->set('scale', isset($this->request->query['scale']) ? $this->request->query['scale'] : '20');
		$this->set('tick', isset($this->request->query['tick']) ? $this->request->query['tick'] : '50');
		$this->set('initLength', isset($this->request->query['initLength']) ? $this->request->query['initLength'] : '20');
		$this->set('bl', isset($this->request->query['bl']) ? $this->request->query['bl'] : '10');
		$this->set('br', isset($this->request->query['br']) ? $this->request->query['br'] : '400');
		$this->set('width', isset($this->request->query['width']) ? $this->request->query['width'] : '500');
		$this->set('height', isset($this->request->query['height']) ? $this->request->query['height'] : '500');
		$this->view = 'canvas';
    }
	
	public function canvas() {
		$this->set('px', isset($this->request->query['px']) ? $this->request->query['px'] : '5');
		$this->set('py', isset($this->request->query['py']) ? $this->request->query['py'] : '5');
		$this->set('scale', isset($this->request->query['scale']) ? $this->request->query['scale'] : '20');
		$this->set('tick', isset($this->request->query['tick']) ? $this->request->query['tick'] : '25');
		$this->set('initLength', isset($this->request->query['initLength']) ? $this->request->query['initLength'] : '50');
		$this->set('bl', isset($this->request->query['bl']) ? $this->request->query['bl'] : '5');
		$this->set('br', isset($this->request->query['br']) ? $this->request->query['br'] : '200');
		$this->set('width', isset($this->request->query['width']) ? $this->request->query['width'] : '500');
		$this->set('height', isset($this->request->query['height']) ? $this->request->query['height'] : '500');
	}
	
}