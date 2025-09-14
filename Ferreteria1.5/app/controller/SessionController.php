<?php
@session_start();
include_once "../../config/connection.php";

$objSession = new connection();
$obtain = $objSession->getConnection();

if(!empty($_POST)){

	if(!empty($_POST["function"])){

		switch($_POST["function"]){
			//============================================================================================
			//======================CASE VALIDATE SESSION================================================
			case "validate_session":

				if(!empty($_POST["user"]) && !empty($_POST["password"])){

					$user = $obtain->real_escape_string($_POST["user"]);
					$password = $obtain->real_escape_string($_POST["password"]);
					$answer = array();
					$sqlVerify = $objSession->execute("SELECT Login, Name AS Complete_Name, Password, Role FROM user WHERE Login = '$user' AND Status = 'A'");
					// echo "SELECT Login, CONCAT(Name, ' ', LastName) AS Complete_Name, password, Role FROM user WHERE Login = '$user' AND Status = 'A' <br>";
					// var_dump($sqlVerify);
					//=========================VERIFY PASSWORD============================================
					if(mysqli_num_rows($sqlVerify) != 0){
						$row = $sqlVerify->fetch_assoc();
						$passwordDB = $row['Password'];
						if(password_verify($password, $passwordDB)){
							$_SESSION['user_completeName'] = str_replace("*", "", $row['Complete_Name']);
							$_SESSION['user_role'] = $row['Role'];
							$_SESSION['user_id'] = $row['Login'];
							// var_dump($_SESSION['user_completeName']);
							$answer['typeAnswer'] = "success";
							

						} else {
							$answer['typeAnswer'] = "error";
						}
						
					}  else {
						$answer['typeAnswer'] = "fail";
					}
					echo json_encode($answer);
				}
				break;

			case "register_user":
			
				if(!empty($_POST["user"]) && !empty($_POST["password"]) && !empty($_POST["verifyPassword"]) ){
					
					$user = $obtain->real_escape_string($_POST['user']);
					$password = $obtain->real_escape_string($_POST['password']);
					$verifyPassword = $obtain->real_escape_string($_POST['verifyPassword']);
					$answer = array();

					if ($password === $verifyPassword) {

						$passEncrypt = password_hash($password, PASSWORD_BCRYPT );

						$sqlVerify = $objSession->execute("INSERT INTO user (Login, Password, Role, Status) VALUES ('$user', '$passEncrypt', 1, 'A')");

						if(mysqli_affected_rows($objSession->getConnection()) > 0 ){
							$answer['typeAnswer'] = "success";
							// echo "bueno";
						}  else {
							$answer['typeAnswer'] = "error";
							// echo "error";
						}
					} else { 
						// echo "fallo";
						$answer['typeAnswer'] = "fail";
					}
					echo json_encode($answer);
				}
				break;

			case "close_session":
				@session_unset();
				@session_destroy();
				break;
		}
	}

}







