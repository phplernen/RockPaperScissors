<?php

namespace RockPaperScissors;

interface Player
{	
	public function getName();
	public function chooseHand();
	public function getHand();
	public function increaseScore();
	public function getScore();
}