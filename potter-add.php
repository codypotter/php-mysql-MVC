<!--
    Author: Cody potter
    Date: 2018-05-01
    Description: PHP file to add an entry from a database
    Note: I'm really happy with how this turned out. It still 
        has room to grow.
-->
<?php
    $myDBinfo = 'mysql:host=127.0.0.1;dbname=dogsrus';
    $myDBuser = 'root';
    $myDBpassword = '';
    $myDate = date('Y-m-d');

    try {
        $myConnection = new PDO($myDBinfo, $myDBuser, $myDBpassword);
    } catch (PDOException $myError) {
        echo('The Database connection failed.');
    }

    // each of these if statements pretty much do the same thing with
    // different data.
    if(isset($_POST['customerSubmit'])) {
        $customerName = $_POST['customerName'];
        $myQuery = "INSERT INTO customers (customerName, customerSinceDate, dollarsSpent, lastVisitDate) VALUES (:customerName, :customerSinceDate, :dollarsSpent, :lastVisitDate)";

        $mySqlPrep = $myConnection->prepare($myQuery);
        // I decided to start dollars spent at $0.00,
        // customer since date at today's date
        // and last visit date at today's date because,
        // it just made sense. I'd like to have another page
        // to modify these values later, because dollars spent should
        // increase with each visit, and last visit date should
        // always update at the same time.
        $myCustomerValueArray = array('customerName'=>$customerName, 'customerSinceDate'=>$myDate, 'dollarsSpent'=>0.00, 'lastVisitDate'=>$myDate);
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

    if(isset($_POST['dogSubmit'])) {
        $dogName = $_POST['dogName'];
        $dogBreed = $_POST['dogBreed'];
        $ownerID = $_POST['ownerID'];
        $preferredGroomerID = $_POST['preferredGroomerID'];
        $temperament = $_POST['temperament'];

        $myDogQuery = "INSERT INTO dogs (dogName, dogID, customerID, preferredGroomerID, temperament, dogBreed) VALUES (:dogName, :dogID, :customerID, :preferredGroomerID, :temperament, :dogBreed)";

        $mySqlPrep = $myConnection->prepare($myDogQuery);
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

    if(isset($_POST['employeeSubmit'])) {
        $employeeName = $_POST['employeeName'];
        $employeePosition = $_POST['employeePosition'];
        $employeeWage = $_POST['employeeWage'];
        $employeeIsGroomer = false;
        if(isset($_POST['employeeIsGroomer'])) {
            $employeeIsGroomer = true;
        }

        $myEmployeeQuery = "INSERT INTO employees (employeeName, isGroomer, wage, hireDate, position) VALUES (:employeeName, :isGroomer, :wage, :hireDate, :position)";

        $mySqlPrep = $myConnection->prepare($myEmployeeQuery);
        $myEmployeeValueArray = array('employeeName'=>$employeeName, 'isGroomer'=>$employeeIsGroomer, 'wage'=>$employeeWage, 'hireDate'=>$myDate, 'position'=>$employeePosition);
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
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
        <link rel="stylesheet" href="master.css">
        <title>Dogs R Us</title>
    </head>
    <body style="background-color: #9bc1bc;">
        <div class="container page-container">
            <h1 class="page-header display-3 text-white">Dogs R Us</h1>
            <nav class="container m-3">
                <ul class="nav nav-pills justify-content-center">
                    <li class="nav-item">
                        <a class="nav-link" href="potter-view.php">View Data</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="potter-add.php">Add Data</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="potter-delete.php">Delete Data</a>
                    </li>
                </ul>
            </nav>
            <div class="row">
                <div class="col">
                    <form class="border rounded p-2 bg-light material-container" action="potter-add.php" method="post">
                        <h2>New Customer</h2>
                        <div class="form-group">
                            <label for="customerName">Name</label>
                            <input type="text" class="form-control" name="customerName" placeholder="Enter name" required>
                        </div>
                        <input type="submit" name="customerSubmit" value="Submit" class="btn btn-primary btn-lg btn-block">
                    </form>
                </div>
                <div class="col">
                    <form class="border rounded p-2 bg-light material-container" action="potter-add.php" method="post">
                        <h2>New Dog</h2>
                        <div class="form-group">
                            <label for="dogName">Name</label>
                            <input type="text" class="form-control" name="dogName" placeholder="Enter name" required>
                        </div>
                        <div class="form-group">
                            <label for="dogBreed">Breed</label>
                            <input type="text" class="form-control" name="dogBreed" placeholder="Enter breed" required>
                        </div>
                        <div class="form-group">
                            <label for="ownerID">Owner ID</label>
                            <input type="number" class="form-control" name="ownerID" min="1" placeholder="Enter owner ID" required>
                        </div>
                        <div class="form-group">
                            <label for="preferredGroomerID">Preferred Groomer ID</label>
                            <input type="number" class="form-control" name="preferredGroomerID" min="1" placeholder="Enter groomer ID" required>
                        </div>
                        <div class="form-group">
                            <label for="temperament">Temperament</label>
                            <input type="range" class="form-control custom-range border-0" name="temperament" min="1" max="10" step="1" aria-describedby="temperamentHelp" placeholder="Enter dog temperament">
                            <label class="form-text float-left">👿</label>
                            <label class="form-text float-right">😇</label>
                            <small id="temperamentHelp" class="form-text text-muted"><br></small>
                        </div>
                        <input type="submit" name="dogSubmit" value="Submit" class="btn btn-primary btn-lg btn-block">
                    </form>
                </div>
                <div class="col">
                    <form class="border rounded p-2 bg-light material-container" action="potter-add.php" method="post">
                        <h2>New Employee</h2>
                        <div class="form-group">
                            <label for="employeeName">Name</label>
                            <input type="text" class="form-control" name="employeeName" placeholder="Enter name" required>
                        </div>
                        <div class="form-group">
                            <label for="employeePosition">Position</label>
                            <input type="text" class="form-control" name="employeePosition" placeholder="Enter position" required>
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input type="checkbox" value="" class="form-check-input" name="employeeIsGroomer">
                                <label class="form-check-label" for="employeeIsGroomer">Groomer?</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="employeeWage">Wage</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">$</div>
                                </div>
                                <input type="decimal" class="form-control" name="employeeWage" placeholder="Enter wage" required>
                            </div>
                        </div>
                        <input type="submit" name="employeeSubmit" value="Submit" class="btn btn-primary btn-lg btn-block">
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
