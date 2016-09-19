<?php

class ajax {
	private $aiWinOptions = [];
	private $playerWinOptions = [];
	
	public function __construct($post) {
		$this->aiWinOptions[0] = [2, 2, 2, 0, 0, 0, 0, 0, 0];
		$this->aiWinOptions[1] = [0, 0, 0, 2, 2, 2, 0, 0, 0];
		$this->aiWinOptions[2] = [0, 0, 0, 0, 0, 0, 2, 2, 2];
		$this->aiWinOptions[3] = [2, 0, 0, 0, 2, 0, 0, 0, 2];
		$this->aiWinOptions[4] = [0, 0, 2, 0, 2, 0, 2, 0, 0];
		$this->aiWinOptions[5] = [2, 0, 0, 2, 0, 0, 2, 0, 0];
		$this->aiWinOptions[6] = [0, 2, 0, 0, 2, 0, 0, 2, 0];
		$this->aiWinOptions[7] = [0, 0, 2, 0, 0, 2, 0, 0, 2];
		
		$this->playerWinOptions[0] = [1, 1, 1, 0, 0, 0, 0, 0, 0];
		$this->playerWinOptions[1] = [0, 0, 0, 1, 1, 1, 0, 0, 0];
		$this->playerWinOptions[2] = [0, 0, 0, 0, 0, 0, 1, 1, 1];
		$this->playerWinOptions[3] = [1, 0, 0, 0, 1, 0, 0, 0, 1];
		$this->playerWinOptions[4] = [0, 0, 1, 0, 1, 0, 1, 0, 0];
		$this->playerWinOptions[5] = [1, 0, 0, 1, 0, 0, 1, 0, 0];
		$this->playerWinOptions[6] = [0, 1, 0, 0, 1, 0, 0, 1, 0];
		$this->playerWinOptions[7] = [0, 0, 1, 0, 0, 1, 0, 0, 1];
		
		$this->pushBoardState($post);
	}
	
	public function pushBoardState($post) {
		/*
		 * TODO: Determine whose turn it is, can also be done in index.php
		 * This you can simply do with a bool in javascript. done?
		 * TODO: We also need a PHP variant
		 * 
		 * TODO: Implement Minimax algorithm obviously
		 *
		 */

//
//		echo $this->checkWinState($post['boardState']);
//		echo "\n";
//
//		$this->debugBoardState($post);
        echo "\n";
        $this->minimax($post['boardState'], 4 ,$post['aiTurn']);
	}

    public function minimax($boardState, $depth, $aiTurn) {
        /* Implementation of minimax (The right implementation???) */

        /*
         * Build board tree
         * Go over every possible move the human/computer can make
         * and save this data in the boardTree variable.
         *
         */

        $boardTree = [];
        $turn = $aiTurn ? 2 : 1;

        $this->debugBoardState($_POST);
        echo "\n";

        for ($ii = 0; $ii < count($boardState); $ii++) {
            if ($boardState[$ii] != 1 && $boardState[$ii] != 2) {
                $memorizeState = $boardState;

                $boardState[$ii] = 2;
                $boardTree[$ii] = $boardState;

                if ($memorizeState[$ii] == 0) {
                    $boardState[$ii] = 0;
                } else if ($memorizeState[$ii] == 1) {
                    $boardState[$ii] = 1;
                }
            }
        }

        foreach ($boardTree as $tree) {
            foreach ($tree as $state) {
                echo $state;
            }

            echo "\n";
        }
    }
	
	public function checkWinState($post) {
		/*
        * Check all options for ai, player win or draw.
		* Ai win: 2
		* Player win: 1
		* Draw: 3
		* No win or draw: 0
        */
		
		/* Check all win options for ai. */
		$nummer = "";
		foreach ($this->aiWinOptions as $state) {
			for ($ii = 0; $ii < count($state); $ii++) {
				if ($state[$ii] == 2 && $post[$ii] == 2) {
					$nummer .= $state[$ii];
					if (strlen($nummer) == 3) {
						return 2;
					}
				}
			}

			$nummer = "";
		}
		
		/* Check all win options for player. */
		$nummer = "";
		foreach ($this->playerWinOptions as $state) {
			for ($nn = 0; $nn < count($state); $nn++) {
				if ($state[$nn] == 1 && $post[$nn] == 1) {
					$nummer .= $state[$nn];
					if (strlen($nummer) == 3) {
						return 1;
					}
				}
			}

			$nummer = "";
		}
		
		/* Check for draw. */
		/* TODO: It says check for draw but wasn't the value of 'draw' 3?*/
		foreach ($post as $id) {
			if ($id == 0) {
				return 0;
				break;
			}
		}
		
		return 3;
	}
	
	public function debugBoardState($post) {
		/* echo boardState in console log */
        echo "A.I turn?: " . $post['aiTurn'];
        echo "\n";

		foreach ($post['boardState'] as $state) {
			echo $state;
		}

		echo "\n";
	}
}