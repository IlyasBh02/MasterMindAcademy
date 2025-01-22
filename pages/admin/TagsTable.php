<?php 
require_once __DIR__."/../../session_start.php";
if(isset($_SESSION['role']) && $_SESSION['role'] != 'Admin'){
    header("Location: ../enseignant/unauthorizedPage.php");
    exit;
}
require_once __DIR__."/../../class/Tag.php";
$tags = tag::showTags();

if(isset($_POST['submit'])){
    $tago = $_POST['tags'];

    $tag = new tag($tago);

    if($tag->createTags()){
        header("Location: /edex-html/pages/admin/TagsTable.php");
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tags Management - EduPortal</title>
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
    <!-- Add Tag Button -->
    <div class="container mx-auto px-4 py-6">
        <button onclick="openModal()" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition-colors duration-300 flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Add New Tags
        </button>
    </div>

    <!-- Tags Table Section -->
    <div class="container mx-auto px-4 pb-8">
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-6 border-b">
                <h2 class="text-xl font-semibold text-gray-800">Tags Management</h2>
            </div>
            <div class="p-6">
                <table id="coursesTable" class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-white uppercase bg-green-600">
                        <tr>
                            <th class="px-6 py-3">ID</th>
                            <th class="px-6 py-3">Name</th>
                            <th class="px-6 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        // echo"<pre>";
                        // var_dump($tags[0]);
                         
                        // die;
                        foreach ($tags as $tag): ?>
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="px-6 py-4"><?= $tag['idTag'] ?></td>
                            <td class="px-6 py-4 font-medium text-gray-900"><?= $tag['nom'] ?></td>
                            <td class="px-6 py-4">
                                <div class="flex space-x-3">
                                    <a href="./updateTag.php?id=<?= $tag['idTag'] ?>"
                                        class="text-blue-600 hover:text-blue-900">
                                        Edit
                                    </a>
                                    <a href="./deleteTag.php?id=<?= $tag['idTag'] ?>"
                                        class="text-red-600 hover:text-red-900"
                                        onclick="return confirm('Are you sure you want to delete this tag?');">
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

    <!-- Modal Backdrop -->
    <div id="modalBackdrop" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center">
        <!-- Modal Content -->
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-4">
            <!-- Modal Header -->
            <div class="border-b px-6 py-4">
                <div class="flex items-center justify-between">
                    <h3 class="text-xl font-semibold text-gray-900">Add New Tags</h3>
                    <button onclick="closeModal()" class="text-gray-400 hover:text-gray-500">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Modal Body -->
            <form action="" method="post">
            <div class="p-6">
                <div class="space-y-4">
                    <!-- Tags Input Container -->


                    <div id="tagsContainer" class="space-y-3">
                        <div class="flex items-center gap-2">
                            <input type="text" 
                            name="tags"
                                class="flex-1 border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-500 focus:border-transparent outline-none" 
                                placeholder="Enter tag name">
                        </div>
                    </div>

                </div>
            </div>

            <!-- Modal Footer -->
            <div class="border-t px-6 py-4 bg-gray-50 flex justify-end gap-3 rounded-b-lg">
                <button onclick="closeModal()" 
                        class="px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 rounded-lg transition-colors duration-300">
                    Cancel
                </button>
                <button name="submit" 
                        class="px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-lg hover:bg-green-700 transition-colors duration-300">
                    Save Tags
                </button>
                </form>
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
                    "search": "Search tags:",
                    "paginate": {
                        "next": "→",
                        "previous": "←"
                    }
                }
            });
        });

        // Modal functions
        function openModal() {
            document.getElementById('modalBackdrop').classList.remove('hidden');
            document.getElementById('modalBackdrop').classList.add('flex');
            document.body.style.overflow = 'hidden';
        }
        function closeModal() {
            document.getElementById('modalBackdrop').classList.add('hidden');
            document.getElementById('modalBackdrop').classList.remove('flex');
            document.body.style.overflow = 'auto';
            
        }

    const mobileMenuButton = document.querySelector('.mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');

    mobileMenuButton.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });
    </script>
</body>
</html>