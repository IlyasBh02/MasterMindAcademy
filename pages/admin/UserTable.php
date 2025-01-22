<?php 
require_once __DIR__."/../../class/Admin.php";

$Users = Admin::getallUser();
if(isset($_SESSION['role']) && $_SESSION['role'] != 'Admin'){
    header("Location: ../enseignant/unauthorizedPage.php");
    exit;
}

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
                <a href="./UserTable" class="text-gray-700 hover:text-green-600 px-3 py-2 rounded-md text-sm font-medium transition-colors <?php echo basename($_SERVER['PHP_SELF']) == 'enrolled.php' ? 'text-green-600' : ''; ?>">
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
        const mobileMenuButton = document.querySelector('.mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');

    mobileMenuButton.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });
    </script>
</body>
</html>