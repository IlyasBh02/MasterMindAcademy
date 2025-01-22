<?php
// Include database connection
// session_start();
require_once __DIR__."/../../class/Enseignant.php";
if(!isset($_SESSION['role']) && $_SESSION['role'] != 'Enseignant'){
    header("Location: ./unauthorizedPage.php");
    exit;
}
if (isset($_SESSION['status']) &&  $_SESSION['status'] == 'not allowed') {
    header("Location: ./bannedPage.php");
    exit();
}
$enseignantId = $_SESSION['userId'];
$cours = Enseignant::MesInscription($enseignantId);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Courses - EduPortal</title>
    <!-- Include Tailwind CSS for styling -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Include DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Include DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
</head>
<body class="bg-gray-100">

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
                <a href="./MyCourses.php" class="text-gray-700 hover:text-green-600 px-3 py-2 rounded-md text-sm font-medium transition-colors <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'text-green-600' : ''; ?>">
                    MyCourses
                </a>
                <a href="" class="text-gray-700 hover:text-green-600 px-3 py-2 rounded-md text-sm font-medium transition-colors <?php echo basename($_SERVER['PHP_SELF']) == 'mycourses.php' ? 'text-green-600' : ''; ?>">
                    MyStudents
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
            <a href="./MyCourses.php" class="text-gray-700 hover:text-green-600 block px-3 py-2 rounded-md text-base font-medium">My Courses</a>
            <a href="./MesInscription.php" class="text-gray-700 hover:text-green-600 block px-3 py-2 rounded-md text-base font-medium ">My Students</a>
            <a href="./logout.php" class="bg-green-600 text-white block px-3 py-2 rounded-md text-base font-medium hover:bg-green-700 transition-colors mt-2">Logout</a>
        </div>
    </div>
</nav>
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-semibold text-gray-800 mb-4">My Courses</h1>
        
        <table id="example" class="display table-auto w-full text-sm text-left text-gray-600">
            <thead class="bg-green-500 text-white">
                <tr>
                    <th class="py-3 px-4">StudentName</th>
                    <th class="py-3 px-4">CourseTitle</th>
                    <th class="py-3 px-4">TeacherName</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                <?php foreach($cours as $cour): ?>
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-3 px-4"><?= $cour['StudentName'] ?></td>
                        <td class="py-3 px-4"><?= $cour['CourseTitle'] ?></td>
                        <td class="py-3 px-4"><?= $cour['TeacherName'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script>
        $(document).ready(function () {
            // Initialize DataTables
            $('#example').DataTable({
                "pagingType": "simple_numbers",
                "pageLength": 10,
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
