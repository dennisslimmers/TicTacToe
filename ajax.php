<?php

class ajax {
    public function __construct($post) {
	    $this->pushBoardState($post);
    }

    public function pushBoardState($post) {
        var_dump($post);
    }
}