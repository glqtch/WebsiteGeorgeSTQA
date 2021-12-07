<?php
  include("./connect_db.php");
  include("./functions.php");

  // var_dump($_POST);exit();

  $email = sanitize($_POST["email"]);
  $pwh = sanitize($_POST["pwh"]);
  $password = sanitize($_POST["password"]);
  $passwordCheck = sanitize($_POST["passwordCheck"]);
  $firstname = sanitize($_POST["firstname"]);
  $infix = sanitize($_POST["infix"]);
  $lastname = sanitize($_POST["lastname"]);
  $mobile = sanitize($_POST["mobile"]);

  $domicile = (isset($_POST["domicile"]))? $_POST["domicile"]: "";
  $is_student = (isset($_POST["domicile"]))? "student": "";
  $zipcode = (isset($_POST["zipcode"]))? $_POST["zipcode"]: "";
  $address = (isset($_POST["address"]))? $_POST["address"]: "";
  $teacher = (isset($_POST["teacher"]))? $_POST["teacher"]: "";
  $lessonseries = (isset($_POST["lessonseries"]))? $_POST["lessonseries"]: "";

  
  if (empty($_POST["password"]) || empty($_POST["passwordCheck"])) {
    header("Location: ./index.php?content=message&alert=password-empty&email=$email&pwh=$pwh");
  } 
  elseif (empty($_POST["firstname"]) || empty($_POST["lastname"]) || empty($_POST["mobile"])) {
    header("Location: ./index.php?content=message&alert=credentials-empty&email=$email&pwh=$pwh");
  } 
  elseif (strcmp($password, $passwordCheck)) {
    header("Location: ./index.php?content=message&alert=nomatch-password&email=$email&pwh=$pwh");
  } else {
    
    $sql = "SELECT * FROM `password` WHERE `email` = '$email'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result)) {

      $record = mysqli_fetch_assoc($result);

      if ($record["activated"]) {
        header("Location: ./index.php?content=message&alert=already-active");
      } else {

        if ( !strcmp($record["passwd"], $pwh)) {
          // 1. Maak een passwordhash voor het nieuw gekozen wachtwoord
          $password_hash = password_hash($password, PASSWORD_BCRYPT);
    
          // 2. Ga het record updaten met het nieuw gekozen gehashte wachtwoord
          $sql = "UPDATE `password` 
                  SET    `passwd` = '$password_hash',
                         `activated`= 1 
                  WHERE  `email` = '$email'
                  AND    `passwd` = '$pwh';";

          if (!strcmp($record['rol'], 'klant')) {
                $sql .= "INSERT INTO `klant` (`id`, 
                                              `voornaam`, 
                                              `tussenvoegsel`, 
                                              `achternaam`, 
                                              `email`, 
                                              `mobiel`, 
                                              `rol`, 
                                              `createdAt`, 
                                              `updatedAt`, 
                                              `emailVerified`) 
                                  VALUES              (NULL, 
                                              '$firstname', 
                                              '$infix', 
                                              '$lastname', 
                                              '$email', 
                                              '$mobile', 
                                              'klant', 
                                              CURRENT_TIMESTAMP, 
                                              CURRENT_TIMESTAMP, 
                                              '1');";

          } elseif (!strcmp($record['rol'], 'student')) {
            $chop_email = explode("@", $email);
            $studentnr = $chop_email[0];

            $sql .= "INSERT INTO `student` (`studentnr`, 
                                            `voornaam`, 
                                            `tussenvoegsel`, 
                                            `achternaam`, 
                                            `mobiel`, 
                                            `email`, 
                                            `woonplaats`, 
                                            `straat`, 
                                            `postcode`, 
                                            `rol`, 
                                            `docent`, 
                                            `lespakket`) 
                                    VALUES ('$studentnr', 
                                            '$firstname', 
                                            '$infix', 
                                            '$lastname', 
                                            '$mobile', 
                                            '$email', 
                                            '$domicile', 
                                            '$address', 
                                            '$zipcode', 
                                            'student', 
                                            '$teacher', 
                                            '$lessonseries');";


          } else {
              if (in_array($record['rol'], array('docent'))) {
            
                $chop_email = explode("@", $email);
                $abbreviation = strtoupper($chop_email[0]);
            
              } elseif (in_array($record['rol'], array('begeleider', 'eigenaar'))) {

                $abbreviation = strtoupper(substr($firstname, 0,1) . substr($firstname, -1, 1) . substr($lastname, 0, 1) . substr($lastname, -1, 1));
              
              }

              $sql .= "INSERT INTO `medewerker` (`email`, 
                                                  `voornaam`, 
                                                  `tussenvoegsel`, 
                                                  `achternaam`, 
                                                  `mobiel`, 
                                                  `afkorting`) 
                                          VALUES ('$email', 
                                                  '$firstname', 
                                                  '$infix', 
                                                  '$lastname', 
                                                  '$mobile', 
                                                  '$abbreviation');";
          }


          if (mysqli_multi_query($conn, $sql)) {
            // succes
            header("Location: ./index.php?content=message&alert=update-success");
          } else {
            // error
            header("Location: ./index.php?content=message&alert=update-error&email=$email&pwh=$pwh");        
          }
        } else {
          header("Location: ./index.php?content=message&alert=no-match-pwh");        
        }

      }
      
      
      // 3. Geef de gebruiker feedback met een alert dat het updaten is gelukt of niet en stuur dan door naar een andere pagina.
    } else {
      // foutmelding
      header("Location: ./index.php?content=message&alert=no-id-pwh-match");
    }
  }
