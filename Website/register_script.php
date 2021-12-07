<?php
  if (empty($_POST["email"])) {
    header("Location: ./index.php?content=message&alert=no-email");
  } else {
    include("./connect_db.php");
    include("./functions.php");

    $email = sanitize($_POST["email"]);

    $sql = "SELECT * FROM `password` WHERE `email` = '$email'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result)) {
      header("Location: ./index.php?content=message&alert=emailexists");
    } else {    
      
      $userrole = determine_userrole($email);
      // echo $userrole;exit();
      switch ($userrole) {
        case 'klant':
          $activationpage = "activate";
        break;
        case 'begeleider':
          $activationpage = "activate";
        break;
        case 'docent':
          $activationpage = "activate";
        break;
        case 'eigenaar':
          $activationpage = "activate";
        break;
        case 'student':
          $activationpage = "activate_student";
        break;
        default:
          $activationpage = "something_went_wrong";
        break;
      }

      // De functie mk_password_hash_from_microtime() maakt een password hash,
      // haalt de tijd en datum op op basis van de php-functie microtime() 
      // en geeft dit terug in $array
      $array = mk_password_hash_from_microtime();      
      
      $sql = "INSERT INTO `password` (`email`,
                                      `passwd`,
                                      `createdAt`,
                                      `updatedAt`,
                                      `rol`)
              VALUES                 ('$email',
                                      '{$array["password_hash"]}',
                                      CURRENT_TIMESTAMP,
                                      CURRENT_TIMESTAMP,
                                      '$userrole')";
      // echo $sql;exit();
      
      if (mysqli_query($conn, $sql)) {

        $id = mysqli_insert_id($conn);

        $to = $email;
        $subject = "Activatielink voor uw account van georgemboutrecht.nl";
        // echo $activationpage; exit();
        include("./email.php");
        // include("./alt-email.php");
        
        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=UTF-8\r\n";
        $headers .= "From: admin@georgemboutrecht.nl\r\n";
        $headers .= "Cc: moderator@georgemboutrecht.nl\r\n";
        $headers .= "Bcc: root@georgemboutrecht.nl";
        
        mail($to, $subject, $message, $headers);

        header("Location: ./index.php?content=message&alert=register-success");
      } else {
        header("Location: ./index.php?content=message&alert=register-error");
      }
    }
  }
?>