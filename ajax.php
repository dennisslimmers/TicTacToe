<?php

class ajax {
    public function __construct($post) {
	    $this->pushBoardState($post);

        /*
         * TODO: create A.I win options (Same as in script.js)
         */
    }

    public function pushBoardState($post) {
        /*
         * TODO: Determine whose turn it is, can also be done in index.php
         * TODO: Implement Minimax algorithm obviously
         * TODO: Find a way to send data from PHP back to Javascript (AJAX???)
         */

        var_dump($post['id']);
    }
}