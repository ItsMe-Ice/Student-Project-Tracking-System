<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

        <!-- Styles / Scripts -->
        <link rel="stylesheet" href="{{ asset('app.css') }}">
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="bg-gradient-to-br from-slate-50 to-slate-100 dark:from-slate-900 dark:to-slate-800 min-h-screen flex flex-col">
        <!-- Animated Background Elements -->
        <div class="fixed inset-0 overflow-hidden pointer-events-none">
            <div class="absolute top-20 left-10 w-72 h-72 bg-gradient-to-br from-blue-400/20 to-purple-400/20 rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute top-40 right-10 w-96 h-96 bg-gradient-to-br from-emerald-400/20 to-cyan-400/20 rounded-full blur-3xl animate-pulse delay-1000"></div>
            <div class="absolute bottom-20 left-1/3 w-80 h-80 bg-gradient-to-br from-orange-400/20 to-pink-400/20 rounded-full blur-3xl animate-pulse delay-500"></div>
        </div>

        <header class="relative z-10 w-full max-w-6xl mx-auto p-6 lg:p-8">
            @if (Route::has('login'))
                <nav class="flex items-center justify-between">
                    <!-- Logo/Brand -->
                    <div class="flex items-center space-x-4">
                        <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-purple-600 rounded-xl shadow-lg flex items-center justify-center">
                            <span class="text-white font-bold text-sm">SP</span>
                        </div>
                        <div>
                            <h1 class="text-xl font-semibold text-slate-900 dark:text-white">Student Project Tracking</h1>
                            <p class="text-sm text-slate-600 dark:text-slate-300">Manage your academic projects</p>
                        </div>
                    </div>

                    <!-- Navigation Links -->
                    <div class="flex items-center space-x-4">
                        @auth
                            <a
                                href="{{ url('/dashboard') }}"
                                class="px-6 py-2 bg-white dark:bg-slate-800 text-slate-900 dark:text-white rounded-lg shadow-md hover:shadow-lg transition-all duration-300 border border-slate-200 dark:border-slate-700"
                            >
                                Dashboard
                            </a>
                        @else
                            <div class="flex items-center space-x-3">
                                <a
                                    href="{{ route('login') }}"
                                    class="px-6 py-2 bg-white dark:bg-slate-800 text-slate-900 dark:text-white rounded-lg shadow-md hover:shadow-lg transition-all duration-300 border border-slate-200 dark:border-slate-700"
                                >
                                    Sign In
                                </a>

                                @if (Route::has('register'))
                                    <a
                                        href="{{ route('register') }}"
                                        class="px-6 py-2 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105"
                                    >
                                        Get Started
                                    </a>
                                @endif
                            </div>
                        @endauth
                    </div>
                </nav>
            @endif
        </header>

        <main class="relative z-10 flex-1 flex items-center justify-center p-6 lg:p-8">
            <div class="max-w-6xl mx-auto w-full">
                <div class="grid lg:grid-cols-2 gap-8 items-center">
                    <!-- Content Section -->
                    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-xl p-8 lg:p-12 border border-slate-200 dark:border-slate-700">
                        <div class="space-y-6">
                            <div class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-50 to-purple-50 dark:from-slate-700 dark:to-slate-600 rounded-full text-sm font-medium text-slate-700 dark:text-slate-200">
                                🚀 Welcome to the Future
                            </div>
                            
                            <h2 class="text-3xl lg:text-4xl font-bold text-slate-900 dark:text-white leading-tight">
                                Streamline Your <span class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">Academic Journey</span>
                            </h2>
                            
                            <p class="text-lg text-slate-600 dark:text-slate-300 leading-relaxed">
                                Take control of your projects with our intuitive platform designed specifically for students and educators. Track progress, collaborate effectively, and achieve your academic goals.
                            </p>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="flex items-start space-x-3 p-4 bg-slate-50 dark:bg-slate-700 rounded-lg">
                                    <div class="w-8 h-8 bg-gradient-to-r from-green-400 to-blue-400 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-slate-900 dark:text-white">Easy Project Management</h3>
                                        <p class="text-sm text-slate-600 dark:text-slate-300">Create, organize, and track your projects seamlessly</p>
                                    </div>
                                </div>
                                
                                <div class="flex items-start space-x-3 p-4 bg-slate-50 dark:bg-slate-700 rounded-lg">
                                    <div class="w-8 h-8 bg-gradient-to-r from-purple-400 to-pink-400 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path></svg>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-slate-900 dark:text-white">Collaborative Learning</h3>
                                        <p class="text-sm text-slate-600 dark:text-slate-300">Connect with teachers and peers</p>
                                    </div>
                                </div>
                            </div>

                            <div class="pt-4">
                                <div class="flex flex-col sm:flex-row gap-4">
                                    <a href="{{ route('register') }}" class="flex-1 bg-gradient-to-r from-blue-600 to-purple-600 text-white py-3 px-6 rounded-lg font-semibold text-center shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                                        Start Your Journey
                                    </a>
                                    <a href="{{ route('login') }}" class="flex-1 bg-white dark:bg-slate-700 text-slate-900 dark:text-white py-3 px-6 rounded-lg font-semibold text-center shadow-md hover:shadow-lg transition-all duration-300 border border-slate-200 dark:border-slate-600">
                                        Sign In
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Visual Section -->
                    <div class="relative">
                        <div class="bg-gradient-to-br from-blue-500/10 to-purple-500/10 dark:from-blue-400/20 dark:to-purple-400/20 rounded-3xl p-8 lg:p-12 backdrop-blur-sm border border-slate-200/50 dark:border-slate-700/50">
                            <!-- App Preview Mockup -->
                            <div class="relative bg-white dark:bg-slate-900 rounded-2xl shadow-2xl overflow-hidden border border-slate-200 dark:border-slate-700">
                                <!-- Status Bar -->
                                <div class="flex items-center justify-between p-4 bg-gradient-to-r from-blue-600 to-purple-600 text-white">
                                    <div class="flex items-center space-x-2">
                                        <div class="w-2 h-2 bg-white rounded-full"></div>
                                        <div class="w-2 h-2 bg-white rounded-full"></div>
                                        <div class="w-2 h-2 bg-white rounded-full"></div>
                                    </div>
                                    <div class="text-sm font-medium">Student Project Tracking</div>
                                    <div class="text-sm">9:41 AM</div>
                                </div>

                                <!-- App Content Preview -->
                                <div class="p-6 space-y-4">
                                    <!-- Project Card -->
                                    <div class="bg-gradient-to-r from-blue-50 to-purple-50 dark:from-slate-800 dark:to-slate-700 rounded-xl p-4 border border-slate-200 dark:border-slate-600">
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <h3 class="font-semibold text-slate-900 dark:text-white">Web Development Project</h3>
                                                <p class="text-sm text-slate-600 dark:text-slate-300">Due: March 15, 2024</p>
                                            </div>
                                            <div class="flex items-center space-x-2">
                                                <span class="px-2 py-1 bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200 text-xs rounded-full">In Progress</span>
                                                <div class="w-16 bg-slate-200 dark:bg-slate-600 rounded-full h-2">
                                                    <div class="bg-gradient-to-r from-blue-500 to-purple-500 h-2 rounded-full w-2/3"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Progress Stats -->
                                    <div class="grid grid-cols-3 gap-4">
                                        <div class="text-center p-3 bg-slate-50 dark:bg-slate-800 rounded-lg">
                                            <div class="text-2xl font-bold text-blue-600">3</div>
                                            <div class="text-xs text-slate-600 dark:text-slate-300">Active</div>
                                        </div>
                                        <div class="text-center p-3 bg-slate-50 dark:bg-slate-800 rounded-lg">
                                            <div class="text-2xl font-bold text-green-600">12</div>
                                            <div class="text-xs text-slate-600 dark:text-slate-300">Completed</div>
                                        </div>
                                        <div class="text-center p-3 bg-slate-50 dark:bg-slate-800 rounded-lg">
                                            <div class="text-2xl font-bold text-purple-600">92%</div>
                                            <div class="text-xs text-slate-600 dark:text-slate-300">Success Rate</div>
                                        </div>
                                    </div>

                                    <!-- Action Buttons -->
                                    <div class="flex gap-3">
                                        <button class="flex-1 bg-gradient-to-r from-blue-500 to-blue-600 text-white py-2 px-4 rounded-lg text-sm font-medium hover:shadow-lg transition-all">
                                            Add Project
                                        </button>
                                        <button class="flex-1 bg-gradient-to-r from-purple-500 to-purple-600 text-white py-2 px-4 rounded-lg text-sm font-medium hover:shadow-lg transition-all">
                                            View Progress
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Floating Elements -->
                            <div class="absolute -top-4 -right-4 w-24 h-24 bg-gradient-to-br from-cyan-400 to-blue-400 rounded-full opacity-20 animate-pulse"></div>
                            <div class="absolute -bottom-4 -left-4 w-20 h-20 bg-gradient-to-br from-purple-400 to-pink-400 rounded-full opacity-20 animate-pulse delay-500"></div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="relative z-10 w-full max-w-6xl mx-auto p-6 lg:p-8 text-center text-slate-600 dark:text-slate-400 text-sm">
            <p>Designed with ❤️ for students and educators | Built with Laravel & Tailwind CSS</p>
        </footer>

        @if (Route::has('login'))
            <div class="h-14.5 hidden lg:block"></div>
        @endif
    </body>
</html>