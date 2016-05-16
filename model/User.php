<?php

Class User {
	private $id;
	private $kuerzel;
	private $vorname;
	private $nachname;
	private $rangId;
	
	public function getId(){
		return $this->id;
	}
	public function setId($id){
		$this->id = $id;
	}
	public function getKuerzel(){
		return $this->kuerzel;
	}
	public function setKuerzel($kuerzel){
		$this->kuerzel = $kuerzel;
	}
	public function getVorname(){
		return $this->vorname;
	}
	public function setVorname($vorname){
		$this->vorname = $vorname;
	}
	public function getNachname(){
		return $this->nachname;
	}
	public function setNachname($nachname){
		$this->nachname = $nachname;
	}
	public function getRangId(){
		return $this->rangId;
	}
	public function setRangId($rangId){
		$this->rangId = $rangId;
	}
}