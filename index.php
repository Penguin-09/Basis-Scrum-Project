<?php

require_once 'db.php';

// // Check if user is logged in
// if (!isset($_SESSION['userLoggedIn'])) {
//     header('Location: login.php');
//     exit();
// }

// Get user data
if (isset($_GET['userID'])) {
    $userID = $_GET['userID'];

    $userData = $pdo->query("SELECT username, isAdmin, class, completedModules, sickDays, confirmedAbsentDays, unconfirmedAbsentDays, lateDays FROM accounts WHERE id = $userID")->fetchAll();
}

// Get class data
$classData = $pdo->query("SELECT * FROM classes")->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Three Columns Layout</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-screen bg-[#f9f8f4]">
    <!-- Navbar -->
    <nav class="bg-[#3b4930] h-20 flex items-center justify-between px-8 shadow-lg">
        <!-- Logo -->
        <a href="#">
            <img src="images/Logo.png" alt="Logo" class="h-12 w-auto">
        </a>

        <!-- Navbar tabs -->
        <div class="flex items-center space-x-8">
            <a href="#" class="text-lg font-medium text-[#f9f8f4] hover:translate-y-1 transition duration-100">
                Home
            </a>
            <a href="#" class="text-lg font-medium text-[#f9f8f4] hover:translate-y-1 transition duration-100">
                Tree
            </a>
            <a href="#" class="text-lg font-medium text-[#f9f8f4] hover:translate-y-1 transition duration-100">
                Reviews
            </a>
            <a href="#" class="text-lg font-medium text-[#f9f8f4] hover:translate-y-1 transition duration-100">
                Ontwikkeling
            </a>
        </div>

        <!-- Profile photo -->
        <a href="#">
            <img src="images/profile.png" alt="Profile Photo" class="h-12 w-12 rounded-full border-2 border-gray-300 shadow-md">
        </a>
    </nav>

    <!-- Main content -->
    <div class="flex">
        <!-- Column 1 -->
        <div class="p-1 m-1 gap-x-3 ml-20 mt-4">
            <!-- Weekly goals -->
            <div class="bg-[#3b4930] text-[#f9f8f4] p-6 rounded-md shadow-lg flex flex-col justify-center items-center w-[calc(50vh)] h-[calc(15vh)] mb-6 gap-x-4">
                <div class="container justify-center">
                    <p class="text-center pb-8 text-3xl">My weekly goals</p>
                </div>
                <div class="container flex justify-center">
                    <form action="#" class="">
                        <input type="text">
                        <input type="submit" value="Save" class="text-xl">
                    </form>
                </div>
            </div>

            <!-- Upcomming exams -->
            <div class="bg-[#3b4930] text-[#f9f8f4] p-6 rounded-md shadow-lg flex justify-center items-center w-full h-[calc(25vh)] mb-12 gap-x-4">
                <p class="text-center pb-8 text-3xl">Upcomming exams</p>
                <!-- Upcomming exams here -->
            </div>

            <!-- Skills -->
            <div class="bg-[#3b4930] text-[#f9f8f4] p-6 rounded-md shadow-lg flex justify-center items-center w-full h-[calc(40vh)] gap-x-4">
                <p class="text-center pb-8 text-3xl">Skills</p>
            </div>
        </div>

        <!-- Column 2] -->
        <div class="p-1 m-1 gap-x-3 ml-10 mt-4">
            <!-- Roster -->
            <div class="bg-[#3b4930] text-[#f9f8f4] p-6 rounded-md shadow-lg flex flex-col justify-center items-center w-[calc(75vh)] h-[calc(42.2vh)] mb-12 gap-x-4">
                <p class="text-center pb-8 text-3xl">Roster</p>

                <!-- Time stamps -->
                <div class="flex">
                    <?php 
                        for ($i = 8; $i < 17; $i++) {
                            echo "<div class='border border-[#000000] p-3 w-1/8 text-center'>";
                                if ($i < 10) {
                                    echo "0$i:00";
                                } else {
                                    echo "$i:00";
                                }
                            echo "</div>";
                        }
                    ?>
                </div>

                <!-- Days -->
                <div class="flex w-full mt-4 flex-col">
                    <!-- Monday -->
                    <div class="flex w-1/5">
                        <div class="text-center border border-[#000000] p-3">Mo</div>
                        <div class="bg-[#FFFFFF] flex-grow"></div>
                    </div>

                    <!-- Tuesday -->
                    <div class="flex w-1/5">
                        <div class="text-center border border-[#000000] p-3">Tu</div>
                        <div class="bg-[#FFFFFF] flex-grow"></div>
                    </div>

                    <!-- Wednesday -->
                    <div class="flex w-1/5">
                        <div class="text-center border border-[#000000] p-3">We</div>
                        <div class="bg-[#FFFFFF] flex-grow"></div>
                    </div>

                    <!-- Thursday -->
                    <div class="flex w-1/5">
                        <div class="text-center border border-[#000000] p-3">Th</div>
                        <div class="bg-[#FFFFFF] flex-grow"></div>
                    </div>

                    <!-- Friday -->
                    <div class="flex w-1/5">
                        <div class="text-center border border-[#000000] p-3">Fr</div>
                        <div class="bg-[#FFFFFF] flex-grow"></div>
                    </div>
                </div>

            </div>


            <!-- Tendancy -->
            <div class="bg-[#3b4930] text-[#f9f8f4] p-6 rounded-md shadow-lg flex justify-center items-center w-[calc(75vh)] h-[calc(40vh)] gap-x-4">
                Tendancy
            </div>
        </div>

        <!-- Column 3] -->
        <div class="p-1 m-1 gap-x-3 ml-10 mt-4">
            <div class="bg-[#3b4930] text-[#f9f8f4] p-6 rounded-md shadow-lg flex justify-center items-center w-[calc(27vh)] h-[calc(23vh)] ml-2 mb-12 gap-x-2">
                Software developer progress
            </div>
            <div class="bg-[#3b4930] text-[#f9f8f4] p-6 rounded-md shadow-lg flex justify-center items-center w-[calc(27vh)] h-[calc(59.3vh)] ml-2 gap-x-2">
                Homework
            </div>
        </div>
    </div>
</body>
</html>
