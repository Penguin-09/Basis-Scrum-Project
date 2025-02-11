<?php

session_start();

require_once 'db.php';

// Check if user is logged in
if (!isset($_SESSION['userLoggedIn'])) {
    header("Location: login.php");
    exit();
}

// Get user data
try {
    if (isset($_SESSION['userLoggedIn'])) {
        $userID = intval($_SESSION['userLoggedIn']);

        if (!isset($pdo)) {
            throw new Exception('Database connection is not initialized');
        }

        $stmt = $pdo->prepare("SELECT a.username, a.isAdmin, a.class, a.completedModules, 
                                    a.sickDays, a.confirmedAbsentDays, a.unconfirmedAbsentDays, a.lateDays,
                                    c.homework, c.examName, c.examDate
                               FROM accounts a
                               LEFT JOIN classes c ON a.class = c.classId
                               WHERE a.id = :userID");
        $stmt->execute(['userID' => $userID]);
        $userData = $stmt->fetch();

        if (!$userData) {
            throw new Exception('User not found');
        }

        // Give the user data to variables
        $username = $userData['username'] ?? 'Unknown';
        $isAdmin = $userData['isAdmin'] ?? 0;
        $class = $userData['class'] ?? 'N/A';
        $completedModules = $userData['completedModules'] ?? 0;
        $sickDays = $userData['sickDays'] ?? 0;
        $confirmedAbsentDays = $userData['confirmedAbsentDays'] ?? 0;
        $unconfirmedAbsentDays = $userData['unconfirmedAbsentDays'] ?? 0;
        $lateDays = $userData['lateDays'] ?? 0;
        $totalDays = 30;

        // Class data
        $homework = $userData['homework'] ?? 'N/A';
        $examName = $userData['examName'] ?? 'N/A';
        $examDate = $userData['examDate'] ?? 'N/A';

    } else {
        throw new Exception('No user ID provided');
    }
} catch (Exception $e) {
    error_log("Error in index.php: " . $e->getMessage());
    echo "<p class='error'>Error: " . $e->getMessage() . "</p>";
}

// Calculate XP
function XPCalculator($completedModules) {
    $xp = 0;
    preg_match_all('/e(\d+)/', $completedModules, $matches);

    $integers = $matches[1];

    for($i = 0; $i < count($integers); $i++) {
        $xp += $integers[$i] * 10;
    }
    return $xp;
}

// Calculate level
function levelUpCalculator($totalXP) {
    $level = 0;

    for ($i = $totalXP; $i >= 0; $i -= 20) {
        if ($i >= 20) {
            $level++;
        }
    }

    return $level;
}

if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit();
}

// Display error if it exists
if (isset($error)) {
    echo "<p class='error'>$error</p>";
}

function calculatePercentage($completedModules, $moduleNumber) {

    $x = array_fill(1, 9, 0);

    preg_match_all('/m(\d+)e(\d+)/', $completedModules, $matches, PREG_SET_ORDER);

    foreach ($matches as $match) {
        $key = (int)$match[1];  
        $value = (int)$match[2];
        $x[$key] = $value;      
    }

    $aantalCompletedLevels = $x[$moduleNumber] ?? 0;  
    
    $totalAmountOfLevels = 5;

    $precentage = ($aantalCompletedLevels / $totalAmountOfLevels) * 100;

    return $precentage;
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rhizome</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/universe.css">
</head>
<body>
    <!-- HEADER -->
    <header class="d-flex flex-column flex-sm-row justify-content-between align-items-center p-2 p-sm-3">
            <!-- Logo -->
            <img src="images/logo.png" alt="Rhizome Logo" class="img-fluid mb-2 mb-sm-0" style="height: 3rem" />

            <!-- Navigation -->
            <nav class="d-flex flex-wrap justify-content-center">
                <a class="m-2 text-decoration-none fs-4" href="index.php">Home</a>
                <a class="m-2 text-decoration-none fs-4" href="#">Tree</a>
                <a class="m-2 text-decoration-none fs-4" href="#">Reviews</a>
                <a class="m-2 text-decoration-none fs-4" href="#">Ontwikkeling</a>
            </nav>

            <!-- Profile -->
            <div class="d-flex justify-content-between align-items-center mt-2 mt-sm-0">
                <p class="p-2 px-5 me-2 mb-0 rounded-pill" style="background-color: #d5d0ba; color: #210720">LVL <?= levelUpCalculator(XPCalculator($completedModules)) ?> | <?= XPCalculator($completedModules) - (levelUpCalculator(XPCalculator($completedModules)) * 20) ?>/20 XP</p>

                <p>
                    <div class="btn-group buttonNavColor">
                        <button type="button" class="btn dropdown-toggle buttonNavColor" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                            <?= $username; ?>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-lg-end buttonNavColor">
                            <li><button class="dropdown-item buttonNavColorDr" type="button">Change Avatar</button></li>
                            <li><button class="dropdown-item buttonNavColorDr" type="button">Settings</button></li>
                            <form method="post">
                                <li><button class="dropdown-item buttonNavColorDr" type="submit" name="logout">Log Out</button></li>
                            </form>
                        </ul>
                    </div>
                </p>
            </div>
        </header>

        <!-- TREE -->
        <main class="container" style="color: #cdcdb5">
            <div class="row mt-3 d-flex align-items-center flex-column">
                <!-- Front-end -->
                <div class="col-lg-4 d-flex align-items-center flex-column">
                    <!-- HTML A -->
                    <a href="#">
                        <div class="rounded-circle d-flex align-items-center justify-content-center text-center customModule shadow position-relative">
                            <span class="text-overlay">HTML Advanced</span>
                            <div class="progress-bar progress-striped position-absolute" style="height: <?php echo calculatePercentage($completedModules, 5); ?>%;"></div>
                        </div>
                    </a>

                    <div class="d-flex justify-content-center gap-3">
                        <!-- HTML B -->
                        <a href="#">
                            <div class="rounded-circle d-flex align-items-center justify-content-center text-center customModule shadow position-relative">
                                <span class="text-overlay">HTML Beginner</span>
                                <div class="progress-bar progress-striped position-absolute" style="height: <?php echo calculatePercentage($completedModules, 4); ?>%;"></div>
                            </div>
                        </a>

                        <!-- JS A -->
                        <a href="#">
                            <div class="rounded-circle d-flex align-items-center justify-content-center text-center customModule shadow position-relative">
                                <span class="text-overlay">Javascript Beginner</span>
                                <div class="progress-bar progress-striped position-absolute" style="height: <?php echo calculatePercentage($completedModules, 6); ?>%;"></div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="d-flex mt-5 justify-content-center gap-3">
                    <!-- Back-end -->
                    <div class="col-lg-4 d-flex align-items-center flex-column">
                        <!-- DB A -->
                        <a href="#">
                            <div class="rounded-circle d-flex align-items-center justify-content-center text-center customModule shadow position-relative">
                                <span class="text-overlay">Database Beginner</span>
                                <div class="progress-bar progress-striped position-absolute" style="height: <?php echo calculatePercentage($completedModules, 3); ?>%;"></div>
                            </div>
                        </a>

                        <div class="d-flex justify-content-center gap-3">
                            <!-- PHP A -->
                            <a href="#">
                                <div class="rounded-circle d-flex align-items-center justify-content-center text-center customModule shadow position-relative">
                                    <span class="text-overlay">PHP Advanced</span>
                                    <div class="progress-bar progress-striped position-absolute" style="height: <?php echo calculatePercentage($completedModules, 2); ?>%;"></div>
                                </div>
                            </a>

                            <!-- PHP B -->
                            <a href="#">
                                <div class="rounded-circle d-flex align-items-center justify-content-center text-center customModule shadow position-relative">
                                    <span class="text-overlay">PHP Beginner</span>
                                    <div class="progress-bar progress-striped position-absolute" style="height: <?php echo calculatePercentage($completedModules, 1); ?>%;"></div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <!-- Data analist -->
                    <div class="col-lg-4 d-flex align-items-center flex-column">
                        <!-- Data visualization -->
                        <a href="#">
                            <div class="rounded-circle d-flex align-items-center justify-content-center text-center customModule shadow position-relative">
                                <span class="text-overlay">Data Visualization</span>
                                <div class="progress-bar progress-striped position-absolute" style="height: <?php echo calculatePercentage($completedModules, 9); ?>%;"></div>
                            </div>
                        </a>

                        <div class="d-flex justify-content-center gap-3">
                            <!-- Python Beginner -->
                            <a href="#">
                                <div class="rounded-circle d-flex align-items-center justify-content-center text-center customModule shadow position-relative">
                                    <span class="text-overlay">Python Beginner</span>
                                    <div class="progress-bar progress-striped position-absolute" style="height: <?php echo calculatePercentage($completedModules, 7); ?>%;"></div>
                                </div>
                            </a>

                            <!-- Data Manipulation -->
                            <a href="#">
                                <div class="rounded-circle d-flex align-items-center justify-content-center text-center customModule shadow position-relative">
                                    <span class="text-overlay">Data Manipulation</span>
                                    <div class="progress-bar progress-striped position-absolute" style="height: <?php echo calculatePercentage($completedModules, 8); ?>%;"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>