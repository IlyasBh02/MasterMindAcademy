<?php 
require __DIR__. "/../../class/Etudiant.php";
// require_once __DIR__."/../../class/Etudiant.php";
if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $test = Etudiant::login($email,$password);
    if($test){
        header("Location: ./AllCourses.php");
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="../../public/output.css" rel="stylesheet">
</head>
<body>
<!-- Login Page -->
<section class="bg-white relative min-h-screen overflow-hidden">
    <!-- Decorative SVGs -->
    <span class="absolute animate-bounce left-[50px] top-[80px] hidden 2xl:inline-block">
        <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M19.5046 24.6797L16.8046 32.0063C16.7247 32.2216 16.5808 32.4073 16.3923 32.5384C16.2038 32.6695 15.9796 32.7398 15.75 32.7398C15.5203 32.7398 15.2962 32.6695 15.1076 32.5384C14.9191 32.4073 14.7752 32.2216 14.6953 32.0063L11.9953 24.6797C11.9383 24.5251 11.8484 24.3846 11.7319 24.2681C11.6154 24.1516 11.4749 24.0617 11.3203 24.0047L3.99371 21.3047C3.77841 21.2248 3.59273 21.0809 3.4616 20.8924C3.33048 20.7038 3.26019 20.4797 3.26019 20.25C3.26019 20.0204 3.33048 19.7962 3.4616 19.6077C3.59273 19.4191 3.77841 19.2752 3.99371 19.1953L11.3203 16.4953C11.4749 16.4384 11.6154 16.3485 11.7319 16.232C11.8484 16.1154 11.9383 15.975 11.9953 15.8203L14.6953 8.49377C14.7752 8.27847 14.9191 8.09279 15.1076 7.96166C15.2962 7.83054 15.5203 7.76025 15.75 7.76025C15.9796 7.76025 16.2038 7.83054 16.3923 7.96166C16.5808 8.09279 16.7247 8.27847 16.8046 8.49377L19.5046 15.8203C19.5616 15.975 19.6515 16.1154 19.768 16.232C19.8846 16.3485 20.025 16.4384 20.1796 16.4953L27.5062 19.1953C27.7215 19.2752 27.9072 19.4191 28.0383 19.6077C28.1694 19.7962 28.2397 20.0204 28.2397 20.25C28.2397 20.4797 28.1694 20.7038 28.0383 20.8924C27.9072 21.0809 27.7215 21.2248 27.5062 21.3047L20.1796 24.0047C20.025 24.0617 19.8846 24.1516 19.768 24.2681C19.6515 24.3846 19.5616 24.5251 19.5046 24.6797Z" fill="#1A906B"/>
        </svg>
    </span>

    <span class="absolute animate-pulse right-[60px] top-[180px]">
        <svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="25" cy="25" r="24" stroke="#FF6A6A" stroke-width="2"/>
            <circle cx="25" cy="25" r="12" fill="#FF6A6A"/>
        </svg>
    </span>

    <span class="absolute animate-spin-slow bottom-[50px] left-[150px]">
        <svg width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M40 5A35 35 0 1 0 40 75A35 35 0 1 0 40 5Z" fill="none" stroke="#1A906B" stroke-width="5" />
        </svg>
    </span>

    <div class="container px-4 sm:px-6 2xl:px-0 flex items-center justify-center min-h-screen relative z-10">
        <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
            <h2 class="text-primary-900 font-display font-semibold text-3xl mb-6 text-center">Login</h2>
            <form method="POST">
                <div class="mb-6">
                    <input type="email" name="email" placeholder="Email Address" class="w-full px-6 py-4 rounded border focus:outline-none focus:ring-1 focus:ring-primary-500 transition duration-300">
                </div>
                <div class="mb-6">
                    <input type="password" name="password" placeholder="Password" class="w-full px-6 py-4 rounded border focus:outline-none focus:ring-1 focus:ring-primary-500 transition duration-300">
                </div>
                <button type="submit" name="submit" class="w-full bg-primary-500 text-white font-display font-semibold py-4 px-6 rounded hover:bg-primary-600 transition duration-300">
                    Login
                </button>
                <p class="text-center mt-6 text-gray-500">Don't have an account? <a href="register.html" class="text-primary-500 font-semibold">Sign up</a></p>
            </form>
        </div>
    </div>

    <!-- Floating circles -->
    <div class="absolute inset-0 overflow-hidden">
        <span class="absolute bg-primary-500 rounded-full opacity-20 w-40 h-40 -bottom-[60px] -right-[30px]"></span>
        <span class="absolute bg-blue-500 rounded-full opacity-30 w-52 h-52 -top-[80px] -left-[50px]"></span>
    </div>
</section>
</body>
</html>