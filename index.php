<?php

session_start();

require_once 'db.php';

// Check if user is logged in
if (!isset($_SESSION['userLoggedIn'])) {
    header('Location: login.php');
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
        <title>Rhizome</title>
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
            crossorigin="anonymous"
        />
        <link rel="stylesheet" href="style.css" />
    </head>
    <body class="text-white" style="background-color: #f9f8f4">
        <!-- HEADER -->
        <header
            class="d-flex justify-content-between align-items-center p-2"
            style="background-color: #3b4930"
        >
            <!-- Logo -->
            <img
                src="images/logo.png"
                alt="Rhizome Logo"
                class="img-fluid"
                style="height: 3rem"
            />

            <!-- Navigation -->
            <nav>
                <a class="m-2" href="#">Home</a>

                <a class="m-2" href="#">Tree</a>

                <a class="m-2" href="#">Reviews</a>

                <a class="m-2" href="#">Ontwikkeling</a>
            </nav>

            <!-- Profile -->
            <div>Profile placeholder</div>
        </header>

        <main class="d-flex justify-content-center">
            <!-- COLUMN LEFT -->
            <div class="col-lg-4">
                <!-- Week Goals -->
                <div
                    class="p-2 m-2 rounded"
                    style="background-color: #3b4930; height: 10rem"
                >
                    <h2>Week Goals</h2>
                </div>

                <!-- Exams -->
                <div
                    class="p-2 m-2 rounded"
                    style="background-color: #3b4930; height: 12rem"
                >
                    <h2>Exams</h2>
                </div>

                <!-- Skills -->
                <div
                    class="p-2 m-2 rounded"
                    style="background-color: #3b4930; height: 15rem"
                >
                    <h2>Skills</h2>
                </div>
            </div>

            <!-- COLUMN MIDDLE -->
            <div class="col-lg-5">
                <!-- Roster -->
                <div
                    class="p-2 m-2 rounded"
                    style="background-color: #3b4930; height: 23rem"
                >
                    <h2>Roster</h2>
                </div>

                <!-- Attendance -->
                <div
                    class="p-2 m-2 rounded"
                    style="background-color: #3b4930; height: 14rem"
                >
                    <h2>Attendance</h2>
                </div>
            </div>

            <!-- COLUMN RIGHT -->
            <div class="col-lg-3">
                <!-- Progress -->
                <div
                    class="p-2 m-2 rounded"
                    style="background-color: #3b4930; height: 15rem"
                >
                    <h2>Progress</h2>
                </div>

                <!-- Homework -->
                <div
                    class="p-2 m-2 rounded"
                    style="background-color: #3b4930; height: 22rem"
                >
                    <h2>Homework</h2>
                </div>
            </div>
        </main>

        <!-- FOOTER -->
        <footer class="text-black text-center mb-2">Footer</footer>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
