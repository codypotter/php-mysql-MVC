<!--
    Author: Cody potter
    Date: 2018-05-01
    Description: PHP file to read entries from a database
    Note: I'm really happy with how this turned out. It still
        has room to grow.
-->
<?php
    // initial setup
    $myDBinfo = 'mysql:host=127.0.0.1;dbname=dogsrus';
    $myDBuser = 'root';
    $myDBpassword = '';

    try {
        $myConnection = new PDO($myDBinfo, $myDBuser, $myDBpassword);
    } catch (PDOException $myError) {
        echo('The Database connection failed.');
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
    <body>
        <div class="container page-container">
            <h1 class="page-header display-3">Dogs R Us</h1>
            <nav class="container m-3">
                <ul class="nav nav-pills justify-content-center">
                    <li class="nav-item">
                        <a class="nav-link active" href="potter-view.php">View Data</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="potter-add.php">Add Data</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="potter-delete.php">Delete Data</a>
                    </li>
                </ul>
            </nav>
            <div class="container dog-table table-div rounded">
                <h3 class="d-inline table-title m-2">🐶 Dogs</h3>
                <table class="table m-2">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Breed</th>
                            <th scope="col">Dog Temperament</th>
                            <th scope="col">Owner</th>
                            <th scope="col">Preferred Groomer</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            // make a query to get ALL the dogs
                            $allDogs = "SELECT * FROM dogs";
                            // get the records using the query
                            $allDogRecords = $myConnection->query($allDogs);
                            // iterate over the records, making the table as you go
                            foreach ($allDogRecords as $dog) {
                                // Need to use some nested queries to get useful data
                                //
                                // Extra Credit for this part? :^)
                                //
                                // Get owner name using known owner ID
                                $ownerQuery = "SELECT * FROM customers WHERE customerID=:customerID";
                                $myOwnerSqlPrep = $myConnection->prepare($ownerQuery);
                                $myOwnerArray = array('customerID'=>$dog['customerID']);
                                $myOwnerQuerySuccess = $myOwnerSqlPrep->execute($myOwnerArray);
                                $myOwnerQueryData = $myOwnerSqlPrep->fetch();

                                // Get preferred groomer name using known groomer ID
                                $groomerQuery = "SELECT * FROM employees WHERE employeeID=:employeeID";
                                $myGroomerSqlPrep = $myConnection->prepare($groomerQuery);
                                $myGroomerArray = array('employeeID'=>$dog['preferredGroomerID']);
                                $myGroomerQuerySuccess = $myGroomerSqlPrep->execute($myGroomerArray);
                                $myGroomerQueryData = $myGroomerSqlPrep->fetch();

                                // Finally, build the table row using all our data from intial and nested queries
                                echo(
                                    '<tr>
                                        <th scope="row">' . $dog['dogID'] . '</th>
                                        <td>' . $dog['dogName'] . '</td>
                                        <td>' . $dog['dogBreed'] . '</td>
                                        <td>' . $dog['temperament'] . '</td>
                                        <td>' . $myOwnerQueryData['customerName'] . '</td>
                                        <td>' . $myGroomerQueryData['employeeName'] . '</td>
                                    </tr>'
                                );
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="container customer-table table-div rounded">
                <h3 class="d-inline table-title m-2">💵 Customers</h3>
                <table class="table m-2">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Customer Since</th>
                            <th scope="col">Loyalty Dollars</th>
                            <th scope="col">Last Visit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // PHP styling says indent should start here
                            // But I think it looks cleaner when I indent here
                            $allCustomers = "SELECT * FROM customers";
                            $allCustomerRecords = $myConnection->query($allCustomers);
                            foreach ($allCustomerRecords as $customer) {
                                echo(
                                    '<tr>
                                        <th scope="row">' . $customer['customerID'] . '</th>
                                        <td>' . $customer['customerName'] . '</td>
                                        <td>' . $customer['customerSinceDate'] . '</td>
                                        <td>$' . $customer['dollarsSpent'] . '</td>
                                        <td>' . $customer['lastVisitDate'] . '</td>
                                    </tr>'
                                );
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="container employee-table table-div rounded">
                <h3 class="d-inline mx-auto m-2">👩 Employees</h3>
                <table class="table m-2">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Position</th>
                            <th scope="col">Groomer?</th>
                            <th scope="col">Wage</th>
                            <th scope="col">Hire Date</th>
                            <th scope="col">Termination Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $allEmployees = "SELECT * FROM employees";
                            $allEmployeeRecords = $myConnection->query($allEmployees);
                            foreach ($allEmployeeRecords as $employee) {
                                $isGroomer = 'no';
                                if ($employee['isGroomer']){
                                    $isGroomer = "yes";
                                }

                                echo(
                                    '<tr>
                                        <th scope="row">' . $employee['employeeID'] . '</th>
                                        <td>' . $employee['employeeName'] . '</td>
                                        <td>' . $employee['position'] . '</td>
                                        <td>' . $isGroomer . '</td>
                                        <td>$' . $employee['wage'] . '</td>
                                        <td>' . $employee['hireDate'] . '</td>
                                        <td>' . $employee['terminationDate'] . '</td>
                                    </tr>'
                                );
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>
