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
        echo "\n";
        $this->minimax($post['boardState'], $post['aiTurn']);
	}

    public function minimax($boardState, $aiTurn) {
        /* Implementation of minimax (The right implementation???) */

		/*
         * Build board tree
         * Go over every possible move the human/computer can make
         * and save this data in the boardTree variable.
         *
         */

		$aiMove = [];

		$boardTree = $this->buildBoardTree($boardState, $aiTurn);
		$terminatingNode = $this->findTerminatingNode($boardTree);
		
		if (!empty($terminatingNode)) {
			$aiMove = $terminatingNode;
		} else {
			$aiMove = $this->returnMoveLayer2($boardTree);
		}

		$this->dumpBoardState($aiMove);
    }

	public function buildBoardTree($boardState, $aiTurn) {
		$turn = $aiTurn ? 2 : 1;
		$boardTree = [];


		for ($ii = 0; $ii < count($boardState); $ii++) {
			if ($boardState[$ii] == 0) {
				$memorizeState = $boardState;

				$boardState[$ii] = 2;
				$boardTree[0][] = $boardState;

				if ($memorizeState[$ii] == 0) {
					$boardState[$ii] = 0;
				} else if ($memorizeState[$ii] == 1) {
					$boardState[$ii] = 1;
				}
			}
		}


		foreach ($boardTree[0] as $state) {
			for ($hh = 0; $hh < count($state); $hh++) {
				if ($state[$hh] == 0) {
					$memorizeState = $state;

					$state[$hh] = 1;
					$boardTree[1][] = $state;

					if ($memorizeState[$hh] == 0) {
						$state[$hh] = 0;
					} else if ($memorizeState[$hh] == 1) {
						$state[$hh] = 1;
					}
				}
			}
		}

		return $boardTree;
	}

	public function findTerminatingNode($boardTree) {
		foreach ($boardTree as $tree) {
			foreach ($tree as $state) {
				for ($ii = 0; $ii < count($state); $ii++) {
					$terminatingNode = $this->mapStateOnTerminatingOptions($state);

					if (!empty($terminatingNode)) {
						return $terminatingNode;
					}
 				}
			}
		}

		return null;
	}

	public function mapStateOnTerminatingOptions($state) {
		$winOption = [];
		$loseOption = [];

		for ($ii = 0; $ii < count($state); $ii++) {
			if ($state[$ii] == 1) {
				$winOption[$ii] = 0;
			} else {
				$winOption[$ii] = $state[$ii];
			}
		}

		foreach ($this->aiWinOptions as $option) {
			if ($winOption == $option) {
				return $winOption;
			}
		}

		for ($ii = 0; $ii < count($state); $ii++) {
			if ($state[$ii] == 2) {
				$loseOption[$ii] = 0;
			} else {
				$loseOption[$ii] = $state[$ii];
			}
		}

		foreach ($this->playerWinOptions as $option) {
			if ($loseOption == $option) {
				return $loseOption;
			}
		}

		return null;
	}

	public function returnMoveLayer2($boardTree) {
		$index = array_rand($boardTree[0]);
		return $boardTree[0][$index];
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
        echo "\n";

		foreach ($post['boardState'] as $state) {
			echo $state;
		}

		echo "\n";
	}

	public function dumpBoardState ($state) {
		foreach($state as $num) {
			echo $num;
		}

		echo "\n";
	}
}