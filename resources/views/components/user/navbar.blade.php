<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ข่าวสาร</title>

    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Yuji+Mai&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: "Kanit", sans-serif;
            font-weight: 400;
            font-style: normal;
        }
        /* CSS Transition for Sidebar */
        #sidebar {
            transform: translateX(100%);
            transition: transform 0.3s ease-in-out;
        }
        #sidebar.show {
            transform: translateX(0);
        }
        /* Overlay Style */
        #overlay {
            background: rgba(0, 0, 0, 0.5);
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
            pointer-events: none;
        }
        #overlay.show {
            opacity: 1;
            pointer-events: auto; /* ทำให้ overlay คลิกได้ */
        }
    </style>

</head>
<body class="bg-gray-100">
    <!-- Navbar -->
    <nav class="bg-[#26806c] fixed w-full z-20 top-0 start-0 border-b border-gray-200">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="https://upload.wikimedia.org/wikipedia/th/8/8f/Logo_of_Prapokklao_Hospital.png" 
                class="h-12" 
                alt="Logo">
                <span class="self-center text-2xl text-[#F3CA52] whitespace-nowrap">โรงพยาบาลพระปกเกล้า</span>
            </a>
            <div class="flex md:order-2 space-x-3 rtl:space-x-reverse">
                
                <a href="/" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">  
                    <span class="flex-1 whitespace-nowrap">หน้าแรก</span>
                </a>

                <a href="/viewNews" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">  
                    <span class="flex-1 whitespace-nowrap">ข่าว</span>
                </a>

                <a href="/" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">  
                    <span class="flex-1 whitespace-nowrap">ข่าวด่วน</span>
                </a>

                <a href="/viewFuneral" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">  
                    <span class="flex-1 whitespace-nowrap">ข่าวแสดงความเสียใจ</span>
                </a>

                @guest
                <a href="login" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">  
                    <span class="flex-1 whitespace-nowrap">เข้าสู่ระบบ</span>
                </a>

                <a href="register" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">  
                    <span class="flex-1 whitespace-nowrap">สมัครสมาชิก</span>
                </a>
                @endguest

                @auth
                <a href="/" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">  
                    <span class="flex-1 whitespace-nowrap">{{ Auth::user()->name }}</span>
                </a>
                @endauth

                <div class="mr-8"></div>

                <!-- Sidebar Toggle Icon -->
                <button id="sidebarButton" type="button" class=" text-gray-700 hover:text-gray-900">
                    <!-- Hamburger Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-gray-900 rounded-lg hover:bg-gray-100 group">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 5.25h16.5M3.75 12h16.5M3.75 18.75h16.5" />
                    </svg>
                </button>
            </div>
        </div>
    </nav>

    <!-- Overlay -->
    <div id="overlay" class="fixed inset-0 bg-black z-40"></div>

    <!-- Sidebar -->
    <div id="sidebar" class="fixed top-0 right-0 w-[22rem] h-full bg-[#5DB996] text-white shadow-lg z-50 p-4">

        <!-- ปุ่มปิด Sidebar -->
        <button id="closeSidebar" class="absolute top-2 right-2 text-gray-400 hover:text-white focus:outline-none">

            <!-- Close Icon -->
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <!-- เนื้อหา Sidebar -->
        <h2 class="text-2xl font-bold mb-4">โรงพยาบาลพระปกเกล้า</h2>
        <ul>
            <!-- หน้าแรก -->
    <li class="mb-2">
        <a href="/" class="flex items-center p-3 bg-white text-gray-900 rounded-lg shadow hover:bg-gray-100">
            <svg class="w-[27px] h-[27px] text-gray-800" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                <path fill-rule="evenodd" d="M11.293 3.293a1 1 0 0 1 1.414 0l6 6 2 2a1 1 0 0 1-1.414 1.414L19 12.414V19a2 2 0 0 1-2 2h-3a1 1 0 0 1-1-1v-3h-2v3a1 1 0 0 1-1 1H7a2 2 0 0 1-2-2v-6.586l-.293.293a1 1 0 0 1-1.414-1.414l2-2 6-6Z" clip-rule="evenodd"/>
            </svg>
            <span class="ml-3 flex-1 text-base font-medium">หน้าแรก</span>
        </a>
    </li>

    @auth
    @if(auth()->user()->status === 'Admin' || auth()->user()->status === 'Editor')
    <li class="mb-2">
        <a href="/dashboard" class="flex items-center p-3 bg-white text-gray-900 rounded-lg shadow hover:bg-gray-100">
            <svg class="w-[27px] h-[27px] text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                <path d="M13.5 2c-.178 0-.356.013-.492.022l-.074.005a1 1 0 0 0-.934.998V11a1 1 0 0 0 1 1h7.975a1 1 0 0 0 .998-.934l.005-.074A7.04 7.04 0 0 0 22 10.5 8.5 8.5 0 0 0 13.5 2Z"/>
                <path d="M11 6.025a1 1 0 0 0-1.065-.998 8.5 8.5 0 1 0 9.038 9.039A1 1 0 0 0 17.975 13H11V6.025Z"/>
            </svg> 
            <span class="ml-3 flex-1 text-base font-medium">แดชบอร์ด</span>
        </a>
    </li>
    @endif
    @endauth

    <li class="mb-2" >
        <a href="/viewNews" class="flex items-center p-3 bg-white text-gray-900 rounded-lg shadow hover:bg-gray-100">
            <svg class="w-[27px] h-[27px] text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                <path fill-rule="evenodd" d="M5 3a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h11.5c.07 0 .14-.007.207-.021.095.014.193.021.293.021h2a2 2 0 0 0 2-2V7a1 1 0 0 0-1-1h-1a1 1 0 1 0 0 2v11h-2V5a2 2 0 0 0-2-2H5Zm7 4a1 1 0 0 1 1-1h.5a1 1 0 1 1 0 2H13a1 1 0 0 1-1-1Zm0 3a1 1 0 0 1 1-1h.5a1 1 0 1 1 0 2H13a1 1 0 0 1-1-1Zm-6 4a1 1 0 0 1 1-1h6a1 1 0 1 1 0 2H7a1 1 0 0 1-1-1Zm0 3a1 1 0 0 1 1-1h6a1 1 0 1 1 0 2H7a1 1 0 0 1-1-1ZM7 6a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H7Zm1 3V8h1v1H8Z" clip-rule="evenodd"/>
              </svg> 
            <span class="ml-3 flex-1 text-base font-medium">ข่าว</span>
        </a>
    </li>

    <li class="mb-2">
        <a href="/viewNews" class="flex items-center p-3 bg-white text-gray-900 rounded-lg shadow hover:bg-gray-100">
            <svg class="w-[27px] h-[27px] text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                <path fill-rule="evenodd" d="M5 3a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h11.5c.07 0 .14-.007.207-.021.095.014.193.021.293.021h2a2 2 0 0 0 2-2V7a1 1 0 0 0-1-1h-1a1 1 0 1 0 0 2v11h-2V5a2 2 0 0 0-2-2H5Zm7 4a1 1 0 0 1 1-1h.5a1 1 0 1 1 0 2H13a1 1 0 0 1-1-1Zm0 3a1 1 0 0 1 1-1h.5a1 1 0 1 1 0 2H13a1 1 0 0 1-1-1Zm-6 4a1 1 0 0 1 1-1h6a1 1 0 1 1 0 2H7a1 1 0 0 1-1-1Zm0 3a1 1 0 0 1 1-1h6a1 1 0 1 1 0 2H7a1 1 0 0 1-1-1ZM7 6a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H7Zm1 3V8h1v1H8Z" clip-rule="evenodd"/>
              </svg> 
            <span class="ml-3 flex-1 text-base font-medium">ข่าวด่วน</span>
        </a>
    </li>

             @guest
            <li class="mb-2">
                <a href="login" class="bg-white flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                    <svg class="w-[27px] h-[27px] text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M5 8a4 4 0 1 1 7.796 1.263l-2.533 2.534A4 4 0 0 1 5 8Zm4.06 5H7a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h2.172a2.999 2.999 0 0 1-.114-1.588l.674-3.372a3 3 0 0 1 .82-1.533L9.06 13Zm9.032-5a2.907 2.907 0 0 0-2.056.852L9.967 14.92a1 1 0 0 0-.273.51l-.675 3.373a1 1 0 0 0 1.177 1.177l3.372-.675a1 1 0 0 0 .511-.273l6.07-6.07a2.91 2.91 0 0 0-.944-4.742A2.907 2.907 0 0 0 18.092 8Z" clip-rule="evenodd"/>
                      </svg>                                                                   
                 <span class="flex-1 ms-3 whitespace-nowrap">เข้าสู่ระบบ</span>
                </a>
             </li>

             <li class="mb-2">
                <a href="register" class="bg-white flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                    <svg class="w-[27px] h-[27px] text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M9 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4H7Zm8-1a1 1 0 0 1 1-1h1v-1a1 1 0 1 1 2 0v1h1a1 1 0 1 1 0 2h-1v1a1 1 0 1 1-2 0v-1h-1a1 1 0 0 1-1-1Z" clip-rule="evenodd"/>
                      </svg>                                                                                        
                 <span class="flex-1 ms-3 whitespace-nowrap">สมัครสมาชิก</span>
                </a>
             </li>
             @endguest

              <!-- ออกจากระบบ -->
    @auth
    <li class="mb-2">
        <form action="/logout" method="POST" class="flex items-center">
            @csrf
            <button type="submit" class="text-start flex items-center w-full p-3 bg-white text-gray-900 rounded-lg shadow hover:bg-gray-100">
                <svg class="w-[27px] h-[27px] text-gray-800" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12H4m12 0-4 4m4-4-4-4m3-4h2a3 3 0 0 1 3 3v10a3 3 0 0 1-3 3h-2"/>
                </svg>
                <span class="ml-3 flex-1 text-base font-medium">ออกจากระบบ</span>
            </button>
        </form>
    </li>
    @endauth

        </ul>
    </div>

    <section class="mt-12">
        @yield('content')
    </section>

    <!-- JavaScript -->
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const sidebarButton = document.getElementById("sidebarButton");
            const closeSidebar = document.getElementById("closeSidebar");
            const sidebar = document.getElementById("sidebar");
            const overlay = document.getElementById("overlay");

            // เปิด Sidebar พร้อม Overlay
            sidebarButton.addEventListener("click", () => {
                sidebar.classList.add("show");
                overlay.classList.add("show");
            });

            // ปิด Sidebar และ Overlay
            const closeMenu = () => {
                sidebar.classList.remove("show");
                overlay.classList.remove("show");
            };

            closeSidebar.addEventListener("click", closeMenu);
            overlay.addEventListener("click", closeMenu); // ปิด Sidebar เมื่อคลิกที่ overlay
        });
    </script>
</body>
</html>