<?php
require_once __DIR__."/../../session_start.php";  


if(!isset($_SESSION['role']) && $_SESSION['role'] != 'Enseignant'){
    header("Location: ./unauthorizedPage.php");
    exit;
}
if (isset($_SESSION['status']) &&  $_SESSION['status'] == 'not allowed') {
    header("Location: ./bannedPage.php");
    exit;
}
require __DIR__ . "/../../class/Tag.php";
require __DIR__ . "/../../class/Category.php";
require_once __DIR__ . "/../../class/VedeoCourse.php";
require_once __DIR__ . "/../../class/TextCourse.php";
// require_once __DIR__."/../../class/Enseignant.php";
// Enseignant::logout();
$tags = tag::showTags();
$categories = Category::showcateroies();
if (isset($_POST['submit'])) {
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $content = $_POST['content'];
    $categorieId = $_POST['categorieId'];
    $tagsArray = $_POST['tags'];
    $enseignantId = $_SESSION['userId'];
    $price = $_POST['price'];

    if (!isset($_POST['checkbox'])) {
        if (!empty($_FILES['contentVedeo']['name'])) {
            $targetDir = __DIR__."/../../uploads/";
            $vedeoName = basename($_FILES['contentVedeo']['name']);
            $targetFilePath = $targetDir . $vedeoName;

            if (move_uploaded_file($_FILES['contentVedeo']['tmp_name'], $targetFilePath)) {
                $obj = new VedeoCourse($titre, $description, null, $vedeoName, $categorieId, $enseignantId,$price);
                $obj->createCourse($tagsArray);
            } else {
                echo "Error uploading file. Please check directory permissions.";
            }
        } else {
            echo "No video file selected.";
        }
    } else {
        if (!empty($content)) {
            $obj = new TextCourse($titre, $description, $content, null, $categorieId, $enseignantId,$price);
            $obj->createCourse($tagsArray);
        } else {
            echo "Please provide course content.";
        }
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Course</title>
    <link href="../../public/output.css" rel="stylesheet">
    <style>
        .file-upload-container {
            position: relative;
            width: 100%;
            min-height: 120px;
            border: 2px dashed #e2e8f0;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            background-color: #f8fafc;
            overflow: hidden;
        }

        .file-upload-container:hover {
            border-color: #1A906B;
            background-color: #f0fdf4;
        }

        .file-upload-input {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            opacity: 0;
            cursor: pointer;
        }

        .upload-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 12px;
            padding: 20px;
            text-align: center;
        }

        .upload-icon {
            color: #1A906B;
            transition: transform 0.3s ease;
        }

        .file-upload-container:hover .upload-icon {
            transform: translateY(-5px);
        }

        .selected-file {
            display: none;
            width: 100%;
            padding: 8px;
            background-color: #f0fdf4;
            border-radius: 6px;
            margin-top: 8px;
            font-size: 0.875rem;
            color: #1A906B;
        }

        .hidden {
            display: none;
        }
    </style>
</head>

<body>
    <!-- Course Registration Page -->
    <section class="bg-white relative min-h-screen overflow-hidden">
        <!-- Decorative SVGs -->
        <span class="absolute animate-bounce left-[50px] top-[80px] hidden 2xl:inline-block">
            <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="18" cy="18" r="16" stroke="#1A906B" stroke-width="4" fill="none" />
            </svg>
        </span>

        <div class="container px-4 sm:px-6 2xl:px-0 flex items-center justify-center min-h-screen relative z-10">
            <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-lg">
                <h2 class="text-primary-900 font-display font-semibold text-3xl mb-6 text-center">Create a New Course</h2>
                <form method="POST" enctype="multipart/form-data">
                    <div class="mb-6">
                        <input type="text" name="titre" placeholder="Course Title" class="w-full px-6 py-4 rounded border focus:outline-none focus:ring-1 focus:ring-primary-500 transition duration-300">
                    </div>
                    <div class="mb-6">
                        <input type="text" name="description" placeholder="Short Description" class="w-full px-6 py-4 rounded border focus:outline-none focus:ring-1 focus:ring-primary-500 transition duration-300">
                    </div>
                    <div class="mb-6">
                        <label class="inline-flex items-center">
                            <input type="checkbox" id="toggleInputType" name="checkbox" onclick="toggleContentInput(this)" class="form-checkbox text-primary-500">
                            <span class="ml-2 text-gray-600">Enter Text Content</span>
                        </label>
                    </div>
                    <div class="mb-6 hidden" id="TextContent">
                        <textarea name="content" rows="6" placeholder="Course Content" class="w-full px-6 py-4 rounded border focus:outline-none focus:ring-1 focus:ring-primary-500 transition duration-300"></textarea>
                    </div>
                    <div id="fileInputContainer" class="mb-6">
                        <label class="block mb-2 text-gray-600">Upload Video</label>
                        <div class="file-upload-container" id="uploadContainer">
                            <input type="file" name="contentVedeo" class="file-upload-input" id="fileInput" accept="video/*">
                            <div class="upload-content">
                                <svg class="upload-icon" width="40" height="40" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M7 10V9C7 6.23858 9.23858 4 12 4C14.7614 4 17 6.23858 17 9V10C19.2091 10 21 11.7909 21 14C21 16.2091 19.2091 18 17 18H7C4.79086 18 3 16.2091 3 14C3 11.7909 4.79086 10 7 10Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M12 12V15M12 15L14 13M12 15L10 13" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="text-sm text-gray-600">
                                    <span class="font-semibold text-primary-500">Click to upload</span>
                                    <div class="mt-1 text-xs text-gray-500">MP4, WebM or Ogg (MAX. 800MB)</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-6">
                        <select name="categorieId" class="w-full px-6 py-4 rounded border focus:outline-none focus:ring-1 focus:ring-primary-500 transition duration-300">
                            <option value="">Select Category</option>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= $category['idCategory'] ?>"><?= $category['nom'] ?></option>
                            <?php endforeach; ?>
                            <!-- Add more categories dynamically -->
                        </select>
                    </div>
                    <div class="mb-6">
                        <select name="tags[]" class="w-full px-6 py-4 rounded border focus:outline-none focus:ring-1 focus:ring-primary-500 transition duration-300" multiple>
                            <?php foreach ($tags as $tag): ?>
                                <option value="<?= $tag['idTag'] ?>"><?= $tag['nom'] ?></option>
                            <?php endforeach; ?>
                            <!-- Add more tags dynamically -->
                        </select>
                        <small class="text-gray-500">Hold Ctrl (or Cmd on Mac) to select multiple tags.</small>
                    </div>
                    <div class="mb-6">
                        <input type="number" name="price" placeholder="$" class="w-full px-6 py-4 rounded border focus:outline-none focus:ring-1 focus:ring-primary-500 transition duration-300">
                    </div>
                    <button type="submit" name="submit" class="w-full bg-primary-500 text-white font-display font-semibold py-4 px-6 rounded hover:bg-primary-600 transition duration-300">
                        Register Course
                    </button>
                </form>
            </div>
        </div>

        <!-- Floating circles -->
        <div class="absolute inset-0 overflow-hidden">
            <span class="absolute bg-primary-500 rounded-full opacity-20 w-40 h-40 -bottom-[60px] -right-[30px]"></span>
            <span class="absolute bg-blue-500 rounded-full opacity-30 w-52 h-52 -top-[80px] -left-[50px]"></span>
        </div>
    </section>
    <script>
        function toggleContentInput(checkbox) {
            const TextInputContainer = document.getElementById("TextContent");
            const fileInputContainer = document.getElementById("fileInputContainer");

            if (checkbox.checked) {
                TextInputContainer.style.display = "block";
                fileInputContainer.style.display = "none";
            } else {
                TextInputContainer.style.display = 'none';
                fileInputContainer.style.display = "block";
            }
        }
    </script>
</body>

</html>