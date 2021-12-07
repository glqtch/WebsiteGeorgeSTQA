<?php
if (!(isset($_GET["content"]) && isset($_GET["email"]) && isset($_GET["pwh"]))) {
  header("Location: ./index.php?content=message&alert=hacker-alert");
  exit();
}

include("./connect_db.php");
include("./functions.php");

$email = sanitize($_GET["email"]);

$sql = "SELECT * FROM `medewerker`, `password` 
        WHERE `password`.`rol` = 'docent'
        AND `medewerker`.`email` = `password`.`email`;";
$sql .= "SELECT * FROM `lespakket`";

if (mysqli_multi_query($conn, $sql)) {
  // echo "Het is gelukt";
  $records = "";
  $lespakket = "";
  do {
    if ($result = mysqli_store_result($conn)) {
      while ($record = mysqli_fetch_assoc($result)) {
        if (isset($record["afkorting"])) {
          $records .= "<option value='" . $record['afkorting'] . "'>" . $record['afkorting'] . "</option>";
        } elseif (isset($record["lespakket"])) {
          $lespakket .= "<option value='" . $record['lespakket'] . "'>" . $record['lespakket'] . "</option>";
        }
      }
      mysqli_free_result($result);

      if (mysqli_more_results($conn)) {
        // printf("-------------\n");  
      }
    }


  }  while(mysqli_next_result($conn));
}

if (!check_userrole($email, array('student')) )
{
  header("Location: ./index.php?content=message&alert=wrongactivationpage");
  exit();
} 
else {
?>

<div class="container mt-5">
  <form action="./index.php?content=activate_script" method="post">
    <div class="row">
      <div class="col-6">
        <div class="row mb-3">
          <div class="col-12">
            <label for="inputPassword">Kies een nieuw wachtwoord</label>
            <input name="password" type="password" class="form-control" id="inputPassword" aria-describedby="passwordHelp" autofocus>
            <small id="passwordHelp" class="form-text text-muted">Kies een veilig wachtwoord..</small>
          </div>
        </div>
        <div class="row mb-3">
          <div class="col-12">
            <label for="inputPasswordCheck">Type het wachtwoord opnieuw:</label>
            <input name="passwordCheck" type="password" class="form-control" id="inputPasswordCheck" aria-describedby="passwordCheckHelp">
            <small id="passwordHelpCheck" class="form-text text-muted">Ter controle voert u nogmaals uw wachtwoord in...</small>
          </div>
        </div>
        <div class="row mb-3">
          <div class="col-4">
            <label for="inputFirstname">Voornaam:</label>
            <input name="firstname" type="text" class="form-control" id="inputFirstname" aria-describedby="firstnameCheck">
            <small id="passwordHelpCheck" class="form-text text-muted">&nbsp;</small>
          </div>
          <div class="col-3">
            <label for="inputInfix">Tussenvoegsel:</label>
            <input name="infix" type="text" class="form-control" id="inputInfix" aria-describedby="infixCheck">
            <small id="passwordHelpCheck" class="form-text text-muted">&nbsp;</small>
          </div>
          <div class="col-5">
            <label for="inputLastname">Achternaam:</label>
            <input name="lastname" type="text" class="form-control" id="inputLastname" aria-describedby="lastnameCheck">
            <small id="passwordHelpCheck" class="form-text text-muted">&nbsp;</small>
          </div>
        </div>
      </div>
      <div class="col-6">
        <div class="row mb-3">
          <div class="col-5">
            <label for="inputMobile">Mobiel:</label>
            <input name="mobile" type="tel" class="form-control" id="inputMobile" aria-describedby="mobileCheck">
            <small id="passwordHelpCheck" class="form-text text-muted">Uw mobiele nummer...</small>
          </div>
          <div class="col-7">
            <label for="inputAddress">Woonplaats:</label>
            <input name="domicile" type="text" class="form-control" id="inputAddress" aria-describedby="domicileHelp">
            <small id="passwordHelpCheck" class="form-text text-muted">Uw woonplaats...</small>
          </div>
        </div>
        <div class="row mb-3">
          <div class="col-8">
            <label for="inputAddress">Straatnaam:</label>
            <input name="address" type="text" class="form-control" id="inputAddress" aria-describedby="addressCheck">
            <small id="passwordHelpCheck" class="form-text text-muted">Uw straatnaam...</small>
          </div>
          <div class="col-4">
            <label for="inputZipcode">Postcode:</label>
            <input name="zipcode" type="text" class="form-control" id="inputInputZipcode" aria-describedby="zipcodeCheck">
            <small id="passwordHelpCheck" class="form-text text-muted">Uw postcode</small>
          </div>
        </div>
        <div class="row mb-3">
          <div class="col-6">
            <label for="inputAddress">Lespakket</label>
              <select class="form-select form-select-sm form-control" aria-label=".form-select-lg example" name="lessonseries">
                <option selected>Open this select menu</option>
                <?php echo $lespakket; ?>
              </select>
            <small id="passwordHelpCheck" class="form-text text-muted">Welk lespakket ga je kiezen...</small>
          </div>
          <div class="col-6">
            <label for="inputZipcode">Begeleider MBOUtrecht</label>
              <select class="form-select form-select-sm form-control" aria-label=".form-select-lg example" name="teacher">
                <option selected>Open this select menu</option>
                <?php echo $records; ?>
              </select>
            <small id="passwordHelpCheck" class="form-text text-muted">Je docent die je heeft uitgenodigd</small>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <button type="submit" class="btn btn-success btn-lg btn-block">Activeer</button>
        
      </div>
    </div>
    <input type="hidden" name="email" value="<?php echo $_GET["email"]; ?>">
    <input type="hidden" name="pwh" value="<?php echo $_GET["pwh"]; ?>">
  </form>
</div>

<?php
}
?>