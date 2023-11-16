<?php
$invalid = "";

if (isset($_POST['email']) && !empty($_POST['email'])) {

    $email = $_POST['email'];

    // if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    //     $test = "";
    //     $test = "Invalid email format";
    // }

    require 'database.php';

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->bindParam(":email", $email);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (is_array($user) && count($user) > 0) { // user is found
        //test wachtwoord
        if (isset($_POST['password']) && !empty($_POST['password'])) {
            $password = $_POST['password']; //ingevulde wachtwoord

            if ($user["password"] == $password) {

                $_SESSION["gebruikerData"] = $user;

                if ($user['role_id'] == 1) {
                    header("Location: index.php");
                } else {
                    header("Location: index.php");
                }
            }
        }
    } else {
        $invalid = "Invalid user";
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>

<body>
    <!-- <div class="container">
        <form method="post">
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp" placeholder="Enter email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password">
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </div>
    </form>
    <p>Nog geen account? <a href="registreer.php">Maak hier je account!</a><? // $test 
                                                                            ?></p> -->
    <!-- ---------------------------------------------------------------------------------------- -->
    <section class="h-100 h-custom" style="background-color: #8fc4b7;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-8 col-xl-6">
                    <div class="card rounded-3">
                        <IMG src="./images_site/lampionnen.png" class="w-100" style="border-top-left-radius: .3rem; border-top-right-radius: .3rem; height: 225px;" alt="Sample photo"></IMG>
                        <div class="card-body p-4 p-md-5">
                            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5 px-md-2">Log in</h3>
                            <p style="color: red;"><? echo $invalid;   ?></p>

                            <form method="post" action="" class="px-md-2">

                                <div class="form-outline mb-4">
                                    <input type="email" name="email" id="email" required class="form-control" />
                                    <label class="form-label" for="form3Example1q">E-mailadres</label>
                                </div>


                                <div class="form-outline mb-4">
                                    <input type="password" name="password" id="password" required class="form-control" />
                                    <label class="form-label" for="form3Example1q">Wachtwoord</label>
                                </div>


                                <input class="btn btn-success btn-lg mb-1" type="submit" value="login" name="submit">

                            </form>
                            <p>Nog geen account? <a href="registreer.php">Maak hier je account!</a></p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>