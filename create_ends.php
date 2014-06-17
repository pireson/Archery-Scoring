<?php

include 'session_check.php';

require_once("connect.php");

// GET NUM ROUNDS PUT INTO $num_rounds
$results = mysqli_query($con, "SELECT * FROM round_setup INNER JOIN round ON round.round_setup_id = round_setup.round_setup_id WHERE round.round_id = '$_POST[round_id]'");

$round_setup = mysqli_fetch_array($results);

$num_ends = $round_setup["number_of_ends"];

$end = $_POST["end"];

$distance = $_POST["distance"];

for($i=1; $i<=$num_ends; $i++)
{

	$arrow = explode(",", $end[$i]);

	if(count($arrow) == 6)
	{
		
		$query = "INSERT INTO end 
			(
				round_id,
				distance,
				1st,
				2nd,
				3rd,
				4th,
				5th,
				6th
			) VALUES (
				'$_POST[round_id]',
				'$distance[$i]',
				'$arrow[0]',
				'$arrow[1]',
				'$arrow[2]',
				'$arrow[3]',
				'$arrow[4]',
				'$arrow[5]'
			)";

		if (!mysqli_query($con,$query))
		{
  			die('Error: ' . mysqli_error($con));
		}

	} 
	else 
	{
		//ERROR
	}

}

header("location:round_display.php");

?>

