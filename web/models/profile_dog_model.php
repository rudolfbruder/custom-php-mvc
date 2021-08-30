<?php

/**
 * 
 */
class Profile_Dog_Model extends Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	function profileExists($id)
	{
		if(isset($_SESSION['u_id'])) {
			$userId = $id;
			$defaultNumb = 0;
			$sql = "SELECT dog_Id FROM tbl_Dogs WHERE dog_Id=?";
			$stmt = mysqli_stmt_init($this->conn);
			if (!mysqli_stmt_prepare($stmt,$sql)) {
			header("../MyChamps.php?dogregister=failed");
			exit();
			}
			else{
				mysqli_stmt_bind_param($stmt,"i",$userId);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_store_result($stmt);
				mysqli_stmt_bind_result($stmt,$dogId);
				mysqli_stmt_fetch($stmt);
				return $dogId;
			}			
		}
	}

	function getCompetitionsCount($id)
	{
		if(isset($_SESSION['u_id'])) {
			$dogId = mysqli_real_escape_string($this->conn,$id);
			$sql = "SELECT COUNT(DISTINCT(award_Competition)) FROM tbl_Awards WHERE award_DogId = ?;";
			$stmt = mysqli_stmt_init($this->conn);
			if (!mysqli_stmt_prepare($stmt,$sql)) {
			header("../MyChamps.php?dogregister=failed");
			exit();
			}
			else{
				mysqli_stmt_bind_param($stmt,"i",$dogId);
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
			$dogId = mysqli_real_escape_string($this->conn,$id);
			$defaultNumb = 0;
			$sql = "SELECT SUM(tbl_AwardsTypes.type_Value) FROM tbl_Awards JOIN tbl_AwardsTypes ON tbl_Awards.award_TypeId = tbl_AwardsTypes.type_Id AND tbl_Awards.award_DogId=?;";
			$stmt = mysqli_stmt_init($this->conn);
			if (!mysqli_stmt_prepare($stmt,$sql)) {
			header("../MyChamps.php?dogregister=failed");
			exit();
			}
			else{
				mysqli_stmt_bind_param($stmt,"i",$dogId);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_store_result($stmt);
				mysqli_stmt_bind_result($stmt,$number);
				mysqli_stmt_fetch($stmt);
				$defaultNumb = $defaultNumb + $number;
				return $defaultNumb;
			}			
		}
	}

	function getProfileInfo($id)
	{
		if(isset($_SESSION['u_id'])) {
			$dogId = mysqli_real_escape_string($this->conn, $id);
			$sql = "SELECT dog_Name,dog_NickName,dog_DateOfBirt,dog_Gender,dog_Race,dog_PlaceOfBirth,dog_OwnerId,dog_ProfilePicture,dog_About,dog_ShortDesc FROM tbl_Dogs WHERE dog_Id=?";
			$stmt = mysqli_stmt_init($this->conn);
			if (!mysqli_stmt_prepare($stmt,$sql)) {
				header("../index.php?error=sqlerror");
				exit();
			}else{
				mysqli_stmt_bind_param($stmt,"i",$dogId);
				mysqli_stmt_execute($stmt);		
				mysqli_stmt_store_result($stmt);	
				mysqli_stmt_bind_result($stmt,$name,$nickName,$dateOfBirth,$gender,$race,$placeOfBirth,$ownerId,$picture,$about,$shortDesc);
				$resultcheck = mysqli_stmt_num_rows($stmt);
				$profile = new stdClass();
				if ($resultcheck = 1) {
					while (mysqli_stmt_fetch($stmt)) {
						$profile->name = $name;
						$profile->nickName = $nickName;
						$profile->dateOfBirth = $dateOfBirth;
						$profile->gender = $gender;
						$profile->race = $race;
						$profile->placeOfBirth = $placeOfBirth;
						$profile->ownerId = $ownerId;
						$profile->picture = $picture;
						$profile->about = $about;
						$profile->shortDesc = $shortDesc;
					}
				}
				return $profile;
			}
		}
	}

	function getProfileAwards($id)
	{
		if (isset($_SESSION['u_id'])) {
			$dogId = mysqli_real_escape_string($this->conn,$id);
			$sql = "SELECT tbl_AwardsTypes.type_Name,tbl_AwardsTypes.type_Value,tbl_Awards.award_Id,tbl_Awards.award_Date,tbl_Dogs.dog_Name,tbl_Competitions.comp_City FROM tbl_AwardsTypes INNER JOIN tbl_Awards ON tbl_AwardsTypes.type_Id = tbl_Awards.award_TypeId AND tbl_Awards.award_DogId = ? INNER JOIN tbl_Dogs ON tbl_Dogs.dog_Id=tbl_Awards.award_DogId INNER JOIN tbl_Competitions ON tbl_Competitions.comp_Id = tbl_Awards.award_Competition";
			$stmt = mysqli_stmt_init($this->conn);
			if (!mysqli_stmt_prepare($stmt,$sql)) {
				header("../index.php?error=sqlerror");
				exit();
			}else{
				mysqli_stmt_bind_param($stmt,"i",$dogId);
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

}