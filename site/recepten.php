<?php

require 'database.php';

// $servername = "mariadb";
// $username = "username";
// $password = "password";
// $dbname = "myDBPDO";


// $stmt = $conn->prepare("SELECT id, first_name, last_name FROM users");
// $stmt->execute();

// // set the resulting array to associative
// $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
// $myGuests = $stmt->fetchAll();


$stmt = $conn->prepare("SELECT id, title, picture FROM recipes");
$stmt->execute();

// set the resulting array to associative
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
$all_recipes = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recepten</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/header.css">
</head>

<body>
    <?php include 'header.php' ?>
    <?php include 'navbar.php' ?>

    <div class="container mt-5" style="background-color:#dfebe8; ">
        <h1 class="mb-3 text-center">Recepten</h1>

        <div class="row">
            <?php foreach ($all_recipes as $recipe) { ?>
                <div class="col-sm-4">
                    <img src="./images/<?php echo $recipe['picture']; ?>" width="400px" height="300px">
                    <br>
                    <a class="btn btn-outline-light btn-lg mb-1" style="background-color:#9a8c98;" href="recept.php?recipeID=<?php echo $recipe['id'] ?>"><?php echo $recipe["title"] ?></a>
                </div>

            <?php } ?>
        </div>
    </div>
    
    <?php include 'footer.php' ?>
</body>

</html>