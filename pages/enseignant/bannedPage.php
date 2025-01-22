

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Suspended - EduPortal</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="max-w-2xl w-full mx-auto p-4">
        <div class="bg-white rounded-lg shadow-xl overflow-hidden">
            <!-- Red Banner -->
            <div class="bg-red-600 px-6 py-8 text-center">
                <div class="mx-auto w-16 h-16 bg-white rounded-full flex items-center justify-center mb-4">
                    <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                        </path>
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-white mb-2">Account Suspended</h1>
                <p class="text-white text-opacity-90">Your teaching account has been suspended</p>
            </div>

            <!-- Content -->
            <div class="px-6 py-8">
                <!-- Reason Section -->
                <div class="mb-8">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">Why was my account suspended?</h2>
                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                        <p class="text-gray-700">
                            Your account has been suspended due to a violation of our community guidelines or terms of service. 
                            This decision was made after careful review of your account activity.
                        </p>
                    </div>
                </div>

                <!-- What This Means Section -->
                <div class="mb-8">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">What does this mean?</h2>
                    <ul class="space-y-3 text-gray-700">
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-red-500 mr-2 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                            </svg>
                            You cannot access your teaching dashboard
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-red-500 mr-2 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                            </svg>
                            You cannot create new courses or edit existing ones
                        </li>
                    </ul>
                </div>

                <!-- Appeal Section -->
                <div class="mb-8">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">Want to appeal this decision?</h2>
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 text-blue-800">
                        <p class="mb-4">
                            If you believe this suspension was made in error, you can submit an appeal for review. 
                            Please include any relevant information that might help us understand your situation better.
                        </p>
                        <a href="mailto:support@eduportal.com" 
                           class="inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 transition-colors duration-300">
                            Contact Support
                        </a>
                    </div>
                </div>

                <!-- Logout Section -->
                <div class="text-center pt-4 border-t">
                    <form action="./logout.php" method="POST">
                        <button type="submit" 
                                class="text-gray-600 hover:text-gray-900 text-sm font-medium transition-colors duration-300">
                            Sign Out
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>