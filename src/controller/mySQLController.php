<?php
namespace Acme\Controller;
	class mySQLController implements iCrud {




		public function read($conn){


			$sql = "SELECT * FROM guests ORDER BY guestID DESC;";
			//$result = $conn->query($sql); 
			$result = mysqli_query($conn,$sql);



			return $result;



		}

		public function insert($conn,$data){

			$sql = "INSERT INTO guests values ('$data[id]','$data[name]','$data[surname]')";
			$result = $conn->query($sql);

			return $result;

		}

		public function update($conn,$data){
			$sql = "UPDATE guests set name='$data[name]', surname='$data[surname]' where id='$data[id]'";
			$result = $conn ->query($sql);


		}

		public function delete($conn,$id){
			$sql = "DELETE from guests where id='$id'";
			$result = $conn ->query($sql);

		}

	}
	

	?>