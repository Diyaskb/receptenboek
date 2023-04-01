<?php
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>navbar</title>
    <link rel="stylesheet" href="./css/header.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>


<body>
    <nav class="navbar navbar-expand-md navbar-dark " style="background-color: #8fc4b7 ;">
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="navbar">
                <ul class="navbar-nav mr-auto ">
                    <li class="nav-item ">
                        <a class="nav-link " href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="recepten.php">Recepten</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="recept_add.php">Add Recipes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="specials.php">Specials</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="ingredienten.php">Ingrediënten</a>
                    </li>
                    <?php if (($_SESSION['gebruikerData']['role_id']) == 2) { ?>
                        <li class="nav-item"><a class="nav-link" href="beheer_gebruikers.php">Beheer gebruikers</a></li>
                        <li class="nav-item"><a class="nav-link" href="beheer_recepten.php">Beheer recepten</a></li>

                    <?php } else { ?>
                        <li hidden class="nav-item"><a class="nav-link" href="beheer_gebruikers.php">Beheer gebruikers</a></li>
                        <li hidden class="nav-item"><a class="nav-link" href="beheer_recepten.php">Beheer recepten</a></li>
                    <?php } ?>
                    <?php if (isset($_SESSION["gebruikerData"])) { ?>
                        <li class="nav-item"><a class="nav-link" href="logout.php">Log uit</a></li>
                    <?php } else { ?>
                        <li class="nav-item"><a class="nav-link" href="login.php">Log in</a></li>
                        <li class="nav-item"><a class="nav-link" href="registreer.php">Registreer</a></li>
                    <?php } ?>

                </ul>
            </div>
        </div>
    </nav>
</body>

</html>