<!doctype html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Seznam místností</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body class="container">
<h1>Seznam místností</h1>
<table class="table">
    <?php
    include("./database/database_inc.php");

    if( isset($_GET["poradi"]))
        $sort_key = $_GET["poradi"];
    else
        $sort_key = "";
    $table_head = "<tr><th>Název<a href='?poradi=nazev_up'><span class='glyphicon glyphicon-arrow-down' aria-hidden='true'></span></a><a href='?poradi=nazev_down'><span class='glyphicon glyphicon-arrow-up' aria-hidden='true'></span></a></th><th>Číslo<a href='?poradi=cislo_up'><span class='glyphicon glyphicon-arrow-down' aria-hidden='true'></span></a><a href='?poradi=cislo_down'><span class='glyphicon glyphicon-arrow-up' aria-hidden='true'></span></a></th><th>Telefon<a href='?poradi=telefon_up'><span class='glyphicon glyphicon-arrow-down' aria-hidden='true'></span></a><a href='?poradi=telefon_down'><span class='glyphicon glyphicon-arrow-up' aria-hidden='true'></span></a></th></tr>";
    if($sort_key != "")
        $table_head = str_replace($sort_key . "'", $sort_key . "' class='sorted'", $table_head);
    echo $table_head;


    $order_value = NULL;
    $order_direction = NULL;

    $sort = explode("_", $sort_key);
    if (count($sort) == 2 ) {
        $sort_value = $sort[0];
        $sort_direction = $sort[1];

        switch ($sort_value) {
            case "nazev":
                $order_value = "name";
                break;
            case "telefon":
                $order_value = "phone";
                break;
            case "cislo":
                $order_value = "no";
                break;
        }

        switch ($sort_direction) {
            case "up":
                $order_direction = "asc";
                break;
            case "down":
                $order_direction = "desc";
                break;
        }
    }

    if($order_direction != NULL && $order_value != NULL) {
        $order_string = "ORDER BY " . $order_value . " " . $order_direction;
    }
    else $order_string = "";

    $room_list = getRooms($order_string);
    foreach($room_list as $room) {
        $row = "<tr>
                        <td><a href='room.php?roomId={$room->room_id}'>{$room->name}</a></td>
                        <td>$room->no</td>
                        <td>$room->phone</td>
                    </tr>";
        echo $row;
    }
    ?>
</table>
</body>
</html>
