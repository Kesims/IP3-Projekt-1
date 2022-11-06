<?php
    include("./database/database_inc.php");
    include("404.php");
    $employee_id = filter_input(INPUT_GET, "employeeId", FILTER_VALIDATE_INT);
    if($employee_id === NULL || $employee_id === false) {
        throw404();
    }
    $employee = getEmployee($employee_id);
    if($employee === NULL) {
        throw404();
    }
    $short_name = $employee->surname . " " . mb_str_split($employee->first_name)[0] . ".";
?>

<!doctype html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <title>Karta osoby <?=$short_name?></title>
</head>
<body class="container">
    <h1>Karta osoby <i><?=$short_name?></i></h1>
    <dl class='dl-horizontal'>
        <dt>Jméno</dt><dd><?=$employee->first_name?></dd>
        <dt>Příjmení</dt><dd><?=$employee->surname?></dd>
        <dt>Pozice</dt><dd><?=$employee->job?></dd>
        <dt>Mzda</dt><dd><?=$employee->wage?></dd>
        <dt>Místnost</dt><dd><a href="room.php?roomId=<?=$employee->room_id?>"><?=$employee->room_name?></a></dd>
        <dt>Klíče</dt>
        <?php
            foreach($employee->keys as $key) {
                echo "<dd><a href='room.php?roomId={$key->room_id}'>{$key->name}</a></dd>";
            }
        ?>
    </dl>

    <a href='employee_list.php'><span class='glyphicon glyphicon-arrow-left' aria-hidden='true'></span> Zpět na seznam zaměstnanců</a>
</body>
</html>