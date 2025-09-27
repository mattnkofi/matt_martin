<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');

$error_message = '';
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $user_id = (int)$_GET['id'];
    
    // In a real application, you would connect to the database here
    // to check if the user ID exists.
    // For this example, we'll just check if the ID is 0 or less.
    if ($user_id <= 0) {
        $error_message = 'No student found with that ID. Please enter a valid ID.';
    } else {
        // If the ID is valid, redirect to the update page.
        header('Location: ' . site_url('users/update/' . $user_id));
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students Management System</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style>
        body {
            font-family: 'Century Gothic', sans-serif;
            background-color: #000000;
            color: #ffffff;
        }

        .bg-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            pointer-events: none;
        }

        .error-message {
            background-color: #ef4444; /* red-500 */
            color: white;
            padding: 1rem;
            border-radius: 0.5rem;
            margin-top: 1rem;
            text-align: center;
        }
    </style>
</head>

<body class="relative bg-[#212631] text-white">
    <section
        class="min-h-screen flex flex-col justify-center items-center text-center px-6 sm:px-12 bg-cover bg-center relative"
        style="background-image: url('cfbg.png');">
        <div class="bg-overlay"></div>

        <h1
            class="font-extrabold uppercase leading-snug tracking-tight text-4xl sm:text-6xl md:text-7xl max-w-3xl sm:max-w-5xl lg:max-w-7xl z-10">
            Students Management System
        </h1>

        <div class="mt-6 sm:mt-10 flex flex-col justify-center gap-5 sm:gap-6 z-10">
            <a href="<?= site_url('users/show'); ?>"
                class="px-16 py-6 bg-black text-white rounded-2xl font-bold text-lg sm:text-xl 
                       transform transition-all duration-300 hover:scale-105 active:scale-95
                       shadow-[0_8px_15px_rgba(255,255,255,0.2)] hover:shadow-[0_12px_25px_rgba(255,255,255,0.3)]">
                View Student List
            </a>
            <a href="<?= site_url('users/create'); ?>"
                class="px-16 py-6 bg-black text-white rounded-2xl font-bold text-lg sm:text-xl 
                       transform transition-all duration-300 hover:scale-105 active:scale-95
                       shadow-[0_8px_15px_rgba(255,255,255,0.2)] hover:shadow-[0_12px_25px_rgba(255,255,255,0.3)]">
                Add Student
            </a>
            
            <form action="" method="get" class="flex flex-col sm:flex-row items-center gap-2">
                <input type="number" name="id" min="1" placeholder="ID" required 
                       class="w-24 px-4 py-6 bg-black text-white rounded-2xl font-bold text-lg sm:text-xl text-center 
                              shadow-[0_8px_15px_rgba(255,255,255,0.2)] focus:outline-none focus:ring-2 focus:ring-white">
                <button type="submit"
                        class="px-8 py-6 bg-black text-white rounded-2xl font-bold text-lg sm:text-xl flex-grow
                               transform transition-all duration-300 hover:scale-105 active:scale-95
                               shadow-[0_8px_15px_rgba(255,255,255,0.2)] hover:shadow-[0_12px_25px_rgba(255,255,255,0.3)]">
                    Edit Student
                </button>
            </form>

            <?php if (!empty($error_message)): ?>
                <div class="error-message">
                    <?= $error_message; ?>
                </div>
            <?php endif; ?>

        </div>
    </section>
</body>
</html>