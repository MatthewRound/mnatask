<?php

// bootstrap
spl_autoload_register(function ($class) {
    $newClass = str_replace("\\", "/", $class);
    include_once './' . $newClass . '.php';
});


use \moviecollection\entities\Actor as Actor;
use \moviecollection\entities\Movie as Movie;



//test data
$date = new DateTime();
$date->setDate(1981, 10, 30);
$mom = Actor::generate("Mom", $date);

$date = new DateTime();
$date->setDate(1981, 12, 4);
$dad = Actor::generate("Dad", $date);

$date = new DateTime();
$date->setDate(2004, 12, 19);
$alison = Actor::generate("Alison", $date);

$date = new DateTime();
$date->setDate(2005, 12, 25);
$dave = Actor::generate("Dave", $date);


$date = new DateTime();
$date->setDate(2016, 1, 1);
/* $movie = Movie::generate($date, $_title = "A home movie: Alisons Birtday", $_runTime = 90); */
$movie = new Movie();
try {
	$movie->setTitle("A home movie: Alison's Birthday");
	$movie->setRuntime(90);
	$movie->setReleaseDate($date);
	$movie->getUUID($date);
	$movie->addActor($mom, "Mother");
	$movie->addActor($dad, "Father");
	$movie->addActor($alison, "Daughter");
	$movie->addActor($dave, "Son");
} catch (Exception $e) {

}


// To Use
$json = $movie->toJson();
echo 'test.php(+43 1-5),json type=';var_dump($json);
$sortedActors = $movie->getActors($_sortByAge = true);
echo 'test.php(+45 1-13),sortedActors type=';var_dump($sortedActors);
