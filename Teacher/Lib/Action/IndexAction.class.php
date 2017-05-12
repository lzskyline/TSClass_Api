<?php
class IndexAction extends Action {
    public function index(){
	$this->show('Hello, World!','utf-8');
    }
}