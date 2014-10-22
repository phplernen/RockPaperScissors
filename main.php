<?php

require_once __DIR__ . '/__init.php';

use RockPaperScissors\Hands\Rock;
use RockPaperScissors\Game;
use RockPaperScissors\ComputerPlayer;

// Init players

$p1 	= new ComputerPlayer( 'Michael' );
$p2 	= new ComputerPlayer( 'Paul' );

// Init game

$game 	= new Game( $p1, $p2, 3 );

// Let's play

$game->play();