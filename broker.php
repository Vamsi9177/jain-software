<?php
session_start();
if (!isset($_SESSION["user"])) {
   header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>

    <style>
        .tb {
            background-color: #0cb8b6;
            /* color: white */
        }
        
        th {
            color: black;
            font-weight: 500;
        }
        
        .btn {
            background: #0cb8b6;
            color: #fff;
        }
    </style>
</head>

<body>
    <br>
    <h1 align="center">{{number}}</h1><br>

    <br>
    <div class="container">
        <a href="logout.php" class="btn">Logout</a><br><br>
        <h3 align="center">PROPERTIES</h3><br>
        <div style="overflow-x:auto">
            <table class="table table-striped">
                <tr class="tb">
                    <th scope="col">Property ID</th>
                    <th scope="col">Owner Name</th>
                    <th scope="col">Mobile Num</th>
                    <th scope="col">Address</th>
                    <th scope="col">City</th>
                    <th scope="col">Zip Code</th>
                    <th scope="col">kind</th>
                    <th scope="col">Area</th>
                    <th scope="col">Valuation</th>
                    <th scope="col">Status</th>

                </tr>
            </table>
        </div>
    </div>



</body>


</html>
