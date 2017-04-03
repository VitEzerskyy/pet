<?php
require_once "autoload.php";
session_start();

$_SESSION['player1'] =  new Player();
$_SESSION['player2'] =  new Player();
$_SESSION['player3'] =  new Player();
$_SESSION['player4'] =  new Player();

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userdata = array_map('htmlentities', $_POST);

    $i = 1;
    foreach ($userdata as $name) {
        $_SESSION['player'.$i]->setName($name);
        $i++;
    }

    foreach ($userdata as $value) {
        if ($value == false) {
            header("Location: /PHP/bowling/index.php?errors=1");
            break;
        }

        if (!isset($_GET['errors'])) {
            header("Location: /PHP/bowling/game.php");
        }

        //file_put_contents("names.txt", serialize($userdata));
    }

}
?>

<html>
<head>
    <title>Names</title>
    <meta charset="utf-8">
    <link href="style.css" rel="stylesheet">
</head>
<body>
<?php if( isset ($_GET['errors']) && $_GET['errors'] == 1):?>
    <script>alert('error');</script>
    <div style="color: #d9534f;"><h4>Заполните все поля!</h4></div>

<?php endif; ?>
<div>
<form action="index.php" method="GET" enctype="multipart/form-data">
    <label for="fnumber">Выберите количество участников в игре</label>
    <select id="fnumber" name="fnumber" required>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
    </select>
    <br/>
    <input type="submit" value="Готово" />
</form>
</div>

<div>
    <form method="POST" action="index.php" enctype="multipart/form-data">
        <?php

        if (isset($_GET['fnumber'])) {
            $_SESSION["num_of_players"] = $_GET['fnumber'];
        }
        for ($i = 1; $i <= $_SESSION["num_of_players"]; $i++):?>
            <label for="player<?=$i?>">Введите имя <?=$i?>го игрока</label>
            <input type="text" name="player<?=$i?>" id="player<?=$i?>">
        <?php endfor; ?>
        <input type="submit" value="Готово">
    </form>
</div>

</body>
</html>