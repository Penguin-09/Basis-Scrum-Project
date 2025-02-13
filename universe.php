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
    <link rel="stylesheet" href="css/universe.css">
</head>
<body>
    <!-- HEADER -->
    <header class="d-flex flex-column flex-sm-row justify-content-between align-items-center p-2 p-sm-3 position-fixed">
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
        <main id="main-container" class="container">
            <div class="row mt-3 d-flex align-items-center flex-column">
                <!-- Front-end -->
                <div class="col-lg-4 d-flex align-items-center flex-column">
                    <!-- HTML A -->
                    <a href="#">
                        <div class="rounded-circle d-flex align-items-center justify-content-center text-center position-relative">
                        <svg viewBox="0 0 100 100" width="150" height="150">
                            <?php 
                                // Get the fill height as a percentage of 100.
                                $fillHeight = calculatePercentage($completedModules, 5); 
                            ?>
                            <defs>
                                <!-- 
                                The clipPath rectangle controls how much of the leaf is "filled".
                                For a viewBox height of 100, if $fillHeight is 60 (60% fill):
                                    y = 100 - 60 = 40 and height = 60.
                                -->
                                <clipPath id="leafClipFront1">
                                <rect x="0" y="<?php echo 100 - $fillHeight; ?>" width="100" height="<?php echo $fillHeight; ?>" />
                                </clipPath>
                            </defs>
                            
                            <!-- Base (Unfilled) Leaf -->
                            <path
                                d="M50,5 C70,15, 90,40, 50,95, 10,40, 30,15, 50,5 Z"
                                fill="#D3EAA3" />
                            
                            <!-- Filled Portion (Clipped) -->
                            <g clip-path="url(#leafClipFront1)">
                                <path
                                d="M50,5 C70,15, 90,40, 50,95, 10,40, 30,15, 50,5 Z"
                                fill="#76C043" />
                            </g>
                            
                            <!-- Leaf Outline -->
                            <path
                                d="M50,5 C70,15, 90,40, 50,95, 10,40, 30,15, 50,5 Z"
                                fill="none"
                                stroke="#4A7B20"
                                stroke-width="2" />
                            </svg>
                            <span class="text-overlay text-dark">
                                <span class="line">HTML</span>
                                <span class="line">Advanced</span>
                            </span>
                        </div>
                    </a>


                    <div class="d-flex justify-content-center gap-3">
                        <!-- HTML B -->
                        <a href="#">
                            <div class="rounded-circle d-flex align-items-center justify-content-center text-center position-relative">
                            <svg viewBox="0 0 100 100" width="150" height="150" style="transform: rotate(270deg);">
                            <?php 
                                $fillHeight = calculatePercentage($completedModules, 4); 
                            ?>
                            <defs>
                                <clipPath id="leafClipFront2">
                                <rect x="0" y="<?php echo 100 - $fillHeight; ?>" width="100" height="<?php echo $fillHeight; ?>" />
                                </clipPath>
                            </defs>
                            <path
                                d="M50,5 C70,15, 90,40, 50,95, 10,40, 30,15, 50,5 Z"
                                fill="#D3EAA3" />

                            <g clip-path="url(#leafClipFront2)">
                                <path
                                d="M50,5 C70,15, 90,40, 50,95, 10,40, 30,15, 50,5 Z"
                                fill="#76C043" />
                            </g>
                            
                            <path
                                d="M50,5 C70,15, 90,40, 50,95, 10,40, 30,15, 50,5 Z"
                                fill="none"
                                stroke="#4A7B20"
                                stroke-width="2" />
                            </svg>
                                <span class="text-overlay text-dark">
                                    <span class="line">HTML</span>
                                    <span class="line">Beginner</span>
                                </span>
                            </div>
                        </a>

                        <!-- JS A -->
                        <a href="#">
                            <div class="rounded-circle d-flex align-items-center justify-content-center text-center position-relative">
                            <svg viewBox="0 0 100 100" width="150" height="150" style="transform: rotate(90deg);">
                            <?php 
                                $fillHeight = calculatePercentage($completedModules, 6); 
                            ?>
                            <defs>
                                <clipPath id="leafClipFront3">
                                <rect x="0" y="<?php echo 100 - $fillHeight; ?>" width="100" height="<?php echo $fillHeight; ?>" />
                                </clipPath>
                            </defs>
                            
                            <path
                                d="M50,5 C70,15, 90,40, 50,95, 10,40, 30,15, 50,5 Z"
                                fill="#D3EAA3" />

                            <g clip-path="url(#leafClipFront3)">
                                <path
                                d="M50,5 C70,15, 90,40, 50,95, 10,40, 30,15, 50,5 Z"
                                fill="#76C043" />
                            </g>
                            
                            <path
                                d="M50,5 C70,15, 90,40, 50,95, 10,40, 30,15, 50,5 Z"
                                fill="none"
                                stroke="#4A7B20"
                                stroke-width="2" />
                            </svg>
                            <span class="text-overlay text-dark">
                                <span class="line">Javascript</span>
                                <span class="line">Beginner</span>
                            </span>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="d-flex mt-5 justify-content-center gap-3">
                    <!-- Back-end -->
                    <div class="col-lg-4 d-flex align-items-center flex-column">
                        <!-- DB A -->
                        <a href="#">
                            <div class="rounded-circle d-flex align-items-center justify-content-center text-center position-relative">
                            <svg viewBox="0 0 100 100" width="150" height="150">
                            <?php 
                                $fillHeight = calculatePercentage($completedModules, 1); 
                            ?>
                            <defs>
                                <clipPath id="leafClipBack1">
                                <rect x="0" y="<?php echo 100 - $fillHeight; ?>" width="100" height="<?php echo $fillHeight; ?>" />
                                </clipPath>
                            </defs>
                            
                            <path
                                d="M50,5 C70,15, 90,40, 50,95, 10,40, 30,15, 50,5 Z"
                                fill="#D3EAA3" />
                            
                            <g clip-path="url(#leafClipBack1)">
                                <path
                                d="M50,5 C70,15, 90,40, 50,95, 10,40, 30,15, 50,5 Z"
                                fill="#76C043" />
                            </g>
                            
                            <path
                                d="M50,5 C70,15, 90,40, 50,95, 10,40, 30,15, 50,5 Z"
                                fill="none"
                                stroke="#4A7B20"
                                stroke-width="2" />
                            </svg>
                                <span class="text-overlay text-dark">
                                    <span class="line">Database</span>
                                    <span class="line">Beginner</span>
                                </span>
                            </div>
                        </a>

                        <div class="d-flex justify-content-center gap-3">
                            <!-- PHP A -->
                            <a href="#">
                                <div class="rounded-circle d-flex align-items-center justify-content-center text-center position-relative">
                                <svg viewBox="0 0 100 100" width="150" height="150" style="transform: rotate(180deg);">
                            <?php 
                                $fillHeight = calculatePercentage($completedModules, 2); 
                            ?>
                            <defs>
                                <clipPath id="leafClipBack2">
                                <rect x="0" y="<?php echo 100 - $fillHeight; ?>" width="100" height="<?php echo $fillHeight; ?>" />
                                </clipPath>
                            </defs>
                            
                            <path
                                d="M50,5 C70,15, 90,40, 50,95, 10,40, 30,15, 50,5 Z"
                                fill="#D3EAA3" />
                            
                            <g clip-path="url(#leafClipBack2)">
                                <path
                                d="M50,5 C70,15, 90,40, 50,95, 10,40, 30,15, 50,5 Z"
                                fill="#76C043" />
                            </g>
                            
                            <path
                                d="M50,5 C70,15, 90,40, 50,95, 10,40, 30,15, 50,5 Z"
                                fill="none"
                                stroke="#4A7B20"
                                stroke-width="2" />
                            </svg>
                                <span class="text-overlay text-dark">
                                    <span class="line">PHP</span>
                                    <span class="line">Advanced</span>
                                </span>
                                </div>
                            </a>

                            <!-- PHP B -->
                            <a href="#">
                                <div class="rounded-circle d-flex align-items-center justify-content-center text-center position-relative">
                                <svg viewBox="0 0 100 100" width="150" height="150" style="transform: rotate(180deg);">
                            <?php 
                                $fillHeight = calculatePercentage($completedModules, 1); 
                            ?>
                            <defs>
                                <clipPath id="leafClipBack3">
                                <rect x="0" y="<?php echo 100 - $fillHeight; ?>" width="100" height="<?php echo $fillHeight; ?>" />
                                </clipPath>
                            </defs>
                            
                            <path
                                d="M50,5 C70,15, 90,40, 50,95, 10,40, 30,15, 50,5 Z"
                                fill="#D3EAA3" />
                            
                            <g clip-path="url(#leafClipBack3)">
                                <path
                                d="M50,5 C70,15, 90,40, 50,95, 10,40, 30,15, 50,5 Z"
                                fill="#76C043" />
                            </g>
                            
                            <path
                                d="M50,5 C70,15, 90,40, 50,95, 10,40, 30,15, 50,5 Z"
                                fill="none"
                                stroke="#4A7B20"
                                stroke-width="2" />
                            </svg>
                                <span class="text-overlay text-dark">
                                    <span class="line">PHP</span>
                                    <span class="line">Beginner</span>
                                </span>
                                </div>
                            </a>
                        </div>
                    </div>

                    <!-- Data analist -->
                    <div class="col-lg-4 d-flex align-items-center flex-column">
                        <!-- Data visualization -->
                        <a href="#">
                            <div class="d-flex align-items-center justify-content-center text-center position-relative">
                            <svg viewBox="0 0 100 100" width="150" height="150">
                            <?php 
                                $fillHeight = calculatePercentage($completedModules, 9); 
                            ?>
                            <defs>
                                <clipPath id="leafClipData1">
                                <rect x="0" y="<?php echo 100 - $fillHeight; ?>" width="100" height="<?php echo $fillHeight; ?>" />
                                </clipPath>
                            </defs>
                            
                            <path
                                d="M50,5 C70,15, 90,40, 50,95, 10,40, 30,15, 50,5 Z"
                                fill="#D3EAA3" />
                            
                            <g clip-path="url(#leafClipData1)">
                                <path
                                d="M50,5 C70,15, 90,40, 50,95, 10,40, 30,15, 50,5 Z"
                                fill="#76C043" />
                            </g>
                            

                            <path
                                d="M50,5 C70,15, 90,40, 50,95, 10,40, 30,15, 50,5 Z"
                                fill="none"
                                stroke="#4A7B20"
                                stroke-width="2" />
                            </svg>
                                <span class="text-overlay text-dark">
                                    <span class="line">Data</span>
                                    <span class="line">Visualization</span>
                                </span>
                            </div>
                        </a>

                        <div class="d-flex justify-content-center gap-3">
                            <!-- Python Beginner -->
                            <a href="#">
                                <div class="rounded-circle d-flex align-items-center justify-content-center text-center position-relative">
                                <svg viewBox="0 0 100 100" width="150" height="150" style="transform: rotate(180deg);">
                                    <defs>
                                        <clipPath id="leafClipData2">
                                        <rect x="0" y="40" width="100" height="60" />
                                        </clipPath>
                                    </defs>
                                    
                                    <path
                                        d="M50,5 C70,15, 90,40, 50,95, 10,40, 30,15, 50,5 Z"
                                        fill="#D3EAA3" />
                                    
                                    <g clip-path="url(#leafClipData2)">
                                        <path
                                        d="M50,5 C70,15, 90,40, 50,95, 10,40, 30,15, 50,5 Z"
                                        fill="#76C043" />
                                    </g>
                                    
                                    <path
                                        d="M50,5 C70,15, 90,40, 50,95, 10,40, 30,15, 50,5 Z"
                                        fill="none"
                                        stroke="#4A7B20"
                                        stroke-width="2" />
                                    </svg>
                                <span class="text-overlay text-dark">
                                    <span class="line">Python</span>
                                    <span class="line">Beginner</span>
                                </span>
                                </div>
                            </a>

                            <!-- Data Manipulation -->
                            <a href="#">
                                <div class="rounded-circle d-flex align-items-center justify-content-center text-center position-relative">
                                <svg viewBox="0 0 100 100" width="150" height="150" style="transform: rotate(180deg);">
                            <?php 
                                $fillHeight = calculatePercentage($completedModules, 8); 
                            ?>
                            <defs>
                                <clipPath id="leafClipData3">
                                <rect x="0" y="<?php echo 100 - $fillHeight; ?>" width="100" height="<?php echo $fillHeight; ?>" />
                                </clipPath>
                            </defs>
                            
                            <path
                                d="M50,5 C70,15, 90,40, 50,95, 10,40, 30,15, 50,5 Z"
                                fill="#D3EAA3" />
                            
                            <g clip-path="url(#leafClipData3)">
                                <path
                                d="M50,5 C70,15, 90,40, 50,95, 10,40, 30,15, 50,5 Z"
                                fill="#76C043" />
                            </g>
                            
                            <path
                                d="M50,5 C70,15, 90,40, 50,95, 10,40, 30,15, 50,5 Z"
                                fill="none"
                                stroke="#4A7B20"
                                stroke-width="2" />
                            </svg>
                                <span class="text-overlay text-dark">
                                    <span class="line">Data</span>
                                    <span class="line">Manipulation</span>
                                </span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <footer class="d-flex justify-content-start p-1 m-2">
            <div class="d-flex justify-content-center flex-column">
                <table class="tableColor fs-6">
                    <thead class="rounded">
                        <tr>
                            <td class="p-1 border-bottom text-center fs-4">ShortCuts</td>
                            <td class="p-1 border-bottom border-end"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="p-1 border-bottom border-end">Reset View</td>
                            <td class="p-1 border-bottom border-end">-</td>
                        </tr>
                        <tr>
                            <td class="p-1 border-bottom border-end">Search</td>
                            <td class="p-1 border-bottom border-end">-</td>
                        </tr>
                        <tr>
                            <td class="p-1 border-bottom border-end">In & Out Zoom</td>
                            <td class="p-1 border-bottom border-end">Scroll</td>
                        </tr>
                        <tr>
                            <td class="p-1 border-bottom border-end">Move</td>
                            <td class="p-1 border-bottom border-end">Press & Hold Mouse and move</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="js/universe.js"></script>
</body>
</html>