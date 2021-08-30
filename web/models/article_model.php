<?php 
class Article_Model extends Model
{
	
	function __construct()
	{
		parent::__construct();

	}

	function create($id)
	{
		$userId = mysqli_real_escape_string($this->conn, $_SESSION['u_id']);
		$articleId = mysqli_real_escape_string($this->conn,$id);

		$sql = "INSERT INTO tbl_Articles SELECT * FROM tbl_ArticlesPreview WHERE Id=? AND user_Id=?";
		$stmt = mysqli_stmt_init($this->conn);
		if (!mysqli_stmt_prepare($stmt,$sql)) {
		header("/error/error");
		exit();
		}
		else{
			mysqli_stmt_bind_param($stmt,"ii",$id,$userId);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_store_result($stmt);
			$newId = mysqli_insert_id($this->conn);

			$sql = "DELETE FROM tbl_ArticlesPreview WHERE Id=? AND user_Id=?";
			$stmt = mysqli_stmt_init($this->conn);

			if (!mysqli_stmt_prepare($stmt,$sql)) {
			header("../MyChamps.php?dogregister=failed");
			exit();
			}
			else{
				mysqli_stmt_bind_param($stmt,"ii",$id,$userId);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_store_result($stmt);
				header("Location:/article/loadArticle/". $newId);
				exit();
			}
		}
	}

	function update($id)
	{

	}

	function delete($id)
	{
		$userId = mysqli_real_escape_string($this->conn, $_SESSION['u_id']);
		$articleId = mysqli_real_escape_string($this->conn,$id);
		$sql = "DELETE FROM tbl_Articles WHERE Id=? AND user_Id=?;";
		$stmt = mysqli_stmt_init($this->conn);
		if (!mysqli_stmt_prepare($stmt,$sql)) {
		header("../MyChamps.php?dogregister=failed");
		exit();
		}
		else{
			mysqli_stmt_bind_param($stmt,"ii",$articleId,$userId);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_store_result($stmt);
		}
	}

	function loadArticle($id)
	{
		$articleId = mysqli_real_escape_string($this->conn,$id);
		$sql = "SELECT Title,Category,ShortDesc,Content,user_Id,dateOfCreation,dateOfModification,picture FROM tbl_Articles WHERE Id=?;";
		$stmt = mysqli_stmt_init($this->conn);
		if (!mysqli_stmt_prepare($stmt,$sql)) {
			return "asdasd";
		header("../MyChamps.php?dogregister=failed");
		exit();
		}
		else{
			mysqli_stmt_bind_param($stmt,"i",$articleId);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_store_result($stmt);
			mysqli_stmt_bind_result($stmt,$title,$category,$shortDesc,$content,$userId,$dateOfCreation,$dateOfModification,$picture);
			$resultcheck = mysqli_stmt_num_rows($stmt);
			$article = new stdclass();
			if ($resultcheck = 1) {
				while (mysqli_stmt_fetch($stmt)) {
					$article->title = $title;
					$article->category = $category;
					$article->shortDesc = $shortDesc;
					$article->content = str_replace("\\",'',$content);
					$article->userId = $userId;
					$article->dateOfCreation = $dateOfCreation;
					$article->dateOfModification = $dateOfModification;
					$article->picture = $picture;
				}
			}
			return $article;
		}
	}

	function listMyArticles()
	{
		$userId = mysqli_real_escape_string($this->conn, $_SESSION['u_id']);

		$sql = "SELECT Title,Content,dateOfModification,dateOfCreation FROM tbl_Articles WHERE user_Id=?;";
		$stmt = mysqli_stmt_init($this->conn);
		if (!mysqli_stmt_prepare($stmt,$sql)) {
			return "asdasd";
		header("/errors/error");
		exit();
		}
		else{
			mysqli_stmt_bind_param($stmt,"i",$userId);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_store_result($stmt);
			mysqli_stmt_bind_result($stmt,$ttile,$content,$dateOfCreation,$dateOfModification);
			$resultcheck = mysqli_stmt_num_rows($stmt);
			$row = 1;
			$myArticles = array();
			if ($resultcheck > 0) {
				while (mysqli_stmt_fetch($stmt)) {
					$article = new stdclass();
					$article->row = $row;
					$article->title = $title;
					$article->content = $content;
					$article->dateOfCreation = $dateOfCreation;
					$article->dateOfModification = $dateOfModification;
					array_push($myArticles, $article);
			    	$row = $row + 1;
				}
				return $myArticles;
			}
		}
	}	

	function uploadImage()
	{
		$target_dir = ROOT. "views/article/img/";

		$file = $_FILES["articlePhoto"];
		if (is_uploaded_file($_FILES["articlePhoto"]["tmp_name"])) {
			# code...
		
		$fileName = $_FILES["articlePhoto"]["name"];
		$fileTmpName = $_FILES["articlePhoto"]["tmp_name"];
		$fileSize = $_FILES["articlePhoto"]["size"];
		$fileError = $_FILES["articlePhoto"]["error"];
		$fileType = $_FILES["articlePhoto"]["type"];

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
			echo $fileNameNew;
		}
	}

	function loadNewestArticles($id)
	{
		$five = 4;
		$start = ($id-1) *4;
		$sql = "SELECT Id,Title,ShortDesc,Content,Category,dateOfModification,dateOfCreation,picture FROM tbl_Articles ORDER BY dateOfModification DESC limit ?,?;";
		$stmt = mysqli_stmt_init($this->conn);
		if (!mysqli_stmt_prepare($stmt,$sql)) {
			return "asdasd";
		header("/errors/error");
		exit();
		}
		else{
			mysqli_stmt_bind_param($stmt,"ii",$start,$five);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_store_result($stmt);
			mysqli_stmt_bind_result($stmt,$id,$title,$desc,$content,$category,$dateOfCreation,$dateOfModification,$picture);
			$resultcheck = mysqli_stmt_num_rows($stmt);
			$row = 1;
			$myArticles = array();
			if ($resultcheck > 0) {
				while (mysqli_stmt_fetch($stmt)) {
					$article = new stdclass();
					$article->row = $row;
					$article->id = $id;
					$article->title = $title;
					$article->category = $category;
					$article->desc = $desc;
					$article->content = $content;
					$article->dateOfCreation = $dateOfCreation;
					$article->dateOfModification = $dateOfModification;
					$article->dateOfModification = $dateOfModification;
					$article->picture = $picture;
					array_push($myArticles, $article);
			    	$row = $row + 1;
				}
				return $myArticles;
			}
		}
	}

	function createPreview()
	{
		$content = mysqli_real_escape_string($this->conn, $_POST['newTextEditor']);
		$userId = mysqli_real_escape_string($this->conn, $_SESSION['u_id']);
		$dateOfCreation = date("Y-m-d");
		$title = mysqli_real_escape_string($this->conn, $_POST['title']);
		$category = mysqli_real_escape_string($this->conn, $_POST['category']);
		$shotDesc = mysqli_real_escape_string($this->conn, $_POST['shortDescription']);
		if (file_exists($_FILES['titlePhoto']['tmp_name'])) {
			$path = uploadImage("../Images/ArticleImages/","titlePhoto");
		}else{
			$path = "articleDefault.png";
		}
		
		$sql = "INSERT INTO tbl_ArticlesPreview (Title,Category,ShortDesc,Content,user_Id,dateOfCreation,dateOfModification,picture) VALUES (?,?,?,?,?,?,?,?);";
		$stmt = mysqli_stmt_init($this->conn);
		if (!mysqli_stmt_prepare($stmt,$sql)) {
		header("../MyChamps.php?dogregister=failed");
		exit();
		}
		else{
			mysqli_stmt_bind_param($stmt,"ssssisss",$title,$category,$shotDesc,$content,$userId,$dateOfCreation,$dateOfCreation,$path);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_store_result($stmt);
			
			header("Location:/article/preview/". mysqli_insert_id($this->conn));
			exit();
		}
	}

	function loadArticlePreview($id)
	{
		$articleId = mysqli_real_escape_string($this->conn,$id);
		$sql = "SELECT Id,Title,Category,ShortDesc,Content,user_Id,dateOfCreation,dateOfModification,picture FROM tbl_ArticlesPreview WHERE Id=?;";
		$stmt = mysqli_stmt_init($this->conn);
		if (!mysqli_stmt_prepare($stmt,$sql)) {
			return "asdasd";
		header("../MyChamps.php?dogregister=failed");
		exit();
		}
		else{
			mysqli_stmt_bind_param($stmt,"i",$articleId);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_store_result($stmt);
			mysqli_stmt_bind_result($stmt,$id,$title,$category,$shortDesc,$content,$userId,$dateOfCreation,$dateOfModification,$picture);
			$resultcheck = mysqli_stmt_num_rows($stmt);
			$article = new stdclass();
			if ($resultcheck = 1) {
				while (mysqli_stmt_fetch($stmt)) {
					$article->id = $id;
					$article->title = $title;
					$article->category = $category;
					$article->shortDesc = $shortDesc;
					$article->content = str_replace("\\",'',$content);
					$article->userId = $userId;
					$article->dateOfCreation = $dateOfCreation;
					$article->dateOfModification = $dateOfModification;
					$article->picture = $picture;
				}
			}
			return $article;
		}
	}
	/**
	 * Gets page numbers from url and based on that proper articles are loaded and pagination is setup
	 return array[url page,next,previous]
	 */
	function getPageNumber()
	{
		$url = null;
		$url = isset($_GET['url']) ? $_GET['url'] : null;
		$url = rtrim($url, '/');
		$url = explode("/", $url);
		$pageInfo = array();
		
		if (!isset($url[2])) {
			array_push($pageInfo, 1);
			$previous = 0;
			$next = 2;
			array_push($pageInfo, $previous);
			array_push($pageInfo, $next);
		}else{
			$previous = intval($url[2]) -1;
			$next = intval($url[2]) +1;
			array_push($pageInfo, $url[2]);
			array_push($pageInfo, $previous);
			array_push($pageInfo, $next);
		}
		


		return $pageInfo;
	}

	function getTotalArticlesCount()
	{
		$sql = "SELECT COUNT(DISTINCT(id)) FROM tbl_Articles";
		$stmt = mysqli_stmt_init($this->conn);
		if (!mysqli_stmt_prepare($stmt,$sql)) {
		}else{
			mysqli_stmt_execute($stmt);
			mysqli_stmt_store_result($stmt);
			mysqli_stmt_bind_result($stmt,$number);
			mysqli_stmt_fetch($stmt);
			return $number;
		}			
	}

	function getMyPreviewsCount()
	{
		$userId = mysqli_real_escape_string($this->conn, $_SESSION['u_id']);
		$sql = "SELECT COUNT(DISTINCT(id)) FROM tbl_ArticlesPreview WHERE user_Id=?";
		$stmt = mysqli_stmt_init($this->conn);
		if (!mysqli_stmt_prepare($stmt,$sql)) {
		}else{
			mysqli_stmt_bind_param($stmt, "i", $userId);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_store_result($stmt);
			mysqli_stmt_bind_result($stmt,$number);
			mysqli_stmt_fetch($stmt);
			return $number;
		}	
	}

	function getMyArticleCount()
	{
		$userId = mysqli_real_escape_string($this->conn, $_SESSION['u_id']);
		$sql = "SELECT COUNT(DISTINCT(id)) FROM tbl_Articles WHERE user_Id=?";
		$stmt = mysqli_stmt_init($this->conn);
		if (!mysqli_stmt_prepare($stmt,$sql)) {
		}else{
			mysqli_stmt_bind_param($stmt, "i", $userId);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_store_result($stmt);
			mysqli_stmt_bind_result($stmt,$number);
			mysqli_stmt_fetch($stmt);
			return $number;
		}	
	}

	function getMyFavouritesCount()
	{
		$userId = mysqli_real_escape_string($this->conn, $_SESSION['u_id']);
		$sql = "SELECT COUNT(DISTINCT(Id)) FROM tbl_FavouriteArticles WHERE UserId=?";
		$stmt = mysqli_stmt_init($this->conn);
		if (!mysqli_stmt_prepare($stmt,$sql)) {
		}else{
			mysqli_stmt_bind_param($stmt, "i", $userId);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_store_result($stmt);
			mysqli_stmt_bind_result($stmt,$number);
			mysqli_stmt_fetch($stmt);
			return $number;
		}
	}
}
