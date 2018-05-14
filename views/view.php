<!--
Author: Cody Potter
Date: 2018-05-14
Assignment: Week 5/6
-->
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
                        <a class="nav-link active" href="/cs234-a3/controller.php?link=view">View Data</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/cs234-a3/controller.php?link=add">Add Data</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/cs234-a3/controller.php?link=delete">Delete Data</a>
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
                        // you could use javascript to abstract this away from view even further
                        $rows = $dogs->fetchAll();
                        foreach($rows as $row) {
                          $customerName = getCustomerName($row['customerID'])->fetch();
                          $preferredGroomerName = getPreferredGroomerName($row['preferredGroomerID'])->fetch();
                          echo(
                              '<tr>
                                  <th scope="row">' . $row['dogID'] . '</th>
                                  <td>' . $row['dogName'] . '</td>
                                  <td>' . $row['dogBreed'] . '</td>
                                  <td>' . $row['temperament'] . '</td>
                                  <td>' . $customerName[0] . '</td>
                                  <td>' . $preferredGroomerName[0] . '</td>
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
                        // you could use javascript to abstract this away from view even further
                        $customerRecords = $customers->fetchAll();
                        foreach ($customerRecords as $customer) {
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
                        // you could use javascript to abstract this away from view even further
                        $employeeRecords = $employees->fetchAll();
                        foreach ($employeeRecords as $employee) {
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
