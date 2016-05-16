<?php
Class Material {
	private $description;
	private $size;
	
	public function getDescription(){
		return $this->description;
	}
	public function setDescription($description){
		$this->description = $description;
	}
	public function getSize(){
		return $this->size;
	}
	public function setSize($size){
		$this->size = $size;
	}
}