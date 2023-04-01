<?php
require 'database.php';


$stmt = $conn->prepare("SELECT users.id, firstname, lastname, email, password, roles.name FROM `users` JOIN roles ON roles.id = role_id");
$stmt->execute();

// set the resulting array to associative
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
$all_users = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">



</head>

<body>
    <?php include "header.php"; ?>
    <?php include "navbar.php"; ?>
    <h1 class="mb-3 " style="color:  #000;">Gebruikers</h1>
    <div class="col-sm">
        <a type="button" class="btn btn-outline-secondary btn-sm" href="registreer.php">Nieuwe gebruiker</a>
    </div>

    <div class="col-sm">
        <table class="table">
            <thead>
                <tr style="color: #000;">
                    <th>Id</th>
                    <th>First name</th>
                    <th>Last name</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Role</th>
                </tr>
            </thead>
            <tbody>


                <?php foreach ($all_users as $user) { ?>
                    <tr style="color: #000;">
                        <td><?php echo $user["id"] ?></td>
                        <td><?php echo $user["firstname"] ?></td>
                        <td><?php echo $user["lastname"] ?></td>
                        <td><?php echo $user["email"] ?></td>
                        <td><?php echo $user["password"] ?></td>
                        <td><?php echo $user["name"] ?></td>
                        <td>
                            <a type="button" class="btn btn-outline-secondary" href="gebruiker_update.php?id=<?php echo $user["id"] ?>">wijzig</a>
                            <a type="button" class="btn btn-outline-secondary" href="gebruiker_delete.php?id=<?php echo $user["id"] ?>" onclick="return confirm('Are you sure?')">Verwijder</a>
                        </td>

                    </tr>
                <?php } ?>


            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <?php include "footer.php"; ?>

</body>

</html>