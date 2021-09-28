<?php
  include("./functions.php");
  is_authorized(["admin", "root", "moderator"]);
?>



a-home
<?php
  echo "Mijn gebruikersrol is: " . $_SESSION["userrole"];
  echo "<hr>";
  echo "Mijn id is: " . $_SESSION["id"];
?>
