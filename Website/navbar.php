<?php
$active = (isset($_GET["content"])) ? $_GET["content"] : "";
?>
<nav class="navbar navbar-expand-md navbar-light bg-light">
  <a class="navbar-brand" href="./index.php?content=home">George Marina</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <?php
        if (isset($_SESSION["id"])) {
          switch ($_SESSION["userrole"]) {
            case 'admin':
              echo '<li class="nav-item '; echo (in_array($active, ["a-home", ""])) ? "active" : ""; echo '">
                      <a class="nav-link" href="./index.php?content=a-home">home <span class="sr-only">(current)</span></a>
                    </li>';
            break;
            case 'root':
              echo '<li class="nav-item '; echo (in_array($active, ["r-home", ""])) ? "active" : ""; echo '">
                      <a class="nav-link" href="./index.php?content=r-home">home <span class="sr-only">(current)</span></a>
                    </li>';
            break;
            case 'customer':
              echo '<li class="nav-item '; echo (in_array($active, ["c-home", ""])) ? "active" : ""; echo '">
                      <a class="nav-link" href="./index.php?content=c-home">home <span class="sr-only">(current)</span></a>
                    </li>';
            break;
            case 'moderator':
              echo '<li class="nav-item '; echo (in_array($active, ["m-home", ""])) ? "active" : ""; echo '">
                      <a class="nav-link" href="./index.php?content=m-home">home <span class="sr-only">(current)</span></a>
                    </li>';
            break;
            default:
              echo '<li class="nav-item '; echo (in_array($active, ["home", ""])) ? "active" : ""; echo '">
                      <a class="nav-link" href="./index.php?content=home">home <span class="sr-only">(current)</span></a>
                    </li>';
            break;

          }
        } else {
          echo '<li class="nav-item '; echo (in_array($active, ["home", ""])) ? "active" : ""; echo '">
                  <a class="nav-link" href="./index.php?content=home">home <span class="sr-only">(current)</span></a>
                </li>';
        }
      ?> 
      <li class="nav-item <?php echo ($active == "contact") ? "active" : "" ?>">
        <a class="nav-link" href="./index.php?content=contact">Contact</a>
      </li>
      <li class="nav-item <?php echo ($active == "reserveren") ? "active" : "" ?>">
        <a class="nav-link" href="./index.php?content=reserveren">Reserveren</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle <?php echo (in_array($active, ["gallery", "reserveren", "evenementen"])) ? "active" : "" ?>" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Meer
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item <?php echo ($active == "aboutus") ? "active" : "" ?>" href="./index.php?content=aboutus">Over Ons</a>
          <a class="dropdown-item <?php echo ($active == "gallery") ? "active" : "" ?>" href="./index.php?content=gallery">Gallerij</a>
          <a class="dropdown-item <?php echo ($active == "evenementen") ? "active" : "" ?>" href="./index.php?content=evenementen">Evenementen</a>
        </div>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <?php 
        if (isset($_SESSION["id"])) {
          switch($_SESSION["userrole"]) {
            case 'admin':
              echo '<li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle '; echo (in_array($active, ["a-users", "a-reset_password"])) ? "active" : ""; echo '" href="#" id="navbarDropdownMenuLinkRight" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        admin workbench
                      </a>
                      <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLinkRight">
                        <a class="dropdown-item '; echo ($active == "a-users") ? "active" : ""; echo '" href="./index.php?content=a-users">users</a>
                        <a class="dropdown-item '; echo ($active == "a-reset_password") ? "active" : ""; echo '" href="./index.php?content=a-reset_password">reset password</a>
                      </div>
                    </li>';
            break;
            case 'root':
              echo '<li class="nav-item '; echo ($active == "r-rootpage") ? "active" : ""; echo '">
                      <a class="nav-link" href="./index.php?content=r-rootpage">rootpage</a>
                    </li>';

            break;
            case 'moderator':
              // Maak hier de hyperlinks voor de gebruikersrol moderator

            break;
            case 'customer':
              // Maak hier de hyperlinks voor de gebruikersrol customer

            break;
            default:
            break;
          }
          echo '<li class="nav-item '; echo ($active == "logout") ? "active" : ""; echo '">
                  <a class="nav-link" href="./index.php?content=logout">uitloggen</a>
                </li>';
        } else {
          echo '<li class="nav-item '; echo ($active == "register")? "active" : ""; echo '">
                  <a class="nav-link" href="./index.php?content=register">registreer</a>
                </li>
                <li class="nav-item '; echo ($active == "login") ? "active" : ""; echo '">
                  <a class="nav-link" href="./index.php?content=login">inloggen</a>
                </li>';
        }
      ?>    
    </ul>
  </div>
</nav>