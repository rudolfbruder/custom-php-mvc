<?php

/**
 * 
 */
class Awards_Model extends Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	//Gets dogs which i return in array and printout in specific select tag as options
	function getDogs()
	{
		@session_start();
		if (isset($_SESSION['u_id'])) {
			$sql = "SELECT dog_Name,dog_NickName,dog_Race,dog_Id FROM tbl_Dogs WHERE dog_OwnerId=?";
			$stmt = mysqli_stmt_init($this->conn);
			if (!mysqli_stmt_prepare($stmt,$sql)) {
				header("../../index.php?error=sqlerror");
				exit();
			}else{
				mysqli_stmt_bind_param($stmt,"s",$_SESSION['u_id']);
				mysqli_stmt_execute($stmt);		
				mysqli_stmt_store_result($stmt);	
				mysqli_stmt_bind_result($stmt,$name,$nickName,$race,$dogId);
				$resultcheck = mysqli_stmt_num_rows($stmt);
				$dogs = array();
				while (mysqli_stmt_fetch($stmt)) {
					$dog = new stdClass();
					$dog->id = $dogId;
					$dog->name = $name;
					array_push($dogs, $dog);
				}
				return $dogs;
				}
			}
	}
	
	//Gets all my awards and returns them in array which i print out in view	
	function getMyAwards()
	{
		if (isset($_SESSION['u_id'])) {
			$sql = "SELECT tbl_AwardsTypes.type_Name,tbl_AwardsTypes.type_Value,tbl_Awards.award_Id,tbl_Awards.award_Date,tbl_Dogs.dog_Name,tbl_Competitions.comp_City FROM tbl_AwardsTypes INNER JOIN tbl_Awards ON tbl_AwardsTypes.type_Id = tbl_Awards.award_TypeId AND tbl_Awards.award_UserId = ? INNER JOIN tbl_Dogs ON tbl_Dogs.dog_Id=tbl_Awards.award_DogId INNER JOIN tbl_Competitions ON tbl_Competitions.comp_Id = tbl_Awards.award_Competition";
			$stmt = mysqli_stmt_init($this->conn);
			if (!mysqli_stmt_prepare($stmt,$sql)) {
				header("../index.php?error=sqlerror");
				exit();
			}else{

				mysqli_stmt_bind_param($stmt,"s",$_SESSION['u_id']);
				mysqli_stmt_execute($stmt);		
				mysqli_stmt_store_result($stmt);	
				mysqli_stmt_bind_result($stmt,$name,$points,$id,$date,$dogName,$city);
				$resultcheck = mysqli_stmt_num_rows($stmt);
				$awards = array();
				$row = 1;
				if ($resultcheck > 0) {
					while (mysqli_stmt_fetch($stmt)) {
						$award = new stdClass();
						$award->row = $row;
						$award->id = $id;
						$award->name = $name;
						$award->points = $points;
						$award->dogName = $dogName;
						$award->city = $city;
						$award->date = $date;
						array_push($awards, $award);
						$row = $row + 1;
					}

					return $awards;
				}
			}
		}
	}
	

	function getPoints()
	{

		if(isset($_SESSION['u_id'])) {
			$sql = "SELECT SUM(tbl_AwardsTypes.type_Value) FROM tbl_Awards JOIN tbl_AwardsTypes ON tbl_Awards.award_TypeId = tbl_AwardsTypes.type_Id AND tbl_Awards.award_UserId=?";
			$stmt = mysqli_stmt_init($this->conn);
			if (!mysqli_stmt_prepare($stmt,$sql)) {
			exit();
			}
			else{
				mysqli_stmt_bind_param($stmt,"i",$_SESSION['u_id']);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_store_result($stmt);
				mysqli_stmt_bind_result($stmt,$number);
				mysqli_stmt_fetch($stmt);
				$resultPoints = 0 + $number;
				return $resultPoints;
			}			
		}
	}

	function getCountOfCompetitions()
	{
		if(isset($_SESSION['u_id'])) {
			$sql = "SELECT COUNT(DISTINCT(award_Competition)) FROM tbl_Awards WHERE award_UserId = ?";
			$stmt = mysqli_stmt_init($this->conn);
			if (!mysqli_stmt_prepare($stmt,$sql)) {
			}
			else{
				mysqli_stmt_bind_param($stmt,"i",$_SESSION['u_id']);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_store_result($stmt);
				mysqli_stmt_bind_result($stmt,$number);
				mysqli_stmt_fetch($stmt);
				return $number;
			}			
		}
	}

	function getScore()
	{
		$score =5;
		return $score;
	}

	function getCompetitions()
	{
		if (isset($_SESSION['u_id'])) {
			$sql = "SELECT comp_Id,comp_City,comp_Date FROM tbl_Competitions";
			$stmt = mysqli_stmt_init($this->conn);
			if (!mysqli_stmt_prepare($stmt,$sql)) {
				header("../index.php?error=sqlerror");
				exit();
			}else{
				mysqli_stmt_execute($stmt);		
				mysqli_stmt_store_result($stmt);	
				mysqli_stmt_bind_result($stmt,$id,$city,$date);
				$resultcheck = mysqli_stmt_num_rows($stmt);
				$competitions = array();
				if ($resultcheck > 0) {
					while (mysqli_stmt_fetch($stmt)) {
						$comp = new stdClass();
						$comp->id = $id;
						$comp->city = $city;
						$comp->date = $date;
						array_push($competitions, $comp);
					}
				return $competitions;
				}
			}
		}
	}

	function getAwardsOptions()
	{
		if (isset($_SESSION['u_id'])) {
			$sql = "SELECT type_Id,type_Name FROM tbl_AwardsTypes";
			$stmt = mysqli_stmt_init($this->conn);
			if (!mysqli_stmt_prepare($stmt,$sql)) {
				header("../index.php?error=sqlerror");
				exit();
			}else{
				mysqli_stmt_execute($stmt);		
				mysqli_stmt_store_result($stmt);	
				mysqli_stmt_bind_result($stmt,$id,$name);
				$resultcheck = mysqli_stmt_num_rows($stmt);
				$awards = array();
				if ($resultcheck > 0) {
					while (mysqli_stmt_fetch($stmt)) {
						$award = new stdClass();
						$award->id = $id;
						$award->name = $name;
						array_push($awards, $award);
					}
				}
				return $awards;
			}
		}
	}

	function create()
	{
			
		$dogId = mysqli_real_escape_string($this->conn,$_POST['dogId']);
		$competitionId= mysqli_real_escape_string($this->conn,$_POST['competition']);
		$awardId = mysqli_real_escape_string($this->conn,$_POST['award']);
		$comment = mysqli_real_escape_string($this->conn,$_POST['comment']);
		$userId =  $_SESSION['u_id'];
		if (empty($dogId) || empty($competitionId) || empty($awardId) || empty($comment)) {
			header("Location:../MyChamps.php?dog=".$dogId."competition=" .$competitionId."awardid=".$awardid."date=".$comment);
			exit();
		}else{

			$sql = "SELECT comp_Date FROM tbl_Competitions WHERE comp_Id =?";
			$stmt = mysqli_stmt_init($this->conn);
			if (!mysqli_stmt_prepare($stmt,$sql)) {
			header("../MyChamps.php?dogregister=failed");
			exit();
			}
			else{
				mysqli_stmt_bind_param($stmt,"i",$competitionId);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_store_result($stmt);
				mysqli_stmt_bind_result($stmt,$compdate);
				$resultcheck = mysqli_stmt_num_rows($stmt);
				if ($resultcheck > 0) {
					while (mysqli_stmt_fetch($stmt)) {
						$date = str_replace("/","-",substr($compdate, -10));
					}
					$sql = "INSERT INTO tbl_Awards (award_UserId,award_DogId,award_TypeId,award_Date,award_Comment,award_Competition) VALUES (?,?,?,?,?,?)";
					$stmt = mysqli_stmt_init($this->conn);
					if (!mysqli_stmt_prepare($stmt,$sql)) {
					header("../MyChamps.php?dogregister=failed");
					exit();
					}
					else{
						//Insert the dog into the database
						mysqli_stmt_bind_param($stmt,"iiissi",$userId,$dogId,$awardId,$date,$comment,$competitionId);
						mysqli_stmt_execute($stmt);
						mysqli_stmt_store_result($stmt);
					}
				}
				else{
					header("Location: ../MyChamps.php?newaward=failed");
				}
			}
		}
	}

	function update($id)
	{
		$dogId = mysqli_real_escape_string($this->conn,$_POST['dogId']);
		$competitionId= mysqli_real_escape_string($this->conn,$_POST['competition']);
		$awardTypeId = mysqli_real_escape_string($this->conn,$_POST['award']);
		$comment = mysqli_real_escape_string($this->conn,$_POST['comment']);
		$userId =  $_SESSION['u_id'];
		$awardId = mysqli_real_escape_string($this->conn,$id);

		$sql = "SELECT comp_Date FROM tbl_Competitions WHERE comp_Id =?";
		$stmt = mysqli_stmt_init($this->conn);
		if (!mysqli_stmt_prepare($stmt,$sql)) {
		header("../MyChamps.php?dogregister=failed");
		exit();
		}
		else{
			mysqli_stmt_bind_param($stmt,"i",$competitionId);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_store_result($stmt);
			mysqli_stmt_bind_result($stmt,$compdate);
			$resultcheck = mysqli_stmt_num_rows($stmt);
			if ($resultcheck > 0) {
				while (mysqli_stmt_fetch($stmt)) {
					$date = str_replace("/","-",substr($compdate, -10));
				}
				$sql = "UPDATE tbl_Awards SET award_DogId=?,award_TypeId=?,award_Date=?,award_Comment=?,award_Competition=? WHERE award_Id=? AND award_UserId=? ";
				$stmt = mysqli_stmt_init($this->conn);
				if (!mysqli_stmt_prepare($stmt,$sql)) {
				header("../MyChamps.php?dogregister=failed");
				exit();
				}
				else{
					//Insert the dog into the database
					mysqli_stmt_bind_param($stmt,"iisssii",$dogId,$awardTypeId,$date,$comment,$competitionId,$awardId,$userId);
					mysqli_stmt_execute($stmt);
					mysqli_stmt_store_result($stmt);
					header("Location: /awards/myawards");
					exit();
				}
			}
			else{
				header("Location: ../MyChamps.php?newaward=failed");
			}
		}
	}
	function delete()
	{
		if(isset($_REQUEST)) {
			$awardId = mysqli_real_escape_string($this->conn,$_POST['awardId']);

			$sql = "DELETE FROM tbl_Awards WHERE award_Id=? AND award_UserId=?";
			$stmt = mysqli_stmt_init($this->conn);
			if (!mysqli_stmt_prepare($stmt,$sql)) {
			header("../MyChamps.php?dogregister=failed");
			exit();
			}
			else{
				mysqli_stmt_bind_param($stmt,"ii",$awardId,$userId);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_store_result($stmt);
			}			
		}
	}

	function getDetails($id)
	{
		$awardId = mysqli_real_escape_string($this->conn,$id);
		$userId = $_SESSION['u_id'];
		$sql = "SELECT award_Id,award_DogId,award_Competition,award_TypeId,award_Comment FROM tbl_Awards WHERE award_Id=? AND award_UserId=?";
		$stmt = mysqli_stmt_init($this->conn);
		if (!mysqli_stmt_prepare($stmt,$sql)) {
		header("../MyChamps.php?dogregister=failed");
		exit();
		}
		else{
			mysqli_stmt_bind_param($stmt,"ii",$awardId,$userId);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_store_result($stmt);
			mysqli_stmt_bind_result($stmt,$id,$dogId,$compId,$awardTypeId,$comment);
			$resultcheck = mysqli_stmt_num_rows($stmt);
			$award = new stdClass();
			if ($resultcheck > 0) {
				while (mysqli_stmt_fetch($stmt)) {
					$award->id = $id;
					$award->dogId = $dogId;
					$award->compId = $compId;
					$award->awardTypeId = $awardTypeId;
					$award->comment = $comment;
				}
			}
			return $award;
		}
	}

	function getLeaderboardBestDogs()
	{
		if(isset($_SESSION['u_id'])) {
			$sql = "SELECT tbl_Users.user_FirstName,tbl_Users.user_LastName,tbl_Dogs.dog_Name,tbl_Dogs.dog_Race,tbl_Dogs.dog_Gender, SUM(tbl_AwardsTypes.type_Value) FROM tbl_Dogs INNER JOIN tbl_Awards ON tbl_Awards.award_DogId = tbl_Dogs.dog_Id INNER JOIN tbl_AwardsTypes ON tbl_AwardsTypes.type_Id = tbl_Awards.award_TypeId INNER JOIN tbl_Users ON tbl_Dogs.dog_OwnerId = tbl_Users.user_Id GROUP BY tbl_Dogs.dog_Id;";
			$stmt = mysqli_stmt_init($this->conn);
			if (!mysqli_stmt_prepare($stmt,$sql)) {
			header("../MyChamps.php?dogregister=failed");
			exit();
			}
			else{
				mysqli_stmt_execute($stmt);		
				mysqli_stmt_store_result($stmt);	
				mysqli_stmt_bind_result($stmt,$firstName,$lastName,$dogName,$dogRace,$dogGender,$point);
				$resultcheck = mysqli_stmt_num_rows($stmt);
				$row = 1;
				$bestDogs = array();
				if ($resultcheck > 0) {
					while (mysqli_stmt_fetch($stmt)) {
						$bestDog = new stdClass();
						$bestDog->row = $row;
						$bestDog->name = $dogName;
						$bestDog->race = $dogRace;
						$bestDog->gender = $dogGender;
						$bestDog->firstName = $firstName;
						$bestDog->lastName = $lastName;
						$bestDog->point = $point;
				    	array_push($bestDogs, $bestDog);
				    	$row = $row + 1;
					}
				}
				return $bestDogs;
			}			
		}
	}

	function getLeaderboardBestMembers()
	{
		if(isset($_SESSION['u_id'])) {
			$sql = "SELECT tbl_Users.user_FirstName,tbl_Users.user_LastName, SUM(tbl_AwardsTypes.type_Value) FROM tbl_Users INNER JOIN tbl_Awards ON tbl_Awards.award_UserId = tbl_Users.user_Id INNER JOIN tbl_AwardsTypes ON tbl_AwardsTypes.type_Id = tbl_Awards.award_TypeId GROUP BY tbl_Users.user_Id;";
			$stmt = mysqli_stmt_init($this->conn);
			if (!mysqli_stmt_prepare($stmt,$sql)) {
			header("../MyChamps.php?dogregister=failed");
			exit();
			}
			else{
				mysqli_stmt_execute($stmt);		
				mysqli_stmt_store_result($stmt);	
				mysqli_stmt_bind_result($stmt,$firstName,$lastName,$point);
				$resultcheck = mysqli_stmt_num_rows($stmt);
				$row = 1;
				$bestUsers = array();
				if ($resultcheck > 0) {
					while (mysqli_stmt_fetch($stmt)) {
						$bestUser = new stdClass();
						$bestUser->row = $row;
						$bestUser->firstName = $firstName;
						$bestUser->lastName = $lastName;
						$bestUser->point = $point;
				    	$row = $row + 1;
				    	array_push($bestUsers, $bestUser);
					}
					return $bestUsers;
				}
			}			
		}
	}

	function getDogCount()
	{
		if(isset($_SESSION['u_id'])) {
		$sql = "SELECT COUNT(dog_Id) FROM tbl_Dogs;";
		$stmt = mysqli_stmt_init($this->conn);
		if (!mysqli_stmt_prepare($stmt,$sql)) {
			header("../MyChamps.php?dogregister=failed");
			exit();
		}else{
				mysqli_stmt_execute($stmt);
				mysqli_stmt_store_result($stmt);
				mysqli_stmt_bind_result($stmt,$number);
				mysqli_stmt_fetch($stmt);
				return $number;
			}			
		}
	}

	function getUserCount()
	{
		if(isset($_SESSION['u_id'])) {
			$sql = "SELECT COUNT(user_Id) FROM tbl_Users WHERE user_Verified=? ;";
			$verified = 1;
			$stmt = mysqli_stmt_init($this->conn);
			if (!mysqli_stmt_prepare($stmt,$sql)) {
			header("../MyChamps.php?dogregister=failed");
			exit();
			}
			else{
				mysqli_stmt_bind_param($stmt,"i",$verified);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_store_result($stmt);
				mysqli_stmt_bind_result($stmt,$number);
				mysqli_stmt_fetch($stmt);
				return $number;
			}			
		}
	}

	function getAwardCount()
	{
		if(isset($_SESSION['u_id'])) {
			$sql = "SELECT COUNT(tbl_Awards.award_Id) FROM tbl_Awards;";
			$stmt = mysqli_stmt_init($this->conn);
			if (!mysqli_stmt_prepare($stmt,$sql)) {
			header("../MyChamps.php?dogregister=failed");
			exit();
			}
			else{
				mysqli_stmt_execute($stmt);
				mysqli_stmt_store_result($stmt);
				mysqli_stmt_bind_result($stmt,$number);
				mysqli_stmt_fetch($stmt);
				return $number;				
			}			
		}
	}
}