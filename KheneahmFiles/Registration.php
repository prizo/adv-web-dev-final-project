<?php //this php file registers users
  require("DatabaseConnection.php");
  require("Functions.php");
  if(isset($_POST['submit'])){
    //intialize registration variables for querying to database
    $lName = $_POST['form-lName'];
    $fName = $_POST['form-lName'];
    $email = $_POST['form-email'];
    $username = $_POST['form-username'];
    $password = $_POST['form-password'];
    $conf_pass = $_POST['form-confirm_password'];

    //validating if password == conf_pass
    if($password !== $conf_pass){
      print("<h1>Passwords do not match!</h1>");
    }
    //validating if username and email is already taken
    $errorExists = "";
    $statementUser = ("Select username, password FROM users where username = '{$username}' LIMIT 1");
    $statementEmail = ("Select username, password FROM users where email = '{$email}' LIMIT 1");
    $result = $conn->prepare($statementUser);
    $num_rows = $result->rowCount();
    if($num_rows == 1){
      $errorExists .= "u";
    }
    $result = $conn->prepare($statementEmail);
    $num_rows =$result->rowCount();
    if($num_rows == 1){
      $errorExists .= "e";
    }
    if ($errorExists == "u") echo "<p><b>Error:</b> Username already exists!</p>";
  	else if ($errorExists == "e") echo "<p><b>Error:</b> Email already exists!</p>";
  	else if ($errorExists == "ue") echo "<p><b>Error:</b> Username and Email already exists!</p>";
    else{ //add user
      print("yaga");
      $sqlInput = "INSERT  INTO `users` (`id`, `username`, `password`, `first_name`, `last_name`, `email`)
				VALUES (NULL, '{$username}', '{$password}', '{$fName}', '{$lName}', '{$email}')";

      $stmnt = $conn->prepare($sqlInput);
      if($stmnt->execute()){
        print("Congrats you registered!");
        redirect_to('LogIn.php?msg=Registered Successfully');
      }
      else{
        print("We were unable to register you");
      }
    }
}

?>
