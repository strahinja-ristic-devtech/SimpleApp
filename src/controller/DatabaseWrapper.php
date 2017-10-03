<?php
namespace Acme\Controller;

class DatabaseWrapper {

	public function __construct(iCrud $crud){
		$this->crud = $crud;

	}

	public function read($conn){

        //trying to return sql select object
		$result =  $this->crud->read($conn);
		//print_r($this);
		return $result;

	}

	public function insert($conn,$data){

		$this->crud->insert($conn,$data);
	}

	public function update($conn,$id,$data){

		$this->crud->update($conn,$id,$data);

	}

	public function delete($conn,$id){

		$this->crud->delete($conn,$id);

	}
	public function setCrud(iCrud $crud){
		$this->crud = $crud;

	}




}


