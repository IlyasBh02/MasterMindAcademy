<?php
require_once __DIR__ . "/../../class/Course.php";
$courses = Course::showCourses(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses Management - EduPortal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
</head>
<body class="bg-gray-50">
    <!-- Courses Table Section -->
    <div class="container mx-auto px-4 py-6">
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-6 border-b">
                <h2 class="text-xl font-semibold text-gray-800">Courses Management</h2>
            </div>
            <div class="p-6">
                <table id="coursesTable" class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-white uppercase bg-green-600">
                        <tr>
                            <th class="px-6 py-3">Course ID</th>
                            <th class="px-6 py-3">Title</th>
                            <th class="px-6 py-3">Description</th>
                            <th class="px-6 py-3">Content</th>
                            <th class="px-6 py-3">Video Link</th>
                            <th class="px-6 py-3">Category</th>
                            <th class="px-6 py-3">Instructor</th>
                            <th class="px-6 py-3">Tags</th>
                            <th class="px-6 py-3">Creation Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($courses as $course): ?>
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="px-6 py-4"><?= $course['idCours'] ?></td>
                            <td class="px-6 py-4 font-medium text-gray-900"><?= $course['titre'] ?></td>
                            <td class="px-6 py-4"><?= $course['description'] ?></td>
                            <td class="px-6 py-4 max-w-xs  truncate"><?= $course['contenu'] ?></td>
                            <td class="px-6 py-4"><?= $course['vedeo'] ?></td>
                            <td class="px-6 py-4"><?= $course['CategoryName'] ?></td>
                            <td class="px-6 py-4"><?= $course['Enseignant'] ?></td>
                            <td class="px-6 py-4"><?= $course['tags'] ?></td>
                            <td class="px-6 py-4"><?= $course['date_creation'] ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        // DataTable initialization
        $(document).ready(function() {
            $('#coursesTable').DataTable({
                "pagingType": "simple_numbers",
                "pageLength": 10,
                "order": [[0, "desc"]],
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