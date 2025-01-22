<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Only start the session if it's not already active
}
require_once __DIR__."/../../class/Course.php";
$id = $_GET['id'];

$course = course::showCourseById($id);

// Check if the user is already enrolled in the course
if(isset($_SESSION['userId'])){
    $userId = $_SESSION['userId'];
    $userEnrolled = course::isUserEnrolled($userId,$id);
}

if(isset($_POST['submit'])){
    $userEnrolled = true;
    $coursId = $_POST['coursId'];
    $userId = $_SESSION['userId'];
    if(course::EnrollCourse($userId,$coursId)){
        $userEnrolled = true;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Description - Web Development Bootcamp</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gray-50">
    <!-- Hero Section -->
    <div class="bg-gradient-to-b from-green-50 to-white">
        <div class="container mx-auto px-4 py-8">
            <div class="grid lg:grid-cols-2 gap-12 items-start">
                <!-- Video/Image Section -->
                <?php if($course['type'] == "vedeo"): ?>
    <?php if($userEnrolled): // Check if the user is enrolled ?>
        <div class="relative group rounded-2xl overflow-hidden shadow-xl bg-black aspect-video">
            <video 
                id="courseVideo"
                class="w-full h-full object-cover"
                poster=""
                controls
            >
                <source src="<?= $course['video'] ?>" type="video/mp4">
                Your browser does not support the video tag.
            </video>
            <div class="absolute top-4 right-4 bg-green-500 text-white px-3 py-1 rounded-full text-sm font-medium">
                Video Course
            </div>
        </div>
    <?php else: ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Access Restricted!</strong>
            <span class="block sm:inline">You need to enroll in this course to access its content.</span>
        </div>
    <?php endif; ?>
<?php endif; ?>

<?php if($course['type'] == "text"): ?>
    <?php if($userEnrolled): // Check if the user is enrolled ?>
        <div class="bg-gray-100 border border-gray-400 text-gray-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Course Content:</strong>
            <span class="block sm:inline"><?= $course['contenu'] ?></span>
        </div>
    <?php else: ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Access Restricted!</strong>
            <span class="block sm:inline">You need to enroll in this course to access its content.</span>
        </div>
    <?php endif; ?>
<?php endif; ?>


                <!-- Course Info -->
                <div class="space-y-6">
                    <div>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                            <?= $course['CategoryName']?>
                        </span>
                    </div>
                    
                    <h1 class="text-4xl font-bold text-gray-900"><?= $course['titre']?></h1>
                    
                    <div class="flex items-center space-x-4 text-gray-600">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-yellow-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                            </svg>
                            <span class="ml-1">4.8</span>
                        </div>
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            </svg>
                            <span class="ml-1"><?= $course['Enseignant'] ?></span>
                        </div>
                    </div>

                    <p class="text-gray-600 text-lg">
                        <?= $course['description']?>
                </p>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="flex items-center space-x-2 text-gray-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 14"></polyline>
                            </svg>
                            <span><?=date('Y-m-d',strtotime($course['date_creation'])) ?></span>
                        </div>
                        <div class="flex items-center space-x-2 text-gray-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path>
                                <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path>
                            </svg>
                            <span>Online Access</span>
                        </div>
                    </div>
                    <div>
                    <?php 
                    // Split the tags by comma and display each as a badge
                    $tags = explode(',', $course['tags']); 
                    foreach ($tags as $tag): 
                    ?>
                        <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded mr-1">
                            <?= $tag ?>
                        </span>
                    <?php endforeach; ?>
                    </div>

                    <div class="flex items-center justify-between pt-6">
                        <div class="flex items-center space-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-green-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="12" y1="1" x2="12" y2="23"></line>
                                <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                            </svg>
                            <span class="text-2xl font-bold text-green-600"><?= $course['price']?></span>
                        </div>
                        <form action="" method="post">
                            <input type="hidden" name="coursId" value="<?= $course['idCours'] ?>" >
                            <button name="submit" class="px-8 py-3 bg-green-600 text-white rounded-full font-medium hover:bg-green-700 transition-colors duration-300">
                                Enroll Now
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Course Details Tabs -->
    <div class="container mx-auto px-4 py-12">
        <div class="bg-white rounded-xl shadow-lg p-6">
            <div class="border-b border-gray-200">
                <nav class="-mb-px flex space-x-8">
                    <button onclick="switchTab('overview')" class="border-green-600 text-green-600 whitespace-nowrap pb-4 px-1 border-b-2 font-medium text-sm" id="tab-overview">
                        Overview
                    </button>
                    <button onclick="switchTab('curriculum')" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap pb-4 px-1 border-b-2 font-medium text-sm" id="tab-curriculum">
                        Curriculum
                    </button>
                    <button onclick="switchTab('reviews')" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap pb-4 px-1 border-b-2 font-medium text-sm" id="tab-reviews">
                        Reviews
                    </button>
                </nav>
            </div>
            
            <div class="mt-8" id="tab-content-overview">
                <h3 class="text-lg font-medium text-gray-900 mb-4">What you'll learn</h3>
                <div class="grid md:grid-cols-2 gap-4">
                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mt-1 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-600">Build modern responsive websites</span>
                    </div>
                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mt-1 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-600">Master JavaScript fundamentals and ES6+</span>
                    </div>
                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mt-1 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-600">Create full-stack applications</span>
                    </div>
                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mt-1 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-600">Deploy applications to production</span>
                    </div>
                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mt-1 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-600">Implement authentication and authorization</span>
                    </div>
                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mt-1 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-gray-600">Work with databases and APIs</span>
                    </div>
                </div>
            </div>

            <div class="mt-8 hidden" id="tab-content-curriculum">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Course Curriculum</h3>
                <div class="space-y-4">
                    <div class="border rounded-lg p-4">
                        <h4 class="font-medium">Module 1: HTML & CSS Fundamentals</h4>
                        <p class="text-gray-600 mt-2">Learn the basics of web development with HTML5 and CSS3.</p>
                    </div>
                    <div class="border rounded-lg p-4">
                        <h4 class="font-medium">Module 2: JavaScript Essentials</h4>
                        <p class="text-gray-600 mt-2">Master core JavaScript concepts and modern ES6+ features.</p>
                    </div>
                    <div class="border rounded-lg p-4">
                        <h4 class="font-medium">Module 3: Backend Development</h4>
                        <p class="text-gray-600 mt-2">Build server-side applications with Node.js and Express.</p>
                    </div>
                </div>
            </div>

            <div class="mt-8 hidden" id="tab-content-reviews">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Student Reviews</h3>
                <div class="space-y-6">
                    <div class="border-b pb-6">
                        <div class="flex items-center mb-2">
                            <div class="flex text-yellow-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                            </div>
                            <span class="ml-2 text-gray-600">John Doe</span>
                        </div>
                        <p class="text-gray-600">This course exceeded my expectations. The content is well-structured and the instructor explains complex concepts clearly.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function switchTab(tabName) {
            // Hide all tab contents
            document.querySelectorAll('[id^="tab-content-"]').forEach(content => {
                content.classList.add('hidden');
            });
            
            // Show selected tab content
            document.getElementById(`tab-content-${tabName}`).classList.remove('hidden');
            
            // Reset all tab buttons
            document.querySelectorAll('[id^="tab-"]').forEach(tab => {
                tab.classList.remove('border-green-600', 'text-green-600');
                tab.classList.add('border-transparent', 'text-gray-500');
            });
            
            // Highlight selected tab button
            document.getElementById(`tab-${tabName}`).classList.remove('border-transparent', 'text-gray-500');
            document.getElementById(`tab-${tabName}`).classList.add('border-green-600', 'text-green-600');
        }
        const enrollButton = document.getElementById("Enroll")
        
    </script>
</body>
</html>