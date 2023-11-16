<?php


require "database.php";







// Check if the recipeID is sent via the link
if (isset($_GET['recipeID'])) {
    $recipeID = $_GET['recipeID'];

    $stmt = $conn->prepare("SELECT * FROM recipes WHERE id = $recipeID");
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $all_recipes = $stmt->fetch();


    $stmtING = $conn->prepare("SELECT * FROM `recipes_ingredients` JOIN ingredients ON ingredients.id = ingredients_id WHERE  recipes_id = $recipeID");
    $stmtING->execute();

    // set the resulting array to associative
    $resultING = $stmtING->setFetchMode(PDO::FETCH_ASSOC);
    $all_ING = $stmtING->fetchAll();
}

?>




<!DOCTYPE html>
<html>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Recept</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<!-- CSS link -->
<link rel="stylesheet" href="./css/header.css">

<head>
    <title>recept</title>
</head>

<body>
    <?php include 'header.php' ?>
    <?php include 'navbar.php' ?>

    <div class="" style="background-color: #dfebe8;">
        <div class="container py-5">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-8 col-xl-6">
                    <div class="card rounded-3">
                        <IMG src="./images_site/lampionnen.png" class="w-100" style="border-top-left-radius: .3rem; border-top-right-radius: .3rem; height: 225px;" alt="Sample photo"></IMG>
                        <div class="card-body p-4 p-md-5">
                            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5 px-md-2">Recept</h3>

                            <input type="hidden" name="recipeID" id="recipeID" value="<? echo $recipeID; ?>">

                            <div class="container-fluid p-5 bg-light text-dark text-center">
                                <h1>
                                    <p><?php echo $all_recipes['title']; ?></p>
                                </h1>
                                <p><img src="./images/<?php echo $all_recipes['picture']; ?>" width="400px"></p>
                            </div>

                            <div class="container mt-5">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <h5>Bereidingstijd</h5>
                                        <h6><?php echo $all_recipes['duration']; ?> minuten</h6>
                                    </div>
                                    <div class="col-sm-4">
                                        <h4>Gerecht</h4>
                                        <h6><?php echo $all_recipes['dish']; ?></h6>
                                    </div>
                                    <div class="col-sm-4">
                                        <h5>Moeilijkheids-graad</h5>
                                        <h6><?php echo $all_recipes['difficulty']; ?> /5</h6>
                                    </div>
                                </div>
                            </div>

                            <!-- ===========INGREDIENTS====================== -->
                            <div class="col-sm">
                                <table class="table">
                                    <thead>
                                        <h5>Ingrediënten</h5>
                                        <tr style="color: #000;">
                                            <th>Naam</th>
                                            <th>Hoeveelheid</th>
                                        </tr>
                                    </thead>
                                    <tbody>


                                        <?php foreach ($all_ING as $ing) { ?>
                                            <tr style="color: #000;">
                                                <td><?php echo $ing["name"] ?></td>
                                                <td><?php echo $ing["amount"] ?></td>
                                            </tr>
                                        <?php } ?>


                                    </tbody>
                                </table>
                            </div>

                            <!-- ================================ -->

                            <div class="container-fluid p-5 bg-light text-dark text-center">
                                <h3>Bereindingswijze </h3>
                                <p><?php echo $all_recipes['preparation']; ?></p>

                            </div>
                            <a class="btn btn-success btn-lg mb-1" href="recept_edit.php?recipeID=<?php echo $recipeID ?>">Bewerken</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <?php include 'footer.php' ?>

</body>

</html>