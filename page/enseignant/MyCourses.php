<?php
// session_start();
require_once __DIR__ . "/../../class/Enseignant.php";

if (isset($_SESSION['status']) &&  $_SESSION['status'] == 'not allowed') {
    header("Location: ./bannedPage.php");
}

// Fetch teacher data
$enseignantId = $_SESSION['userId'];
$cours = Enseignant::showMyCourses($enseignantId);
// Calculate statistics
$totalCourses = Enseignant::NbrCours($enseignantId);
$totalStudents = Enseignant::NbrEtudiantInscrit($enseignantId);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard - EduPortal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
</head>

<body class="bg-gray-50">
    <div class="min-h-screen">
        <!-- Header Section -->
        <div class="bg-white shadow">
            <div class="container mx-auto px-4 py-6">
                <h1 class="text-3xl font-bold text-gray-800">Teacher Dashboard</h1>
                <p class="text-gray-600 mt-1">Manage your courses and track your progress</p>
            </div>
        </div>

        <!-- Stats Section -->
        <div class="container mx-auto px-4 py-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Total Students Card -->
                <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-blue-500">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-blue-100 mr-4">
                            <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 mb-1">Total Enrolled Students</p>
                            <p class="text-2xl font-bold text-gray-800"><?= $totalStudents ?></p>
                        </div>
                    </div>
                </div>

                <!-- Total Courses Card -->
                <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-green-500">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-green-100 mr-4">
                            <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 mb-1">Total Courses</p>
                            <p class="text-2xl font-bold text-gray-800"><?= $totalCourses ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Courses Table Section -->
        <div class="container mx-auto px-4 pb-8">
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="p-6 border-b">
                    <h2 class="text-xl font-semibold text-gray-800">My Courses</h2>
                </div>
                <div class="p-6">
                    <table id="coursesTable" class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-white uppercase bg-green-600">
                            <tr>
                                <th class="px-6 py-3">ID</th>
                                <th class="px-6 py-3">Title</th>
                                <th class="px-6 py-3">Description</th>
                                <th class="px-6 py-3">Content</th>
                                <th class="px-6 py-3">Category</th>
                                <th class="px-6 py-3">Type</th>
                                <th class="px-6 py-3">Price</th>
                                <th class="px-6 py-3">Created</th>
                                <th class="px-6 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($cours as $cour): ?>
                                <tr class="bg-white border-b hover:bg-gray-50">
                                    <td class="px-6 py-4"><?= $cour['idCours'] ?></td>
                                    <td class="px-6 py-4 font-medium text-gray-900"><?= $cour['titre'] ?></td>
                                    <td class="px-6 py-4"><?= $cour['description'] ?></td>
                                    <td class="px-6 py-4 truncate max-w-xs"><?= $cour['contenu'] ?></td>
                                    <td class="px-6 py-4"><?= $cour['nom'] ?></td>
                                    <td class="px-6 py-4"><?= $cour['type'] ?></td>
                                    <td class="px-6 py-4">$<?= $cour['price'] ?></td>
                                    <td class="px-6 py-4"><?= $cour['date_creation'] ?></td>
                                    <td class="px-6 py-4">
                                        <div class="flex space-x-3">
                                            <a href="./EditMyCourse.php?id=<?= $cour['idCours'] ?>"
                                                class="text-blue-600 hover:text-blue-900">
                                                Edit
                                            </a>
                                            <a href="./deleteCourse.php?id=<?= $cour['idCours'] ?>&type=<?= $cour['type'] ?>"
                                                class="text-red-600 hover:text-red-900"
                                                onclick="return confirm('Are you sure you want to delete this course?');">
                                                Delete
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#coursesTable').DataTable({
                "pagingType": "simple_numbers",
                "pageLength": 10,
                "order": [
                    [0, "desc"]
                ],
                "responsive": true,
                "language": {
                    "search": "Search courses:",
                    "paginate": {
                        "next": "→",
                        "previous": "←"
                    }
                }
            });
        });
    </script>
</body>

</html>