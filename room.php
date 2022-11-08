<?php
include("./database/database_inc.php");
$room_id = filter_input(INPUT_GET, "roomId", FILTER_VALIDATE_INT);
if($room_id === false) {
    throw404();
}
else if ($room_id === NULL) {
    throw400();
}
$room = getRoom($room_id);
if($room === NULL) {
    (include "404.php");
    throw404();
}

if($room->phone === NULL) $room->phone = "---";
if($room->wage === NULL) $room->wage = "---";
?>

<!doctype html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <title>Karta místnostni <?=$room->no?></title>
</head>
<body class="container">
<h1>Karta místnosti <i><?=$room->no?></i></h1>
<dl class='dl-horizontal'>
    <dt>Číslo</dt><dd><?=$room->no?></dd>
    <dt>Název</dt><dd><?=$room->room_name?></dd>
    <dt>Telefon</dt><dd><?=$room->phone?></dd>
    <dt>Lidé</dt>
    <?php
        if(count($room->people) == 0) {
            echo "<dd>---</dd>";
        }
        else {
            foreach($room->people as $employee) {
                echo "<dd><a href='employee.php?employeeId=$employee->employee_id'>$employee->name</a></dd>";
            }
        }
    ?>
    <dt>Průměrná mzda</dt><dd><?=$room->wage?></dd>
    <dt>Klíče</dt>
    <?php
    if(count($room->keys) == 0) {
        echo "<dd>---</dd>";
    }
    else {
        foreach($room->keys as $employee) {
            echo "<dd><a href='employee.php?employeeId=$employee->employee_id'>$employee->name</a></dd>";
        }
    }
    ?>
</dl>

<a href='room_list.php'><span class='glyphicon glyphicon-arrow-left' aria-hidden='true'></span> Zpět na seznam místností</a>
</body>
</html>