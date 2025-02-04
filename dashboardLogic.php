<?php

include_once 'db.php';

// Check if user is logged in
if (!isset($_SESSION['userLoggedIn'])) {
    header('Location: login.php');
    exit();
}

// Get user data
if (isset($_GET['userID'])) {
    $userID = $_GET['userID'];

    $userData = $pdo->query("SELECT username, isAdmin, class, completedModules, sickDays, confirmedAbsentDays, unconfirmedAbsentDays, lateDays FROM accounts WHERE id = $userID")->fetchAll();
}

// // Get class data
// $classData = $pdo->query("SELECT * FROM classes")->fetchAll();

// function xpcalc($a)
// {
//     $xp = 0;
//     preg_match_all('/e(\d+)/', $a, $matches);

//     $integers = $matches[1];

//     for($i = 0; $i < count($integers); $i++) {
//         $xp += $integers[$i] * 10;
//     }
//     return $xp;
// }
// $exCount =  xpcalc('m1e5m2e2m3e1m6e4m4e7m3e8m2e9m1e5');