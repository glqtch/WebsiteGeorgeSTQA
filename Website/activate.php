<?php
if (!(isset($_GET["content"]) && isset($_GET["email"]) && isset($_GET["pwh"]))) {
  header("Location: ./index.php?content=message&alert=hacker-alert");
  exit();
}

include("./connect_db.php");
include("./functions.php");

$email = sanitize($_GET["email"]);

// var_dump(check_userrole($email, 'klant'));exit();

if (!check_userrole($email, array('klant', 'eigenaar', 'docent', 'begeleider')) )
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
            <input name="passwordCheck" type="password" class="form-control" id="inputPasswordCheck" aria-describedby="passwordHelpCheck">
            <small id="passwordHelpCheck" class="form-text text-muted">Ter controle voert u nogmaals uw wachtwoord in...</small>
          </div>
        </div>

      </div>
      <div class="col-6">
        <div class="row mb-3">
          <div class="col-4">
            <label for="inputPasswordCheck">Voornaam:</label>
            <input name="firstname" type="text" class="form-control" id="inputPasswordCheck" aria-describedby="passwordHelpCheck">
            <small id="passwordHelpCheck" class="form-text text-muted">&nbsp;</small>
          </div>
          <div class="col-4">
            <label for="inputPasswordCheck">Tussenvoegsel:</label>
            <input name="infix" type="text" class="form-control" id="inputPasswordCheck" aria-describedby="passwordHelpCheck">
            <small id="passwordHelpCheck" class="form-text text-muted">&nbsp;</small>
          </div>
          <div class="col-4">
            <label for="inputPasswordCheck">Achternaam:</label>
            <input name="lastname" type="text" class="form-control" id="inputPasswordCheck" aria-describedby="passwordHelpCheck">
            <small id="passwordHelpCheck" class="form-text text-muted">&nbsp;</small>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <label for="inputPasswordCheck">Mobiel:</label>
            <input name="mobile" type="tel" class="form-control" id="inputPasswordCheck" aria-describedby="passwordHelpCheck">
            <small id="passwordHelpCheck" class="form-text text-muted">Uw mobiele nummer...</small>
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