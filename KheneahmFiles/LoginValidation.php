<?php
  session_start();
  require 'DatabaseConnection.php';
  if(!empty($_POST['form-username']) && !empty($_POST['form-password'])):
    $records = $conn->prepare('SELECT id, username,password FROM users WHERE username=:username');
    $records->bindParam(':username', $_POST['form-username']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC); //what is PDO??
    // foreach($results as $i){
    //   print($i);
    // }
    print($results['password']);
    print($POST['form-password']);
    print("asdfasdf");
    $message = '';
    if(count($results) > 0 && ($_POST['form-password'] == $results['password'])){
      $_SESSION['user_id'] = $results['id'];
      header("location: UserProfile.php");
    } else {
      $message = 'Sorry, those credentials do not match';
      print($message);
    }
  endif;
?>
