<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <a href="{{ route('projects.show', $project) }}" class="inline-flex items-center px-3 py-2 bg-gray-600 hover:bg-gray-700 text-white text-sm font-medium rounded-lg transition-colors duration-200 shadow-md hover:shadow-lg">
                    ← Back to Project
                </a>
                <div>
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ $document->title }}
                    </h2>
                    <p class="text-sm text-gray-600 mt-1">Document in {{ $project->title }}</p>
                </div>
            </div>
            <div class="flex space-x-2">
                <a href="{{ route('projects.documents.download', [$project, $document]) }}" 
                   class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white text-sm font-medium rounded-lg transition-all duration-200 shadow-md hover:shadow-lg transform hover:-translate-y-1 group">
                    <svg class="w-4 h-4 mr-2 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Download
                </a>
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
                @endif
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-lg p-8">
                <!-- Document Header -->
                <div class="flex items-center justify-between mb-6 border-b border-gray-200 pb-6">
                    <div class="flex items-center space-x-4">
                        <!-- File Icon -->
                        <div class="flex-shrink-0">
                            <div class="w-16 h-16 bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500 rounded-2xl flex items-center justify-center shadow-lg relative overflow-hidden">
                                <!-- Decorative corner accent -->
                                <div class="absolute top-0 right-0 w-8 h-8 bg-white bg-opacity-20 rounded-bl-2xl transform rotate-45 group-hover:bg-opacity-30 transition-all duration-300"></div>
                                
                                <!-- File type icon -->
                                <div class="relative z-10">
                                    @if($document->getFileExtension() === 'pdf')
                                        <div class="text-white">
                                            <svg class="w-8 h-8 mx-auto mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                            </svg>
                                            <div class="text-xs font-bold text-center uppercase tracking-wider opacity-90">PDF</div>
                                        </div>
                                    @elseif(in_array($document->getFileExtension(), ['doc', 'docx']))
                                        <div class="text-white">
                                            <svg class="w-8 h-8 mx-auto mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                            </svg>
                                            <div class="text-xs font-bold text-center uppercase tracking-wider opacity-90">DOC</div>
                                        </div>
                                    @else
                                        <div class="text-white">
                                            <svg class="w-8 h-8 mx-auto mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
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
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900">{{ $document->title }}</h3>
                            <div class="flex items-center space-x-4 text-sm text-gray-600 mt-2">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                    {{ $document->file_name }}
                                </span>
                                <span class="text-xs text-gray-500">{{ number_format($document->file_size / 1024, 2) }} KB</span>
                                <span class="text-xs text-gray-500">{{ $document->created_at->diffForHumans() }}</span>
                            </div>
                            @if($document->description)
                                <p class="text-gray-600 text-sm leading-relaxed mt-2 max-w-2xl">{{ $document->description }}</p>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Document Actions -->
                    <div class="flex items-center space-x-2">
                        @if(auth()->user()->role === 'teacher')
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                Teacher
                            </span>
                        @endif
                    </div>
                </div>

                <!-- Document Preview Section -->
                <div class="mb-8">
                    <h4 class="text-lg font-semibold text-gray-900 mb-4">Document Preview</h4>
                    <div class="bg-gray-50 rounded-lg p-6 border-2 border-dashed border-gray-300">
                        <div class="text-center">
                            <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <p class="text-gray-600 text-sm">Document preview will be available here</p>
                            <p class="text-gray-500 text-xs mt-1">Click download to view the full document</p>
                        </div>
                    </div>
                </div>

                <!-- Comments Section -->
                <div class="border-t border-gray-200 pt-8">
                    <div class="flex items-center justify-between mb-6">
                        <div class="inline-flex items-center space-x-2 text-lg font-semibold text-gray-900">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                            <span>Document Comments</span>
                        </div>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                            {{ $comments->count() }} {{ $comments->count() === 1 ? 'comment' : 'comments' }}
                        </span>
                    </div>
                    
                    <!-- Add Comment Section -->
                    @if(auth()->user()->role === 'teacher' || auth()->user()->role === 'student')
                        <div class="mb-6">
                            <div class="flex items-start space-x-3">
                                <!-- User Avatar -->
                                <div class="flex-shrink-0">
                                    <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500 rounded-full flex items-center justify-center shadow-lg border-2 border-white dark:border-gray-800">
                                        <span class="text-sm font-bold text-white">{{ strtoupper(substr(auth()->user()->name, 0, 2)) }}</span>
                                    </div>
                                </div>
                                
                                <!-- Comment Form -->
                                <div class="flex-1 bg-white rounded-2xl p-4 border border-gray-200 shadow-sm">
                                    <form action="{{ route('projects.documents.comments.store', [$project, $document]) }}" method="POST">
                                        @csrf
                                        <div class="grid grid-cols-1 md:grid-cols-6 gap-4">
                                            <div class="md:col-span-4">
                                                <label for="content" class="block text-sm font-medium text-gray-700 mb-1">{{ __('Add a comment') }}</label>
                                                <textarea name="content" id="content" rows="3" 
                                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500"
                                                    placeholder="Share your thoughts about this document...">{{ old('content') }}</textarea>
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
                                        <div class="mt-3 flex justify-end">
                                            <button type="submit" 
                                                    class="inline-flex items-center px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg transition-colors duration-200 shadow-md hover:shadow-lg">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                                </svg>
                                                Post Comment
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif
                    
                    <!-- Comments List -->
                    <div class="space-y-4">
                        @if($comments->isEmpty())
                            <div class="text-center py-12">
                                <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                </svg>
                                <p class="text-gray-500 text-lg font-medium">No comments yet</p>
                                <p class="text-gray-400 text-sm mt-1">Be the first to comment on this document!</p>
                            </div>
                        @else
                            @foreach($comments as $comment)
                                <div class="group">
                                    <!-- Comment Card -->
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
                                                            <form action="{{ route('projects.documents.comments.destroy', [$project, $document, $comment]) }}" method="POST" class="inline">
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
                                            <form action="{{ route('projects.documents.comments.update', [$project, $document, $comment]) }}" method="POST">
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
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript for Toggle Functionality -->
    <script>
        function toggleEditForm(commentId) {
            const form = document.getElementById('edit-form-' + commentId);
            if (form) {
                form.classList.toggle('hidden');
            }
        }
    </script>
</x-app-layout>