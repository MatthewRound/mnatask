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
    printf("Error:%s", $e->getMessage());
}


// To Use
echo json_encode($movie);
$sortedActors = $movie->getActors($_sortByAge = true);
print_r($sortedActors);
