<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require __DIR__ . '/Models/contest.php';
require __DIR__ . '/data/defines.php';
require __DIR__ . '/CodeforcesUserApi.php';

date_default_timezone_set('Asia/Taipei');
problemset::readFromFile();

$dayNumber = 0;
if (file_exists("data/counter.txt")) {
    $dayNumber = (int)file_get_contents("data/counter.txt");
}
file_put_contents("data/counter.txt", $dayNumber + 1);
$contestIndex = $dayNumber / 7 + 1;
$contests = array(
    new contest(278320, $contestIndex, "Beginners", 700, 1400, $dayNumber % 7 < 5 ? 4 : 3),
    new contest(278321, $contestIndex, "Specialist", 1400, 2000, 3),
    new contest(278324, $contestIndex, "Candidate masters", 1900, 2400, 3),
    new contest(278323, $contestIndex, "Grandmasters", 2500, 3500, 3),
);

$api = new CodeforcesUserApi();
$api->changeTimeToToday($contests[1]);
/*
// end of the day
foreach ($contests as $contest) {
    $api->setVisibilityProblems($contest->contestId, false);
}
*/