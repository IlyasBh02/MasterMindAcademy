<?php 
require_once __DIR__."/../../class/Category.php";
$categories = Category::showcateroies();

if(isset($_POST['submit'])){

    $categorie = $_POST['category'];
    
    $cat = new Category($categorie);
    $cat->createCategory();

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
                <h2 class="text-xl font-semibold text-gray-800">Category Management</h2>
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
                        foreach ($categories as $c): ?>
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="px-6 py-4"><?= $c['idCategory'] ?></td>
                            <td class="px-6 py-4 font-medium text-gray-900"><?= $c['nom'] ?></td>
                            <td class="px-6 py-4">
                                <div class="flex space-x-3">
                                    <a href="./updateCategory.php?id=<?= $c['idCategory']  ?>"
                                        class="text-blue-600 hover:text-blue-900">
                                        Edit
                                    </a>
                                    <a href="./deleteCategory.php?id=<?= $c['idCategory']  ?>"
                                        class="text-red-600 hover:text-red-900"
                                        onclick="return confirm('Are you sure you want to delete this category?');">
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
                    <h3 class="text-xl font-semibold text-gray-900">Add New Category</h3>
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
                            name="category"
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

    </script>
</body>
</html>