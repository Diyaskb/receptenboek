<?php


require "database.php";


// var_dump($_POST);

// Gegevens van het formulier ophalen

if (isset($_POST['submit'])) {

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];


    $stmt = $conn->prepare("INSERT INTO users (firstname, lastname, email, password, role_id) VALUES (:firstname, :lastname, :email, :password, :role_id)");
    $stmt->bindParam(':firstname', $firstname);
    $stmt->bindParam(':lastname', $lastname);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':role_id', $role);

    $stmt->execute();
    header('location: login.php');
    if ($_SESSION["gebruikerData"]['role_id'] == 2) {
        header("Location: beheer_gebruikers.php");
    }
}

// $_SESSION["gebruikerData"] = $user;

// dropdown
$stmt = $conn->prepare("SELECT * FROM `roles`");
$stmt->execute();

// set the resulting array to associative
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
$allRoles = $stmt->fetchAll();


?>




<!DOCTYPE html>
<html>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Registreren</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

<head>
    <title>Gebruiker registreren</title>
</head>

<body>

    <section class="h-100 h-custom" style="background-color: #8fc4b7;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-8 col-xl-6">
                    <div class="card rounded-3">
                        <IMG src="./images_site/lampionnen.png" class="w-100" style="border-top-left-radius: .3rem; border-top-right-radius: .3rem; height: 225px;" alt="Sample photo"></IMG>
                        <div class="card-body p-4 p-md-5">
                            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5 px-md-2">Registration Info</h3>

                            <form method="post" action="" class="px-md-2">


                                <div class="row">
                                    <div class="col-md-6 mb-4">

                                        <div class="form-outline datepicker">
                                            <input type="text" name="firstname" id="firstname" required class="form-control" />
                                            <label for="exampleDatepicker1" class="form-label">Voornaam</label>
                                        </div>

                                    </div>
                                    <div class="col-md-6 mb-4">

                                        <div class="form-outline datepicker">
                                            <input type="text" name="lastname" id="lastname" required class="form-control" />
                                            <label for="exampleDatepicker1" class="form-label">Achternaam</label>
                                        </div>

                                    </div>
                                </div>

                                <div class="form-outline mb-4">
                                    <input type="email" name="email" id="email" required class="form-control" />
                                    <label class="form-label" for="form3Example1q">E-mailadres</label>
                                </div>


                                <div class="form-outline mb-4">
                                    <input type="password" name="password" id="password" required class="form-control" />
                                    <label class="form-label" for="form3Example1q">Wachtwoord</label>
                                </div>

                                <div class="mb-4">

                                    <select name="role" id="">
                                        <?php foreach ($allRoles as $role) { ?>
                                            <option value=<?php echo $role["id"] ?>><?php echo $role["name"] ?></option>
                                        <?php } ?>
                                    </select>

                                </div>


                                <input class="btn btn-success btn-lg mb-1" type="submit" value="Registreren" name="submit">

                            </form>
                            <p>Al een account? <a href="login.php">log hier in!</a></p>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</html>