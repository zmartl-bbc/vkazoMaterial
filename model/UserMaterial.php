<?php
Class UserMaterial {
	private $kuerzel;
	private $serialnumber;
	private $material;
	private $size;
	private $received;
	
	public function getKuerzel(){
		return $this->kuerzel;
	}
	public function setKuerzel($kuerzel){
		$this->kuerzel = $kuerzel;
	}
	public function getSerialNumber(){
		return $this->serialnumber;
	}
	public function setSerialNumber($serialnumber){
		$this->serialnumber = $serialnumber;
	}
	public function getMaterial(){
		return $this->material;
	}
	public function setMaterial($material){
		$this->material = $material;
	}
	public function getSize(){
		return $this->size;
	}
	public function setSize($size){
		$this->size = $size;
	}
	public function getReceived(){
		return $this->received;
	}
	public function setReceived($received){
		$this->received = $received;
	}
}