<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
<head>
<style>
body {
    background:  #f3f3f3;
 }
 </style>
</head>

<br>
<?PHP

session_start();

if (!(isset($_SESSION['id']) && $_SESSION['id'] != '')) {

echo "Je zit niet in een actieve sessie";

} else {

echo "Je zit in een actieve sessie";
}

?>





<?php
  include 'includes/connect.php';

$id=$_SESSION['id'];
$query=mysqli_query($db,"SELECT * FROM reservations where id='$id'")or die(mysqli_error());
$row=mysqli_fetch_array($query);
  ?>


<br>

<p>ID:
<?php echo $row['id'];?>
</p>

<?php
include 'includes/connect.php';
?>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-4">
		</div>
		<div class="col-md-4">
		<div class="card border-light mb-3">
          <div class="card-body">
            <h4 class="card-title">Reserveren</h4>
<form method="post" action="#">
			<div class="row">
				<div class="col-md-6">
				    <div class="form-group">
                      <label for="exampleSelect1" class="form-label mt-4">Aantal personen</label>
                      <select class="form-select" id="exampleSelect1">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                        <option>6</option>
                        <option>7</option>
                        <option>8</option>
                        <option>9</option>
                      </select>
                    </div>
                <div class="form-group">
                  <label for="exampleSelect1" class="form-label mt-4">Tijdslot</label>
                  <select class="form-select" id="exampleSelect1">
                    <option>11:00</option>
                    <option>11:30</option>
                    <option>12:00</option>
                    <option>12:30</option>
                    <option>13:00</option>
                  </select>
                </div>
				</div>
				<div class="col-md-6">
			    <div class="form-group">
                  <label for="exampleInputEmail1" class="form-label mt-4">Datum</label>
                  <input type="date" class="form-control">
                </div>
              <div class="form-group">
                              <label for="exampleInputEmail1" class="form-label mt-4">Code</label>
                              <input value="<?php echo(rand(100000,900000)) ?>" type="text" name="res_code"  placeholder="<?php echo(rand(100000,900000)) ?>"  class="form-control">
                            </div>



				</div>
			</div>
			<div class="row">
				<div class="col-md-12">

<br>
<div class="d-grid gap-2">
  <button type="submit" class="btn btn-lg btn-primary" name="reserveren">Reserveren</button>
</div>


				</div>
			</div>
		</div>
		<div class="col-md-4">
		</div>
	</div>
</div>




   </div>
        </div>


                            <?php

      include 'includes/connect.php';
if(isset($_POST['reserveren'])){
  $res_code = $_POST['res_code'];
  $query=mysqli_query($db,"SELECT * FROM reservations WHERE res_code = '$res_code'");
  $num_rows=mysqli_num_rows($query);
  $row=mysqli_fetch_array($query);
  $_SESSION["id"]=$row['id'];

   $query = "INSERT INTO reservations(res_code)
            VALUES ('$res_code')";


if ($num_rows>0)
{
    ?>
    <script>
      document.location='https://themelift.nl/dashboard.php'
    </script>
    <?php
}
}
      ?>
