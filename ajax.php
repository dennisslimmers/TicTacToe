<?php

class ajax {
	private $aiWinOptions = [];
	private $playerWinOptions = [];
	
	public function __construct($post) {
		$this->aiWinOptions[0] = [1, 1, 1, 0, 0, 0, 0, 0, 0];
		$this->aiWinOptions[1] = [0, 0, 0, 1, 1, 1, 0, 0, 0];
		$this->aiWinOptions[2] = [0, 0, 0, 0, 0, 0, 1, 1, 1];
		$this->aiWinOptions[3] = [1, 0, 0, 0, 1, 0, 0, 0, 1];
		$this->aiWinOptions[4] = [0, 0, 1, 0, 1, 0, 1, 0, 0];
		$this->aiWinOptions[5] = [1, 0, 0, 1, 0, 0, 1, 0, 0];
		$this->aiWinOptions[6] = [0, 1, 0, 0, 1, 0, 0, 1, 0];
		$this->aiWinOptions[7] = [0, 0, 1, 0, 0, 1, 0, 0, 1];
		
		$this->playerWinOptions[0] = [2, 2, 2, 0, 0, 0, 0, 0, 0];
		$this->playerWinOptions[1] = [0, 0, 0, 2, 2, 2, 0, 0, 0];
		$this->playerWinOptions[2] = [0, 0, 0, 0, 0, 0, 2, 2, 2];
		$this->playerWinOptions[3] = [2, 0, 0, 0, 2, 0, 0, 0, 2];
		$this->playerWinOptions[4] = [0, 0, 2, 0, 2, 0, 2, 0, 0];
		$this->playerWinOptions[5] = [2, 0, 0, 2, 0, 0, 2, 0, 0];
		$this->playerWinOptions[6] = [0, 2, 0, 0, 2, 0, 0, 2, 0];
		$this->playerWinOptions[7] = [0, 0, 2, 0, 0, 2, 0, 0, 2];
		
		$this->pushBoardState($post);
	}
	
	public function pushBoardState($post) {
		/*
		 * TODO: Determine whose turn it is, can also be done in index.php
		 * This you can simply do with a bool in javascript. done?
		 * 
		 * TODO: Implement Minimax algorithm obviously
		 * TODO: Find a way to send data from PHP back to Javascript (AJAX???)
		 * This already happens on ajax call.
		 * The data you get back is "data":
			success: function (data) {
	            console.log(data);
	        }
			
			Now this can be used to store in a var like:
			success: function (data) {
	            var backData = data;
	        }
		*/
		
		echo $this->checkWinState($post['id']);
		/* echo "\n"; means new line in console log javascript*/
		echo "\n";
		
		$this->debugBoardState($post);
	}
	
	public function checkWinState($post) {
		/*
        * Check all options for ai, player win or draw.
		* Ai win: 1
		* Player win: 2
		* Draw: 3
		* No win or draw: 0
        */
		
		/* Check all win options for ai. */
		$nummer = "";
		foreach ($this->aiWinOptions as $state) {
			for ($ii = 0; $ii < count($state); $ii++) {
				if ($state[$ii] == 1 && $post[$ii] == 1) {
					$nummer .= $state[$ii];
					if (strlen($nummer) == 3) {
						return 1;
					}
				}
			}
			$nummer = "";
		}
		
		/* Check all win options for player. */
		$nummer = "";
		foreach ($this->playerWinOptions as $state) {
			for ($iii = 0; $iii < count($state); $iii++) {
				if ($state[$iii] == 2 && $post[$iii] == 2) {
					$nummer .= $state[$iii];
					//					echo "Number: " . $nummer . "\n";
					if (strlen($nummer) == 3) {
						return 2;
					}
				}
			}
			$nummer = "";
		}
		
		/* Check for draw. */
		foreach ($post as $id) {
			if ($id == 0) {
				return 0;
				break;
			}
		}
		
		return 3;
	}
	
	public function debugBoardState($post) {
		/*
        * echo boardState in console log
        */
		foreach ($post['id'] as $id) {
			echo $id;
		}
		echo "\n";
	}
}