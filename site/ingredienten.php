<?php
require 'database.php';



$stmt = $conn->prepare("SELECT * FROM ingredients");
$stmt->execute();

// set the resulting array to associative
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
$all_ingredients = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingrediënten</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>

<body>
    <?php include 'header.php' ?>
    <?php include 'navbar.php' ?>

    <div class="container mt-5" style="background-color:#dfebe8; ">
        <h1 class="mb-3 text-center">Ingrediënten</h1>
        <div class="col-sm">
            <a type="button" class="btn btn-outline-secondary btn-sm" href="ingredient_add.php">Nieuwe ingredient</a>
        </div>

        <table class="table table-sm text-center">
            <thead>
                <tr style="color: #000;">
                    <th>Id</th>
                    <th>Name</th>
                    <th>Wijzig naam</th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($all_ingredients as $ingredient) { ?>
                    <tr style="color: #000;">
                        <td><?php echo $ingredient["id"] ?></td>
                        <td><?php echo $ingredient["name"] ?></td>
                        <td>
                            <a type="button" class="btn btn-outline-secondary" href="ingredient.php?id=<?php echo $ingredient["id"] ?>">wijzig</a>
                        </td>

                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <?php include 'footer.php' ?>
</body>

</html>