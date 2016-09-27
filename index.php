<?php

session_start();

?>

<!DOCTYPE html>
    <html lang="nl">
    <head>
        <title>TicTacToe</title>
        <script type="text/javascript" src="assets/scripts/jquery-3.1.0.min.js"></script>
        <link href="assets/css/style.css" rel="stylesheet">
    </head>
    <body>
        <h1>TicTacToe!</h1>
        <button id="1" onclick="pushBoardState(1, event);">-</button>
        <button id="2" onclick="pushBoardState(2, event);">-</button>
        <button id="3" onclick="pushBoardState(3, event);">-</button>
        <br>
        <button id="4" onclick="pushBoardState(4, event);">-</button>
        <button id="5" onclick="pushBoardState(5, event);">-</button>
        <button id="6" onclick="pushBoardState(6, event);">-</button>
        <br>
        <button id="7" onclick="pushBoardState(7, event);">-</button>
        <button id="8" onclick="pushBoardState(8, event);">-</button>
        <button id="9" onclick="pushBoardState(9, event);">-</button>

        <form action="destroy.php">
            <input type="submit" value="destroy sessions">
        </form>
    </body>
    <script type="text/javascript" src="assets/scripts/script.js"></script>
</html>
