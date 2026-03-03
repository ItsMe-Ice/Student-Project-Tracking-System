<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Assign Students to Projects') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-lg p-8">
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Project Assignment</h3>
                    <p class="text-gray-600">Assign students to your projects to track their progress and review their work.</p>
                </div>

                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('projects.assign.store', $project) }}" method="POST" class="space-y-6">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Project</label>
                        <div class="px-3 py-2 border border-gray-300 rounded-md bg-gray-50">
                            {{ $project->title }} ({{ $project->user->name }})
                        </div>
                        <input type="hidden" name="project_id" value="{{ $project->id }}">
                    </div>

                    <div>
                        <label for="teacher_id" class="block text-sm font-medium text-gray-700 mb-2">Select Teacher</label>
                        <select id="teacher_id" name="teacher_id" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">-- Select a teacher --</option>
                            @foreach($teachers as $teacher)
                                <option value="{{ $teacher->id }}">{{ $teacher->name }} ({{ $teacher->email }})</option>
                            @endforeach
                        </select>
                        @error('teacher_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end space-x-3">
                        <a href="{{ route('projects.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 text-gray-700 bg-white hover:bg-gray-50 text-sm font-medium rounded-md transition-colors duration-200">
                            Cancel
                        </a>
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-md transition-colors duration-200 shadow-sm hover:shadow-md">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                            Assign Student
                        </button>
                    </div>
                </form>

                <!-- Current Assignments -->
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Current Assignments</h3>
                    <div class="bg-gray-50 rounded-lg p-4">
                        @php
                            $assignedProjects = \App\Models\Project::where('teacher_id', auth()->id())
                                ->orWhere('user_id', auth()->id())
                                ->get();
                        @endphp

                        @if($assignedProjects->isEmpty())
                            <p class="text-gray-500 text-center py-4">No student assignments found.</p>
                        @else
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @foreach($assignedProjects as $assignedProject)
                                    @if($assignedProject->user)
                                        <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200">
                                            <div class="flex items-center justify-between">
                                                <div>
                                                    <h4 class="font-medium text-gray-900">{{ $assignedProject->title }}</h4>
                                                    <p class="text-sm text-gray-600">Student: {{ $assignedProject->user->name }}</p>
                                                    <p class="text-xs text-gray-500 mt-1">Status: {{ ucfirst($assignedProject->status) }}</p>
                                                </div>
                                                <div class="text-right">
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                        {{ $assignedProject->progress }}% complete
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>