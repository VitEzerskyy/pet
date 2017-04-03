<?php
require_once "autoload.php";
session_start();

function previousSpare () {
global $count;
    if ( isset($_SESSION['player'.$count]->container[count($_SESSION['player'.$count]->container)-1])
        && ($_SESSION['player'.$count]->container[count($_SESSION['player'.$count]->container)-1] instanceof Spare)) {
        $_SESSION['player'.$count]->container[count($_SESSION['player'.$count]->container)-1]->bonus  = $_SESSION["array_score"][0];
        $_SESSION['player'.$count]->container[count($_SESSION['player'.$count]->container)-1]->total();
    }
}

function previousStrike () {
global $count;
    if ( isset($_SESSION['player'.$count]->container[count($_SESSION['player'.$count]->container)-1])
        && ($_SESSION['player'.$count]->container[count($_SESSION['player'.$count]->container)-1] instanceof Strike)) {
        if ($_SESSION["array_score"][0] == 10) {
            $_SESSION['player'.$count]->container[count($_SESSION['player'.$count]->container) - 1]->firstBonus = $_SESSION["array_score"][0];
        } else {
            $_SESSION['player'.$count]->container[count($_SESSION['player'.$count]->container) - 1]->firstBonus = $_SESSION["array_score"][0];
            $_SESSION['player'.$count]->container[count($_SESSION['player'.$count]->container) - 1]->secondBonus = $_SESSION["array_score"][1];
            $_SESSION['player'.$count]->container[count($_SESSION['player'.$count]->container)-1]->total();
        }
    }

    if ( isset ($_SESSION['player'.$count]->container[count($_SESSION['player'.$count]->container)-2])
        && $_SESSION['player'.$count]->container[count($_SESSION['player'.$count]->container)-2] instanceof Strike
        && $_SESSION['player'.$count]->container[count($_SESSION['player'.$count]->container)-1] instanceof Strike) {
        $_SESSION['player'.$count]->container[count($_SESSION['player'.$count]->container) - 2]->secondBonus = $_SESSION["array_score"][0];
        $_SESSION['player'.$count]->container[count($_SESSION['player'.$count]->container) - 2]->total();
    }
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    //определяем границы фрейма
    if (count($_SESSION["array_score"]) == 2 || (isset($_SESSION["array_score"][0]) && $_SESSION["array_score"][0] == 10)) {
        $_SESSION["array_score"] = [];
        $_SESSION["array_score"][] = $_POST["froll_first"];
    } else {
        $_SESSION["array_score"][] = $_POST["froll_first"];
    }

    print_r($_SESSION['array_score']);

    //определяем тип фрейма
    switch (true) {
        case (isset($_SESSION["array_score"][0]) && $_SESSION["array_score"][0] == 10):
            $strike = new Strike();
            $strike->setRoll($_SESSION["array_score"][0],0);
            $strike->total();
            break;
        case (count($_SESSION["array_score"]) == 2 && array_sum($_SESSION["array_score"]) == 10):
            $spare = new Spare();
            $spare->setRoll($_SESSION["array_score"][0],$_SESSION["array_score"][1]);
            $spare->total();
            break;
        case (count($_SESSION["array_score"]) == 2 && array_sum($_SESSION["array_score"]) < 10):
            $openframe = new OpenFrame();
            $openframe->setRoll($_SESSION["array_score"][0],$_SESSION["array_score"][1]);
            $openframe->total();
            break;
    }

    //устанавливаем счетчик и пишем обьекты фреймов в контейнеры.

    if (count($_SESSION["array_score"]) == 2 || $_SESSION["array_score"][0] == 10){

        $count = isset($_SESSION["counter"]) ? $_SESSION["counter"] : 0;
        $count++;
        $_SESSION["counter"] = $count;

        if ( $count > $_SESSION["num_of_players"]) {
            $_SESSION["counter"] = 1;
            $count = 1;
        }

        previousSpare();
        previousStrike();

        $_SESSION['player'.$count]->state = 1;
            if (isset($strike)){
                $_SESSION['player'.$count]->setFrame($strike);
            }
            if (isset($spare)){
                $_SESSION['player'.$count]->setFrame($spare);
            }
            if (isset($openframe)){
                $_SESSION['player'.$count]->setFrame($openframe);
            }
        $_SESSION['player'.$count]->state = 0;

    }


}  ?>
<html>
<head>
<title>Game</title>
<meta charset="utf-8">
<link href="style.css" rel="stylesheet">
</head>
<body>

<div class="div_game">
    <span class="label">Начинаем игру! Бросайте шар</span>
    <img src="bowl02.png">
<?php if (!isset($_SESSION["array_score"][0]) || $_SESSION["array_score"][0] == 10):?>
<form action="game.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="froll_first" value="<?=rand(0,10)?>">
    <input type="submit" value="Поехали!" />
</form>
<?php else:?>
    <form action="game.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="froll_first" value="<?=rand(0,10-$_SESSION["array_score"][0])?>">
        <input type="submit" value="Поехали!" />
    </form>
    <?php endif;?>
</div>

<?php
echo "<pre>";
for ($i = 1; $i <=$_SESSION['num_of_players']; $i ++) {
    print_r($_SESSION['player'.$i]);
}
echo "</pre>";
?>
<div style="margin: 0 auto; width: 30%;"><a href="retry.php"><p class="label">Начать игру сначала</p></a></div>

</body>
</html>