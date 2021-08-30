<?php 
class Article_Model extends Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	function insert()
	{
		if (isset($_SESSION['u_id'])) {
			$content = "asdsad" //mysqli_real_escape_string($this->conn, $_POST['summernote']);
			$userId = mysqli_real_escape_string($this->conn, $_SESSION['u_id']);
			$sql = "INSERT INTO tbl_Articles (Content,user_Id) VALUES (?,?);";
			$stmt = mysqli_stmt_init($this->conn);
			$stmt = mysqli_stmt_init($this->conn);
			if (!mysqli_stmt_prepare($stmt,$sql)) {
			header("../MyChamps.php?dogregister=failed");
			exit();
			}
			else{
				mysqli_stmt_bind_param($stmt,"si",$content,$userId);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_store_result($stmt);
				//header("Location:/article");
				//exit();
			}
		}
	}
}
 ?>