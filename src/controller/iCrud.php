<?php
namespace Acme\Controller;

interface iCrud {

	public function read($conn);
    public function insert($conn,$data);
    public function update($conn,$id,$data);
    public function delete($conn,$id);

}