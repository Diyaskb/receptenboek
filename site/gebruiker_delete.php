<?php
// echo $_GET['id'];
require 'database.php';

$id = $_GET['id'];



$stmt = $conn->prepare("DELETE FROM `recipes` WHERE user_id = $id");
// echo "DELETE FROM `recipes` WHERE user_id = $id";
// $stmt->bindParam(':id', $id);
////$stmt->execute();
//$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
//var_dump($stmt->fetchAll());



$stmt = $conn->prepare("DELETE FROM users WHERE id = $id");
// $stmt->bindParam(':id', $id);
$stmt->execute();



// set the resulting array to associative
//$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
//$user = $stmt->fetch();



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>

<body>


    <h1>Verwijderd!</h1>


    <a type="button" class="btn btn-outline-secondary" href="beheer_gebruikers.php">Terug naar Users</a>

</body>

</html>