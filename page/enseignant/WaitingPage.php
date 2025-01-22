<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Only start the session if it's not already active
}
if (isset($_SESSION['status']) && $_SESSION['status'] == 'welcome') {
    header("Location: ./MyCourses.php");
    exit();
}
// var_dump($_SESSION);
// print_r($_SESSION);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Pending Approval - EduPortal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Add loading animation library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
</head>
<body class="bg-gray-50 min-h-screen">
    <div class="max-w-4xl mx-auto px-4 py-16">
        <!-- Status Card -->
        <div class="bg-white rounded-2xl shadow-xl p-8 text-center animate__animated animate__fadeIn">
            <!-- Status Icon -->
            <div class="mx-auto w-24 h-24 bg-yellow-100 rounded-full flex items-center justify-center mb-6">
                <svg class="w-12 h-12 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>

            <!-- Status Message -->
            <h1 class="text-3xl font-bold text-gray-900 mb-4">Account Under Review</h1>
            <p class="text-lg text-gray-600 mb-8">
                Thank you for registering as a teacher. Our admin team is currently reviewing your application.
            </p>

            <!-- Progress Steps -->
            <div class="max-w-2xl mx-auto mb-8">
                <div class="flex justify-between items-center mb-4">
                    <div class="flex-1">
                        <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center mx-auto mb-2">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <p class="text-sm text-gray-600 text-center">Registration Complete</p>
                    </div>
                    <div class="flex-1">
                        <div class="w-8 h-8 bg-yellow-500 rounded-full flex items-center justify-center mx-auto mb-2 animate-pulse">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <p class="text-sm text-gray-600 text-center">Under Review</p>
                    </div>
                    <div class="flex-1">
                        <div class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-2">
                            <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <p class="text-sm text-gray-400 text-center">Account Activated</p>
                    </div>
                </div>
                <div class="h-2 bg-gray-200 rounded-full">
                    <div class="h-2 bg-yellow-500 rounded-full w-1/2"></div>
                </div>
            </div>

            <!-- Information Box -->
            <div class="bg-blue-50 rounded-lg p-6 mb-8">
                <h2 class="text-lg font-semibold text-blue-900 mb-3">What happens next?</h2>
                <ul class="text-blue-800 text-left space-y-2">
                    <li class="flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        Our admin team will review your credentials
                    </li>
                    <li class="flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        You'll receive an email when your account is activated
                    </li>
                    <li class="flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        Once approved, you can start creating courses
                    </li>
                </ul>
            </div>

            <!-- Contact Support -->
            <div class="text-center">
                <p class="text-gray-600 mb-4">Have questions? Need help?</p>
                <a href="mailto:support@eduportal.com" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-green-700 bg-green-100 hover:bg-green-200 transition-colors duration-300">
                    Contact Support
                </a>
            </div>
        </div>

        <!-- Logout Button -->
        <div class="text-center mt-8">
            <a href="logout.php" class="text-gray-600 hover:text-gray-900 text-sm">
                ← Back to Login
            </a>
        </div>
    </div>

    <!-- Auto-refresh to check status -->
    <script>
        // Refresh the page every 5 minutes to check account status
        setTimeout(() => {
            window.location.reload();
        }, 300000);
    </script>
</body>
</html>