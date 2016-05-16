<?php
class Size {
	private $id;
	private $size;
	
	public function getId() {
		return $this->id;
	}
	public function setId($id){
		$this->id = $id;
	}
	public function getSize(){
		return $this->size;
	}
	public function setSize($size){
		$this->size = $size;
	}
}