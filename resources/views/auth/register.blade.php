<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <style>
        body {
            background: url('https://i.pinimg.com/736x/76/81/f8/7681f870d4cd077faadb10133adea313.jpg') no-repeat center center fixed;
            background-size: cover;
        }
    </style>
</head>
<body class="flex items-center justify-end min-h-screen bg-gray-900 bg-opacity-50">
    <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-md border border-black relative mr-10">
        <h1 class="text-4xl font-bold text-gray-900 mb-6 text-center">Register</h1>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <!-- Name Input -->
            <div class="mb-4">
                <label for="name" class="block text-lg font-bold text-gray-900">Name</label>
                <input type="text" id="name" name="name" class="mt-1 block w-full px-4 py-2 border border-gray-400 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-lg" required>
            </div>
            <!-- Email Input -->
            <div class="mb-4">
                <label for="email" class="block text-lg font-bold text-gray-900">Email</label>
                <input type="email" id="email" name="email" class="mt-1 block w-full px-4 py-2 border border-gray-400 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-lg" required>
            </div>
            <!-- Password Input -->
            <div class="mb-4 relative">
                <label for="password" class="block text-lg font-bold text-gray-900">Password</label>
                <input type="password" id="password" name="password" 
                       class="mt-1 block w-full px-4 py-2 border border-gray-400 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-lg" 
                       required>
                <button type="button" id="togglePassword" 
                        class="mt-4 absolute top-1/2 right-3 -translate-y-1/2 flex items-center">
                    <svg id="eyeOpenPassword" class="w-6 h-6 text-gray-800" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none">
                        <path d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z" stroke="currentColor" stroke-width="2"/>
                        <path d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" stroke="currentColor" stroke-width="2"/>
                    </svg>
                    <svg id="eyeClosedPassword" class="w-6 h-6 text-gray-800 hidden" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none">
                        <path d="M3.933 13.909A4.357 4.357 0 0 1 3 12c0-1 4-6 9-6m7.6 3.8A5.068 5.068 0 0 1 21 12c0 1-3 6-9 6-.314 0-.62-.014-.918-.04M5 19 19 5m-4 7a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                    </svg>
                </button>
            </div>
            <!-- Confirm Password Input -->
            <div class="mb-6 relative">
                <label for="password_confirmation" class="block text-lg font-bold text-gray-900">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" 
                       class="mt-1 block w-full px-4 py-2 border border-gray-400 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-lg" 
                       required>
                <button type="button" id="toggleConfirmPassword" 
                        class="mt-4 absolute top-1/2 right-3 -translate-y-1/2 flex items-center">
                    <svg id="eyeOpenConfirm" class="w-6 h-6 text-gray-800" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none">
                        <path d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z" stroke="currentColor" stroke-width="2"/>
                        <path d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" stroke="currentColor" stroke-width="2"/>
                    </svg>
                    <svg id="eyeClosedConfirm" class="w-6 h-6 text-gray-800 hidden" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none">
                        <path d="M3.933 13.909A4.357 4.357 0 0 1 3 12c0-1 4-6 9-6m7.6 3.8A5.068 5.068 0 0 1 21 12c0 1-3 6-9 6-.314 0-.62-.014-.918-.04M5 19 19 5m-4 7a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                    </svg>
                </button>
            </div>
            <!-- Submit Button -->
            <button type="submit" class="w-full py-2 bg-green-600 text-white font-bold rounded-md hover:bg-green-700 text-lg transition duration-300">
                Register
            </button>
        </form>
        <div class="text-center mt-4">
            <p class="text-lg text-gray-700">Already have an account? <a href="#" class="text-blue-500 font-bold hover:underline">Login</a></p>
        </div>
    </div>
    <script>
        function toggleVisibility(inputId, openIconId, closedIconId) {
            const input = document.getElementById(inputId);
            const openIcon = document.getElementById(openIconId);
            const closedIcon = document.getElementById(closedIconId);
            const isPassword = input.type === "password";
            input.type = isPassword ? "text" : "password";
            openIcon.classList.toggle("hidden", !isPassword);
            closedIcon.classList.toggle("hidden", isPassword);
        }

        document.getElementById("togglePassword").addEventListener("click", () => {
            toggleVisibility("password", "eyeOpenPassword", "eyeClosedPassword");
        });

        document.getElementById("toggleConfirmPassword").addEventListener("click", () => {
            toggleVisibility("password_confirmation", "eyeOpenConfirm", "eyeClosedConfirm");
        });
    </script>
</body>
</html>
