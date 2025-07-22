<?php
    session_start();
        if (isset($_SESSION['Admin-name'])) {
        header("location: index.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        /* Use the Inter font family */
        body {
            font-family: 'Inter', sans-serif;
        }
        /* Simple transition for form visibility */
        .form-container.hidden {
            display: none;
        }
    </style>
</head>
<body class="bg-gray-100 dark:bg-gray-900">

    <main class="flex flex-col items-center justify-center min-h-screen p-4">
        
        <!-- Main container for the login form -->
        <div class="w-full max-w-md bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-8 space-y-6">
            
            <!-- Login Form Container -->
            <div id="login-container" class="form-container">
                <div class="text-center">
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Welcome Back!</h1>
                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Please enter your credentials to log in.</p>
                </div>

                <!-- Placeholder for messages -->
                <div id="login-message" class="hidden mt-4 p-4 text-sm rounded-lg"></div>

                <form id="login-form" action="#" method="post" class="mt-6 space-y-6">
                    <div>
                        <label for="email" class="text-sm font-medium text-gray-700 dark:text-gray-300">Email Address</label>
                        <input type="email" name="email" id="email" placeholder="you@example.com" required
                               class="mt-1 block w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label for="pwd" class="text-sm font-medium text-gray-700 dark:text-gray-300">Password</label>
                        <input type="password" name="pwd" id="pwd" placeholder="••••••••" required
                               class="mt-1 block w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <button type="submit"
                                class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-300">
                            Log In
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
</html>
