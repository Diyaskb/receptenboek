<?php

require "database.php";


// var_dump($_POST);

// Gegevens van het formulier ophalen

if (isset($_POST['submit'])) {

    //$id = $_POST['id'];
    $name = $_POST['name'];



    $stmt = $conn->prepare("INSERT INTO ingredients  (name) VALUES (:name)");
    // $stmt->bindParam(':id', $id);
    $stmt->bindParam(':name', $name);


    $stmt->execute();
    header('location: ingredienten.php');
}


// $stmt = $conn->prepare("SELECT * FROM ingredients");
// $stmt->execute();

// set the resulting array to associative
// $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
// $all_ingredients = $stmt->fetchAll();
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

    <section class="h-100 h-custom" style="background-color: #dfebe8;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-8 col-xl-6">
                    <div class="card rounded-3">
                        <IMG src="./images_site/lampionnen.png" class="w-100" style="border-top-left-radius: .3rem; border-top-right-radius: .3rem; height: 225px;" alt="Sample photo"></IMG>
                        <div class="card-body p-4 p-md-5">
                            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5 px-md-2">Nieuwe ingrediënt</h3>

                            <form method="post" action="" class="px-md-2">

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form3Example1q">Nieuwe ingrediënt</label>
                                    <input type="text" name="name" id="name" required class="form-control" />
                                </div>


                                <input class="btn btn-success btn-lg mb-1" type="submit" value="Submit" name="submit">

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <?php include 'footer.php' ?>
</body>

</html>