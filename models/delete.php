<!--
Author: Cody Potter
Date: 2018-05-14
Assignment: Week 5/6
-->
<?php

function deleteDog() {
  $dogID = $_POST['dogID'];
  $myQuery = "DELETE FROM dogs WHERE dogID=:dogID";
  $myDeleteDogArray = array('dogID'=>$dogID);

  global $connection;

  $mySqlPrep = $connection->prepare($myQuery);
  $mySuccess = $mySqlPrep->execute($myDeleteDogArray);

  if($mySuccess) {
      echo(
          '<div class="alert alert-success" role="alert">
              Successfully deleted dog ' . $dogID . '
          </div>'
      );
  } else {
      echo(
          '<div class="alert alert-danger" role="alert">
              An error occurred.
          </div>'
      );
  }
}

 ?>
