<?php
Class Rang{
	private $id;
	private $rang;
	
	public function getId(){
		return $this->id;
	}
	public function setId($id){
		$this->id = $id;
	}
	public function getRang(){
		return $this->rang;
	}
	public function setRang($rang){
		$this->rang = $rang;
	}
}