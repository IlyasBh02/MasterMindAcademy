<?php
require_once __DIR__ . "/../../class/Admin.php";
if(isset($_SESSION['role']) && $_SESSION['role'] != 'Admin'){
    header("Location: ../enseignant/unauthorizedPage.php");
    exit;
}

$enseiants = Admin::showAllEnseignant();
$nbrCourseBYCategory = Admin::CountCoursByCategory();
$bestCourse = Admin::BestCours();
$topTeachers = Admin::topThreeTeachers();
// Calculate statistics
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
<nav class="bg-white shadow-md">
    <div class="container mx-auto px-4 sm:px-6">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="#" class="flex items-center space-x-2">
                    <span class="text-2xl font-bold text-green-600">EduPortal</span>
                </a>
            </div>

            <!-- Navigation Links -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="./Dashboard.php" class="text-gray-700 hover:text-green-600 px-3 py-2 rounded-md text-sm font-medium transition-colors <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'text-green-600' : ''; ?>">
                    Dashboard
                </a>
                <a href="./CategoryTable.php" class="text-gray-700 hover:text-green-600 px-3 py-2 rounded-md text-sm font-medium transition-colors <?php echo basename($_SERVER['PHP_SELF']) == 'mycourses.php' ? 'text-green-600' : ''; ?>">
                    Category
                </a>
                <a href="./TableCours.php" class="text-gray-700 hover:text-green-600 px-3 py-2 rounded-md text-sm font-medium transition-colors <?php echo basename($_SERVER['PHP_SELF']) == 'enrolled.php' ? 'text-green-600' : ''; ?>">
                    Courses
                </a>
                <a href="./TagsTable.php" class="text-gray-700 hover:text-green-600 px-3 py-2 rounded-md text-sm font-medium transition-colors <?php echo basename($_SERVER['PHP_SELF']) == 'enrolled.php' ? 'text-green-600' : ''; ?>">
                    Tags
                </a>
                <a href="./UserTable.php" class="text-gray-700 hover:text-green-600 px-3 py-2 rounded-md text-sm font-medium transition-colors <?php echo basename($_SERVER['PHP_SELF']) == 'enrolled.php' ? 'text-green-600' : ''; ?>">
                    User
                </a>
                <button onclick="window.location.href='./logout.php'" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors text-sm font-medium">
                    Logout
                </button>
            </div>

            <!-- Mobile menu button -->
            <div class="md:hidden flex items-center">
                <button type="button" class="mobile-menu-button inline-flex items-center justify-center p-2 rounded-md text-gray-700 hover:text-green-600 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-green-500" aria-controls="mobile-menu" aria-expanded="false">
                    <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu -->
    <div class="md:hidden hidden" id="mobile-menu">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
            <a href="./Dashboard.php" class="text-gray-700 hover:text-green-600 block px-3 py-2 rounded-md text-base font-medium">Dashboard</a>
            <a href="./CategoryTable.php" class="text-gray-700 hover:text-green-600 block px-3 py-2 rounded-md text-base font-medium">Category</a>
            <a href="./TableCours.php" class="text-gray-700 hover:text-green-600 block px-3 py-2 rounded-md text-base font-medium ">Courses</a>
            <a href="./TagsTable.php" class="text-gray-700 hover:text-green-600 block px-3 py-2 rounded-md text-base font-medium ">Tags</a>            
            <a href="./UserTable.php" class="text-gray-700 hover:text-green-600 block px-3 py-2 rounded-md text-base font-medium ">Users</a>            
            <a href="./logout.php" class="bg-green-600 text-white block px-3 py-2 rounded-md text-base font-medium hover:bg-green-700 transition-colors mt-2">Logout</a>
        </div>
    </div>
</nav>
    <div class="min-h-screen">

        <!-- Header Section -->
        <div class="bg-white shadow mb-6">
            <div class="container mx-auto px-4 py-6">
                <h1 class="text-3xl font-bold text-gray-800">Teacher Dashboard</h1>
                <p class="text-gray-600 mt-1">Manage your courses and track your progress</p>
            </div>
        </div>

        <!-- Stats Section -->
        <div class="container mx-auto px-4 py-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                <!-- Category Cards -->
                <?php foreach ($nbrCourseBYCategory as $n): ?>
                    <div class="bg-white rounded-lg shadow-lg p-6 flex items-center justify-between border-l-4 border-blue-500 transition-transform transform hover:scale-105">
                        <!-- Category Icon -->
                        <div class="flex items-center space-x-4">
                            <div class="p-3 rounded-full bg-blue-100">
                                <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                            </div>
                            <!-- Category Name and Course Count -->
                            <div>
                                <p class="text-lg font-semibold text-gray-700 mb-1"><?= $n['nom'] ?></p>
                                <p class="text-xl font-bold text-gray-800"><?= $n['coursNbr'] ?> Courses</p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
        </div>
        <!-- Best Course Section -->
        <div class="container mx-auto px-4 py-6">
            <div class="bg-white rounded-lg shadow-lg p-6 flex items-center justify-between border-l-4 border-green-500 transition-transform transform hover:scale-105">
                <!-- Best Course Icon -->
                <div class="flex items-center space-x-4">
                    <div class="p-3 rounded-full bg-green-100">
                        <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </div>
                    <!-- Best Course Info -->
                    <div>
                        <p class="text-lg font-semibold text-gray-700 mb-1">Best Course</p>
                        <p class="text-xl font-bold text-gray-800"><?= $bestCourse['titre'] ?> </p>
                        <p class="text-md text-gray-600"><?= $bestCourse['etudNbr'] ?> Students Enrolled</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Top 3 Teachers Section -->
        <div class="container mx-auto px-4 py-6">
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Top 3 Teachers</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                    <?php foreach ($topTeachers as $teacher): ?>
                        <div class="bg-white rounded-lg shadow-lg p-6 flex items-center justify-between border-l-4 border-purple-500 transition-transform transform hover:scale-105">
                            <!-- Teacher Icon -->
                            <div class="flex items-center space-x-4">
                                <div class="p-3 rounded-full bg-purple-100">
                                    <svg class="w-8 h-8 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                    </svg>
                                </div>
                                <!-- Teacher Name and Enrollment Count -->
                                <div>
                                    <p class="text-lg font-semibold text-gray-700 mb-1"><?= $teacher['name'] ?></p>
                                    <p class="text-xl font-bold text-gray-800"><?= $teacher['enrolle_count'] ?> Enrollments</p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

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
                                <th class="px-6 py-3">Name</th>
                                <th class="px-6 py-3">Email</th>
                                <th class="px-6 py-3">Status</th>
                                <th class="px-6 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($enseiants as $enseiant): ?>
                                <tr class="bg-white border-b hover:bg-gray-50">
                                    <td class="px-6 py-4"><?= $enseiant['id'] ?></td>
                                    <td class="px-6 py-4 font-medium text-gray-900"><?= $enseiant['name'] ?></td>
                                    <td class="px-6 py-4"><?= $enseiant['email'] ?></td>
                                    <td class="px-6 py-4"><?= $enseiant['status'] ?></td>
                                    <td class="px-6 py-4">
                                        <div class="flex space-x-3">
                                            <a href="./activerEnseignant.php?id=<?= $enseiant['id'] ?>" class="text-blue-600 hover:text-blue-900">
                                                Activate
                                            </a>
                                            <a href="./DesactiverEnseignant.php?id=<?= $enseiant['id'] ?>" class="text-red-600 hover:text-red-900"
                                                onclick="return confirm('Are you sure you want to deactivate this teacher?');">
                                                Deactivate
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
        $(document).ready(function () {
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
    const mobileMenuButton = document.querySelector('.mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');

    mobileMenuButton.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });
    </script>
</body>

</html>
