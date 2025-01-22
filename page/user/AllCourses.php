<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Only start the session if it's not already active
}
require_once __DIR__ . "/../../class/Course.php";
if(isset($_POST['submitSearch'])){
    $searchCourse = $_POST['searchInput'];
    $courses = course::search($searchCourse);
}
else{
    $itemPerPage = 4;
    // Get the current page
    $page = isset($_GET['page']) ? $_GET['page'] : 1;

    $courses = course::showCourses($page,$itemPerPage);

    // calculate the page number
    $totalCourse = course::CourseCount();
    $totalPage = ceil($totalCourse['total']/$itemPerPage);


}
// print_r( $_SESSION['nom']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduPortal - Online Learning Platform</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">
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
                <a href="../../index" class="text-gray-700 hover:text-green-600 px-3 py-2 rounded-md text-sm font-medium transition-colors <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'text-green-600' : ''; ?>">
                    Home
                </a>
                <a href="" class="text-gray-700 hover:text-green-600 px-3 py-2 rounded-md text-sm font-medium transition-colors <?php echo basename($_SERVER['PHP_SELF']) == 'mycourses.php' ? 'text-green-600' : ''; ?>">
                    Courses
                </a>
                <a href="./EnrolledCourses.php" class="text-gray-700 hover:text-green-600 px-3 py-2 rounded-md text-sm font-medium transition-colors <?php echo basename($_SERVER['PHP_SELF']) == 'enrolled.php' ? 'text-green-600' : ''; ?>">
                    Learning
                </a>
                <!-- <button onclick="window.location.href='./Userlogout.php'" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors text-sm font-medium">
                    Logout
                </button> -->
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
            <a href="index.php" class="text-gray-700 hover:text-green-600 block px-3 py-2 rounded-md text-base font-medium">Home</a>
            <a href="mycourses.php" class="text-gray-700 hover:text-green-600 block px-3 py-2 rounded-md text-base font-medium">My Courses</a>
            <a href="enrolled.php" class="text-gray-700 hover:text-green-600 block px-3 py-2 rounded-md text-base font-medium ">Learning</a>
            <a href="./Userlogout.php" class="bg-green-600 text-white block px-3 py-2 rounded-md text-base font-medium hover:bg-green-700 transition-colors mt-2">Logout</a>
        </div>
    </div>
</nav>
    <section class="min-h-screen bg-gradient-to-b from-green-50 to-white">
        <div class="container px-4 sm:px-6 2xl:px-0 mx-auto">
            <!-- Hero Section -->
            <div class="flex flex-col justify-center items-center lg:justify-between pt-10 lg:pt-20 lg:flex-row gap-12">
                <div class="max-w-[660px]" data-aos="fade-right">
                    <div class="relative group cursor-pointer">
                        <img src="/api/placeholder/600/400" alt="Learning Platform" class="relative z-10 rounded-2xl shadow-xl transition-transform group-hover:scale-105 duration-300">
                        <div class="absolute -inset-1 bg-gradient-to-r from-green-600 to-teal-600 rounded-2xl blur opacity-30 group-hover:opacity-50 transition duration-300"></div>
                        <div class="absolute -right-6 -bottom-6 w-24 h-24 bg-green-500 rounded-full animate-pulse opacity-50"></div>
                        <div class="absolute -left-4 -top-4 w-16 h-16 bg-teal-500 rounded-full animate-pulse opacity-50 delay-150"></div>
                    </div>
                </div>

                <div class="max-w-[660px]" data-aos="fade-left">
                    <h2 class="text-4xl md:text-5xl xl:text-6xl font-bold text-gray-900 mb-6">
                        Join <span class="text-green-600 relative">World's largest
                            <svg class="absolute -bottom-2 left-0 w-full" viewBox="0 0 100 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0 10 Q 25 0, 50 10 T 100 10" stroke="currentColor" fill="none" stroke-width="2" />
                            </svg>
                        </span> learning platform
                    </h2>
                    <p class="text-xl text-gray-600 mb-8">
                        Start your learning journey today with our expert-led courses
                    </p>
                    <button class="group relative inline-flex items-center px-8 py-3 text-lg font-medium text-white bg-green-600 rounded-full overflow-hidden transition-all hover:bg-green-700">
                        <span class="relative z-10">Start Learning Now</span>
                        <div class="absolute inset-0 -translate-x-full group-hover:translate-x-0 bg-gradient-to-r from-teal-600 to-green-600 transition-transform duration-300"></div>
                    </button>
                </div>
            </div>

            <!-- Search Bar Section -->
            <div class="mt-16 mb-8">
                <form action="" method="post">
                    <div class="w-full max-w-md mx-auto flex items-center bg-white p-4 rounded-full shadow-lg">
                        <input type="text" id="searchInput" name="searchInput" class="w-full px-4 py-2 text-lg text-gray-700 placeholder-gray-400 rounded-full focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Search for courses...">
                        <button id="searchButton" name="submitSearch" class="ml-3 text-green-600 font-medium hover:text-green-700">
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path d="M11 6C13.7614 6 16 8.23858 16 11M16.6588 16.6549L21 21M19 11C19 15.4183 15.4183 19 11 19C6.58172 19 3 15.4183 3 11C3 6.58172 6.58172 3 11 3C15.4183 3 19 6.58172 19 11Z" stroke="#4CAF50" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                </g>
                            </svg>
                        </button>
    
    
                    </div>
                </form>
            </div>

            <!-- Course Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mt-20 mb-16">
                <?php foreach ($courses as $course): ?>
                    <!-- Course Card 1 -->
                    <div class="group bg-white rounded-2xl shadow-lg overflow-hidden transform hover:-translate-y-2 transition-all duration-300" data-aos="fade-up" data-aos-delay="100">
                        <div class="relative">
                            <video width="320" height="240" alt="Course" class="w-full h-48 object-cover transition-transform duration-300 group-hover:scale-110">
                                <source src="../../uploads/<?= $course['vedeo'] ?>" type="video/mp4">
                            </video>
                            <div class="absolute top-4 right-4 bg-green-500 text-white px-3 py-1 rounded-full text-sm font-medium">
                                Popular
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center mb-3">
                                <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded"><?= $course['CategoryName'] ?></span>
                                <span class="ml-2 text-gray-500 text-sm">• 12 weeks</span>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2"><?= $course['titre'] ?></h3>
                            <p class="text-gray-600 mb-4"><?= $course['description'] ?></p>
                            <div class="flex justify-between items-center">
                                <span class="text-2xl font-bold text-green-600">$<?= $course['price'] ?></span>
                                <?php if (isset($_SESSION['userId']) && $_SESSION['role'] == 'Etudiant'): ?>
                                    <a href="./description.php?id=<?= $course['idCours'] ?>" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                                        Read More
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                <!-- Course Card 2 -->
                <!-- <div class="group bg-white rounded-2xl shadow-lg overflow-hidden transform hover:-translate-y-2 transition-all duration-300" data-aos="fade-up" data-aos-delay="200">
                    <div class="relative">
                        <img src="/api/placeholder/400/250" alt="Course" class="w-full h-48 object-cover transition-transform duration-300 group-hover:scale-110">
                        <div class="absolute top-4 right-4 bg-blue-500 text-white px-3 py-1 rounded-full text-sm font-medium">
                            New
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center mb-3">
                            <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">Data Science</span>
                            <span class="ml-2 text-gray-500 text-sm">• 8 weeks</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Data Science Fundamentals</h3>
                        <p class="text-gray-600 mb-4">Learn data analysis, visualization, and machine learning basics.</p>
                        <div class="flex justify-between items-center">
                            <span class="text-2xl font-bold text-blue-600">$59.99</span>
                            <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                Enroll Now
                            </button>
                        </div>
                    </div>
                </div> -->

                <!-- Course Card 3 -->
                <!-- <div class="group bg-white rounded-2xl shadow-lg overflow-hidden transform hover:-translate-y-2 transition-all duration-300" data-aos="fade-up" data-aos-delay="300">
                    <div class="relative">
                        <img src="/api/placeholder/400/250" alt="Course" class="w-full h-48 object-cover transition-transform duration-300 group-hover:scale-110">
                        <div class="absolute top-4 right-4 bg-purple-500 text-white px-3 py-1 rounded-full text-sm font-medium">
                            Featured
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center mb-3">
                            <span class="bg-purple-100 text-purple-800 text-xs font-medium px-2.5 py-0.5 rounded">UI/UX Design</span>
                            <span class="ml-2 text-gray-500 text-sm">• 10 weeks</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">UI/UX Design Masterclass</h3>
                        <p class="text-gray-600 mb-4">Create beautiful and user-friendly interfaces that convert.</p>
                        <div class="flex justify-between items-center">
                            <span class="text-2xl font-bold text-purple-600">$69.99</span>
                            <button class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors">
                                Enroll Now
                            </button>
                        </div>
                    </div>
                </div> -->
            </div>

            <!-- Pagination -->
            <div class="flex justify-center pb-20" data-aos="fade-up">
                <nav class="inline-flex rounded-lg shadow-sm">
                    <?php for($i = 1;$i<=$totalPage;$i++): ?>
                    <a href="?page=<?= $i?>" class="px-4 py-2 text-sm font-medium text-white bg-green-600 border border-green-600">
                        <?= $i ?>
                    </a>
                    <?php endfor; ?>
                </nav>
            </div>
        </div>
    </section>

    <script>
        AOS.init({
            duration: 800,
            easing: 'ease-out-cubic',
            once: true
        });
    const mobileMenuButton = document.querySelector('.mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');

    mobileMenuButton.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });
    </script>
</body>

</html>