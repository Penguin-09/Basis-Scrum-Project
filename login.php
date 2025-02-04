<?php

session_start();

require_once 'db.php';

try {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = trim($_POST['username']);
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

        if ($user && password_verify($password, $user['password'])) {            
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
    </head>
    <body style="background-color: #929780">
        <div class="d-flex">
            <!-- Quote and image -->
            <div
                class="col-lg-6 d-flex justify-content-center align-items-center flex-column rounded"
                style="height: 100vh; background-color: #afb49d"
            >
                <h2 style="color: #3b4930">"Growth is just the beginning"</h2>

                <img
                    src="images/womanWatering.png"
                    alt="watering"
                    style="width: 70%"
                />
            </div>

            <div
                class="d-flex justify-content-center align-items-center text-light"
                style="width: 100%"
            >
                <!-- Form -->
                <div
                    class="d-flex align-items-center flex-column rounded p-3"
                    style="background-color: #3b4930; width: min-content;"
                >
                    <img src="images/logo.png" alt="logo" style="width: 300px" />

                    <p class="py-4">Sign into your account</p>

                    <form method="post">
                        <!-- Name -->
                        <div class="d-flex flex-column">
                            <label for="name">Your name</label>
                            <input
                                type="text"
                                name="name"
                                id="name"
                                placeholder="name"
                                class="rounded-pill p-1"
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
                                class="rounded-pill p-1"
                            />
                        </div>

                        <!-- Submit -->
                        <div class="d-flex flex-column pt-3">
                            <button type="submit" class="btn btn-light rounded-pill">Login</button>
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
