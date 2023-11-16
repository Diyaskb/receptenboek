<?php



require "database.php";


if (isset($_SESSION['gebruikerData'])) {

    if ($_SESSION['gebruikerData']['role_id'] == '2') {
        //echo "<script>alert('Welkom op recepten update!');</script>";
    } else {
        //echo "<script>alert('U bent niet admin!'); window.location.href = 'index.php';</script>";
    }
} else {
    echo "<script>alert('U bent niet ingelogd!'); window.location.href = 'index.php';</script>";
}

$saved = "";
$recipeID = "";


if (isset($_POST['submit'])) {


    $recipeID = $_POST['recipeID'];
    $title = $_POST['title'];
    $picture = $_POST['picture'];
    $duration = $_POST['duration'];
    $dish = $_POST['dish'];
    $difficulty = $_POST['difficulty'];
    $preparation = $_POST['preparation'];

    $stmt = $conn->prepare("UPDATE recipes SET title = :title, picture = :picture, duration = :duration, dish = :dish, difficulty = :difficulty, preparation =:preparation WHERE id = :recipeID");
    $stmt->bindParam(':recipeID', $recipeID);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':picture', $picture);
    $stmt->bindParam(':duration', $duration);
    $stmt->bindParam(':dish', $dish);
    $stmt->bindParam(':difficulty', $difficulty);
    $stmt->bindParam(':preparation', $preparation);




    $stmt->execute();
    $saved = 'Opgeslagen! <BR>' . '<a class="btn btn-success btn-lg mb-1" href="recepten.php">Terug naar recepten</a>';


    // ingredienten updaten

    // loop door alle post variables
    foreach ($_POST as $key => $val) {

        if (substr("$key", 0, 5) == "ingID") {
            $prepareSQL2 = $val;
            $IDfound = "Yes";
        }
        if (substr("$key", 0, 7) == "ingAmnt" && $IDfound == "Yes") {
            $prepareSQL3 = "$val";
            $IDfound = "";

            $prepareSQL = "UPDATE recipes_ingredients SET amount = '$prepareSQL3' WHERE ingredients_id = $prepareSQL2";
            $stmtING = $conn->prepare($prepareSQL);
            $stmtING->execute();
        }
    }
}






if (isset($_GET['recipeID'])) {
    $id = $_GET['recipeID'];
    $user_id = $_SESSION['gebruikerData']['id'];

    // als de beheerder is ingelogd
    if ($_SESSION['gebruikerData']['role_id'] == '2') {
        $stmt = $conn->prepare("SELECT * FROM recipes WHERE id = :id");
    } else {
        // als de ingelogde user de maker is
        $stmt = $conn->prepare("SELECT * FROM recipes WHERE id = :id AND user_id = :user_id");
        $stmt->bindParam(':user_id', $user_id);
    }
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $all_recipes = $stmt->fetch();

    // geen beheerder en niet je eigen recept
    if ($all_recipes == false && $_SESSION['gebruikerData']['role_id'] != '2') {
        echo "<script>alert('U heeft geen recepten!'); window.location.href = 'index.php';</script>";
    }

    // ingredienten ophalen
    // echo "SELECT * FROM `recipes_ingredients` JOIN ingredients ON ingredients.id = ingredients_id WHERE recipes_id = $id; 
    $stmtING = $conn->prepare("SELECT * FROM `recipes_ingredients`  JOIN ingredients ON ingredients.id = ingredients_id WHERE recipes_id = $id");
    //$stmt->bindParam(':user_id', $user_id);
    $stmtING->execute();

    $result = $stmtING->setFetchMode(PDO::FETCH_ASSOC);
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

<head>
    <title>Recept edit</title>
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
                            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5 px-md-2">Recept</h3>
                            <p style="color: green;"><? echo $saved;   ?></p>

                            <form method="post" action="" class="px-md-2">
                                <input type="hidden" name="recipeID" id="recipeID" value="<? echo $id; ?>">


                                <div class="row">
                                    <div class="col-md-6 mb-4">

                                        <div class="form-outline datepicker">

                                            <input type="text" name="title" id="title" value="<?php echo $all_recipes['title']; ?>" required class="form-control" />
                                            <label for="exampleDatepicker1" class="form-label">Title</label>
                                        </div>

                                    </div>
                                    <div class="col-md-6 mb-4">

                                        <div class="form-outline datepicker">
                                            <label for="exampleDatepicker1" class="form-label">Upload Picture</label>
                                            <input type="file" id="picture" name="picture">
                                        </div>

                                    </div>
                                </div>

                                <div class="form-outline mb-4">
                                    <input type="duration" name="duration" id="duration" value="<?php echo $all_recipes['duration']; ?>" required class="form-control" />
                                    <label class="form-label" for="form3Example1q">Duration</label>
                                </div>


                                <div class="form-outline mb-4">
                                    <input type="dish" name="dish" id="dish" value="<?php echo $all_recipes['dish']; ?>" required class="form-control" />
                                    <label class="form-label" for="form3Example1q">Dish</label>
                                </div>

                                <div class="mb-4">

                                    <select name="difficulty" id="difficulty">
                                        <option selected value=<?php echo $all_recipes['difficulty']; ?>><?php echo $all_recipes['difficulty']; ?></option>
                                        <option value=1>1</option>
                                        <option value=2>2</option>
                                        <option value=3>3</option>
                                        <option value=4>4</option>
                                        <option value=5>5</option>
                                    </select>
                                    <label>Difficulty</label>

                                </div>

                                <!-- ================================== -->
                                <div id="divIngredients"></div>
                                <table class="table table-sm text-center">
                                    <thead>
                                        <tr style="color: #000;">
                                            <th>Name</th>
                                            <th>Amount</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $x = 0;
                                        foreach ($all_ING as $ing) {
                                            $x++;
                                        ?>
                                            <tr style="color: #000;">
                                                <input type="hidden" name="ingID<?php echo $x ?>" id="ingID<?php echo $x ?>" value="<?php echo $ing['ingredients_id'] ?>">
                                                <td><?php echo $ing['name'] ?></td>
                                                <td><input type="text" name="ingAmnt<?php echo $x ?>" id="ingAmnt<?php echo $x ?>" value="<?php echo $ing['amount'] ?>"></td>
                                                <td>
                                                    <!-- <a type=" button" class="btn btn-outline-secondary" href="recept_edit.php?ingredients_id=<?php echo $ing["ingredients_id"] ?>">wijzig</a> -->
                                                </td>

                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>

                                <!-- ================================= -->
                                <div class="form-outline mb-4">
                                    <textarea name="preparation" id="preparation" required class="form-control"><?php echo $all_recipes['preparation']; ?></textarea>

                                    <label class="form-label" for="form3Example1q">Preparation</label>
                                </div>

                                <input class="btn btn-success btn-lg mb-1" type="submit" value="Save" name="submit">
                        </div>
                        </form>



                    </div>
                </div>
            </div>
        </div>
        <!-- </div> -->
    </section>
    <?php include 'footer.php' ?>
</body>


</html>