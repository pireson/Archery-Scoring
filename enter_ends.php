<?php

include 'session_check.php';

require_once("connect.php");

$round_id=$_GET['id'];

//$result_rounds = mysqli_query($con,"SELECT round_setup_id, round_name FROM round_setup");
//$archer_rounds = mysqli_query($con,"SELECT * FROM round INNER JOIN round_setup ON round.round_setup_id = round_setup.round_setup_id WHERE round.archer_id = '$_SESSION[archer_id]'");
//archer_ends

$results_ends = mysqli_query($con,
  "SELECT *
   FROM round
   LEFT JOIN round_setup ON round.round_setup_id=round_setup.round_setup_id");

$results_distances = mysqli_query($con,
  "SELECT * 
   FROM round 
   INNER JOIN round_setup ON round.round_setup_id = round_setup.round_setup_id");

?>

<!DOCTYPE html>
<html lang="en">
  <?php include'PHP Source/head.php' ?>
  <body>

    <?php include'PHP Source/nav.php' ?>

    <div class="login-intro">
      <p>Please enter the ends details below.</p>
    </div>

    <div class="row">
      <div class="col-md-6">
        <form action="create_ends.php" method="post" class="table">
          <table class="table">
            <thead>
              <th>Arrow Score</th>
              <th>Distance</th>
            </thead>
            <tbody>
        
              <?php

              $ends = mysqli_fetch_array($results_ends);

              $distances = mysqli_fetch_array($results_distances);

              $distances_arr = explode(",", $distances["dis_allowed"]);

              for ($i=1; $i<=$ends[number_of_ends]; $i++)//is this the correct ends def? check this!
              {
                echo '<tr><td><input type="text" name="end['.$i.']"></td><td><select name="distance['.$i.']" class="form-control">';

                foreach ($distances_arr as &$value) 
                {
                  echo '<option value="'.$value.'">'.$value.'</option>';
                }
                echo '</td>';

              }
        
              ?>
              <tr><td></td><td><button type="submit" class="btn btn-primary">Create</button></td>
        
            </tbody>
          </table>
          <input type="hidden" name="round_id" value="<?php echo($_GET["id"]); ?>" />
        </form>
      </div>
    </div>

  </body>
</html>
