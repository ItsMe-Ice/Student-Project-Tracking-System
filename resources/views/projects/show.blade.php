<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $project->title }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('projects.edit', $project) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 hover:bg-gray-900 text-white text-sm font-medium rounded-lg transition-colors duration-200 shadow-md hover:shadow-lg">
                    {{ __('Edit') }}
                </a>
                <form action="{{ route('projects.destroy', $project) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Are you sure you want to delete this project?')" class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-lg transition-colors duration-200 shadow-md hover:shadow-lg">
                        {{ __('Delete') }}
                    </button>
                </form>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-lg p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Project Details -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">{{ __('Project Details') }}</h3>
                        <div class="space-y-3">
                            <div>
                                <span class="text-sm font-medium text-gray-600">{{ __('Student:') }}</span>
                                <p class="mt-1 text-gray-900">{{ $project->user->name }}</p>
                            </div>
                            <div>
                                <span class="text-sm font-medium text-gray-600">{{ __('Teacher:') }}</span>
                                <p class="mt-1 text-gray-900">{{ $project->teacher ? $project->teacher->name : 'Not assigned' }}</p>
                            </div>
                            <div>
                                <span class="text-sm font-medium text-gray-600">{{ __('Status:') }}</span>
                                <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    {{ $project->status === 'completed' ? 'bg-green-100 text-green-800' : ($project->status === 'in_progress' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800') }}">
                                    {{ ucfirst($project->status) }}
                                </span>
                            </div>
                            <div>
                                <span class="text-sm font-medium text-gray-600">{{ __('Start Date:') }}</span>
                                <p class="mt-1 text-gray-900">{{ $project->start_date->format('M d, Y') }}</p>
                            </div>
                            <div>
                                <span class="text-sm font-medium text-gray-600">{{ __('End Date:') }}</span>
                                <p class="mt-1 text-gray-900">{{ $project->end_date->format('M d, Y') }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">{{ __('Description') }}</h3>
                        <p class="text-gray-700 leading-relaxed">{{ $project->description }}</p>
                    </div>
                </div>

                <!-- Documents List -->
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-900">{{ __('Documents') }}</h3>
                        <div class="flex items-center space-x-2">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-indigo-100 text-indigo-800">
                                {{ $project->documents->count() }} {{ $project->documents->count() === 1 ? 'file' : 'files' }}
                            </span>
                        </div>
                    </div>
                    
                    @if($project->documents->isEmpty())
                        <div class="text-center py-12">
                            <div class="w-16 h-16 bg-gradient-to-r from-gray-200 to-gray-300 rounded-full mx-auto mb-4 flex items-center justify-center">
                                <svg class="w-8 h-8 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <p class="text-gray-500 text-lg font-medium">No documents uploaded yet</p>
                            <p class="text-gray-400 text-sm mt-1">Documents will appear here when uploaded</p>
                        </div>
                    @else
                        <div class="grid grid-cols-1 gap-4">
                            @foreach($project->documents as $document)
                                <div class="group bg-white rounded-xl border border-gray-200 hover:border-indigo-200 transition-all duration-300 shadow-sm hover:shadow-lg">
                                    <div class="p-6">
                                        <div class="flex items-center justify-between">
                                            <!-- Document Info -->
                                            <div class="flex items-center space-x-4 flex-1">
                                                <!-- File Icon -->
                                                <div class="flex-shrink-0">
                                                    <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500 rounded-xl flex items-center justify-center shadow-lg relative overflow-hidden group">
                                                        <!-- Decorative corner accent -->
                                                        <div class="absolute top-0 right-0 w-6 h-6 bg-white bg-opacity-20 rounded-bl-xl transform rotate-45 group-hover:bg-opacity-30 transition-all duration-300"></div>
                                                        
                                                        <!-- File type icon -->
                                                        <div class="relative z-10">
                                                            @if($document->getFileExtension() === 'pdf')
                                                                <div class="text-white">
                                                                    <svg class="w-7 h-7 mx-auto mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                                    </svg>
                                                                    <div class="text-xs font-bold text-center uppercase tracking-wider opacity-90">PDF</div>
                                                                </div>
                                                            @elseif(in_array($document->getFileExtension(), ['doc', 'docx']))
                                                                <div class="text-white">
                                                                    <svg class="w-7 h-7 mx-auto mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                                                    </svg>
                                                                    <div class="text-xs font-bold text-center uppercase tracking-wider opacity-90">DOC</div>
                                                                </div>
                                                            @else
                                                                <div class="text-white">
                                                                    <svg class="w-7 h-7 mx-auto mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"></path>
                                                                    </svg>
                                                                    <div class="text-xs font-bold text-center uppercase tracking-wider opacity-90">FILE</div>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        
                                                        <!-- Subtle shine effect -->
                                                        <div class="absolute inset-0 bg-gradient-to-t from-white to-transparent opacity-0 group-hover:opacity-20 transition-opacity duration-300"></div>
                                                    </div>
                                                </div>
                                                
                                                <!-- Document Details -->
                                                <div class="flex-1 min-w-0">
                                                    <div class="flex items-start justify-between">
                                                        <div class="flex-1">
                                                            <h4 class="font-semibold text-gray-900 text-lg mb-1">{{ $document->title }}</h4>
                                                            <div class="flex items-center space-x-4 text-sm text-gray-600 mb-2">
                                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                                    {{ $document->file_name }}
                                                                </span>
                                                                <span class="text-xs text-gray-500">{{ number_format($document->file_size / 1024, 2) }} KB</span>
                                                                <span class="text-xs text-gray-500">{{ $document->created_at->diffForHumans() }}</span>
                                                            </div>
                                                            @if($document->description)
                                                                <p class="text-gray-600 text-sm leading-relaxed">{{ $document->description }}</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <!-- Actions -->
                                            <div class="flex items-center space-x-2 flex-shrink-0">
                                                <!-- Download Button -->
                                                <a href="{{ route('projects.documents.download', [$project, $document]) }}" 
                                                   class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white text-sm font-medium rounded-lg transition-all duration-200 shadow-md hover:shadow-lg transform hover:-translate-y-1 group">
                                                    <svg class="w-4 h-4 mr-2 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                    </svg>
                                                    Download
                                                </a>
                                                
                                                <!-- Delete Button -->
                                                @if(auth()->user()->role === 'student' && $document->user_id === auth()->user()->id)
                                                    <form action="{{ route('projects.documents.destroy', [$project, $document]) }}" method="POST" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" onclick="return confirm('Are you sure you want to delete this document?')" 
                                                                class="inline-flex items-center px-3 py-2 bg-red-100 hover:bg-red-200 text-red-800 text-sm font-medium rounded-lg transition-colors duration-200 group">
                                                            <svg class="w-4 h-4 mr-2 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                            </svg>
                                                            Delete
                                                        </button>
                                                    </form>
                                                @elseif(auth()->user()->role === 'teacher')
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                        Teacher
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Comments Section -->
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <div class="flex items-center justify-between mb-4">
                        <div class="inline-flex items-center space-x-2 text-lg font-semibold text-gray-900">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                            <span>{{ __('Comments') }}</span>
                        </div>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                            {{ $project->comments->count() }} {{ $project->comments->count() === 1 ? 'comment' : 'comments' }}
                        </span>
                    </div>
                    
                    <!-- Add Comment Button -->
                    @if(auth()->user()->role === 'teacher' || auth()->user()->role === 'student')
                        <div class="mb-4">
                            <button type="button" 
                                    onclick="toggleCommentForm()"
                                    class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg transition-colors duration-200 shadow-md hover:shadow-lg">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                Add Comment
                            </button>
                        </div>
                    @endif
                    
                    <!-- Comment Form -->
                    @if(auth()->user()->role === 'teacher' || auth()->user()->role === 'student')
                        <div id="comment-form-container" class="bg-gray-50 rounded-lg p-4 mb-4 hidden">
                            <form action="{{ route('projects.comments.store', $project) }}" method="POST">
                                @csrf
                                <div class="grid grid-cols-1 md:grid-cols-6 gap-4">
                                    <div class="md:col-span-4">
                                        <label for="content" class="block text-sm font-medium text-gray-700 mb-1">{{ __('Add a comment') }}</label>
                                        <textarea name="content" id="content" rows="2" 
                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500"
                                            placeholder="Write your comment here...">{{ old('content') }}</textarea>
                                        @error('content')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="md:col-span-2">
                                        <label for="comment_type" class="block text-sm font-medium text-gray-700 mb-1">{{ __('Comment Type') }}</label>
                                        <select name="comment_type" id="comment_type" 
                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                                            <option value="general" {{ old('comment_type') === 'general' ? 'selected' : '' }}>General</option>
                                            <option value="feedback" {{ old('comment_type') === 'feedback' ? 'selected' : '' }}>Feedback</option>
                                            <option value="question" {{ old('comment_type') === 'question' ? 'selected' : '' }}>Question</option>
                                            <option value="answer" {{ old('comment_type') === 'answer' ? 'selected' : '' }}>Answer</option>
                                        </select>
                                        @error('comment_type')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mt-3 flex justify-end space-x-3">
                                    <button type="button" 
                                            onclick="toggleCommentForm()"
                                            class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                                        Cancel
                                    </button>
                                    <button type="submit" 
                                            class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg transition-colors duration-200 shadow-md hover:shadow-lg">
                                        {{ __('Post Comment') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    @endif

                    <!-- Comments List -->
                    <div class="space-y-4">
                        @if($project->comments->isEmpty())
                            <p class="text-gray-500 text-center py-8">{{ __('No comments yet. Be the first to comment!') }}</p>
                        @else
                            @foreach($project->comments as $comment)
                                <div class="mb-4">
                                    <!-- Main Comment -->
                                    <div class="flex space-x-3 group">
                                        <!-- Avatar -->
                                        <div class="flex-shrink-0">
                                            <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500 rounded-full flex items-center justify-center shadow-lg border-2 border-white dark:border-gray-800">
                                                <span class="text-sm font-bold text-white">{{ strtoupper(substr($comment->user->name, 0, 2)) }}</span>
                                            </div>
                                        </div>
                                        
                                        <!-- Comment Content -->
                                        <div class="flex-1 min-w-0">
                                            <div class="bg-white rounded-2xl rounded-bl-none p-4 shadow-sm border border-gray-100 group-hover:shadow-md transition-shadow duration-200">
                                                <!-- Comment Header -->
                                                <div class="flex items-center justify-between mb-2">
                                                    <div class="flex items-center space-x-2">
                                                        <h4 class="font-semibold text-gray-900 text-sm">{{ $comment->user->name }}</h4>
                                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                                                            {{ ucfirst($comment->user->role) }}
                                                        </span>
                                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                                            {{ $comment->comment_type === 'feedback' ? 'bg-green-100 text-green-800' : 
                                                               ($comment->comment_type === 'question' ? 'bg-yellow-100 text-yellow-800' : 
                                                               ($comment->comment_type === 'answer' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800')) }}">
                                                            {{ ucfirst($comment->comment_type) }}
                                                        </span>
                                                    </div>
                                                    <div class="flex items-center space-x-2 text-xs text-gray-500">
                                                        <span>{{ $comment->created_at->diffForHumans() }}</span>
                                                        <span>•</span>
                                                        <span>{{ $comment->replies->count() }} {{ $comment->replies->count() === 1 ? 'reply' : 'replies' }}</span>
                                                    </div>
                                                </div>
                                                
                                                <!-- Comment Body -->
                                                <div class="text-gray-800 text-sm leading-relaxed whitespace-pre-wrap">
                                                    {{ $comment->content }}
                                                </div>
                                                
                                                <!-- Comment Actions -->
                                                <div class="flex items-center justify-between mt-3 pt-3 border-t border-gray-100">
                                                    <div class="flex items-center space-x-4">
                                                        <!-- Like Button -->
                                                        <button class="flex items-center space-x-1 text-gray-600 dark:text-gray-300 hover:text-red-500 dark:hover:text-red-400 transition-colors duration-200 group">
                                                            <svg class="w-4 h-4 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"></path>
                                                            </svg>
                                                            <span class="text-xs font-medium">Like</span>
                                                        </button>
                                                        
                                                        <!-- Dislike Button -->
                                                        <button class="flex items-center space-x-1 text-gray-600 dark:text-gray-300 hover:text-gray-400 transition-colors duration-200 group">
                                                            <svg class="w-4 h-4 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14H5.236a2 2 0 01-1.789-2.894l3.5-7A2 2 0 018.736 3h4.018a2 2 0 01.485.06l3.76.94m-7 10v5a2 2 0 002 2h.096c.5 0 .905-.405.905-.904 0-.715.211-1.413.608-2.008L17 13V4m-7 10h2m5-10h2a2 2 0 012 2v6a2 2 0 01-2 2h-2.5"></path>
                                                            </svg>
                                                            <span class="text-xs font-medium">Dislike</span>
                                                        </button>
                                                        
                                                        <!-- Reply Button -->
                                                        @if(auth()->user()->role === 'teacher' || auth()->user()->role === 'student')
                                                            <button type="button" 
                                                                    onclick="toggleReplyForm('{{ $comment->id }}')"
                                                                    class="flex items-center space-x-1 text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300 transition-colors duration-200 group">
                                                                <svg class="w-4 h-4 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path>
                                                                </svg>
                                                                <span class="text-xs font-medium">Reply</span>
                                                            </button>
                                                        @endif
                                                    </div>
                                                    
                                                    <!-- Comment Actions Menu -->
                                                    <div class="flex items-center space-x-2">
                                                        @if($comment->user_id === auth()->user()->id || auth()->user()->role === 'teacher' || auth()->user()->role === 'admin')
                                                            <!-- Edit Button -->
                                                            @if($comment->user_id === auth()->user()->id)
                                                                <button type="button" 
                                                                        onclick="toggleEditForm('{{ $comment->id }}')"
                                                                        class="text-xs text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 transition-colors duration-200">
                                                                    Edit
                                                                </button>
                                                            @endif
                                                            
                                                            <!-- Delete Button -->
                                                            <form action="{{ route('projects.comments.destroy', [$project, $comment]) }}" method="POST" class="inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" 
                                                                        onclick="return confirm('Are you sure you want to delete this comment?')"
                                                                        class="text-xs text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-300 transition-colors duration-200">
                                                                    Delete
                                                                </button>
                                                            </form>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    
                                    <!-- Edit Form -->
                                    @if($comment->user_id === auth()->user()->id)
                                        <div id="edit-form-{{ $comment->id }}" class="mt-3 hidden">
                                            <form action="{{ route('projects.comments.update', [$project, $comment]) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="flex space-x-3">
                                                    <!-- Edit Avatar -->
                                                    <div class="flex-shrink-0">
                                                        <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500 rounded-full flex items-center justify-center">
                                                            <span class="text-sm font-bold text-white">{{ strtoupper(substr($comment->user->name, 0, 2)) }}</span>
                                                        </div>
                                                    </div>
                                                    
                                                    <!-- Edit Input -->
                                                    <div class="flex-1">
                                                        <div class="bg-white dark:bg-gray-800 rounded-2xl p-4 border border-gray-200 dark:border-gray-600">
                                                            <textarea name="content" rows="3" 
                                                                class="w-full resize-none border-0 p-0 text-gray-900 dark:text-white focus:ring-0">{{ $comment->content }}</textarea>
                                                            <div class="flex items-center justify-between mt-3">
                                                                <select name="comment_type" 
                                                                    class="text-xs border border-gray-300 dark:border-gray-600 rounded px-2 py-1 bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                                                                    <option value="general" {{ $comment->comment_type === 'general' ? 'selected' : '' }}>General</option>
                                                                    <option value="feedback" {{ $comment->comment_type === 'feedback' ? 'selected' : '' }}>Feedback</option>
                                                                    <option value="question" {{ $comment->comment_type === 'question' ? 'selected' : '' }}>Question</option>
                                                                    <option value="answer" {{ $comment->comment_type === 'answer' ? 'selected' : '' }}>Answer</option>
                                                                </select>
                                                                <div class="flex items-center space-x-2">
                                                                    <button type="button" 
                                                                            onclick="toggleEditForm('{{ $comment->id }}')"
                                                                            class="px-3 py-1 text-xs bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-full hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors duration-200">
                                                                        Cancel
                                                                    </button>
                                                                    <button type="submit" 
                                                                            class="px-3 py-1 text-xs bg-indigo-600 text-white rounded-full hover:bg-indigo-700 transition-colors duration-200">
                                                                        Update
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    @endif
                                    
                                    <!-- Reply Form -->
                                    @if(auth()->user()->role === 'teacher' || auth()->user()->role === 'student')
                                        <div id="reply-form-{{ $comment->id }}" class="mt-3 hidden">
                                            <form action="{{ route('projects.comments.store', $project) }}" method="POST" class="space-y-3">
                                                @csrf
                                                <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                                <div class="flex space-x-3">
                                                    <!-- Reply Avatar -->
                                                    <div class="flex-shrink-0">
                                                        <div class="w-8 h-8 bg-gradient-to-br from-green-400 to-blue-500 rounded-full flex items-center justify-center">
                                                            <span class="text-xs font-bold text-white">{{ strtoupper(substr(auth()->user()->name, 0, 2)) }}</span>
                                                        </div>
                                                    </div>
                                                    
                                                    <!-- Reply Input -->
                                                    <div class="flex-1">
                                                        <div class="bg-white dark:bg-gray-800 rounded-2xl p-3 border border-gray-200 dark:border-gray-600">
                                                            <textarea name="content" rows="2" 
                                                                class="w-full resize-none border-0 p-0 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-0"
                                                                placeholder="Write a reply..."></textarea>
                                                            <div class="flex items-center justify-between mt-2">
                                                                <div class="flex items-center space-x-2">
                                                                    <select name="comment_type" 
                                                                        class="text-xs border border-gray-300 dark:border-gray-600 rounded px-2 py-1 bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                                                                        <option value="general">General</option>
                                                                        <option value="feedback">Feedback</option>
                                                                        <option value="question">Question</option>
                                                                        <option value="answer">Answer</option>
                                                                    </select>
                                                                </div>
                                                                <div class="flex items-center space-x-2">
                                                                    <button type="button" 
                                                                            onclick="toggleReplyForm('{{ $comment->id }}')"
                                                                            class="px-3 py-1 text-xs bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-full hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors duration-200">
                                                                        Cancel
                                                                    </button>
                                                                    <button type="submit" 
                                                                            class="px-3 py-1 text-xs bg-indigo-600 text-white rounded-full hover:bg-indigo-700 transition-colors duration-200">
                                                                        Reply
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        @endif
                    </div>

                <div class="mt-8 pt-6 border-t border-gray-200">
                    <div class="flex justify-end">
                        <a href="{{ route('projects.index') }}" class="inline-flex items-center px-6 py-3 bg-gray-600 hover:bg-gray-700 text-white text-sm font-medium rounded-lg transition-colors duration-200 shadow-md hover:shadow-lg">
                            {{ __('Back to Projects') }}
                        </a>
                    </div>
                </div>

                <!-- JavaScript for Toggle Functionality -->
                <script>
                    function toggleDocumentComments(documentId) {
                        const form = document.getElementById('document-comment-form-' + documentId);
                        const list = document.getElementById('document-comments-list-' + documentId);
                        
                        if (form && list) {
                            const isHidden = form.classList.contains('hidden');
                            if (isHidden) {
                                form.classList.remove('hidden');
                                list.classList.remove('hidden');
                            } else {
                                form.classList.add('hidden');
                                list.classList.add('hidden');
                            }
                        }
                    }

                    function toggleCommentForm() {
                        const formContainer = document.getElementById('comment-form-container');
                        if (formContainer) {
                            formContainer.classList.toggle('hidden');
                        }
                    }

                    function toggleReplyForm(commentId) {
                        const form = document.getElementById('reply-form-' + commentId);
                        if (form) {
                            form.classList.toggle('hidden');
                        }
                    }

                    function toggleEditForm(commentId) {
                        const form = document.getElementById('edit-form-' + commentId);
                        if (form) {
                            form.classList.toggle('hidden');
                        }
                    }

                    function toggleReplies(commentId) {
                        const repliesContainer = document.getElementById('replies-' + commentId);
                        const toggleButton = event.target;
                        
                        if (repliesContainer && toggleButton) {
                            repliesContainer.classList.toggle('hidden');
                            if (repliesContainer.classList.contains('hidden')) {
                                toggleButton.textContent = 'Show replies';
                            } else {
                                toggleButton.textContent = 'Hide replies';
                            }
                        }
                    }
                </script>
            </div>
        </div>
    </div>
</x-app-layout>
