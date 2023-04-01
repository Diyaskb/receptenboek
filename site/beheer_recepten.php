<?php
require 'database.php';


$stmt = $conn->prepare("SELECT recipes.id, title, picture, duration, dish, difficulty, preparation, users.firstname FROM `recipes` JOIN users ON users.id = user_id ");
$stmt->execute();

// set the resulting array to associative
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
$recipes = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recepten</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>

<body>
    <?php include "header.php" ?>
    <?php include "navbar.php" ?>
    <h1 class="mb-3 " style="color:  #000;">Recepten</h1>
    <div class="col-sm">
        <a type="button" class="btn btn-outline-secondary btn-sm" href="recept_add.php">Nieuwe recept</a>
    </div>
    <div class="container mt-5" style="background-color:#dfebe8; ">
        <h1 class="mb-3 text-center">Recepten</h1>
        <!-- <div class="col-sm"> -->
        <table class="table">
            <thead>
                <tr style="color: #000;">
                    <th>Id</th>
                    <th>Titel</th>
                    <th>Foto</th>
                    <th>Bereidingstijd</th>
                    <th>Gerecht</th>
                    <th>Moeilijkheidsgraad</th>
                    <th>Bereidingswijze</th>
                    <th>User naam</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($recipes as $recipe) { ?>
                    <tr style="color: #000;">
                        <td><?php echo $recipe["id"] ?></td>
                        <td><?php echo $recipe["title"] ?></td>
                        <td><?php echo $recipe["picture"] ?></td>
                        <td><?php echo $recipe["duration"] ?></td>
                        <td><?php echo $recipe["dish"] ?></td>
                        <td><?php echo $recipe["difficulty"] ?></td>
                        <td><?php echo $recipe["preparation"] ?></td>
                        <td><?php echo $recipe["firstname"] ?></td>


                        <td>
                            <a type="button" class="btn btn-outline-secondary" href="recept_edit.php?id=<?php echo $recipe["id"] ?>">wijzig</a>
                            <a type="button" class="btn btn-outline-secondary" href="recept_delete.php?id=<?php echo $recipe["id"] ?>" onclick="return confirm('Are you sure?')">verwijder recept</a>
                        </td>

                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <!-- </div> -->
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <?php include "footer.php" ?>

</body>

</html>