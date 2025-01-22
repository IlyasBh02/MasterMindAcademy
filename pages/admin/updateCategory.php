<?php
require_once __DIR__."/../../session_start.php";
if(isset($_SESSION['role']) && $_SESSION['role'] != 'Admin'){
    header("Location: ../enseignant/unauthorizedPage.php");
    exit;
}
require_once __DIR__."/../../class/Category.php";

$id = $_GET['id'];

$value = Category::selectById($id);

if(isset($_POST['submit'])){
    $CAT = $_POST['cats'];
    $CATID = $_POST['idcat'];

    $c = new Category($CAT);
    if($c->updateCategory($CATID)){
        header("Location: ./CategoryTable.php");
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Tag</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans leading-tight tracking-tight">

    <!-- Main Container -->
    <div class="container mx-auto px-4 py-12">
        <div class="max-w-lg mx-auto bg-white p-8 rounded-lg shadow-xl space-y-6">
            
            <!-- Header Section -->
            <div class="text-center">
                <h2 class="text-2xl font-semibold text-gray-800">Update Category</h2>
                <p class="mt-2 text-gray-500">Please enter the name of the tag you want to Category.</p>
            </div>

            <!-- Form to Add Tag -->
            <form action="" method="post" class="space-y-4">
                <div class="space-y-2">
                    <input type="hidden" name="idcat" value="<?= $value['idCategory']?>">
                    <label for="cats" class="block text-sm font-medium text-gray-700">category Name</label>
                    <input type="text" id="cats" name="cats" value="<?= $value['nom']?>"
                        class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-green-500 focus:border-transparent outline-none transition-all ease-in-out duration-200"
                        placeholder="Enter a tag name" required>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-center">
                    <button type="submit" name="submit" class="w-full px-6 py-3 text-lg font-semibold text-white bg-green-600 rounded-lg shadow-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-colors duration-300">
                        Save category
                    </button>
                </div>
            </form>

            <!-- Footer Section -->
            <div class="text-center text-sm text-gray-500">
                <p>By submitting, you are adding a new tag to your system.</p>
            </div>
        </div>
    </div>

    <script>
        // You can add additional JavaScript here for more dynamic behavior if needed.
    </script>
</body>
</html>
