<?php
session_start();
$_SESSION["array_score"] = [];
unset($_SESSION["counter"]);
header("Location: /PHP/bowling/index.php");
?>