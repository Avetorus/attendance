<?php
// session_start();
// if (!isset($_SESSION['Admin-name'])) {
//   header("location: login.php");
//   exit();
// }
// require 'connectDB.php'; // Assuming you have a connection file
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        /* Use the Inter font family */
        body {
            font-family: 'Inter', sans-serif;
        }
        /* Styling for the table that will be loaded via AJAX */
        #manage_users table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }
        #manage_users th, #manage_users td {
            padding: 12px 15px;
            border: 1px solid #e5e7eb; /* gray-200 */
            text-align: left;
        }
        #manage_users th {
            background-color: #f9fafb; /* gray-50 */
            font-weight: 600;
        }
        .dark #manage_users th {
            background-color: #1f2937; /* gray-800 */
            border-color: #374151; /* gray-700 */
        }
        .dark #manage_users td {
             border-color: #374151; /* gray-700 */
        }
        #manage_users tr:nth-child(even) {
            background-color: #f9fafb; /* gray-50 */
        }
        .dark #manage_users tr:nth-child(even) {
            background-color: #1f2937; /* gray-800 */
        }
    </style>
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-white">

<?php // include 'header.php'; // You can include your redesigned header here ?>

<main class="container mx-auto p-4 lg:p-8">
    <div class="text-center mb-8">
        <h1 class="text-3xl md:text-4xl font-bold">Manage Users</h1>
        <p class="mt-2 text-gray-600 dark:text-gray-400">Add, update, or remove users from the system.</p>
    </div>

    <!-- Form for Managing Users -->
    <div class="w-full max-w-4xl mx-auto bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-8">
        <form enctype="multipart/form-data" id="manage-user-form">
            
            <!-- Section 1: Fingerprint ID -->
            <fieldset class="mb-6 p-4 border border-gray-200 dark:border-gray-700 rounded-lg">
                <legend class="text-lg font-semibold px-2"><span class="bg-blue-600 text-white rounded-full h-8 w-8 flex items-center justify-center mr-2 inline-flex">1</span>User Fingerprint ID</legend>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4 items-end">
                    <div>
                        <label for="fingerid" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Enter Fingerprint ID (1-127):</label>
                        <input type="number" name="fingerid" id="fingerid" placeholder="e.g., 42" class="mt-1 block w-full px-4 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <button type="button" name="fingerid_add" class="fingerid_add w-full md:w-auto px-4 py-2 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2 transition-colors">Add Fingerprint ID</button>
                </div>
                <div id="alert" class="mt-3 text-sm text-red-500"></div>
            </fieldset>

            <!-- Section 2: User Info -->
            <fieldset class="p-4 border border-gray-200 dark:border-gray-700 rounded-lg">
                <legend class="text-lg font-semibold px-2"><span class="bg-blue-600 text-white rounded-full h-8 w-8 flex items-center justify-center mr-2 inline-flex">2</span>User Information</legend>
                
                <!-- Hidden fields for IDs -->
                <!-- <input type="hidden" name="finger_id" id="finger_id"> -->
                <!-- <input type="hidden" name="dev_id" id="dev_id"> -->

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-4">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">User Name:</label>
                        <input type="text" name="name" id="name" placeholder="e.g., John Doe" class="mt-1 block w-full px-4 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label for="number" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Serial Number:</label>
                        <input type="text" name="number" id="number" placeholder="e.g., 12345" class="mt-1 block w-full px-4 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label for="dev_sel" class="block text-sm font-medium text-gray-700 dark:text-gray-300">User Department:</label>
                        <select name="dev_sel" id="dev_sel" class="mt-1 block w-full px-4 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="0">All Departments</option>
                            <?php
                            $sql = "SELECT * FROM devices ORDER BY device_name ASC";
                            $data["db"]->query($sql);
                            while ($row = $data->db->single()) {
                                echo '<option value="'.$row['id'].'">'.$row['device_dep'].'</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Gender:</label>
                        <div class="mt-2 flex items-center space-x-6">
                            <label class="inline-flex items-center">
                                <input type="radio" name="gender" value="Male" checked class="h-4 w-4 text-blue-600 border-gray-300 focus:ring-blue-500">
                                <span class="ml-2">Male</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" name="gender" value="Female" class="h-4 w-4 text-blue-600 border-gray-300 focus:ring-blue-500">
                                <span class="ml-2">Female</span>
                            </label>
                        </div>
                    </div>
                </div>
            </fieldset>

            <!-- Action Buttons -->
            <div class="mt-8 grid grid-cols-1 sm:grid-cols-3 gap-4">
                <button type="button" name="user_add" class="user_add w-full px-4 py-3 bg-green-600 text-white font-bold rounded-lg shadow-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-all">Add User</button>
                <button type="button" name="user_upd" class="user_upd w-full px-4 py-3 bg-yellow-500 text-white font-bold rounded-lg shadow-md hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:ring-offset-2 transition-all">Update User</button>
                <button type="button" name="user_rmo" class="user_rmo w-full px-4 py-3 bg-red-600 text-white font-bold rounded-lg shadow-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-all">Remove User</button>
            </div>
        </form>
    </div>

    <!-- User Table Container -->
    <div class="mt-12 w-full max-w-6xl mx-auto bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-4 sm:p-8">
        <h2 class="text-2xl font-bold mb-4">Current Users</h2>
        <div id="manage_users" class="overflow-x-auto">
            <!-- User table will be loaded here by AJAX -->
        </div>
    </div>
</main>

<script>
$(document).ready(function(){
    // --- Original AJAX Functionality ---
    
    // Load initial user table
    // $.ajax({
    //     url: "manage_users_up.php"
    // }).done(function(data) {
    //     $('#manage_users').html(data);
    // });

    // Set interval to update user table
    setInterval(function(){
        $.ajax({
            url: "manage_users_up.php"
        }).done(function(data) {
            $('#manage_users').html(data);
        });
    }, 5000);

    // --- Original JS from manage_users.js would go here ---
    // Example: hooking the buttons to their respective functions
    // Note: You should include your existing manage_users.js file
    // or paste its content here for the buttons to work.
    
    // For demonstration, here's how you might handle a click
    $('.user_add').on('click', function() {
        // Your logic from manage_users.js for adding a user
        console.log('Add user button clicked');
        // Example:
        // var name = $('#name').val();
        // ... get other values
        // $.ajax({ ... });
    });

    $('.user_upd').on('click', function() {
        console.log('Update user button clicked');
    });

    $('.user_rmo').on('click', function() {
        console.log('Remove user button clicked');
    });
    
    $('.fingerid_add').on('click', function() {
        console.log('Add fingerprint ID button clicked');
    });
});
</script>

</body>
</html>
