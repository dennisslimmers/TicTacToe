<?php

class ajax {
    public function __construct() {}

    public function pushBoardState() {
        $boardState = json_decode($_POST["boardState"]);

        var_dump($boardState);
    }
}