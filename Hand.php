<?php

namespace RockPaperScissors;

abstract class Hand
{	
	abstract public function getName();
	
	/**
	 * Get all hand rules for the game
	 *
	 * @return Array of strings ($hand => $rule)
	 */
	
	public static function getHandRules()
	{
		return array(
			'Rock' 		=> 'Scissor',
			'Paper' 	=> 'Rock',
			'Scissor' 	=> 'Paper',
		);
	}
	
	/**
	 * Get all hands
	 *
	 * @return Array of all hands defined in getHandRules() as objects of type Hand
	 */
	
	public static function getHands()
	{
		$hands = array();
		
		foreach( self::getHandRules() as $hand => $rule )
		{
			$className = __NAMESPACE__ . '\\' . $hand;
			$hands[] = new $className;
		}
		
		return $hands;
	}
}