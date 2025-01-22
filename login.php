<?php

session_start();

require_once 'db.php';

$userDB = $pdo->query("SELECT id, username, password FROM accounts")->fetchAll();

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Loop through every user in the DB
    foreach ($userDB as $user) {
        if ($user['username'] == $username && $user['password'] == $password) {
            $_SESSION['userLoggedIn'] = $user['id'];

            header('Location: index.php');
            exit();
        }
    }

    $errorMessage = 'Username and/or password is incorrect';
    header('Location: login.php?error=' . $errorMessage);
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Rhizome</title>
        <link rel="stylesheet" href="Styles/login.css" />
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body>
       <main class="loginPage">
            <!-- Quote and image -->
            <div class="containerimage">
                <div class="layoutImage row">
                    <div>
                        <h1 class="quote">"Growth is just the beginning"</h1>
                        <img src="images/womanWatering.png" alt="WomanWatering">
                    </div>
                </div>
            </div>

            <!-- Login form -->
            <section class="loginRegister">
                <div class="flex items-center justify-center">
                    <div class="loginTextContainer rounded-lg flex flex-col justify-evenly text p-3">
                        <a href="#" class="flex items-center mb-6 mt-2">
                            <img class="h-auto max-w-full rounded-lg" src="images/Logo.png" alt="logo">    
                        </a>

                        <h1 class="text-2xl">
                            Login to your account
                        </h1>

                        <form class="flex flex-col w-72" action="#" method="POST">
                            <div class="p-2 flex flex-col">
                                <label for="Name" class="text-lg mb-1">Your name</label>
                                <input class="p-3 rounded-full border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:outline-none" type="text" name="username" id="username" placeholder="John">
                            </div>

                            <div class="p-2 flex flex-col">
                                <label for="password" class="text-lg mb-1">Password</label>
                                <input class="p-3 rounded-full border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:outline-none" type="password" name="password" id="password" placeholder="••••••••">
                            </div>

                            <div class="flex justify-center mt-6">
                                <button type="submit" class="w-full py-3 px-6 bg-[#929780] text-white text-lg font-semibold rounded-full shadow-md hover:bg-[#e87444] transition duration-300">
                                    Login
                                </button>
                            </div>
                        </form>                
                    </div>
                </div>
            </section>
       </main>

        <script src="JS/index.js"></script>
    </body>
</html>
