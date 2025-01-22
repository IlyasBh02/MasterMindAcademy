<?php
require_once __DIR__."/../../session_start.php";
if(!isset($_SESSION['role']) && $_SESSION['role'] != 'Enseignant'){
    header("Location: ./unauthorizedPage.php");
    exit;
}
if (isset($_SESSION['status']) &&  $_SESSION['status'] == 'not allowed') {
    header("Location: ./bannedPage.php");
}
require_once __DIR__ . "/../../class/Course.php";
require_once __DIR__."/../../class/TextCourse.php";
require_once __DIR__."/../../class/VedeoCourse.php";
require_once __DIR__."/../../class/Category.php";
$userId = $_SESSION['userId'];
$id = $_GET['id'];
$course = course::showCourseById($id);
// print_r($course);

$categories = Category::showcateroies();

if (isset($_POST['submit'])) {
    if ($course['type'] == 'text') {
        $textCourse = new TextCourse($_POST['titre'], $_POST['description'], $_POST['contenu'], null, $_POST['categorie_id'], $userId, $_POST['price']);
        if($textCourse->updateCourse($_POST['idCours'])){
            header("Location: ./MyCourses.php");
        }
    } else if ($course['type'] == 'vedeo') {
        if (isset($_FILES['contentVedeo'])) {
            $videoFile = $_FILES['contentVedeo']['name'];
            $videoPath = __DIR__ . "/../../uploads/" . basename($videoFile);
            move_uploaded_file($_FILES['contentVedeo']['tmp_name'], $videoPath);
            $VedeoCourse = new VedeoCourse($_POST['titre'], $_POST['description'], null, $videoFile, $_POST['categorie_id'], $userId, $_POST['price']);
            if($VedeoCourse->updateCourse($_POST['idCours'])){
                header("Location: ./MyCourses.php");
            }
        }
    }
}

// if($course['type'] == "text"){
//     $textCourse = new VedeoCourse($_POST['titre'],$_POST['description'],null,$_POST['vedeo'],$_POST['categorie_id'],$_POST['price'],$_POST['tags']);
//     $textCourse->updateCourse($_POST['idCours']);
// }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit my course</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <form action="" method="POST" class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded-lg" enctype="multipart/form-data">
        <!-- Hidden ID Field -->
        <input type="hidden" name="idCours" value="<?= $course['idCours'] ?>">

        <!-- Titre -->
        <div class="mb-4">
            <label for="titre" class="block text-gray-700 font-medium mb-2">Titre:</label>
            <input type="text" id="titre" name="titre" value="<?= $course['titre'] ?>"
                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" required>
        </div>

        <!-- Description -->
        <div class="mb-4">
            <label for="description" class="block text-gray-700 font-medium mb-2">Description:</label>
            <textarea id="description" name="description" rows="4"
                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"><?= $course['description'] ?></textarea>
        </div>
        <?php if($course['type'] == "text"): ?>
        <!-- Contenu -->
        <div class="mb-4">
            <label for="contenu" class="block text-gray-700 font-medium mb-2">Contenu:</label>
            <textarea id="contenu" name="contenu" rows="4"
                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"><?php echo !empty($course['contenu']) ? $course['contenu'] : "...." ?></textarea>
        </div>
        <?php endif; ?>
        <?php if($course['type'] == "vedeo"):?>
        <div id="fileInputContainer" class="mb-6">
                        <label class="block mb-2 text-gray-600">Upload Video</label>
                            <input type="file" name="contentVedeo" class="file-upload-input" id="fileInput">
                            
        </div>
        <?php endif; ?>
        <!-- Catégorie -->
        <div class="mb-4">
            <label for="categorie" class="block text-gray-700 font-medium mb-2">Catégorie:</label>
            <select id="categorie" name="categorie_id"
            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                <?php foreach ($categories as $categorie): ?>
                    <option value="<?= $categorie['idCategory'] ?>">
                        <?= $categorie['nom'] ?>
                    </option>
                <?php endforeach; ?>
            </select>

        </div>
        <!-- Price -->
        <div class="mb-4">
            <label for="price" class="block text-gray-700 font-medium mb-2">Price:</label>
            <input type="number" id="price" name="price" value="<?= $course['price'] ?>"
                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" step="0.01" required>
        </div>

        <!-- Date Created (read-only) -->
        <div class="mb-4">
            <label for="date_created" class="block text-gray-700 font-medium mb-2">Date Created:</label>
            <input type="text" id="date_created" name="date_created" value="<?= $course['date_creation'] ?>"
                class="w-full px-3 py-2 border rounded-lg bg-gray-100" readonly>
        </div>

        <!-- Submit Button -->
        <div class="text-right">
            <button type="submit" name="submit" class="px-6 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700">
                Update Course
            </button>
        </div>
    </form>

</body>

</html>