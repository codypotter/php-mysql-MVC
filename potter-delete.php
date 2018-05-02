
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
    <body style="background-color: #ed6a5a;">
        <div class="container page-container">
            <h1 class="page-header display-3 text-white">Dogs R Us</h1>
            <nav class="container m-3">
                <ul class="nav nav-pills justify-content-center">
                    <li class="nav-item">
                        <a class="nav-link btn-danger" href="potter-view.php">View Data</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn-danger" href="potter-add.php">Add Data</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active btn-danger" href="potter-delete.php">Delete Data</a>
                    </li>
                </ul>
            </nav>
            <div class="col">
                <form class="border rounded p-2 bg-light material-container" action="potter-add.php" method="post">
                    <h2>Delete dog</h2>
                    <div class="form-group">
                        <label for="dogID">Dog ID</label>
                        <input type="number" min="1" class="form-control" name="dogID" placeholder="Enter dog ID to DELETE" required>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input type="checkbox" value="" class="form-check-input" name="userIsCertain" required>
                            <label class="form-check-label" for="userIsCertain">I am sure I want to permanently delete a dog from the database.</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-danger btn-lg btn-block">Delete</button>
                    <small>Please don't press this in error.</small>
                </form>
            </div>
        </div>
    </body>
</html>
