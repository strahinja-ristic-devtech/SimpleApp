<?php
namespace Acme\Controller;

	class mongoDBController implements iCrud {


		public function read($conn){


		    $data = null;

		    $table = $conn->myguest;

		    $cursor = $table->find();

		    foreach ($cursor as $document){

		        $data[] = $document;
            }

           // var_dump($data);

            return $data;


		}

		public function insert($conn,$data){

		    $table = $conn->myguest;

            //var_dump($data);

            $table->insertOne(["_id" => (int) $data[id],"name"=>$data[name],"prezime"=>$data[prezime]]);
          //  $table->insert(["_id" => (int) $data[id],"name"=>$data[name],"prezime"=>$data[prezime]]);

        }

		public function update($conn,$id,$data){
		    $table = $conn->myguest;

            $newdata = array('$set'=> array($data));
		    $table->updateOne(["_id"=> (int) $id],['$set'=>["name"=>$data[name],"prezime"=>$data[prezime]]]);
		}

		public function delete($conn,$id){

            $table = $conn->myguest;

            $table->deleteOne(['_id'=> (int) $id]);
		}


	}

	?>