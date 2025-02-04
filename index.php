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
    if (isset($_GET['userID'])) {
        $userID = $_GET['userID'];
        
        $stmt = $pdo->prepare("SELECT username, isAdmin, class, completedModules, 
                              sickDays, confirmedAbsentDays, unconfirmedAbsentDays, 
                              lateDays 
                              FROM accounts 
                              WHERE id = :userID");
                              
        $stmt->execute(['userID' => $userID]);
        $userData = $stmt->fetch();
        
        if (!$userData) {
            throw new Exception('User not found');
        }
    } else {
        throw new Exception('No user ID provided');
    }
} catch (Exception $e) {
    error_log("Error in index.php: " . $e->getMessage());
    $error = "An error occurred while fetching user data";
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Rhizome | Dashboard</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
        <link rel="stylesheet" href="css/index.css">
    </head>
    <body>
        <!-- HEADER -->
        <header class="d-flex flex-column flex-sm-row justify-content-between align-items-center p-2 p-sm-3">
            <!-- Logo -->
            <img src="images/logo.png" alt="Rhizome Logo" class="img-fluid mb-2 mb-sm-0" style="height: 3rem" />

            <!-- Navigation -->
            <nav class="d-flex flex-wrap justify-content-center">
                <a class="m-2 text-decoration-none fs-4" href="#">Home</a>
                <a class="m-2 text-decoration-none fs-4" href="#">Tree</a>
                <a class="m-2 text-decoration-none fs-4" href="#">Reviews</a>
                <a class="m-2 text-decoration-none fs-4" href="#">Ontwikkeling</a>
            </nav>

            <!-- Profile -->
            <div class="mt-2 mt-sm-0">Profile placeholder</div>
        </header>

        <main class="container-fluid p-3">
            <div class="row h-100 g-3">
                <!-- COLUMN LEFT -->
                <div class="col-12 col-md-6 col-lg-4 h-100">
                    <!-- Week Goals -->
                    <div class="dashboard-card card-weekgoals p-3 mb-3 rounded box">
                        <h2 class="h4">Week Goals</h2>                     
                    </div>

                    <!-- Exams -->
                    <div class="dashboard-card card-exams p-3 mb-3 rounded box">
                        <h2 class="h4">Exams</h2>
                    </div>

                    <!-- Skills -->
                    <div class="dashboard-card card-skills p-3 mb-3 rounded box">
                        <h2 class="h4">Skills</h2>
                    </div>
                </div>

                <!-- COLUMN MIDDLE -->
                <div class="col-12 col-md-6 col-lg-5 h-100 Box">
                    <!-- Roster -->
                    <div class="dashboard-card card-roster p-3 mb-3 rounded">
                        <h2 class="h4">Roster
                            <br>
                            Class: <?php echo $class ?>
                        </h2>
                    </div>

                    <!-- Attendance -->
                    <div class="dashboard-card card-attendance p-3 rounded">
                        <h2 class="h4">Attendance
                            <p>Amount of sick days: <?php echo $sickDays; ?></p>
                            <p>Amount of confirmed absent days: <?php echo $confirmedAbsentDays; ?></p>
                            <p>Amount of unconfirmed absent days: <?php echo $unconfirmedAbsentDays; ?></p>
                            <p>Amount of late days: <?php echo $lateDays; ?></p>
                        </h2>
                    </div>
                </div>

                <!-- COLUMN RIGHT -->
                <div class="col-12 col-md-12 col-lg-3 h-100 Box">
                    <!-- Progress -->
                    <div class="dashboard-card card-progress p-3 mb-3 rounded box">
                        <h2 class="h4">Progress</h2>
                    </div>

                    <!-- Homework -->
                    <div class="dashboard-card card-homework p-3 mb-3 rounded box">
                        <h2 class="h4">Homework</h2>
                    </div>
                </div>
            </div>
        </main>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>