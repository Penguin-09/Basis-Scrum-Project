<?php

session_start();

require_once 'db.php';

try {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        if (empty($username) || empty($password)) {
            throw new Exception('Please fill in all fields');
        }

        // Verify database connection
        if (!$pdo) {
            throw new Exception('Database connection failed');
        }

        // Prepare and execute the query
        $stmt = $pdo->prepare("SELECT id, username, password FROM accounts WHERE username = :username");
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch();

        if ($user && $password) {            
            $_SESSION['userLoggedIn'] = $user['id'];
            $_SESSION['username'] = $user['username']; 
            
            header("Location: index.php");
            exit();
        } else {
            $_SESSION['error'] = 'Invalid username or password';
            header("Location: login.php");
            exit();
        }
    }
} catch (Exception $e) {
    $_SESSION['error'] = $e->getMessage();
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Rhizome | Login</title>
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
            crossorigin="anonymous"
        />
        <style>
            @import url('https://fonts.googleapis.com/css2?family=PT+Serif:ital,wght@0,400;0,700;1,400;1,700&family=Playwrite+US+Modern:wght@100..400&display=swap');
            @import url('https://fonts.googleapis.com/css2?family=Playwrite+US+Modern:wght@100..400&display=swap');

            :root {
                --nav-bg-color: #3b4930;
                --nav-text-color: #cdcdb5;
                --box-bg-color: #929780;
                --box-text-color: #3c3b31;
                --button-bg-color: #413d32;
                --button-text-color: #d5d0ba;
                --items-bg-color: #afb49d;
                --items-text-color: #67775a;
            }

            body {
                height: 100vh;
                font-family: "PT Serif", serif;
                font-weight: 400;
                font-style: normal;
                color: var(--nav-text-color);
                background-color: var(--box-bg-color);
            }

            button, .inputT {
                background-color: var(--button-bg-color);
                color: var(--button-text-color);
                border-color: var(--button-text-color);
            }

            .onBox {
                border-radius: 0px 35px 35px 0px;
                color: var(--items-text-color);
                background-color: var(--items-bg-color);
                height: 100vh;
            }

            .formColor {
                background-color: var(--nav-bg-color);
                color: var(--nav-text-color);
            }

            .quoteText {
                font-family: "Playwrite US Modern", serif;
                font-optical-sizing: auto;
                font-weight: 400;
                font-style: normal;
            }
        </style>
    </head>
    <body>
        <div class="d-flex">
            <!-- Quote and image -->
            <div
                class="col-lg-6 d-flex justify-content-center align-items-center flex-column onBox"
            >
                <h2 class="quoteText">"Growth is just the beginning"</h2>

                <img
                    src="images/womanWatering.png"
                    alt="watering"
                    style="width: 70%"
                    class="mt-5"
                />
            </div>

            <div
                class="d-flex justify-content-center align-items-center p-2"
                style="width: 100%"
            >
                <!-- Form -->
                <div
                    class="d-flex align-items-center flex-column rounded-3 p-3 formColor"
                >
                    <img src="images/logo.png" alt="logo" style="width: 300px" class="p-2" />

                    <p class="py-3">Sign into your account</p>

                    <form method="post" action="login.php">
                        <!-- Name -->
                        <div class="d-flex flex-column">
                            <label for="username">Your name</label>
                            <input
                                type="text"
                                name="username"
                                id="username"
                                placeholder="Username"
                                class="inputT rounded-pill p-2"
                            />
                        </div>

                        <!-- Password -->
                        <div class="d-flex flex-column py-3">
                            <label for="password">Your Password</label>
                            <input
                                type="password"
                                name="password"
                                id="password"
                                placeholder="••••••••"
                                class="inputT rounded-pill p-2"
                            />
                        </div>

                        <!-- Submit -->
                        <div class="d-flex flex-column pt-3">
                            <button type="submit" class="rounded-pill border-2 p-2">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"
        ></script>  
    </body>
</html>
