<?php
    session_start();
        if (isset($_SESSION['Admin-name'])) {
        header("location: .");
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
                <div id="login-message" class="<?php if(!isset($_GET["error"])) echo "hidden" ?>bg-red-400 mt-4 p-4 text-sm rounded-lg"><?php if(isset($_GET["error"])) echo $_GET["error"] ?></div>

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

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Get elements
            const loginContainer = document.getElementById('login-container');
            const resetContainer = document.getElementById('reset-container');
            const showResetLink = document.getElementById('show-reset-form');
            const showLoginLink = document.getElementById('show-login-form');
            
            const loginForm = document.getElementById('login-form');
            const resetForm = document.getElementById('reset-form');

            const loginMessage = document.getElementById('login-message');
            const resetMessage = document.getElementById('reset-message');

            // --- Event Listeners to toggle forms ---
            showResetLink.addEventListener('click', (e) => {
                e.preventDefault();
                loginContainer.classList.add('hidden');
                resetContainer.classList.remove('hidden');
            });

            showLoginLink.addEventListener('click', (e) => {
                e.preventDefault();
                resetContainer.classList.add('hidden');
                loginContainer.classList.remove('hidden');
            });

            // --- Form Submission Handlers (Client-Side Demo) ---

            // Function to display messages
            function showMessage(element, message, isError = false) {
                element.textContent = message;
                element.classList.remove('hidden', 'bg-green-100', 'text-green-800', 'dark:bg-green-900', 'dark:text-green-200', 'bg-red-100', 'text-red-800', 'dark:bg-red-900', 'dark:text-red-200');
                if (isError) {
                    element.classList.add('bg-red-100', 'text-red-800', 'dark:bg-red-900', 'dark:text-red-200');
                } else {
                    element.classList.add('bg-green-100', 'text-green-800', 'dark:bg-green-900', 'dark:text-green-200');
                }
            }
            
            // Handle Login Form Submission
            loginForm.addEventListener('submit', function(e) {
                e.preventDefault(); // Prevent actual form submission
                const email = this.email.value;

                // Simulate different server responses based on email
                if (email === 'error@example.com') {
                    showMessage(loginMessage, 'Wrong password! Please try again.', true);
                } else if (email === 'nouser@example.com') {
                    showMessage(loginMessage, 'This E-mail does not exist!', true);
                } else if (email === 'activated@example.com') {
                    showMessage(loginMessage, 'Account activated. Please login.', false);
                }
                else {
                    // Simulate a successful login
                    showMessage(loginMessage, 'Login successful! Redirecting...', false);
                    // Here you would typically redirect the user
                    // window.location.href = '/dashboard.php';
                }
            });

            // Handle Reset Form Submission
            resetForm.addEventListener('submit', function(e) {
                e.preventDefault(); // Prevent actual form submission
                
                // Simulate success
                showMessage(resetMessage, 'Success! Check your E-mail for the reset link.', false);
            });
        });
    </script>
</body>
</html>
