<?php

class ajax {
    private $aiWinOptions = [];

    public function __construct($post) {
        /*
         * Diagonal
         */
        $this->aiWinOptions[0] = [1, 1, 1, 0, 0, 0, 0, 0, 0];
        $this->aiWinOptions[1] = [0, 0, 0, 1, 1, 1, 0, 0, 0];
        $this->aiWinOptions[2] = [0, 0, 0, 0, 0, 0, 1, 1, 1];

        /*
         * Oblique
         */
        $this->aiWinOptions[3] = [1, 0, 0, 0, 1, 0, 0, 0, 1];
        $this->aiWinOptions[4] = [0, 0, 1, 0, 1, 0, 1, 0, 0];

        /*
         * Vertical
         */
        $this->aiWinOptions[5] = [1, 0, 0, 1, 0, 0, 1, 0, 0];
        $this->aiWinOptions[6] = [0, 1, 0, 0, 1, 0, 0, 1, 0];
        $this->aiWinOptions[7] = [0, 0, 1, 0, 0, 1, 0, 0, 1];

	    $this->pushBoardState($post);
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