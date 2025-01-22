<?php
// Include database connection
// session_start();
require_once __DIR__."/../../class/Enseignant.php";
$enseignantId = $_SESSION['userId'];
$cours = Enseignant::MesInscription($enseignantId);
if (isset($_SESSION['status']) &&  $_SESSION['status'] == 'not allowed') {
    header("Location: ./bannedPage.php");
}
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
    </script>
</body>
</html>