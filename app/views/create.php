<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management System | Add Student</title>
    <!-- Using Tailwind CSS CDN via browser build for simplicity -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style>
        /* Custom font declaration for Century Gothic */
        @font-face {
            font-family: 'Century Gothic';
            src: url('path/to/CenturyGothic.woff2') format('woff2'),
                 url('path/to/CenturyGothic.woff') format('woff');
            font-weight: normal;
            font-style: normal;
        }

        body {
            /* Set the font for the entire body */
            font-family: 'Century Gothic', system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif;
            color: white; /* Ensure text remains white against dark overlay */
        }
        
        /* Background Overlay to darken the image */
        .bg-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.7); 
            z-index: 10; /* Ensure this is below all content */
        }

        /* Custom white glow/blur shadow class for buttons and icons */
        .white-glow-shadow {
            /* This is a soft white glow effect */
            box-shadow: 0 0 8px rgba(255, 255, 255, 0.1),
                        0 0 15px rgba(255, 255, 255, 0.05);
            transition: box-shadow 0.3s ease;
        }
        
        /* Hover effect for the glow */
        .white-glow-shadow:hover {
            box-shadow: 0 0 12px rgba(255, 255, 255, 0.4),
                        0 0 25px rgba(255, 255, 255, 0.2);
        }

        /* Styling for the larger input fields and their placeholders */
        .large-input {
            padding: 0.75rem 1.25rem;
            font-size: 1.125rem; /* text-lg */
            height: 3.5rem;
            border-radius: 0.5rem;
            background-color: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: border-color 0.3s;
        }
        .large-input:focus {
            border-color: rgba(255, 255, 255, 0.6);
            outline: none;
        }
        /* Style the placeholder text */
        .large-input::placeholder {
            color: rgba(255, 255, 255, 0.5);
            font-style: italic;
            font-weight: normal;
        }
    </style>
</head>

<!-- Applied the background image and overlay -->
<body class="min-h-screen relative bg-cover bg-center" style="background-image: url('<?php echo base_url(); ?>/cfbg2.png');">
    <div class="bg-overlay"></div>
    
    <!-- Main content container (z-50 ensures it is above the overlay) -->
    <div class="fixed inset-0 flex items-center justify-center z-50 p-4">

        <!-- Back and Home Buttons (OUT OF FRAME, in dark circles with white shadow) -->
        <div class="absolute top-8 left-8 flex space-x-4 z-50">
            <!-- Back Arrow Icon -->
            <a href="<?= site_url('users/show'); ?>" class="bg-[#333333] p-3 rounded-full white-glow-shadow hover:bg-[#444444] transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                </svg>
            </a>
            <!-- Home Icon -->
            <a href="<?= site_url(); ?>" class="bg-[#333333] p-3 rounded-full white-glow-shadow hover:bg-[#444444] transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
            </a>
        </div>

        <!-- Form/Card Container -->
        <div class="bg-[#1a1a1a] rounded-xl p-10 w-full max-w-2xl shadow-2xl border border-[#333333] z-20">

            <div class="flex items-center justify-center mb-10">
                <h1 class="text-3xl font-semibold">Add Student</h1>
            </div>

            <form action="<?= site_url('users/create'); ?>" method="post" id="add-student-form" class="flex flex-col">
                <div class="flex items-start space-x-8">
                    
                    <!-- Profile Picture Section -->
                    <div class="flex flex-col items-center flex-shrink-0">
                        <div class="w-32 h-32 bg-[#333333] rounded-full flex items-center justify-center mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-white" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <button type="button" class="text-lg font-bold py-3 px-6 rounded-md bg-[#333333] hover:bg-[#444444] transition">
                            BROWSE PHOTOS
                        </button>
                    </div>

                    <!-- Input Fields Section -->
                    <div class="flex flex-col flex-grow space-y-6">
                        
                        <div class="flex flex-col">
                            <input type="text" id="last_name" name="last_name" required placeholder="LAST NAME"
                                class="w-full text-white large-input">
                        </div>

                        <div class="flex flex-col">
                            <input type="text" id="first_name" name="first_name" required placeholder="FIRST NAME"
                                class="w-full text-white large-input">
                        </div>

                        <div class="flex flex-col">
                            <input type="email" id="email" name="email" required placeholder="EMAIL"
                                class="w-full text-white large-input">
                        </div>
                        
                    </div>
                </div>
            </form>
            </div>

        <!-- Action Buttons OUTSIDE the form (Reduced Size) -->
        <div class="absolute bottom-[20%] translate-y-full flex justify-center w-full max-w-lg space-x-6 px-4 z-20">
            <a href="<?= site_url('users/show'); ?>"
                class="flex-1 text-center py-3 bg-red-700 hover:bg-red-800 text-white text-lg font-bold rounded-md transition shadow-md white-glow-shadow uppercase">
                CANCEL
            </a>
            <button type="submit" form="add-student-form"
                class="flex-1 py-3 bg-white hover:bg-gray-200 text-black text-lg font-bold rounded-md transition shadow-md white-glow-shadow uppercase">
                SUBMIT
            </button>
        </div>
    </div>

</body>

</html>
