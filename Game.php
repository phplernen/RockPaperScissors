<?php

namespace RockPaperScissors;

class Game
{
	private $rules;
	private $rounds;
	private $avoidDraw;
	
	private $player1;
	private $player2;

	public function __construct( Player $player1, Player $player2, $rounds = 3, $avoidDraw = true )
	{
		$this->player1 		= $player1;
		$this->player2		= $player2;
		$this->rounds 	 	= $rounds;
		$this->avoidDraw 	= $avoidDraw; 
		
		$this->rules		= Hand::getHandRules();
	}
	
	public function play()
	{
		while( $this->nextRound() )
		{
			$this->player1->chooseHand();
			$this->player2->chooseHand();

			echo "{$this->player1->getHand()->getName()} gegen {$this->player2->getHand()->getName()} ..." . PHP_EOL;

			if ( $roundWinner = $this->getRoundWinningPlayer() )
			{
				$roundWinner->increaseScore();
				
				echo "... {$roundWinner->getName()} gewinnt mit {$roundWinner->getHand()->getName()} diese Runde." . PHP_EOL;
			}
			else
			{
				echo '... Untentschieden.' . PHP_EOL;
			}
		}

		echo PHP_EOL . 'Auswertung:' . PHP_EOL . PHP_EOL;

		echo "Spielstand {$this->player1->getName()}: {$this->player1->getScore()}" . PHP_EOL;
		echo "Spielstand {$this->player2->getName()}: {$this->player2->getScore()}" . PHP_EOL;

		echo PHP_EOL;

		if( !is_null( $gameWinner = $this->getGameWinner() ) )
		{
			echo "Gewinner: {$gameWinner->getName()}";
		}
		else
		{
			echo 'Unentschieden';
		}
		
	}
	
	private function nextRound()
	{
		$this->rounds -= 1;
		
		if ( $this->rounds >= 0 )
		{	
			return true;
		}
		else
		{
			if ( $this->avoidDraw && $this->player1->getScore() === $this->player2->getScore() )
			{
				return true;
			}
		}
		
		return false;
	}
	
	private function getRoundWinningPlayer()
	{
		$hand = $this->getRoundWinningHand( $this->player1->getHand(), $this->player2->getHand() );
		
		if ( $this->player1->getHand() == $this->player2->getHand() )
		{
			return null;
		}
		
		if ( $this->player1->getHand() === $hand )
		{
			return $this->player1;
		}
		
		else
		{
			return $this->player2;
		}
	}
	
    private function getRoundWinningHand( Hand $hand1, Hand $hand2 )
	{
		return $this->rules[end(explode('\\', get_class($hand1)))] === end(explode('\\', get_class($hand2))) ?
			$hand1 : $hand2;
	}
	
	private function getGameWinner()
	{
		if ( $this->player1->getScore() === $this->player2->getScore() )
		{
			return null;
		}
		else if ( $this->player1->getScore() > $this->player2->getScore() )
		{
			return $this->player1;
		}
		else
		{
			return $this->player2;
		}
	}
}