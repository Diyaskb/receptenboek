<?php
// Rol 1 = Gebruiker // Rol 2 = Beheerder
require 'database.php';
// Dit is het startpunt van je applicatie.
// echo 'Welkom bij het receptenboek Smaakvol China: Een verzameling van heerlijke recepten';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Smaakvol China </title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <!-- CSS link -->
    <link rel="stylesheet" href="./css/header.css">
</head>

<body>
    <?php include 'header.php' ?>
    <?php include 'navbar.php' ?>


    <main class="container py-3">
        <!-- <h2 class="text-center pb-3">Featured Recipes</h2> -->
        <div class="row">
            <div class="col-md-5">
                <img src="./images_site/china-town.jpg" alt="" class="w-200" style="border-top-left-radius: .3rem; border-top-right-radius: .3rem; height: 250px;">
            </div>
            <div class="col-md-5 col-md-offset-2">
                <h4>Over China</h4>
                <p>China is een land gelegen in Oost-Azië en is het meest bevolkte land ter wereld, met meer dan 1,4 miljard mensen. Het land heeft een rijke geschiedenis die teruggaat tot duizenden jaren geleden en heeft veel invloed op de wereld gehad op het gebied van technologie, kunst en filosofie.</p>
                <p>Het land heeft ook een aantal beroemde bezienswaardigheden, zoals de Grote Muur van China, het Terracottaleger en de Verboden Stad. Kortom, China is een fascinerend land met een rijke geschiedenis, een bloeiende economie en een unieke cultuur.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <img src="./images_site/Chinese-gerechten.jpg" alt="" class="w-300" style="border-top-left-radius: .3rem; border-top-right-radius: .3rem; height: 290px;">
            </div>
            <div class="col-md-5 col-md-offset-2">
                <h4>Chinees eten</h4>
                <p>Chinees eten is wereldwijd bekend om zijn verscheidenheid aan smaken, texturen en aroma's. Het wordt beschouwd als een van de meest diverse en populaire keukens ter wereld, met een geschiedenis die teruggaat tot duizenden jaren geleden.</p>
                <p>Gerechten uit de Chinese keuken zijn vaak gekenmerkt door hun gebruik van verse ingrediënten, zoals groenten, vlees, vis en schaaldieren, en een verscheidenheid aan kruiden en specerijen, zoals knoflook, gember, sojasaus en hoisin saus.</p>
                <p>Traditioneel wordt Chinees eten geserveerd in kleine porties, zodat gasten verschillende gerechten kunnen uitproberen en delen. Bovendien is thee een belangrijk onderdeel van de maaltijd en wordt vaak geserveerd naast de gerechten.</p>
            </div>
        </div>

    </main>

    <?php include 'footer.php' ?>

</body>

</html>