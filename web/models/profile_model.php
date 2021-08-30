<?php

/**
 * 
 */
class Profile_Model extends Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	function getCompetitionsCount($id)
	{
		if(isset($_SESSION['u_id'])) {
			$userId = $id;
			$sql = "SELECT COUNT(DISTINCT(award_Competition)) FROM tbl_Awards WHERE award_UserId = ?;";
			$stmt = mysqli_stmt_init($this->conn);
			if (!mysqli_stmt_prepare($stmt,$sql)) {
			header("../MyChamps.php?dogregister=failed");
			exit();
			}
			else{
				mysqli_stmt_bind_param($stmt,"i",$userId);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_store_result($stmt);
				mysqli_stmt_bind_result($stmt,$number);
				mysqli_stmt_fetch($stmt);
				return $number;
				
			}			
		}
	}

	function getPointsCount($id)
	{
		if(isset($_SESSION['u_id'])) {
			$userId = $id;
			$defaultNumb = 0;
			$sql = "SELECT SUM(tbl_AwardsTypes.type_Value) FROM tbl_Awards JOIN tbl_AwardsTypes ON tbl_Awards.award_TypeId = tbl_AwardsTypes.type_Id AND tbl_Awards.award_UserId=?;";
			$stmt = mysqli_stmt_init($this->conn);
			if (!mysqli_stmt_prepare($stmt,$sql)) {
			header("../MyChamps.php?dogregister=failed");
			exit();
			}
			else{
				mysqli_stmt_bind_param($stmt,"i",$userId);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_store_result($stmt);
				mysqli_stmt_bind_result($stmt,$number);
				mysqli_stmt_fetch($stmt);
				$defaultNumb = $defaultNumb + $number;
				return $defaultNumb;
				echo "<p>Ziskany pocet bodov: " .$defaultNumb. "</p>";
				
			}			
		}
	}

	function getProfileDogs($id)
	{
		if(isset($_SESSION['u_id'])) {
			$userId = $id;
			$sql = "SELECT dog_Id,dog_Name,dog_NickName,dog_Race,dog_Gender,dog_DateOfBirt,dog_ProfilePicture FROM tbl_Dogs WHERE dog_OwnerId=?";
			$stmt = mysqli_stmt_init($this->conn);
			if (!mysqli_stmt_prepare($stmt,$sql)) {
				header("../index.php?error=sqlerror");
				exit();
			}else{
				mysqli_stmt_bind_param($stmt,"s",$userId);
				mysqli_stmt_execute($stmt);		
				mysqli_stmt_store_result($stmt);	
				mysqli_stmt_bind_result($stmt,$id,$name,$nickName,$race,$dog_gender,$dogDateOfBirth,$image);
				$resultcheck = mysqli_stmt_num_rows($stmt);
				if ($resultcheck > 0) {
					$myProfileDogs = array();
					while (mysqli_stmt_fetch($stmt)) {
						$myProfileDog = new stdClass();
						$myProfileDog->id = $id;
						$myProfileDog->name = $name;
						$myProfileDog->nickName = $nickName;
						$myProfileDog->race = $race;
						$myProfileDog->dog_gender = $dog_gender;
						$myProfileDog->dogDateOfBirth = $dogDateOfBirth;
						$myProfileDog->image = $image;
						array_push($myProfileDogs, $myProfileDog);

					}
					return $myProfileDogs;
				}
			}
		}
	}

	function getProfileInfo($id)
	{
		if(isset($_SESSION['u_id'])) {
			$userId = $id;
			$sql = "SELECT user_FirstName,user_LastName,user_Address,user_Email,user_Private,user_Desc,user_ShortDesc,user_ProfilePicture FROM tbl_Users WHERE user_ID=?";
			$stmt = mysqli_stmt_init($this->conn);
			if (!mysqli_stmt_prepare($stmt,$sql)) {
				header("../index.php?error=sqlerror");
				exit();
			}else{
				mysqli_stmt_bind_param($stmt,"i",$userId);
				mysqli_stmt_execute($stmt);		
				mysqli_stmt_store_result($stmt);	
				mysqli_stmt_bind_result($stmt,$firstName,$lastName,$address,$contact,$privacy,$desc,$shortDesc,$picturePath);
				$resultcheck = mysqli_stmt_num_rows($stmt);
				$profile = new stdClass();
				if ($resultcheck = 1) {
					while (mysqli_stmt_fetch($stmt)) {
						$profile->firstName = $firstName;
						$profile->lastName = $lastName;
						$profile->address = $address;
						$profile->contact = $contact;
						$profile->desc = $desc;
						$profile->shortDesc = $shortDesc;
						$profile->picturePath = $picturePath;
						$profile->privacy = $privacy;
					}
				}
				return $profile;
			}
		}
	}

	function getProfileAwards($id)
	{
		if (isset($_SESSION['u_id'])) {
			$userId = $id;
			$sql = "SELECT tbl_AwardsTypes.type_Name,tbl_AwardsTypes.type_Value,tbl_Awards.award_Id,tbl_Awards.award_Date,tbl_Dogs.dog_Name,tbl_Competitions.comp_City FROM tbl_AwardsTypes INNER JOIN tbl_Awards ON tbl_AwardsTypes.type_Id = tbl_Awards.award_TypeId AND tbl_Awards.award_UserID = ? INNER JOIN tbl_Dogs ON tbl_Dogs.dog_Id=tbl_Awards.award_DogId INNER JOIN tbl_Competitions ON tbl_Competitions.comp_Id = tbl_Awards.award_Competition";
			$stmt = mysqli_stmt_init($this->conn);
			if (!mysqli_stmt_prepare($stmt,$sql)) {
				header("../index.php?error=sqlerror");
				exit();
			}else{
				mysqli_stmt_bind_param($stmt,"s",$userId);
				mysqli_stmt_execute($stmt);		
				mysqli_stmt_store_result($stmt);	
				mysqli_stmt_bind_result($stmt,$name,$points,$id,$date,$dogName,$city);
				$resultcheck = mysqli_stmt_num_rows($stmt);
				$row = 1;
				$awards = array();
				if ($resultcheck > 0) {
					while (mysqli_stmt_fetch($stmt)) {
						$award = new stdClass();
						$award->row = $row;
						$award->id = $id;
						$award->city = $city;
						$award->name = $name;
						$award->points = $points;
						$award->dogName = $dogName;
						$award->date = $date;
					    $row = $row + 1;
					    array_push($awards, $award);
					}
				}
				return $awards;
			}
		}
	}

	function getDetails()
	{
		if(isset($_SESSION['u_id'])) {
			$userId = $_SESSION['u_id'];
			$sql = "SELECT user_FirstName,user_LastName,user_Address,user_Email,user_Private,user_Desc,user_ShortDesc,user_ProfilePicture FROM tbl_Users WHERE user_ID=?";
			$stmt = mysqli_stmt_init($this->conn);
			if (!mysqli_stmt_prepare($stmt,$sql)) {
				header("../index.php?error=sqlerror");
				exit();
			}else{
				mysqli_stmt_bind_param($stmt,"i",$userId);
				mysqli_stmt_execute($stmt);		
				mysqli_stmt_store_result($stmt);	
				mysqli_stmt_bind_result($stmt,$firstName,$lastName,$address,$contact,$privacy,$desc,$shortDesc,$picturePath);
				$resultcheck = mysqli_stmt_num_rows($stmt);
				$user = new stdClass();
				if ($resultcheck = 1) {
					while (mysqli_stmt_fetch($stmt)) {
						$user->firstName = $firstName;
						$user->lastName = $lastName;
						$user->address = $address;
						$user->contact = $contact;
						$user->privacy = $privacy;
						$user->desc = $desc;
						$user->shortDesc = $shortDesc;
						$user->picturePath = $picturePath;
					}
				}
				return $user;
			}
		}
	}

	function updateProfile()
	{

		session_start();
		if(isset($_REQUEST)) {

			$target_dir = "../Images/ProfileImages/";

			$file = $_FILES["profilePhoto"];
			if (is_uploaded_file($_FILES["profilePhoto"]["tmp_name"])) {
				# code...
			
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

				$firstName = mysqli_real_escape_string($this->conn,$_POST['firstName']);
				$sureName = mysqli_real_escape_string($this->conn,$_POST['sureName']);
				$address= mysqli_real_escape_string($this->conn,$_POST['address']);
				$contact = mysqli_real_escape_string($this->conn,$_POST['contact']);
				$privacy = mysqli_real_escape_string($this->conn,$_POST['privacyset']);
				$description = mysqli_real_escape_string($this->conn,$_POST['desc']);
				$shortDescription = mysqli_real_escape_string($this->conn,$_POST['shortDesc']);
				$userId =  $_SESSION['u_id'];
				
				if ($privacy =="on") {
					$privacy ="off";
				}else{
					$privacy="on";
				}
				if (empty($firstName) || empty($sureName) ||  empty($address) || empty($contact)) {
					header("Location:../MyChamps.php?updateProfile=empty");
					exit();
					echo "string";
				}else{
					$sql = "UPDATE tbl_Users SET user_FirstName=?,user_LastName=?,user_Address=?,user_ProfilePicture=?,user_Contact=?,user_Private=?,user_Desc=?,user_ShortDesc=? WHERE user_Id=?;";
					$stmt = mysqli_stmt_init($this->conn);
					if (!mysqli_stmt_prepare($stmt,$sql)) {
						header("../MyChamps.php?updateProfile=failed");
						exit();

					}
					else{
						//Insert the dog into the database
						mysqli_stmt_bind_param($stmt,"ssssssssi",$firstName,$sureName,$address,$fileNameNew,$contact,$privacy,$description,$shortDesc,$userId);
						mysqli_stmt_execute($stmt);
						mysqli_stmt_store_result($stmt);
						header("Location: /profile/index/".$userId);
						exit();
					}
				}
			}else{
				$firstName = mysqli_real_escape_string($this->conn,$_POST['firstName']);
				$sureName = mysqli_real_escape_string($this->conn,$_POST['sureName']);
				$address= mysqli_real_escape_string($this->conn,$_POST['address']);
				$contact = mysqli_real_escape_string($this->conn,$_POST['contact']);
				$userId =  $_SESSION['u_id'];
				$privacy = mysqli_real_escape_string($this->conn,$_POST['privacyset']);
				$description = mysqli_real_escape_string($this->conn,$_POST['desc']);
				$shortDescription = mysqli_real_escape_string($this->conn,$_POST['shortDesc']);

				if ($privacy =="on") {
					$privacy ="off";
				}else{
					$privacy="on";
				}
				if (empty($firstName) || empty($sureName) ||  empty($address) || empty($contact)) {
					header("Location:../MyChamps.php?updateProfile=empty");
					exit();
				}else{
					$sql = "UPDATE tbl_Users SET user_FirstName=?,user_LastName=?,user_Address=?,user_Contact=?,user_Private=?,user_Desc=?,user_ShortDesc=? WHERE user_Id=?;";
					$stmt = mysqli_stmt_init($this->conn);
					if (!mysqli_stmt_prepare($stmt,$sql)) {
						header("../MyChamps.php?updateProfile=failed");
						exit();
					}
					else{
						//Insert the dog into the database
						mysqli_stmt_bind_param($stmt,"sssssssi",$firstName,$sureName,$address,$contact,$privacy,$description,$shortDescription,$userId);
						mysqli_stmt_execute($stmt);
						mysqli_stmt_store_result($stmt);
						header("Location: /profile/index/".$userId);
						exit();
					}
				}
			}
		}
	}

	function profileExists($id)
	{
		if(isset($_SESSION['u_id'])) {
			$userId = $id;
			$defaultNumb = 0;
			$sql = "SELECT user_Email FROM tbl_Users WHERE user_Id=?";
			$stmt = mysqli_stmt_init($this->conn);
			if (!mysqli_stmt_prepare($stmt,$sql)) {
			header("../MyChamps.php?dogregister=failed");
			exit();
			}
			else{
				mysqli_stmt_bind_param($stmt,"i",$userId);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_store_result($stmt);
				mysqli_stmt_bind_result($stmt,$email);
				mysqli_stmt_fetch($stmt);
				return $email;
			}			
		}
	}

	// function listMyArticles()
	// {
	// 	$userId = mysqli_real_escape_string($this->conn, $_SESSION['u_id']);

	// 	$sql = "SELECT Title,Content,dateOfModification,dateOfCreation FROM tbl_Articles WHERE user_Id=?;";
	// 	$stmt = mysqli_stmt_init($this->conn);
	// 	if (!mysqli_stmt_prepare($stmt,$sql)) {
	// 		return "asdasd";
	// 	header("../MyChamps.php?dogregister=failed");
	// 	exit();
	// 	}
	// 	else{
	// 		mysqli_stmt_bind_param($stmt,"i",$userId);
	// 		mysqli_stmt_execute($stmt);
	// 		mysqli_stmt_store_result($stmt);
	// 		mysqli_stmt_bind_result($stmt,$title,$content,$dateOfCreation,$dateOfModification);
	// 		$resultcheck = mysqli_stmt_num_rows($stmt);
	// 		$row = 1;
	// 		$myArticles = array();
	// 		if ($resultcheck > 0) {
	// 			while (mysqli_stmt_fetch($stmt)) {
	// 				$article = new stdclass();
	// 				$article->row = $row;
	// 				$article->title = $title;
	// 				$article->content = $content;
	// 				$article->dateOfCreation = $dateOfCreation;
	// 				$article->dateOfModification = $dateOfModification;
	// 				array_push($myArticles, $article);
	// 		    	$row = $row + 1;
	// 			}
	// 			return $myArticles;
	// 		}
	// 	}
	// }	

	function getArticles($id)
	{
		$userId = mysqli_real_escape_string($this->conn, $id);

		$sql = "SELECT Title,Content,dateOfModification,dateOfCreation FROM tbl_Articles WHERE user_Id=?;";
		$stmt = mysqli_stmt_init($this->conn);
		if (!mysqli_stmt_prepare($stmt,$sql)) {
			return "asdasd";
		header("../MyChamps.php?dogregister=failed");
		exit();
		}
		else{
			mysqli_stmt_bind_param($stmt,"i",$userId);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_store_result($stmt);
			mysqli_stmt_bind_result($stmt,$title,$content,$dateOfCreation,$dateOfModification);
			$resultcheck = mysqli_stmt_num_rows($stmt);
			$row = 1;
			$articles = array();
			if ($resultcheck > 0) {
				while (mysqli_stmt_fetch($stmt)) {
					$article = new stdclass();
					$article->row = $row;
					$article->title = $title;
					$article->content = $content;
					$article->dateOfCreation = $dateOfCreation;
					$article->dateOfModification = $dateOfModification;
					array_push($articles, $article);
			    	$row = $row + 1;
				}
				return $articles;
			}
		}
	}
}