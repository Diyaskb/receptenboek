<?php

require 'database.php';


$stmt = $conn->prepare("SELECT Count(title) from recipes;");
$stmt->execute();

// set the resulting array to associative
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
$aantalRecipes = $stmt->fetchAll();

$totalRecipes = $aantalRecipes[0]["Count(title)"];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>header</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/header.css">


</head>

<body>
    <div class="container-fluid p-5  text-white text-center" style="background-color:#80b0a4; ">
        <h1>Smaakvol China</h1>
        <h4>Een verzameling van heerlijke recepten</h4>
        <h5><?php echo $totalRecipes . " recepten"; ?></h5>
    </div>


</body>

</html>