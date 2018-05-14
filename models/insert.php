<!--
Author: Cody Potter
Date: 2018-05-14
Assignment: Week 5/6
-->
<?php
function submitNewDog() {
  $dogName = $_POST['dogName'];
  $dogBreed = $_POST['dogBreed'];
  $ownerID = $_POST['ownerID'];
  $preferredGroomerID = $_POST['preferredGroomerID'];
  $temperament = $_POST['temperament'];

  global $connection;

  $myDogQuery = "INSERT INTO dogs (dogName, dogID, customerID, preferredGroomerID, temperament, dogBreed) VALUES (:dogName, :dogID, :customerID, :preferredGroomerID, :temperament, :dogBreed)";

  $mySqlPrep = $connection->prepare($myDogQuery);
  $myDogValueArray = array('dogName'=>$dogName, 'dogID'=>NULL, 'customerID'=>$ownerID, 'preferredGroomerID'=>$preferredGroomerID, 'temperament'=>$temperament, 'dogBreed'=>$dogBreed);
  $mySuccess = $mySqlPrep->execute($myDogValueArray);

  if($mySuccess) {
      echo(
          '<div class="alert alert-success" role="alert">
              Successfully created ' . $dogName . '
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

function submitNewCustomer() {
  $customerName = $_POST['customerName'];
  $myQuery = "INSERT INTO customers (customerName, customerSinceDate, dollarsSpent, lastVisitDate) VALUES (:customerName, :customerSinceDate, :dollarsSpent, :lastVisitDate)";
  global $connection;
  global $date;
  $mySqlPrep = $connection->prepare($myQuery);
  // I decided to start dollars spent at $0.00,
  // customer since date at today's date
  // and last visit date at today's date because,
  // it just made sense. I'd like to have another page
  // to modify these values later, because dollars spent should
  // increase with each visit, and last visit date should
  // always update at the same time.
  $myCustomerValueArray = array('customerName'=>$customerName, 'customerSinceDate'=>$date, 'dollarsSpent'=>0.00, 'lastVisitDate'=>$date);
  $mySuccess = $mySqlPrep->execute($myCustomerValueArray);

  if($mySuccess) {
      echo(
          '<div class="alert alert-success" role="alert">
              Successfully created ' . $customerName . '
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

function submitNewEmployee() {
  $employeeName = $_POST['employeeName'];
  $employeePosition = $_POST['employeePosition'];
  $employeeWage = $_POST['employeeWage'];
  $employeeIsGroomer = false;

  global $connection;
  global $date;

  if(isset($_POST['employeeIsGroomer'])) {
      $employeeIsGroomer = true;
  }

  $myEmployeeQuery = "INSERT INTO employees (employeeName, isGroomer, wage, hireDate, position) VALUES (:employeeName, :isGroomer, :wage, :hireDate, :position)";

  $mySqlPrep = $connection->prepare($myEmployeeQuery);
  $myEmployeeValueArray = array('employeeName'=>$employeeName, 'isGroomer'=>$employeeIsGroomer, 'wage'=>$employeeWage, 'hireDate'=>$date, 'position'=>$employeePosition);
  $mySuccess = $mySqlPrep->execute($myEmployeeValueArray);
  if($mySuccess) {
      echo(
          '<div class="alert alert-success" role="alert">
              Successfully created ' . $employeeName . '
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
