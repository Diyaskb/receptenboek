<?php


require "database.php";


var_dump($_POST);

echo "<br>";
// var_dump($_SESSION['gebruikerData']);


// Gegevens van het formulier ophalen
$saved = "";
$user_id = "";

if (isset($_SESSION['gebruikerData'])) {
    // $user_id = $_SESSION['gebruikerData'];
    $user_id = $_SESSION['gebruikerData']['id'];


    if ($_SESSION['gebruikerData']['role_id'] == '2') {
        // echo "<script>alert('Welkom op recepten update!');</script>";
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

    //================
    // use exec() because no results are returned
    // $conn->exec($stmt);
    $last_id = $conn->lastInsertId();
    echo "New record created successfully. Last inserted ID is: " . $last_id;
    //==============
    $saved = 'Opgeslagen! <BR>' . '<a class="btn btn-success btn-lg mb-1" href="recepten.php">Terug naar recepten</a>';


    // =====save ingredients========
    // id	recipes_id	ingredients_id	amount	
    $prepareSQL2 = "";
    $prepareSQL3 = "";
    $IDfound = "";


    foreach ($_POST as $key => $val) {
        echo "$key = $val<br>";
        $prepareSQL = 'INSERT INTO recipes_ingredients (recipes_id, ingredients_id, amount) VALUES (' . $last_id;
        if (substr("$key", 0, 5) == "ingID") {
            $prepareSQL2 = "," . $val;
            $IDfound = "Yes";



            echo "<br>$key = $val<br>";
        }
        if (substr("$key", 0, 7) == "ingAmnt" && $IDfound == "Yes") {
            $prepareSQL3 = "," . $val;
            $IDfound = "";

            $prepareSQL = $prepareSQL . $prepareSQL2 . $prepareSQL3 . ')';
            echo "<br>$prepareSQL<br>";
            // $stmtING = $conn->prepare("INSERT INTO recipes_ingredients (recipes_id, ingredients_id, amount) VALUES (70,2,10)");
            $stmtING = $conn->prepare($prepareSQL);

            $stmtING->execute();

            echo "<br>$key = $val<br>";
        }

        //echo "===========================<br>";

        //echo "'$key' = '$val'<br>";
    }




    //  ===========================
}



// dropdown
$stmt = $conn->prepare("SELECT * FROM `ingredients`");
$stmt->execute();

// set the resulting array to associative
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
$allIngredients = $stmt->fetchAll();


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

    <script>
        function resetIngredients() {
            var container = document.getElementById("divIngredients");

            while (container.hasChildNodes()) {
                container.removeChild(container.lastChild);
            }
        }

        // function addIngredientWorking() {
        //     var container = document.getElementById("divIngredients");
        //     var input = document.createElement("input");
        //     input.type = "text";
        //     input.id = "ingredient" + document.getElementById("ingredients").value;
        //     // input.value = document.getElementById('ingredients').text;
        //     var dropdownList = document.getElementById('ingredients');
        //     var selecetedIndex = dropdownList.selectedIndex;
        //     var selectedOption = dropdownList.options[selecetedIndex];
        //     input.value = selectedOption.text;

        //     input.readOnly = true;
        //     container.appendChild(input);
        //     container.appendChild(document.createElement("br"));

        // }

        function addIngredient() {
            var container = document.getElementById("divIngredients");

            var inputIngID = document.createElement("input");
            var input = document.createElement("input");
            var inputAmnt = document.createElement("input");

            inputIngID.type = "hidden";
            input.type = "text";
            inputAmnt.type = "text";

            inputIngID.id = "ingID" + document.getElementById("ingredients").value;
            input.id = "ingName" + document.getElementById("ingredients").value;
            inputAmnt.id = "ingAmnt" + document.getElementById("ingredients").value;

            inputIngID.name = inputIngID.id;
            input.name = input.id;
            inputAmnt.name = inputAmnt.id;


            // input.value = document.getElementById('ingredients').text;
            var dropdownList = document.getElementById('ingredients');
            var selecetedIndex = dropdownList.selectedIndex;
            var selectedOption = dropdownList.options[selecetedIndex];

            inputIngID.value = document.getElementById("ingredients").value;;
            input.value = selectedOption.text;
            inputAmnt.value = document.getElementById("ingAmount").value;;

            input.readOnly = true;
            inputAmnt.readOnly = true;

            container.appendChild(inputIngID);
            container.appendChild(input);
            container.appendChild(inputAmnt);
            container.appendChild(document.createElement("br"));

        }
    </script>
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

                                <div class="mb-4">

                                    <select name="ingredients" id="ingredients">
                                        <?php foreach ($allIngredients as $ingredient) { ?>

                                            <option value=<?php echo $ingredient["id"] ?>><?php echo $ingredient["name"] ?></option>
                                        <?php } ?>

                                    </select>
                                    <input type="text" name="ingAmount" id="ingAmount" size="10">
                                    <input class="btn btn-success btn-sm mb-1" type="" value="Add to receipe" name="clear" onclick="addIngredient()">
                                    <a class="btn btn-success btn-sm mb-1" href="ingredient_add.php">Add New ingredient</a>

                                    <div id="divIngredients"></div>


                                </div>
                                <input class="btn btn-success btn-sm mb-1" type="" value="Clear ingredients" name="clear" onclick="resetIngredients()">


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