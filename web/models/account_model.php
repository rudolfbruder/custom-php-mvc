<?php

/**
 * 
 */
class Account_Model extends Model
{
	
	public function login(){
		if (isset($_POST['submit'])) {
			
			$email = mysqli_real_escape_string($this->conn,$_POST['emailLogin']);
			$password = mysqli_real_escape_string($this->conn,$_POST['passwordLogin']);
			$verified = 1;
			$attempts = 3;
			$zeroAttemts = 0;
			if (empty($email) || empty($password)) {
				header("Location: ../index.php?login=emptyerror");
				exit();	
			}
			else{
				$sql = "SELECT * FROM tbl_Users WHERE user_Email =? AND user_Verified=1 AND user_LoginAttempts <3";
				$stmt = mysqli_stmt_init($this->conn);
				if (!mysqli_stmt_prepare($stmt,$sql)) {
					header("../../index.php?error=sqlerror");
					exit();
				}
				else{
					mysqli_stmt_bind_param($stmt,"s",$email);
					mysqli_stmt_execute($stmt);
					$result = mysqli_stmt_get_result($stmt);
					if ($row = mysqli_fetch_assoc($result)) {
					//Dehashing
					$hashedPwdCheck = password_verify($password, $row['user_Password']);
					if ($hashedPwdCheck == false) {
						$sql = "UPDATE tbl_Users SET user_LoginAttempts = user_LoginAttempts + 1 WHERE user_Email =? AND user_Verified=1";
						$stmt = mysqli_stmt_init($this->conn);
						if (!mysqli_stmt_prepare($stmt,$sql)) {
							header("../../index.php?error=sqlerror");
							exit();
						}
						else{
							mysqli_stmt_bind_param($stmt,"s",$email);
							mysqli_stmt_execute($stmt);
							header("Location: ../../index.php?login=pwerror");
							exit();	
						}
					}elseif ($hashedPwdCheck == true) {
						//Log in the user in website and set logoncount to 0
						$sql = "UPDATE tbl_Users SET user_LoginAttempts = ? WHERE user_Email =? AND user_Verified=? AND user_LoginAttempts < ?";
						$stmt = mysqli_stmt_init($this->conn);
						if (!mysqli_stmt_prepare($stmt,$sql)) {
							header("../../index.php?error=sqlerror");
							exit();
						}else{
							mysqli_stmt_bind_param($stmt,"isii",$zeroAttemts,$email,$verified,$attempts);
							mysqli_stmt_execute($stmt);
							session_start();
							$_SESSION['u_id'] = $row['user_Id'];
							$_SESSION['u_first'] = $row['user_FirstName'];
							$_SESSION['u_last'] = $row['user_LastName'];
							$_SESSION['u_email'] = $row['user_Email'];
							header("Location: ../dashboard");
							exit();
							}
						}
					}
					else{
						//Lets check if the users is locked
						$sql = "SELECT user_LoginAttempts FROM tbl_Users WHERE user_Email =?";
						$stmt = mysqli_stmt_init($this->conn);
						if (!mysqli_stmt_prepare($stmt,$sql)) {
							header("../../index.php?error=sqlerror");
							exit();
						}
						else{
							mysqli_stmt_bind_param($stmt,"s",$email);
							mysqli_stmt_execute($stmt);
							$result = mysqli_stmt_get_result($stmt);
							if ($row = mysqli_fetch_assoc($result)) {
								header("Location: ../../index.php?login=locked");
								exit();
							}else{
								header("Location: ../../index.php?login=incorrectmail");
								exit();
							}
						}
					}
				}
			}
			mysqli_stmt_close($stmt);
			mysqli_close($this->conn);
		}	
		else{
			header("Location: ../../index.php?login=error");
			exit();	
		}
	}

	public function logout(){
		session_start();
		session_unset();
		session_destroy();
		header("Location: ../index");
		exit();

	}

	public function registerNewUser()
	{
		if (isset($_POST['submit'])) {
			$email = mysqli_real_escape_string($this->conn,$_POST['emailReg']);
			$pwd = mysqli_real_escape_string($this->conn,$_POST['passwordReg']);
			$pwdVerif = mysqli_real_escape_string($this->conn,$_POST['passwordVerif']);
			$firstName = mysqli_real_escape_string($this->conn,$_POST['firstName']);
			$lastName = mysqli_real_escape_string($this->conn,$_POST['lastName']);
			$Address = "Not filled";
			$vkey = md5(time().$email);
			$verified = 0;
			$privacy = "off";
			//$Address= mysqli_real_escape_string($this->conn,$_POST['address']);
			//Check for empty fields;
			if (empty($email) || empty($pwd) || empty($firstName) || empty($lastName)) {
					header("Location: ../../index.php?signup=empty");
					exit();
			}
			if ($pwd != $pwdVerif) {
				header("Location: ../../index.php?signup=passworddifferent");
				exit();
			}
			else{
				//Check if email is valid
				if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
					header("Location: ../../index.php?signup=email");
					exit();
				}
				else{
					$sql = "SELECT * FROM tbl_Users WHERE user_Email=?";
					$stmt = mysqli_stmt_init($this->conn);
					if (!mysqli_stmt_prepare($stmt,$sql)) {
						header("../../index.php?error=sqlerror");
						exit();
					}
					else{
						mysqli_stmt_bind_param($stmt,"s",$email);
						mysqli_stmt_execute($stmt);
						mysqli_stmt_store_result($stmt);
						$resultCheck = mysqli_stmt_num_rows($stmt);
						if ($resultCheck > 0) {
							header("Location: ../../index.php?signup=alredyexists");
							exit();	
						}
						else{
							$sql = "INSERT INTO tbl_Users (user_FirstName,user_LastName,user_Email,user_Password,user_Address,user_Vkey,user_Verified,user_Private) VALUES (?,?,?,?,?,?,?,?);";
							$stmt = mysqli_stmt_init($this->conn);
							if (!mysqli_stmt_prepare($stmt,$sql)) {
							header("../../index.php?error=sqlerror");
							exit();
							}
							else{
								//Hashing the password
								$hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
								//Insert the user into the database
								mysqli_stmt_bind_param($stmt,"ssssssss",$firstName,$lastName,$email,$hashedPwd,$Address,$vkey,$verified,$privacy);
								mysqli_stmt_execute($stmt);
								mysqli_stmt_store_result($stmt);
								$url = "http://dogchamp.sk/account/verify/" .$vkey;
								$subject = "Aktivačný link pre Váš účet na DogChamp";

								$message = '<p>Dobrý den,<br>Kliknite na naslednujúci link ak chcete aktitovať Váš účet na DogChamp:<br>';
								$message.= '<a href="' . $url . '">Klinite sem</a></p><br><p>S pozdravom, <br> Váš DogChamp tým</p>';

								$headers = "From: DogChamp <admin@dogchamp.sk>\r\n";
								$headers.= "Reply-To: admin@dogchamp.sk\r\n";
								$headers.= "Content-type: text/html\r\n";
								mail($email, $subject, $message,$headers);

								header("Location: ../../index.php?signup=success");
								exit();
							}
						}
					}
				}
			}
			mysqli_stmt_close($stmt);
			mysqli_close($this->conn);
		}
		else{
			header("Location: ../../index.php");
			exit();
		}
	}

	public function verifyAccount($vkeyOriginal)
	{
		if (isset($vkeyOriginal)) {
			$vkey = mysqli_real_escape_string($this->conn,$vkeyOriginal);
			$sql = "SELECT user_Verified,user_Vkey FROM tbl_Users WHERE user_Verified=0 AND user_Vkey =?";
			$stmt = mysqli_stmt_init($this->conn);

			if (!mysqli_stmt_prepare($stmt,$sql)) {
				header("../../index.php?error=sqlerror");
				exit();
			}
			else{
				mysqli_stmt_bind_param($stmt,"s",$vkey);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_store_result($stmt);
				$resultCheck = mysqli_stmt_num_rows($stmt);
				if ($resultCheck == 1) {
					$sql = "UPDATE tbl_Users SET user_Verified=1 WHERE user_Vkey =?";
					$stmt = mysqli_stmt_init($this->conn);
					if (!mysqli_stmt_prepare($stmt,$sql)) {
						header("../../index.php?error=sqlerror");
						exit();
					}else{
						mysqli_stmt_bind_param($stmt,"s",$vkey);
						mysqli_stmt_execute($stmt);
						header("Location: /account/verifySuccess");
						exit();
					}
				}else{
					header("../../index.php?verif=AlreadyDoneOrInvalid");
					exit();
				}
			}

		}
		else{
			echo "Please use link that you got via email";
		}
	}

	function passwordReset()
	{
		if (isset($_POST['submit'])) {
			
			$selector = bin2hex(random_bytes(8));
			$token = random_bytes(32);

			$url = "http://dogchamp.sk/account/setNewPassword/". $selector. "/" .bin2hex($token);

			$expires = date("U") + 1800;

			$userEmail = mysqli_real_escape_string($this->conn,$_POST["emailNewPw"]);
			$sql = "SELECT * FROM tbl_Users WHERE user_Email=?";
			$stmt = mysqli_stmt_init($this->conn);
			if (!mysqli_stmt_prepare($stmt,$sql)) {
				header("../../index.php?reset=sqlerror");
				exit();
			}
			else{
				mysqli_stmt_bind_param($stmt,"s",$userEmail);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_store_result($stmt);
				$resultCheck = mysqli_stmt_num_rows($stmt);
				if ($resultCheck < 1) {
					header("Location: ../../index.php?reset=notfound");
					exit();	
				}
				else{
					$sql = "DELETE FROM pwdResets WHERE pwdResetEmail = ?;";
					$stmt = mysqli_stmt_init($this->conn);
					if (!mysqli_stmt_prepare($stmt,$sql)) {
						header("../../index.php?reset=sqlerror");
						exit();
					}
					else{
						mysqli_stmt_bind_param($stmt,"s",$userEmail);
						mysqli_stmt_execute($stmt);
					}

					$sql = "INSERT INTO pwdResets (pwdResetEmail,pwdResetSelector,pwdResetToken,pwdResetExpires) VALUES (?,?,?,?);";
					$stmt = mysqli_stmt_init($this->conn);
					if (!mysqli_stmt_prepare($stmt,$sql)) {
						header("../../index.php?reset=sqlerror");
						exit();
					}
					else{
						$hashedToken = password_hash($token, PASSWORD_DEFAULT);
						mysqli_stmt_bind_param($stmt,"ssss",$userEmail,$selector,$hashedToken,$expires);
						mysqli_stmt_execute($stmt);
					}

					mysqli_stmt_close($stmt);
					mysqli_close($this->conn);

					$to = $userEmail;

					$subject = "Reset hesla pre DogChamp.sk";

					$message = '<p>Dobrý deň,</p><p>Na zaklade vasej ziadosti sme pre vas vygenerovali link cez ktory si viete zresetovat vase heslo.<br> Ak chcete vase heslo zresetovat klinite na nasledovny link.<br>';

					$message.= '<a href="' . $url . '">Klinite sem</a></p><p>S pozdravom, <br> Váš DogChamp tým</p>';

					$headers = "From: DogChamp <admin@dogchamp.sk>\r\n";
					$headers.= "Reply-To: admin@dogchamp.sk\r\n";
					$headers.= "Content-type: text/html\r\n";

					mail($to, $subject, $message,$headers);

					header("Location: /account/resetinfo");
				}
		}
		}
		else{
			header("Location: ../../index.php");
			exit();
		}
	}

	function setPassword($selector,$validator)
	{

		if (isset($_POST['pwdsubmit'])) {
			$selector = mysqli_real_escape_string($this->conn,$selector);
			$validator = mysqli_real_escape_string($this->conn,$validator);
			$newPwd = mysqli_real_escape_string($this->conn,$_POST['newPwd']);
			$newPwdVerif = mysqli_real_escape_string($this->conn,$_POST['newPwdVerif']);
			$newAttempts = 0;
			if (empty($newPwd) || empty($newPwdVerif)) {
				header("Location: ../../index.php?reset=empty");
				exit();
			}
			elseif ($newPwd != $newPwdVerif) {
					header("Location: ../../index.php?reset=differentpasswords");
					exit();
			}
			else{
				$currentDate = date("U");

				$sql = "SELECT * FROM pwdResets WHERE pwdResetSelector=? AND pwdResetExpires >= ?";
				$stmt = mysqli_stmt_init($this->conn);
				if (!mysqli_stmt_prepare($stmt,$sql)) {
					header("../../index.php?error=sqlerror");
					exit();
				}
				else{
					mysqli_stmt_bind_param($stmt,"ss",$selector,$currentDate);
					mysqli_stmt_execute($stmt);
					$result = mysqli_stmt_get_result($stmt);
					if (!$row = mysqli_fetch_assoc($result)) {
						echo $selector . "<br>";
						echo $currentDate;
						header("../../index.php?error=resubmit");
						exit();
					}
					else{
						$tokenBin = hex2bin($validator);
						$tokenCheck = password_verify($tokenBin, $row["pwdResetToken"]);
						
						if ($tokenCheck === false) {
							echo "Prosim vas znova poziadajte o reset hesla";
							header("../../index.php?error=sqlerror");
							exit();
						}elseif ($tokenCheck === true) {

							$emailUser = $row["pwdResetEmail"];
							$sql = "SELECT * FROM tbl_Users WHERE user_Email=?;";
							$stmt = mysqli_stmt_init($this->conn);

							if (!mysqli_stmt_prepare($stmt,$sql)) {
								header("../../index.php?error=sqlerror");
								exit();
							}else{
								mysqli_stmt_bind_param($stmt, "s",$emailUser);
								mysqli_stmt_execute($stmt);
								$result = mysqli_stmt_get_result($stmt);
							}
							if (!$row = mysqli_fetch_assoc($result)) {
								echo "Nastala chyba servera. Ospravedlnujeme sa.";
								exit();
							} else {

								$sql = "UPDATE tbl_Users SET user_Password=?, user_LoginAttempts =? WHERE user_Email=?";
								$stmt = mysqli_stmt_init($this->conn);

								if (!mysqli_stmt_prepare($stmt,$sql)) {
								echo "Nastala chyba servera. Ospravedlnujeme sa.";
								exit();
							}
							else{
								$hashedPwd = password_hash($newPwd, PASSWORD_DEFAULT);
								mysqli_stmt_bind_param($stmt, "sis",$hashedPwd,$newAttempts,$emailUser);
								mysqli_stmt_execute($stmt);

								$sql = "DELETE FROM pwdResets WHERE pwdResetEmail=?";
								$stmt = mysqli_stmt_init($this->conn);


								if (!mysqli_stmt_prepare($stmt,$sql)) {
									header("../../index.php?error=sqlerror");	
									exit();
								}
									else{
										mysqli_stmt_bind_param($stmt, "s",$emailUser);
										mysqli_stmt_execute($stmt);
										header("Location: /account/verifySuccess");
										exit();
									}
								}
							}
						}
					}
				}
			}
		}
		else{
			header("Location: ../index.php");
			exit();
		}
	}
}