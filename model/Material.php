<?php
Class Material {
	private $serialnumber;
	private $description;
	private $size;
	
	public function getSerialNumber(){
		return $this->serialnumber;
	}
	public function setSerialNumber($serialnumber){
		$this->serialnumber = $serialnumber;
	}
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