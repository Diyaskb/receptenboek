<?php


require "database.php";


// var_dump($_POST);

// Gegevens van het formulier ophalen
$saved = "";
$user_id = "";

if (isset($_SESSION['gebruikerData'])) {
    $user_id = $_SESSION['gebruikerData'];


    if ($_SESSION['gebruikerData']['role_id'] == '2') {
        echo "<script>alert('Welkom op recepten update!');</script>";
    } else {
        echo "<script>alert('U bent niet admin!'); window.location.href = 'index.php';</script>";
    }
} else {
    echo "<script>alert('U bent niet ingelogd!'); window.location.href = 'index.php';</script>";
}

if (isset($_POST['submit'])) {
    // get user_id from session
    // $user_id = 3;

    $title = $_POST['title'];
    $picture = $_POST['picture'];
    $duration = $_POST['duration'];
    $dish = $_POST['dish'];
    $difficulty = $_POST['difficulty'];
    $preparation = $_POST['preparation'];




    $stmt = $conn->prepare("INSERT INTO recipes (title, picture, duration, dish, difficulty, user_id, preparation) VALUES (:title, :picture, :duration, :dish, :difficulty, :user_id, :preparation)");
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':picture', $picture);
    $stmt->bindParam(':duration', $duration);
    $stmt->bindParam(':dish', $dish);
    $stmt->bindParam(':difficulty', $difficulty);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':preparation', $preparation);

    $stmt->execute();
    $saved = 'Opgeslagen! <BR>' . '<a class="btn btn-success btn-lg mb-1" href="recepten.php">Terug naar recepten</a>';
}


?>




<!DOCTYPE html>
<html>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Recept</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

<head>
    <title>Gebruiker registreren</title>
</head>

<body>
    <?php include 'header.php' ?>
    <?php include 'navbar.php' ?>

    <section class="h-100 h-custom" style="background-color: #dfebe8">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-8 col-xl-6">
                    <div class="card rounded-3">
                        <!-- IMAGE WERKEND MAKEN -->
                        <IMG src="./images_site/lampionnen.png" class="w-100" style="border-top-left-radius: .3rem; border-top-right-radius: .3rem; height: 225px;" alt="Sample photo"></IMG>
                        <div class="card-body p-4 p-md-5">
                            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5 px-md-2">Recept</h3>
                            <p style="color: green;"><?php echo $saved;   ?></p>

                            <form method="post" action="" class="px-md-2">


                                <div class="row">
                                    <div class="col-md-6 mb-4">

                                        <div class="form-outline datepicker">
                                            <input type="text" name="title" id="title" required class="form-control" />
                                            <label for="exampleDatepicker1" class="form-label">Title</label>
                                        </div>

                                    </div>
                                    <div class="col-md-6 mb-4">

                                        <div class="form-outline datepicker">
                                            <!-- <input type="text" name="picture" id="picture" required class="form-control" />-->
                                            <label for="exampleDatepicker1" class="form-label">Upload Picture</label>
                                            <input type="file" id="picture" name="picture">
                                        </div>

                                    </div>
                                </div>

                                <div class="form-outline mb-4">
                                    <input type="duration" name="duration" id="duration" required class="form-control" />
                                    <label class="form-label" for="form3Example1q">Duration</label>
                                </div>


                                <div class="form-outline mb-4">
                                    <input type="dish" name="dish" id="dish" required class="form-control" />
                                    <label class="form-label" for="form3Example1q">Dish</label>
                                </div>

                                <div class="mb-4">

                                    <select name="difficulty" id="difficulty">
                                        <option value=1>1</option>
                                        <option value=2>2</option>
                                        <option value=3>3</option>
                                        <option value=4>4</option>
                                        <option value=5>5</option>
                                    </select>
                                    <label>Difficulty</label>

                                </div>

                                <div class="form-outline mb-4">
                                    <textarea name="preparation" id="preparation" required class="form-control"></textarea>

                                    <label class="form-label" for="form3Example1q">Preparation</label>
                                </div>


                                <input class="btn btn-success btn-lg mb-1" type="submit" value="Save" name="submit">

                            </form>



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php include 'footer.php' ?>


</html>