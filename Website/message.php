<?php
  $alert = (isset($_GET["alert"]))? $_GET["alert"]: "default";
  $id = (isset($_GET["id"]))? $_GET["id"]: "";
  $pwh = (isset($_GET["pwh"]))? $_GET["pwh"]: "";
  $email = (isset($_GET["email"]))? $_GET["email"]: "";
  
  switch($alert) {
    case "no-email" :
      echo '<div class="alert alert-info mt-5 w-50 mx-auto text-center" role="alert">
              U heeft geen e-mailadres ingevuld, probeer het opnieuw...
            </div>';
      header("Refresh: 3; ./index.php?content=register");
    break;
    case "emailexists" :
      echo '<div class="alert alert-warning mt-5 w-50 mx-auto text-center" role="alert">
              Het door u ingevulde e-mailadres bestaat al, probeer het opnieuw met een ander e-mailadres...
            </div>';
      header("Refresh: 3; ./index.php?content=register");
    break;
    case "register-error" :
      echo '<div class="alert alert-danger mt-5 w-50 mx-auto text-center" role="alert">
              Er is iets fout gegaan in het registratieproces... Probeer het nogmaals of neem contact op met admin@vegetablejuice.nl
            </div>';
      header("Refresh: 3; ./index.php?content=register");
    break;
    case "register-success" :
      echo '<div class="alert alert-success mt-5 w-50 mx-auto text-center" role="alert">
              U bent succesvol geregistreerd. U ontvangt een e-mail van ons met daarin een activatielink.
            </div>';
      header("Refresh: 3; ./index.php?content=login");
    break;
    case "hacker-alert" :
      echo '<div class="alert alert-success mt-5 w-50 mx-auto text-center" role="alert">U heeft geen rechten op deze pagina</div>';
      header("Refresh: 3; ./index.php?content=home");
    break;
    case "password-empty" :
      echo '<div class="alert alert-warning mt-5 w-50 mx-auto text-center" role="alert">
              U heeft een van beide wachtwoordvelden niet ingevuld. Probeer het opnieuw
            </div>';
      header("Refresh: 3; ./index.php?content=activate&id=$id&pwh=$pwh");
    break;
    case "nomatch-password" :
      echo '<div class="alert alert-warning mt-5 w-50 mx-auto text-center" role="alert">
              Uw ingevulde wachtwoorden zijn niet gelijk, probeer het opnieuw...
            </div>';
      header("Refresh: 3; ./index.php?content=activate&id=$id&pwh=$pwh");
    break;
    case "no-id-pwh-match" :
      echo '<div class="alert alert-warning mt-5 w-50 mx-auto text-center" role="alert">
              U bent niet geregistreerd in de database, u wordt doorgestuurd naar de registratiepagina
            </div>';
      header("Refresh: 3; ./index.php?content=register");
    break;
    case "update-success" :
      echo '<div class="alert alert-success mt-5 w-50 mx-auto text-center" role="alert">
              U bent succesvol geregistreerd, u wordt doorgestuurd naar de inlogpagina...
            </div>';
      header("Refresh: 3; ./index.php?content=login");
    break;
    case "update-error" :
      echo '<div class="alert alert-danger mt-5 w-50 mx-auto text-center" role="alert">
              Het registratieproces is niet gelukt, kies een nieuw wachtwoord
            </div>';
            header("Refresh: 3; ./index.php?content=activate&id=$id&pwh=$pwh");
    break;
    case "already-active" :
      echo '<div class="alert alert-danger mt-5 w-50 mx-auto text-center" role="alert">
              Uw account is al actief, log in met uw zelfgekozen wachtwoord en emailadres.
            </div>';
            header("Refresh: 3; ./index.php?content=login");
    break;
    case "no-match-pwh" :
      echo '<div class="alert alert-danger mt-5 w-50 mx-auto text-center" role="alert">
              Uw activatielinkgegevens zijn niet correct, registreer opnieuw
            </div>';
            header("Refresh: 3; ./index.php?content=register");
    break;
    case "loginform-empty" :
      echo '<div class="alert alert-danger mt-5 w-50 mx-auto text-center" role="alert">
              U heeft een beide velden niet ingevuld, probeer het opnieuw...
            </div>';
            header("Refresh: 3; ./index.php?content=login");
    break;
    case "email-unknown" :
      echo '<div class="alert alert-danger mt-5 w-50 mx-auto text-center" role="alert">
              Het door u ingevulde e-mailadres is bij ons niet bekend, probeer het opnieuw...
            </div>';
            header("Refresh: 3; ./index.php?content=login");
    break;
    case "not-activated" :
      echo '<div class="alert alert-danger mt-5 w-50 mx-auto text-center" role="alert">
              Uw account is nog niet geactiveerd. Check uw e-mail <span class="badge badge-danger p-2">' . $email . '</span> voor het klikken op de activatielink....
            </div>';
            header("Refresh: 3; ./index.php?content=login");
    break;
    case "no-pw-match" :
      echo '<div class="alert alert-danger mt-5 w-50 mx-auto text-center" role="alert">
              Uw ingevulde wachtwoord voor het e-mailadres <span class="badge badge-danger p-2">' . $email . '</span> is niet correct, probeer het opnieuw....
            </div>';
            header("Refresh: 3; ./index.php?content=login");
    break;
    case "logout" :
      echo '<div class="alert alert-success mt-5 w-50 mx-auto text-center" role="alert">
              U bent uitgelogd, u wordt doorgestuurd naar de homepage....
            </div>';
            header("Refresh: 3; ./index.php?content=home");
    break;
    case "auth-error" :
      echo '<div class="alert alert-success mt-5 w-50 mx-auto text-center" role="alert">
              U bent niet ingelogd, u wordt doorgestuurd naar de homepage....
            </div>';
            header("Refresh: 3; ./index.php?content=home");
    break;
    case "auth-error-user" :
      echo '<div class="alert alert-success mt-5 w-50 mx-auto text-center" role="alert">
              U heeft geen rechten op deze pagina, u wordt doorgestuurd naar de homepage....
            </div>';
            header("Refresh: 3; ./index.php?content=home");
    break;
    default:
      header("Location: ./index.php?content=home");
    break;
  }


?>