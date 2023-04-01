<?php
require "database.php";

// sql gerecht die het langst duurt 
$stmt = $conn->prepare("SELECT id, title, picture FROM recipes ORDER BY duration DESC LIMIT 1");
$stmt->execute();

// set the resulting array to associative
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
$allDuration = $stmt->fetchAll();

// sql gerecht die het makkelijkst is
$stmt = $conn->prepare("SELECT id, title, picture FROM recipes ORDER BY difficulty ASC LIMIT 1");
$stmt->execute();

// set the resulting array to associative
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
$allDifficulty = $stmt->fetchAll();


// welke recept het meeste ingredienten heeft

$stmt = $conn->prepare("SELECT  recipes.id, recipes.title, recipes.picture, recipes_id, COUNT(recipes_id) AS MOST FROM `recipes_ingredients` JOIN recipes ON recipes.id = recipes_id
GROUP BY recipes_id ORDER BY MOST DESC limit 1");
$stmt->execute();

// set the resulting array to associative
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
$allMost = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Specials</title>
</head>

<body>
    <?php include 'header.php' ?>
    <?php include 'navbar.php' ?>
    <div class="container mt-5" style="background-color:#dfebe8; ">
        <h1 class="mb-3 text-center">Specials</h1>


        <div class="row justify-content-md-center">
            <div class="col-md-auto">
                <h5>Gerecht die het langst duurt </h5>
                <?php foreach ($allDuration as $duration) { ?>
                    <div class="col-sm-6">
                        <img src="./images/<?php echo $duration['picture']; ?>" width="400px" height="300px">
                        <br>
                        <a class="btn btn-outline-light btn-lg mb-1" style="background-color:#9a8c98;" href="recept.php?recipeID=<?php echo $duration['id'] ?>"><?php echo $duration["title"] ?></a>
                    </div>
                <?php } ?>
            </div>
            <div class="col-sm">
            <h5>Gerecht die het makkelijkst is </h5>
                <?php foreach ($allDifficulty as $difficulty) { ?>
                    <div class="col-sm-6">
                        <img src="./images/<?php echo $difficulty['picture']; ?>" width="400px" height="300px">
                        <br>
                        <a class="btn btn-outline-light btn-lg mb-1" style="background-color:#9a8c98;" href="recept.php?recipeID=<?php echo $difficulty['id'] ?>"><?php echo $difficulty["title"] ?></a>
                    </div>
                <?php } ?>
            </div>
            <div class="col-sm">
            <h5>Recept met de meeste ingrediënten</h5>
                <?php foreach ($allMost as $most) { ?>
                    <div class="col-sm-6">
                        <!-- <p>gerecht die het makkelijkst is </p> -->
                        <img src="./images/<?php echo $most['picture']; ?>" width="400px" height="300px">
                        <br>
                        <a class="btn btn-outline-light btn-lg mb-1" style="background-color:#9a8c98;" href="recept.php?recipeID=<?php echo $most['id'] ?>"><?php echo $most["title"] ?></a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>


    <?php include 'footer.php' ?>
</body>

</html>