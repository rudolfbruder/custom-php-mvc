<?php

/**
 * 
 */
class Dogs_Model extends Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	function getRaces()
	{
		if (isset($_SESSION['u_id'])) {
			$sql = "SELECT race_Name FROM tbl_Races";
			$stmt = mysqli_stmt_init($this->conn);
			if (!mysqli_stmt_prepare($stmt,$sql)) {
				header("../index.php?error=sqlerror");
				exit();
			}else{
				mysqli_stmt_execute($stmt);		
				mysqli_stmt_store_result($stmt);	
				mysqli_stmt_bind_result($stmt,$name);
				$resultcheck = mysqli_stmt_num_rows($stmt);
				$races = array();
				if ($resultcheck > 0) {
					while (mysqli_stmt_fetch($stmt)) {
						$race = new stdclass();
						$race->name = $name;
						array_push($races, $race);
					}
				return $races;
				}
			}
		}
	}

	function createDog()
	{
		if(isset($_REQUEST)) {
			$target_dir = "../Images/DogProfileImages/";
			$file = $_FILES["profilePhoto"];

			if (is_uploaded_file($_FILES["profilePhoto"]["tmp_name"])) {
			
				$fileName = $_FILES["profilePhoto"]["name"];
				$fileTmpName = $_FILES["profilePhoto"]["tmp_name"];
				$fileSize = $_FILES["profilePhoto"]["size"];
				$fileError = $_FILES["profilePhoto"]["error"];
				$fileType = $_FILES["profilePhoto"]["type"];

				$fileExt = explode('.', $fileName);
				$fileActualExt = strtolower(end($fileExt));

				$allowed = array('jpg','jpeg','png');

				$result === 0;
				if (in_array($fileActualExt, $allowed)) {
					if ($fileError === 0) {
						if ($fileSize < 5000000) {

							$fileNameNew = uniqid('',true). '.' .$fileActualExt;

							$fileDestination = $target_dir . $fileNameNew;
							image_fix_orientation($fileTmpName);
							move_uploaded_file($fileTmpName, $fileDestination);
							$result = 1;

						}else{
							$result === 0;
						}
					}
				}else{
					$result === 0;
				}
			}
			$name = mysqli_real_escape_string($this->conn,$_POST['name']);
			$nickname= mysqli_real_escape_string($this->conn,$_POST['nickname']);
			$gender = mysqli_real_escape_string($this->conn,$_POST['gender']);
			$dateofbirth = mysqli_real_escape_string($this->conn,$_POST['dateofbirth']);
			$race = mysqli_real_escape_string($this->conn,$_POST['race']);
			$privacy = mysqli_real_escape_string($this->conn,$_POST['privacyset']);
			$placeOfBirth = mysqli_real_escape_string($this->conn,$_POST['placeOfBirth']);
			if ($privacy =="on") {
				$privacy ="off";
			}else{
				$privacy="on";
			}
			if (!isset($fileNameNew)) {
				$fileNameNew = "default.png";
			}
			$userId =  $_SESSION['u_id'];
			if (empty($name) || empty($nickname) || empty($gender) || empty($dateofbirth) || empty($race) || empty($userId)) {
				header("Location:../MyChamps.php?dog=empty");
				exit();
			}else{
				$sql = "INSERT INTO tbl_Dogs (dog_Name,dog_NickName,dog_Race,dog_Gender,dog_DateOfBirt,dog_OwnerId,dog_ProfilePicture,dog_Private,dog_PlaceOfBirth) VALUES (?,?,?,?,?,?,?,?,?);";
				$stmt = mysqli_stmt_init($this->conn);
				if (!mysqli_stmt_prepare($stmt,$sql)) {
				header("../MyChamps.php?dogregister=failed");
				exit();
				}
				else{
					//Insert the dog into the database
					mysqli_stmt_bind_param($stmt,"sssssisss",$name,$nickname,$race,$gender,$dateofbirth,$_SESSION['u_id'],$fileNameNew,$privacy,$placeOfBirth);
					mysqli_stmt_execute($stmt);
					mysqli_stmt_store_result($stmt);
					header("Location:/dogs/success/". mysqli_insert_id($this->conn));
					exit();
				}
			}
		}
	}

	//Retrieves my dogs and later loads them in table
	function getMyDogs()
	{
		if (isset($_SESSION['u_id'])) {
			$sql = "SELECT dog_Name,dog_NickName,dog_Race,dog_Id FROM tbl_Dogs WHERE dog_OwnerId=?";
			$stmt = mysqli_stmt_init($this->conn);
			if (!mysqli_stmt_prepare($stmt,$sql)) {
				header("../index.php?error=sqlerror");
				exit();
			}else{
				mysqli_stmt_bind_param($stmt,"s",$_SESSION['u_id']);
				mysqli_stmt_execute($stmt);		
				mysqli_stmt_store_result($stmt);	
				mysqli_stmt_bind_result($stmt,$name,$nickName,$race,$dogId);
				$resultcheck = mysqli_stmt_num_rows($stmt);
				$row = 1;
				$myDogs = array();
				if ($resultcheck > 0) {
					while (mysqli_stmt_fetch($stmt)) {
						$myDog = new stdclass();
						$myDog->row = $row;
						$myDog->dogId = $dogId;
						$myDog->name = $name;
						$myDog->nickName = $nickName;
						$myDog->race = $race;
						array_push($myDogs, $myDog);
				    	$row = $row + 1;
					}
					return $myDogs;
				}
			}
		}
	}

	function deleteDog($id)
	{
		if(isset($_REQUEST)) {
			$dogId = mysqli_real_escape_string($this->conn,$_POST['dogId']);
			$userId = $_SESSION['u_id'];
			if (empty($dogId)) {
				header("Location:../MyChamps.php?deletedog=empty");
				exit();
			}else{
				$sql = "DELETE FROM tbl_Dogs WHERE dog_Id=? AND dog_OwnerId=?";
				$stmt = mysqli_stmt_init($this->conn);
				if (!mysqli_stmt_prepare($stmt,$sql)) {
				header("../MyChamps.php?dogregister=failed");
				exit();
				}
				else{
					//Insert the dog into the database
					mysqli_stmt_bind_param($stmt,"ii",$dogId,$userId);
					mysqli_stmt_execute($stmt);
					mysqli_stmt_store_result($stmt);
				}			
			}
		}
	}

	function successCheck($id)
	{
		$dogId = mysqli_real_escape_string($this->conn,$id);
		$userId = $_SESSION['u_id'];
		if (empty($dogId)) {
			header("Location:/dogs");
			exit();
		}else{
			$sql = "SELECT dog_Id FROM tbl_Dogs WHERE dog_OwnerId=? AND dog_Id=?";
			$stmt = mysqli_stmt_init($this->conn);
			if (!mysqli_stmt_prepare($stmt,$sql)) {
				header("Location:/dogs");
				exit();
			}else{
				mysqli_stmt_bind_param($stmt,"ii",$userId,$dogId);
				mysqli_stmt_execute($stmt);		
				mysqli_stmt_store_result($stmt);	
				mysqli_stmt_bind_result($stmt,$idResult);
				mysqli_stmt_fetch($stmt);
				return $idResult;
			}
		}
	}

	function getDetails($id)
	{
		$dogId = mysqli_real_escape_string($this->conn,$id);
		$userId = $_SESSION['u_id'];
		$sql = "SELECT dog_Name,dog_NickName,dog_DateOfBirt,dog_Gender,dog_Race,dog_Private,dog_ProfilePicture,dog_PlaceOfBirth,dog_Id FROM tbl_Dogs WHERE dog_Id=? AND dog_OwnerId=?";
		$stmt = mysqli_stmt_init($this->conn);
		if (!mysqli_stmt_prepare($stmt,$sql)) {
			header("../index.php?error=sqlerror");
			exit();
		}else{
			mysqli_stmt_bind_param($stmt,"ii",$dogId,$userId);
			mysqli_stmt_execute($stmt);		
			mysqli_stmt_store_result($stmt);	
			mysqli_stmt_bind_result($stmt,$name,$nickName,$dateOfBirth,$gender,$race,$privacy,$picturePath,$placeOfBirth,$id);
			$resultcheck = mysqli_stmt_num_rows($stmt);
			$dogEdit = new stdClass();
			if ($resultcheck = 1) {
				while (mysqli_stmt_fetch($stmt)) {
					$dogEdit->id = $id;
					$dogEdit->name = $name;
					$dogEdit->nickName = $nickName;
					$dogEdit->dateOfBirth = $dateOfBirth;
					$dogEdit->gender = $gender;
					$dogEdit->race = $race;
					$dogEdit->privacy = $privacy;
					$dogEdit->picturePath = $picturePath;
					$dogEdit->placeOfBirth = $placeOfBirth;
				}
			}
			return $dogEdit;
		}
	}

	function update($id)
	{
		$name = mysqli_real_escape_string($this->conn,$_POST['name']);
		$nickname= mysqli_real_escape_string($this->conn,$_POST['nickname']);
		$gender = mysqli_real_escape_string($this->conn,$_POST['gender']);
		$dateofbirth = mysqli_real_escape_string($this->conn,$_POST['dateofbirth']);
		$race = mysqli_real_escape_string($this->conn,$_POST['race']);
		$privacy = mysqli_real_escape_string($this->conn,$_POST['privacyset']);
		$placeOfBirth = mysqli_real_escape_string($this->conn,$_POST['placeOfBirth']);
		$dogId = mysqli_real_escape_string($this->conn,$id);
		$userId = $_SESSION['u_id'];
		if ($privacy =="on") {
			$privacy ="off";
		}else{
			$privacy="on";
		}

		$target_dir = "../Images/DogProfileImages/";
		$file = $_FILES["profilePhoto"];

		if (is_uploaded_file($_FILES["profilePhoto"]["tmp_name"])) {
		
			$fileName = $_FILES["profilePhoto"]["name"];
			$fileTmpName = $_FILES["profilePhoto"]["tmp_name"];
			$fileSize = $_FILES["profilePhoto"]["size"];
			$fileError = $_FILES["profilePhoto"]["error"];
			$fileType = $_FILES["profilePhoto"]["type"];

			$fileExt = explode('.', $fileName);
			$fileActualExt = strtolower(end($fileExt));

			$allowed = array('jpg','jpeg','png');

			$result === 0;
			if (in_array($fileActualExt, $allowed)) {
				if ($fileError === 0) {
					if ($fileSize < 5000000) {

						$fileNameNew = uniqid('',true). '.' .$fileActualExt;

						$fileDestination = $target_dir . $fileNameNew;
						image_fix_orientation($fileTmpName);
						move_uploaded_file($fileTmpName, $fileDestination);
						$result = 1;

					}else{
						$result === 0;
					}
				}
			}else{
				$result === 0;
			}
			$sql = "UPDATE tbl_Dogs SET dog_Name=?,dog_NickName=?,dog_Gender=?,dog_Race=?,dog_DateOfBirt=?,dog_PlaceOfBirth=?,dog_Private=?,dog_ProfilePicture=? WHERE dog_OwnerId=? AND dog_Id=?;";
			$stmt = mysqli_stmt_init($this->conn);
			if (!mysqli_stmt_prepare($stmt,$sql)) {
				header("../index.php?error=sqlerror");
				exit();
			}else{
				mysqli_stmt_bind_param($stmt,"ssssssssii",$name,$nickname,$gender,$race,$dateofbirth,$placeOfBirth,$privacy,$fileNameNew,$userId,$dogId);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_store_result($stmt);
				header("Location: /dogs");
				exit();
			}
		}else{
			$sql = "UPDATE tbl_Dogs SET dog_Name=?,dog_NickName=?,dog_Gender=?,dog_Race=?,dog_DateOfBirt=?,dog_PlaceOfBirth=?,dog_Private=? WHERE dog_OwnerId=? AND dog_Id=?;";
			$stmt = mysqli_stmt_init($this->conn);
			if (!mysqli_stmt_prepare($stmt,$sql)) {
				header("../index.php?error=sqlerror");
				exit();
			}else{
				mysqli_stmt_bind_param($stmt,"sssssssii",$name,$nickname,$gender,$race,$dateofbirth,$placeOfBirth,$privacy,$userId,$dogId);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_store_result($stmt);
				header("Location: /dogs");
				exit();
			}
		}
	}
}
	
	