<!--
Author: Cody Potter
Date: 2018-05-14
Assignment: Week 5/6
-->
<?php
include('models/connect.php');
include('models/insert.php');
include('models/select.php');
include('models/delete.php');

//Look for URL variables to decide which view to load
if ($_GET['link'] == 'add') {
  include('views/add.php');
} else if ($_GET['link'] == 'delete') {
  include('views/delete.php');
} else {
  //view case - download data to preload view.php
  $dogs = getDogs();
  $customers = getCustomers();
  $employees = getEmployees();

  include('views/view.php');
}

// Watch post array to determine what logic is needed
if (isset($_POST['customerSubmit'])) {
  //new customer submitted
  submitNewCustomer();
}

if (isset($_POST['dogSubmit'])) {
  //new dog submitted
  submitNewDog();
}

if (isset($_POST['employeeSubmit'])) {
  //new employee submitted
  submitNewEmployee();
}

if (isset($_POST['deleteSubmit'])) {
  //dog deleted
  deleteDog();
}


 ?>
