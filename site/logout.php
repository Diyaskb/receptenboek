<?php

require 'database.php';

if (isset($_SESSION['gebruikerData'])) {
    session_destroy();
    echo "<script>alert('logout!'); window.location.href = 'login.php';</script>";
} else {
    session_destroy();
    echo "<script>alert('al uitgelogd!'); window.location.href = 'login.php';</script>";
}
