<?php


require "database.php";



if (isset($_POST['submit'])) {

    $userId = $_POST['id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];


    $stmt = $conn->prepare("UPDATE users SET firstname = :firstname, lastname = :lastname, email = :email, password = :password, role_id = :role_id WHERE id = :id");
    $stmt->bindParam(':id', $userId);
    $stmt->bindParam(':firstname', $firstname);
    $stmt->bindParam(':lastname', $lastname);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':role_id', $role);

    $stmt->execute();

}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE id = $id");
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $allUsers = $stmt->fetch();
}

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
<title>Recept</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

<head>
    <title>Gebruiker edit</title>
</head>

<body>
    <!-- <h2>Gebruiker registreren</h2>
    <form method="post" action="">
        <label for="title">voornaam:</label>
        <input type="text" name="title" id="title" required><br><br>

        <label for="picture">achternaam:</label>
        <input type="text" name="picture" id="picture" required><br><br>

        <label for="duration">E-mailadres:</label>
        <input type="duration" name="duration" id="duration" required><br><br>

        <label for="dish">Wachtwoord:</label>
        <input type="dish" name="dish" id="dish" required><br><br>

        <label for="difficulty">Rol:</label>
        <select name="difficulty" id="">
       
        </select>

        <br>
        <br>

        <input type="submit" value="Registreren" name="submit">
    </form>

    <p>al een account? <a href="login.php">log hier in!</a></p>
</body> -->

    <!-- --------------------------------------------------------------- -->
    <!-- ---------------------------------------------------------------------------------------- -->
    <section class="h-100 h-custom" style="background-color: #8fc4b7;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-8 col-xl-6">
                    <div class="card rounded-3">
                        <!-- IMAGE WERKEND MAKEN -->
                        <IMG src="./images_site/lampionnen.png" class="w-100" style="border-top-left-radius: .3rem; border-top-right-radius: .3rem; height: 225px;" alt="Sample photo"></IMG>
                        <div class="card-body p-4 p-md-5">
                            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5 px-md-2"> Update gebruiker</h3>

                            <form method="post" action="" class="px-md-2">

                                <input type="hidden" name="id" id="id" value="<?php echo $allUsers['id']; ?>">

                                <div class="row">
                                    <div class="col-md-6 mb-4">

                                        <div class="form-outline datepicker">
                                            <input type="text" name="firstname" id="firstname" required class="form-control" value="<?php echo $allUsers['firstname']; ?>" />
                                            <label for="exampleDatepicker1" class="form-label">Voornaam</label>
                                        </div>

                                    </div>
                                    <div class="col-md-6 mb-4">

                                        <div class="form-outline datepicker">
                                            <input type="text" name="lastname" id="lastname" required class="form-control" value="<?php echo $allUsers['lastname']; ?>" />
                                            <label for="exampleDatepicker1" class="form-label">Achternaam</label>
                                        </div>

                                    </div>
                                </div>

                                <div class="form-outline mb-4">
                                    <input type="email" name="email" id="email" required class="form-control" value="<?php echo $allUsers['email']; ?>" />
                                    <label class="form-label" for="form3Example1q">E-mailadres</label>
                                </div>


                                <div class="form-outline mb-4">
                                    <input type="password" name="password" id="password" required class="form-control" value="<?php echo $allUsers['password']; ?>" />
                                    <label class="form-label" for="form3Example1q">Wachtwoord</label>
                                </div>

                                <div class="mb-4">

                                    <select name="role" id="" value="<?php echo $allUsers['role_id']; ?>">
                                        <?php foreach ($allRoles as $role) { ?>
                                            <option value=<?php echo $role["id"] ?>><?php echo $role["name"] ?></option>
                                        <?php } ?>
                                    </select>

                                </div>


                                <input class="btn btn-success btn-lg mb-1" type="submit" value="Save" name="submit">

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>