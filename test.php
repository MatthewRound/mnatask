<?php


spl_autoload_register(function ($class) {
	$newClass = str_replace("\\", "/", $class);
    include_once './' . $newClass . '.php';
});



use \moviecollection\entities\Actor as Actor;
use \moviecollection\entities\Movie as Movie;

$date = new DateTime();


$date->setDate(1981, 10, 30);
$mom = Actor::generate("Mom", $date);
$date->setDate(1981, 12, 4);
$dad = Actor::generate("Dad", $date);
$date->setDate(2004, 12, 19);
$alison = Actor::generate("Alison", $date);
$date->setDate(2005, 12, 25);
$dave = Actor::generate("Dave", $date);


$date->setDate(2016, 1, 1);
$movie = Movie::generate($_title = "A home movie: Alisons Birtday", $_runTime = 90, $date);
$movie->addActor($mom);
$movie->addActor($dad);
$movie->addActor($alison);
$movie->addActor($dave);
echo 'test.php(+29 1-16),movie->addActor type=';var_dump($movie);




