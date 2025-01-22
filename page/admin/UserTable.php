<?php 
require_once __DIR__."/../../class/Admin.php";

$Users = Admin::getallUser();


?>
<html>
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard - EduPortal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    </head>
    <body>
        
           <!-- Courses Table Section -->
           <div class="container mx-auto px-4 pb-8">
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="p-6 border-b">
                    <h2 class="text-xl font-semibold text-gray-800">Users</h2>
                </div>
                <div class="p-6">
                    <table id="coursesTable" class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-white uppercase bg-green-600">
                            <tr>
                                <th class="px-6 py-3">ID</th>
                                <th class="px-6 py-3">name</th>
                                <th class="px-6 py-3">email</th>
                                <th class="px-6 py-3">status</th>
                                <th class="px-6 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($Users as $user): ?>
                                <tr class="bg-white border-b hover:bg-gray-50">
                                    <td class="px-6 py-4"><?= $user['id'] ?></td>
                                    <td class="px-6 py-4 font-medium text-gray-900"><?= $user['name'] ?></td>
                                    <td class="px-6 py-4"><?= $user['email'] ?></td>
                                    <td class="px-6 py-4 truncate max-w-xs"><?= $user['status'] ?></td>
                                    <td class="px-6 py-4">
                                        <div class="flex space-x-3">
                                            <a href="./activerUser.php?id=<?= $user['id'] ?>"
                                                class="text-blue-600 hover:text-blue-900">
                                                activer
                                            </a>
                                            <a href="./desactiverUser.php?id=<?= $user['id'] ?>"
                                                class="text-red-600 hover:text-red-900"
                                                onclick="return confirm('Are you sure you want to desactive this user?');">
                                                desactiver
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