<?php

/**
 * 
 */
class Index_Model extends Model
{
	
	function __construct()
	{
	}

	function search()
	{
		if(isset($_REQUEST)) {
			$search = mysqli_real_escape_string($this->conn,$_POST['searchMembers']);
			$privacy ="off";
			if (empty($search)) {
				//header("Location:../MyChamps.php?deletedog=empty");
				//exit();
			}else{
					$sql = "SELECT user_FirstName,user_LastName,user_Id,user_ProfilePicture FROM tbl_Users WHERE user_Private=? AND user_LastName LIKE '%".$search."%';";
					$stmt = mysqli_stmt_init($this->conn);
					if (!mysqli_stmt_prepare($stmt,$sql)) {
					header("../MyChamps.php?dogregister=failed");
					exit();
					}
					else{
					mysqli_stmt_bind_param($stmt,"s",$privacy);
					mysqli_stmt_execute($stmt);		
					mysqli_stmt_store_result($stmt);	
					mysqli_stmt_bind_result($stmt,$name,$lastName,$userId,$image);
					$resultcheck = mysqli_stmt_num_rows($stmt);
					$searchResults = array();
					if ($resultcheck > 0) {
						while (mysqli_stmt_fetch($stmt)) {
							$searchResult = stdClass();
							$searchResult->userId = $userid;
							$searchResult->lastName = $lastName;
							$searchResult->image = $image;
							array_push($searchResults, $searchResult);
									    // echo " <option class='opt' data-value= ".URL."/pages/members/profile.php?userid=".$userId.">" .$lastName."</option>"; 
						}
						return $searchResults;
					}
				}			
			}
		}
	}
	
	function sendEmail()
	{
		if (isset($_REQUEST)) {
			$name = $_POST['name'];
			$userEmail = $_POST['email'];
			$subject = $_POST['subject'];
			$text = $_POST['messagetext'];

			$message = '<p>Meno:' .$name. '</p><p>Email:' .$userEmail.  '</p><p>Subject:' .$subject.  '</p><h3>Otazka:</h3><p>' .$text. '</p><br>';

			$headers = "From: DogChamp <support@dogchamp.sk>\r\n";
			$headers.= "Reply-To: support@dogchamp.sk\r\n";
			$headers.= "Content-type: text/html\r\n";

			mail($userEmail, $subject, $message,$headers);
		}
	}
}

?>