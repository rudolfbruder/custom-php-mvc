<?php

/**
 * 
 */

class Dashboard_Model extends Model
{

	function __construct()
	{
		parent::__construct();
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
			}else{
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

	
	function search()
	{
		if(isset($_REQUEST)) {
			$search = mysqli_real_escape_string($this->conn,$_POST['searchMembers']);
			$privacy ="off";
			$searchResults = array();
			$sql = "SELECT CONCAT(user_FirstName, ' ',user_LastName) as name,user_Id as Id,user_ProfilePicture as Picture, 'Person' as 'type' FROM tbl_Users WHERE user_Private=? AND user_LastName LIKE '%".$search."%' UNION ALL SELECT dog_Name as Name,dog_Id as Id,dog_ProfilePicture as Picture, 'Dog' as 'type' FROM tbl_Dogs WHERE dog_Name LIKE '%".$search."%';";
			$stmt = mysqli_stmt_init($this->conn);
			if (!mysqli_stmt_prepare($stmt,$sql)) {
			header("../MyChamps.php?dogregister=failed");
			exit();
			}else{
				mysqli_stmt_bind_param($stmt,"s",$privacy);
				mysqli_stmt_execute($stmt);		
				mysqli_stmt_store_result($stmt);	
				mysqli_stmt_bind_result($stmt,$name,$id,$image,$type);
				$resultcheck = mysqli_stmt_num_rows($stmt);
				
				if ($resultcheck > 0) {
					while (mysqli_stmt_fetch($stmt)) {
						$searchResult = new stdclass();
						$searchResult->id = $id;
						$searchResult->name = $name;
						$searchResult->image = $image;
						$searchResult->type = $type;
						array_push($searchResults, $searchResult);
					}
				}
				return $searchResults;
			}			
		}
	}
}
?>