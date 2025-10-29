<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'App Pegawai')</title>
    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        softpink: '#FFD1DC',
                        rosepink: '#FFC0CB',
                        blushpink: '#FFB6C1',
                        coralpeach: '#FFABAB',
                    }
                }
            }
        }
    </script>
    <style>
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        .fade-in { animation: fadeIn 0.5s ease-out; }
    </style>
</head>
<body class="min-h-screen" style="background: linear-gradient(135deg, #FFD1DC 0%, #FFC0CB 50%, #FFABAB 100%);">
    
    <!-- Sidebar Navigation -->
    <aside id="sidebar" class="fixed left-0 top-0 h-full w-64 text-gray-500 shadow-2xl z-50" style="background: linear-gradient(to bottom, #FFB6C1, #FFABAB);">
        <div class="p-6 border-b border-white/20">
            <div class="flex items-center space-x-3">
                <div id="logoBadge" class="w-12 h-12 rounded-xl flex items-center justify-center font-bold text-xl shadow-lg" style="background: linear-gradient(to bottom right, #FFD1DC, #FFC0CB); color: #FF69B4;">
                    AP
                </div>
                <div>
                    <h2 class="text-xl font-bold">App Pegawai</h2>
                    <p class="text-xs opacity-80">Management System</p>
                </div>
            </div>
        </div>
        
        <nav class="p-4 space-y-2">
            <!-- Employee -->
            <a href="{{ url('/employees') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl hover:bg-white/10 transition-all duration-200 group">
                <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                <span class="font-medium">Employee</span>
            </a>

            <!-- Department -->
            <a href="{{ url('/departemens') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl hover:bg-white/10 transition-all duration-200 group">
                <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
                <span class="font-medium">Department</span>
            </a>

            <!-- Position -->
            <a href="{{ url('/positions') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl hover:bg-white/10 transition-all duration-200 group">
                <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 3v18M6 3a3 3 0 016 0v18a3 3 0 01-6 0zm6 0h6a3 3 0 013 3v12a3 3 0 01-3 3h-6"></path>
                </svg>
                <span class="font-medium">Position</span>
            </a>

            <!-- Salaries -->
            <a href="{{ url('/salaries') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl hover:bg-white/10 transition-all duration-200 group">
                <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 1.343-3 3 0 .86.356 1.635.928 2.192l2.715 2.609a2 2 0 01-2.643 3.016l-.003-.002A4.992 4.992 0 017 16M12 8a4.992 4.992 0 015 4c0 1.43-.62 2.719-1.624 3.624a4.992 4.992 0 01-7.168-6.824A3.978 3.978 0 0112 8zM12 8V4m0 16v-4"></path>
                </svg>
                <span class="font-medium">Salaries</span>
            </a>

            <!-- Attendance -->
            <a href="{{ url('/attendances') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl hover:bg-white/10 transition-all duration-200 group">
                <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                </svg>
                <span class="font-medium">Attendance</span>
            </a>


        <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-white/20">
            <div class="flex items-center space-x-3 px-4 py-3">
                <div id="userAvatar" class="w-10 h-10 rounded-full flex items-center justify-center text-sm font-bold" style="background: linear-gradient(to bottom right, #FFD1DC, #FFC0CB); color: #FF69B4;">
                    AD
                </div>
                <div class="flex-1">
                    <p class="text-sm font-medium">Admin User</p>
                    <p class="text-xs opacity-80">admin@appPegawai.com</p>
                </div>
            </div>
        </div>
    </aside>

    <!-- Main Content Area -->
    <div class="ml-64 flex flex-col min-h-screen">
        <!-- Top Header -->
        <header class="bg-white/80 backdrop-blur-lg shadow-sm sticky top-0 z-30">
            <div class="px-8 py-4">
                <div class="flex items-center justify-between">
                    <h1 id="pageTitle" class="text-2xl font-bold bg-clip-text text-transparent" style="background-image: linear-gradient(to right, #FFB6C1, #FFABAB);">
                        @yield('page-title', 'Dashboard')
                    </h1>
                    
                    <div class="flex items-center space-x-3">
                        <button class="relative p-2 text-gray-600 hover:text-pink-600 hover:bg-pink-50 rounded-lg transition-all">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                            </svg>
                            <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                        </button>
                        
                        <div id="headerAvatar" class="w-10 h-10 rounded-full flex items-center justify-center text-white font-bold cursor-pointer hover:scale-110 transition-transform" style="background: linear-gradient(to bottom right, #FFB6C1, #FFABAB);">
                            A
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="flex-1 px-8 py-6">
            <div class="fade-in">
                @yield('content')
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-white/80 backdrop-blur-lg border-t border-gray-200 mt-auto">
            <div class="px-8 py-6">
                <div class="flex items-center justify-between">
                    <p class="text-sm text-gray-600">
                        &copy; {{ date('Y') }} <span class="font-semibold" style="color: #FFB6C1;">App Pegawai</span>. All rights reserved.
                    </p>
                    <div class="flex space-x-6 text-sm">
                        <a href="#" class="text-gray-600 hover:text-pink-600 transition-colors">Privacy</a>
                        <a href="#" class="text-gray-600 hover:text-pink-600 transition-colors">Terms</a>
                        <a href="#" class="text-gray-600 hover:text-pink-600 transition-colors">Support</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
