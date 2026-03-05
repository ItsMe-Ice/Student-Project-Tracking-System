<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Section -->
            <div class="bg-white rounded-lg shadow-lg p-8 mb-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Welcome back, {{ auth()->user()->name }}!</h1>
                        <p class="text-gray-600 mt-2">
                            You are logged in as a 
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                {{ ucfirst(auth()->user()->role) }}
                            </span>
                        </p>
                    </div>
                    <div class="hidden md:block">
                        <div class="bg-gradient-to-r from-blue-500 to-purple-600 rounded-full p-6">
                            <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Admin Dashboard -->
            @if(auth()->user()->role === 'admin')
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <!-- User Management Card -->
                    <a href="{{ route('admin.users') }}" class="group bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">User Management</h3>
                                <p class="text-gray-600 text-sm">Manage students and teachers</p>
                                <div class="mt-4 flex items-center space-x-2">
                                    <span class="text-2xl">👥</span>
                                    <span class="text-sm font-medium text-blue-600 group-hover:text-blue-700">View All Users</span>
                                </div>
                            </div>
                            <div class="bg-blue-100 p-4 rounded-full">
                                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </a>

                    <!-- Promote Students Card -->
                    <a href="{{ route('admin.promote') }}" class="group bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">Promote Students</h3>
                                <p class="text-gray-600 text-sm">Promote students to teachers</p>
                                <div class="mt-4 flex items-center space-x-2">
                                    <span class="text-2xl">🚀</span>
                                    <span class="text-sm font-medium text-green-600 group-hover:text-green-700">Promote Now</span>
                                </div>
                            </div>
                            <div class="bg-green-100 p-4 rounded-full">
                                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </div>
                        </div>
                    </a>

                    <!-- Teacher Assignment Card -->
                    <a href="{{ route('admin.assign.teachers') }}" class="group bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">Teacher Assignment</h3>
                                <p class="text-gray-600 text-sm">Assign teachers to students</p>
                                <div class="mt-4 flex items-center space-x-2">
                                    <span class="text-2xl">👥</span>
                                    <span class="text-sm font-medium text-blue-600 group-hover:text-blue-700">Assign Now</span>
                                </div>
                            </div>
                            <div class="bg-blue-100 p-4 rounded-full">
                                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </a>

                    <!-- System Overview Card -->
                    <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">System Overview</h3>
                                <p class="text-gray-600 text-sm">View system statistics</p>
                                <div class="mt-4 flex items-center space-x-2">
                                    <span class="text-2xl">📊</span>
                                    <span class="text-sm font-medium text-purple-600">Coming Soon</span>
                                </div>
                            </div>
                            <div class="bg-purple-100 p-4 rounded-full">
                                <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Teacher Dashboard -->
            @if(auth()->user()->role === 'teacher')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <!-- My Students Card -->
                    <a href="{{ route('projects.index') }}" class="group bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">My Students</h3>
                                <p class="text-gray-600 text-sm">Manage your assigned students</p>
                                <div class="mt-4 flex items-center space-x-2">
                                    <span class="text-2xl">🎓</span>
                                    <span class="text-sm font-medium text-yellow-600 group-hover:text-yellow-700">View Students</span>
                                </div>
                            </div>
                            <div class="bg-yellow-100 p-4 rounded-full">
                                <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </a>

                    <!-- Progress Reports Card -->
                    <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">Progress Reports</h3>
                                <p class="text-gray-600 text-sm">Review student progress</p>
                                <div class="mt-4 flex items-center space-x-2">
                                    <span class="text-2xl">📈</span>
                                    <span class="text-sm font-medium text-indigo-600">Coming Soon</span>
                                </div>
                            </div>
                            <div class="bg-indigo-100 p-4 rounded-full">
                                <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Student Dashboard -->
            @if(auth()->user()->role === 'student')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <!-- My Projects Card -->
                    <a href="{{ route('projects.index') }}" class="group bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">My Projects</h3>
                                <p class="text-gray-600 text-sm">View and manage your projects</p>
                                <div class="mt-4 flex items-center space-x-2">
                                    <span class="text-2xl">📁</span>
                                    <span class="text-sm font-medium text-red-600 group-hover:text-red-700">View Projects</span>
                                </div>
                            </div>
                            <div class="bg-red-100 p-4 rounded-full">
                                <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        </div>
                    </a>

                    <!-- Edit Project Card -->
                    <a href="{{ route('projects.index') }}" class="group bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">Edit Project</h3>
                                <p class="text-gray-600 text-sm">Update project details and upload documents</p>
                                <div class="mt-4 flex items-center space-x-2">
                                    <span class="text-2xl">✏️</span>
                                    <span class="text-sm font-medium text-indigo-600 group-hover:text-indigo-700">Edit Now</span>
                                </div>
                            </div>
                            <div class="bg-indigo-100 p-4 rounded-full">
                                <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </div>
                        </div>
                    </a>

                    <!-- Progress Reports Card -->
                    <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">Progress Reports</h3>
                                <p class="text-gray-600 text-sm">Submit progress reports</p>
                                <div class="mt-4 flex items-center space-x-2">
                                    <span class="text-2xl">📝</span>
                                    <span class="text-sm font-medium text-teal-600">Coming Soon</span>
                                </div>
                            </div>
                            <div class="bg-teal-100 p-4 rounded-full">
                                <svg class="w-8 h-8 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Calendar Section -->
            <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-semibold text-gray-900">Calendar</h3>
                    <div class="flex items-center space-x-4">
                        <button id="prevMonth" class="p-2 hover:bg-gray-100 rounded-full transition-colors">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                        </button>
                        <h4 id="currentMonth" class="text-md font-medium text-gray-700"></h4>
                        <button id="nextMonth" class="p-2 hover:bg-gray-100 rounded-full transition-colors">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>
                    </div>
                </div>
                
                <div class="grid grid-cols-7 gap-1 mb-2">
                    <div class="text-center text-xs font-semibold text-gray-500 py-2">Mon</div>
                    <div class="text-center text-xs font-semibold text-gray-500 py-2">Tue</div>
                    <div class="text-center text-xs font-semibold text-gray-500 py-2">Wed</div>
                    <div class="text-center text-xs font-semibold text-gray-500 py-2">Thu</div>
                    <div class="text-center text-xs font-semibold text-gray-500 py-2">Fri</div>
                    <div class="text-center text-xs font-semibold text-gray-500 py-2">Sat</div>
                    <div class="text-center text-xs font-semibold text-gray-500 py-2">Sun</div>
                </div>
                
                <div id="calendarGrid" class="grid grid-cols-7 gap-1">
                    <!-- Calendar days will be populated by JavaScript -->
                </div>
            </div>

            <!-- Quick Stats Section -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Stats</h3>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div class="bg-blue-50 rounded-lg p-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-blue-600">Total Users</p>
                                <p class="text-2xl font-bold text-blue-900">{{ \App\Models\User::count() }}</p>
                            </div>
                            <div class="bg-blue-200 p-3 rounded-full">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-green-50 rounded-lg p-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-green-600">Students</p>
                                <p class="text-2xl font-bold text-green-900">{{ \App\Models\User::where('role', 'student')->count() }}</p>
                            </div>
                            <div class="bg-green-200 p-3 rounded-full">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-purple-50 rounded-lg p-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-purple-600">Teachers</p>
                                <p class="text-2xl font-bold text-purple-900">{{ \App\Models\User::where('role', 'teacher')->count() }}</p>
                            </div>
                            <div class="bg-purple-200 p-3 rounded-full">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-red-50 rounded-lg p-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-red-600">Projects</p>
                                <p class="text-2xl font-bold text-red-900">{{ \App\Models\Project::count() }}</p>
                            </div>
                            <div class="bg-red-200 p-3 rounded-full">
                                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Calendar JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const calendarGrid = document.getElementById('calendarGrid');
            const currentMonthElement = document.getElementById('currentMonth');
            const prevMonthBtn = document.getElementById('prevMonth');
            const nextMonthBtn = document.getElementById('nextMonth');
            
            let currentDate = new Date();
            let currentYear = currentDate.getFullYear();
            let currentMonth = currentDate.getMonth();

            // Month names for display
            const monthNames = [
                'January', 'February', 'March', 'April', 'May', 'June',
                'July', 'August', 'September', 'October', 'November', 'December'
            ];

            // Project deadlines (you can fetch these from your backend)
            const projectDeadlines = [
                { date: '2024-03-15', title: 'Project A Due', color: 'bg-red-500' },
                { date: '2024-03-20', title: 'Project B Due', color: 'bg-blue-500' },
                { date: '2024-03-25', title: 'Project C Due', color: 'bg-green-500' }
            ];

            function renderCalendar() {
                calendarGrid.innerHTML = '';
                currentMonthElement.textContent = `${monthNames[currentMonth]} ${currentYear}`;

                // Get first day of month and total days
                const firstDay = new Date(currentYear, currentMonth, 1);
                const lastDay = new Date(currentYear, currentMonth + 1, 0);
                const startDate = firstDay.getDay(); // 0 = Sunday, 1 = Monday, etc.
                const totalDays = lastDay.getDate();

                // Add empty cells for days before the first day of the month
                for (let i = 0; i < startDate; i++) {
                    const emptyCell = document.createElement('div');
                    emptyCell.className = 'h-16 border border-gray-100';
                    calendarGrid.appendChild(emptyCell);
                }

                // Add days of the month
                for (let day = 1; day <= totalDays; day++) {
                    const dayCell = document.createElement('div');
                    dayCell.className = 'h-16 border border-gray-100 p-1 hover:bg-gray-50 transition-colors relative';
                    
                    // Create day number
                    const dayNumber = document.createElement('div');
                    dayNumber.className = 'text-xs font-semibold text-gray-700 mb-1';
                    dayNumber.textContent = day;
                    
                    // Check if today
                    const today = new Date();
                    if (day === today.getDate() && currentMonth === today.getMonth() && currentYear === today.getFullYear()) {
                        dayNumber.className += ' text-blue-600 bg-blue-50 rounded-full w-6 h-6 flex items-center justify-center';
                    }

                    // Check for project deadlines
                    const dateString = `${currentYear}-${String(currentMonth + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
                    const deadline = projectDeadlines.find(d => d.date === dateString);
                    
                    if (deadline) {
                        const deadlineDot = document.createElement('div');
                        deadlineDot.className = `w-2 h-2 ${deadline.color} rounded-full absolute top-1 right-1`;
                        deadlineDot.title = deadline.title;
                        dayCell.appendChild(deadlineDot);
                    }

                    dayCell.appendChild(dayNumber);
                    calendarGrid.appendChild(dayCell);
                }
            }

            // Event listeners for navigation
            prevMonthBtn.addEventListener('click', function() {
                currentMonth--;
                if (currentMonth < 0) {
                    currentMonth = 11;
                    currentYear--;
                }
                renderCalendar();
            });

            nextMonthBtn.addEventListener('click', function() {
                currentMonth++;
                if (currentMonth > 11) {
                    currentMonth = 0;
                    currentYear++;
                }
                renderCalendar();
            });

            // Initial render
            renderCalendar();
        });
    </script>
</x-app-layout>
