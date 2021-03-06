<?php
namespace Acme\Controller;
	class mySQLController implements iCrud {




		public function read($conn){

            $data=null;
			$sql = "SELECT * FROM guest;";
			$result = $conn->query($sql);
			//$result = mysqli_query($conn,$sql);

			if($result->num_row === 0){

				echo "No rows found";
			}
			else{

            	while ( $row = $result->fetch_array(MYSQLI_ASSOC)) {
                	$data[] = $row;
            	}

        	}

            return $data;



		}

		public function insert($conn,$data){

			$sql = "INSERT INTO guest value (?,?,?)";
            $stmt = $conn->prepare($sql);

            $stmt -> bind_param("iss",$data[id],$data[name],$data[surname]);

			$stmt->execute();

		//	return $result;

		}

		public function update($conn,$id,$data){
			$sql = "UPDATE guest set name=?, surname=? where id=?";
			$stmt = $conn ->prepare($sql);

            $stmt ->bind_param("ssi",$data[name],$data[surname],$id);


			$stmt->execute();


		}

		public function delete($conn,$id){
			$sql = "DELETE from guest where id=?";
			$stmt = $conn->prepare($sql);
			$stmt -> bind_param("i",$id);

			$stmt ->execute();

		}

	}
	

	?>