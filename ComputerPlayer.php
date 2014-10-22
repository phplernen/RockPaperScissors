<?php

namespace RockPaperScissors;

class ComputerPlayer implements Player
{
	private $name;
	private $hand;
	private $score;
	
	public function __construct( $name )
	{
		$this->name 	= $name;
		$this->score 	= 0;
	}
	
	public function getName()
	{
		return $this->name;
	}
	
	public function chooseHand()
	{
		$hands = Hand::getHands();
		
		$this->hand = $hands[ array_rand( $hands, 1 ) ];
	}
	
	public function getHand()
	{
		return $this->hand;
	}
	
	public function increaseScore()
	{
		$this->score += 1;
	}
	
	public function getScore()
	{
		return $this->score;
	}
}