<!--
Author: Cody Potter
Date: 2018-05-14
Assignment: Week 5/6
-->
<?php

function getDogs()
{
    $allDogs = "SELECT * FROM dogs";
    // get the records using the query
    global $connection;
    $allDogRecords = $connection->prepare($allDogs);
    $allDogRecords->execute();

    return $allDogRecords;
}

function getCustomerName($customerID) {
  $customerQuery = "SELECT * FROM customers WHERE customerID=$customerID";

  global $connection;
  $customerRecord = $connection->prepare($customerQuery);
  $customerRecord->execute();

  return $customerRecord;
}

function getPreferredGroomerName($employeeID) {

  $groomerQuery = "SELECT * FROM employees WHERE employeeID=$employeeID";

  global $connection;
  $groomerRecord = $connection->prepare($groomerQuery);
  $groomerRecord->execute();

  return $groomerRecord;
}

function getCustomers()
{
  $allCustomerQuery = "SELECT * FROM customers";
  global $connection;
  $allCustomerRecords = $connection->prepare($allCustomerQuery);
  $allCustomerRecords->execute();

  return $allCustomerRecords;
}

function getEmployees()
{
  $allEmployeeQuery = "SELECT * FROM employees";
  global $connection;
  $allEmployeeRecords = $connection->prepare($allEmployeeQuery);
  $allEmployeeRecords->execute();

  return $allEmployeeRecords;
}
