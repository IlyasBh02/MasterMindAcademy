<?php
// session_start();
require_once __DIR__ . "/../../class/Etudiant.php";
$userId = $_SESSION['userId'];
$courses = Etudiant::showEnrolledCourses($userId);
// print_r($courses);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Enrolled Courses - EduPortal</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <section class="min-h-screen bg-gradient-to-b from-green-50 to-white py-12">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-10">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">My Enrolled Courses</h1>
                <p class="text-gray-600">Continue your learning journey with your enrolled courses</p>
            </div>

            
            <!-- Course Cards -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <?php if (empty($courses)): ?>
                    <div class="col-span-full bg-white rounded-xl shadow-md p-6 text-center">
                        <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">No Courses Found</h3>
                        <p class="text-gray-600">You haven't enrolled in any courses yet.</p>
                        <a href="courses.php" class="mt-4 inline-block px-6 py-2 bg-green-600 text-white rounded-full hover:bg-green-700 transition-colors">
                            Browse Courses
                        </a>
                    </div>
                <?php else: ?>
                    <?php foreach ($courses as $course): ?>
                        <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                            <div class="flex flex-col sm:flex-row h-full">
                                <!-- Video Preview -->
                                <div class="sm:w-48 h-48 sm:h-auto relative bg-gray-100">
                                    <?php if (!empty($course['vedeo'])): ?>
                                        <video 
                                            class="w-full h-full object-cover"
                                            preload="none"
                                        >
                                            <source src="../../uploads/<?= $course['vedeo'] ?>" type="video/mp4">
                                        </video>
                                        <button class="absolute inset-0 w-full h-full flex items-center justify-center bg-black bg-opacity-30 hover:bg-opacity-40 transition-opacity group">
                                            <svg class="w-12 h-12 text-white opacity-90 group-hover:opacity-100 transform group-hover:scale-110 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </button>
                                    <?php else: ?>
                                        <div class="w-full h-full flex items-center justify-center bg-gray-100">
                                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <!-- Course Info -->
                                <div class="flex-1 p-6">
                                    <div class="flex flex-col h-full">
                                        <div>
                                            <h3 class="text-xl font-bold text-gray-900 mb-2">
                                                <?= $course['titreCours'] ?? 'Untitled Course' ?>
                                            </h3>
                                            <p class="text-gray-600 mb-4 line-clamp-2">
                                                <?= $course['description'] ?? 'No description available' ?>
                                            </p>
                                        </div>

                                        <div class="mt-auto flex items-center justify-between">
                                            <div class="flex items-center space-x-4">
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                    In Progress
                                                </span>
                                            </div>
                                            <a href="./description.php?id=<?= $course['CoursId'] ?>" 
                                               class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors">
                                                Continue Learning
                                                <svg class="ml-2 -mr-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <script>
        // Add click handlers for video play buttons
        document.querySelectorAll('video').forEach(video => {
            const button = video.nextElementSibling;
            if (button) {
                button.addEventListener('click', () => {
                    if (video.paused) {
                        video.play();
                    } else {
                        video.pause();
                    }
                });
            }
        });
    </script>
</body>
</html>