<?php

require "database.php";


// Gegevens van het formulier ophalen
$saved = "";
$user_id = "";

if (isset($_SESSION['gebruikerData'])) {
    // user id ophalen van de logged in user
    $user_id = $_SESSION['gebruikerData']['id'];

    // // check of de admin is ingelogd
    // if ($_SESSION['gebruikerData']['role_id'] == '2') {
    //     // echo "<script>alert('Welkom op recepten update!');</script>";
    // } else {
    //     // echo "<script>alert('U bent niet admin!'); window.location.href = 'index.php';</script>";
    // }
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
    // haal de laatste recept ID om de ingredenten in aparte tabel in desbetreffende secept ID op te slaan
    $last_id = $conn->lastInsertId();
    //==============
    $saved = 'Opgeslagen! <BR>' . '<a class="btn btn-success btn-lg mb-1" href="recepten.php">Terug naar recepten</a>';


    // ===== sla ingredienten op == START========
    $prepareSQL2 = "";
    $prepareSQL3 = "";
    $IDfound = "";

    // loop door alle post variables waar de `key` is de naam van de variable en `val` is de waarde van de variable
    foreach ($_POST as $key => $val) {
        // deels aanmaken van de SQL statement
        $prepareSQL = 'INSERT INTO recipes_ingredients (recipes_id, ingredients_id, amount) VALUES (' . $last_id;

        // zoeken naar variable die begint met ingID om ingredient ID vast te stellen
        if (substr("$key", 0, 5) == "ingID") {
            $prepareSQL2 = "," . $val;
            // checken of ingID is gevonden
            $IDfound = "Yes";
        }
        // zoeken naar variable die begint met ingAmnt om de amount vast te stellen
        if (substr("$key", 0, 7) == "ingAmnt" && $IDfound == "Yes") {
            $prepareSQL3 = ",'" . $val . "'";
            // reset IDfound zodat ie klaar is om volgende zetje van ID en Amount te zoeken 
            $IDfound = "";
            // zet alle stukken van SQL statement in elkaar
            $prepareSQL = $prepareSQL . $prepareSQL2 . $prepareSQL3 . ')';
            $stmtING = $conn->prepare($prepareSQL);
            $stmtING->execute();
        }
        //echo "'$key' = '$val'<br>";
    }
    //  ===========sla ingredienten op == END================
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



        function addIngredient() {
            // haal de div op waar de ingredienten in komen te staan
            var container = document.getElementById("divIngredients");

            // creëer input elemanten in de DIV divIngredients
            var inputIngID = document.createElement("input");
            var input = document.createElement("input");
            var inputAmnt = document.createElement("input");

            // geef de type van de input aan
            inputIngID.type = "hidden";
            input.type = "text";
            inputAmnt.type = "text";

            // voeg de ingredient ID toe aan de id van de element om uniek ID te creëren 
            inputIngID.id = "ingID" + document.getElementById("ingredients").value;
            input.id = "ingName" + document.getElementById("ingredients").value;
            inputAmnt.id = "ingAmnt" + document.getElementById("ingredients").value;

            // geef naam aan de input element (zelfde als de ID 
            inputIngID.name = inputIngID.id;
            input.name = input.id;
            inputAmnt.name = inputAmnt.id;

            // om de tekst van de dropdown lijst te krijgen om het vervolgens te gebruiken als waarde van input.value
            // input.value = document.getElementById('ingredients').text;
            var dropdownList = document.getElementById('ingredients');
            var selecetedIndex = dropdownList.selectedIndex;
            var selectedOption = dropdownList.options[selecetedIndex];

            inputIngID.value = document.getElementById("ingredients").value;
            input.value = selectedOption.text;
            inputAmnt.value = document.getElementById("ingAmount").value;

            // deze twee elementen niet bewerkbaar maken
            input.readOnly = true;
            inputAmnt.readOnly = true;

            // voeg de gemaakte elementen toe aan de DIV divIngredients
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
                                    <input class="btn btn-success btn-sm mb-1" type="" value="Add to recipe" name="clear" onclick="addIngredient()">
                                    <a class="btn btn-success btn-sm mb-1" href="ingredient_add.php">Add New ingredient</a>

                                    <div id="divIngredients"></div>


                                </div>
                                <input class="btn btn-success btn-sm mb-1" type="" style="background-color: red;" value="Clear ingredients" name="clear" onclick="resetIngredients()">


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