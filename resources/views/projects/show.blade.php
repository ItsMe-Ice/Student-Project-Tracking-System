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
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">{{ __('Documents') }}</h3>
                    
                    @if($project->documents->isEmpty())
                        <p class="text-gray-500 text-center py-4">{{ __('No documents uploaded yet.') }}</p>
                    @else
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="grid grid-cols-1 gap-4">
                                @foreach($project->documents as $document)
                                    <div class="flex items-center justify-between bg-white p-4 rounded-lg shadow-sm border border-gray-200">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-10 h-10 bg-indigo-100 rounded-full flex items-center justify-center">
                                                @if($document->getFileExtension() === 'pdf')
                                                    <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                    </svg>
                                                @elseif(in_array($document->getFileExtension(), ['doc', 'docx']))
                                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                                    </svg>
                                                @else
                                                    <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"></path>
                                                    </svg>
                                                @endif
                                            </div>
                                            <div class="flex-1">
                                                <div class="flex items-center justify-between">
                                                    <div>
                                                        <h4 class="font-medium text-gray-900">{{ $document->title }}</h4>
                                                        <p class="text-sm text-gray-600">{{ $document->file_name }} • {{ number_format($document->file_size / 1024, 2) }} KB</p>
                                                        @if($document->description)
                                                            <p class="text-sm text-gray-500 mt-1">{{ $document->description }}</p>
                                                        @endif
                                                    </div>
                                                    <div class="flex items-center space-x-2">
                                                        <span class="text-xs text-gray-500">{{ $document->created_at->diffForHumans() }}</span>
                                                        <a href="{{ route('projects.documents.download', [$project, $document]) }}" 
                                                           class="inline-flex items-center px-3 py-1 bg-green-100 text-green-800 text-sm font-medium rounded-full hover:bg-green-200 transition-colors">
                                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                            </svg>
                                                            Download
                                                        </a>
                                                        @if(auth()->user()->role === 'student' && $document->user_id === auth()->user()->id)
                                                            <form action="{{ route('projects.documents.destroy', [$project, $document]) }}" method="POST" class="inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" onclick="return confirm('Are you sure you want to delete this document?')" 
                                                                        class="inline-flex items-center px-3 py-1 bg-red-100 text-red-800 text-sm font-medium rounded-full hover:bg-red-200 transition-colors">
                                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                                    </svg>
                                                                    Delete
                                                                </button>
                                                            </form>
                                                        @elseif(auth()->user()->role === 'teacher')
                                                            <span class="text-xs text-gray-500">Teacher</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                
                                                <!-- Document Comments Section -->
                                                <div class="mt-4 pt-4 border-t border-gray-200">
                                                    <div class="flex items-center justify-between mb-4">
                                                        <div class="flex items-center space-x-3">
                                                            <button type="button" 
                                                                    onclick="toggleDocumentComments('{{ $document->id }}')"
                                                                    class="inline-flex items-center space-x-2 text-sm font-semibold text-gray-900 hover:text-indigo-600 transition-colors">
                                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                                                </svg>
                                                                <span>Document Comments</span>
                                                            </button>
                                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                                {{ $document->comments->count() }} {{ $document->comments->count() === 1 ? 'comment' : 'comments' }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                    
                                                    <!-- Document Comment Form -->
                                                    @if(auth()->user()->role === 'teacher' || auth()->user()->role === 'student')
                                                        <div id="document-comment-form-{{ $document->id }}" class="mb-6 bg-white rounded-xl border-2 border-indigo-200 shadow-lg transition-all duration-300 ease-in-out hidden" style="margin-left: -16px; margin-right: -16px;">
                                                            <div class="p-6">
                                                                <div class="flex items-center justify-between mb-4">
                                                                    <div class="flex items-center space-x-3">
                                                                        <div class="w-8 h-8 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-full flex items-center justify-center">
                                                                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                                                            </svg>
                                                                        </div>
                                                                        <div>
                                                                            <h6 class="text-sm font-semibold text-gray-900">Add your comment</h6>
                                                                            <p class="text-xs text-gray-600">Share your thoughts about this document</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <form action="{{ route('projects.comments.store', $project) }}" method="POST" class="space-y-4">
                                                                    @csrf
                                                                    <input type="hidden" name="document_id" value="{{ $document->id }}">
                                                                    <div class="grid grid-cols-1 gap-4">
                                                                        <div>
                                                                            <label for="document-content-{{ $document->id }}" class="block text-sm font-medium text-gray-700 mb-2">Your comment</label>
                                                                            <textarea name="content" id="document-content-{{ $document->id }}" rows="4" 
                                                                                class="w-full px-4 py-3 border-2 border-indigo-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200 resize-none placeholder-gray-500"
                                                                                placeholder="Share your thoughts about this document... What do you think about the content? Any feedback or questions?">{{ old('content') }}</textarea>
                                                                            @error('content')
                                                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                                            @enderror
                                                                        </div>
                                                                        <div>
                                                                            <label for="document-comment-type-{{ $document->id }}" class="block text-sm font-medium text-gray-700 mb-2">Comment type</label>
                                                                            <select name="comment_type" id="document-comment-type-{{ $document->id }}" 
                                                                                class="w-full px-4 py-3 border-2 border-indigo-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200">
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
                                                                    <div class="flex justify-end space-x-3 pt-2">
                                                                        <button type="submit" 
                                                                                class="px-6 py-2 text-sm font-medium text-white bg-gradient-to-r from-indigo-600 to-purple-600 rounded-lg hover:from-indigo-700 hover:to-purple-700 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-1 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                                                            <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                                                            </svg>
                                                                            Post Comment
                                                                        </button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    
                                                    <!-- Document Comments List -->
                                                    <div id="document-comments-list-{{ $document->id }}" class="hidden">
                                                        @if($document->comments->isEmpty())
                                                            <div class="text-center py-8">
                                                                <div class="w-16 h-16 bg-gradient-to-r from-gray-200 to-gray-300 rounded-full mx-auto mb-4 flex items-center justify-center">
                                                                    <svg class="w-8 h-8 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                                                    </svg>
                                                                </div>
                                                                <p class="text-gray-500 text-sm font-medium">No comments yet</p>
                                                                <p class="text-gray-400 text-xs mt-1">Be the first to comment on this document</p>
                                                            </div>
                                                        @else
                                                            <div class="space-y-4">
                                                            @foreach($document->comments as $comment)
                                                                <div class="bg-white rounded-lg p-4 border border-gray-200 hover:shadow-md transition-shadow duration-200">
                                                                    <div class="flex items-start justify-between">
                                                                        <div class="flex-1">
                                                                            <div class="flex items-center space-x-3 mb-3">
                                                                                <div class="flex items-center space-x-2">
                                                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                                                        {{ $comment->comment_type === 'feedback' ? 'bg-green-100 text-green-800' : 
                                                                                           ($comment->comment_type === 'question' ? 'bg-yellow-100 text-yellow-800' : 
                                                                                           ($comment->comment_type === 'answer' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800')) }}">
                                                                                        {{ ucfirst($comment->comment_type) }}
                                                                                    </span>
                                                                                    <span class="text-xs text-gray-500">•</span>
                                                                                    <span class="text-xs text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="flex items-center space-x-3 mb-3">
                                                                                <div class="w-8 h-8 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-full flex items-center justify-center">
                                                                                    <span class="text-xs font-semibold text-white">{{ strtoupper(substr($comment->user->name, 0, 2)) }}</span>
                                                                                </div>
                                                                                <div>
                                                                                    <h4 class="font-medium text-gray-900 text-sm">{{ $comment->user->name }}</h4>
                                                                                    <p class="text-xs text-gray-600">{{ ucfirst($comment->user->role) }}</p>
                                                                                </div>
                                                                            </div>
                                                                            <div class="text-gray-700 text-sm leading-relaxed">
                                                                                {{ $comment->content }}
                                                                            </div>
                                                                            
                                                                            <!-- Reply Form -->
                                                                            @if(auth()->user()->role === 'teacher' || auth()->user()->role === 'student')
                                                                                <div class="mt-4 pt-4 border-t border-gray-100">
                                                                                    <button type="button" 
                                                                                            onclick="toggleReplyForm('{{ $comment->id }}')"
                                                                                            class="text-sm text-indigo-600 hover:text-indigo-800 font-medium inline-flex items-center">
                                                                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path>
                                                                                        </svg>
                                                                                        Reply
                                                                                    </button>
                                                                                </div>
                                                                                
                                                                                <div id="reply-form-{{ $comment->id }}" class="mt-4 p-4 bg-gray-50 rounded-lg hidden">
                                                                                    <form action="{{ route('projects.comments.store', $project) }}" method="POST" class="space-y-3">
                                                                                        @csrf
                                                                                        <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                                                                        <input type="hidden" name="document_id" value="{{ $document->id }}">
                                                                                        <textarea name="content" rows="2" 
                                                                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500"
                                                                                            placeholder="Write your reply..."></textarea>
                                                                                        <div class="flex justify-end space-x-2">
                                                                                            <button type="button" 
                                                                                                    onclick="toggleReplyForm('{{ $comment->id }}')"
                                                                                                    class="px-3 py-1 text-sm bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">
                                                                                                Cancel
                                                                                            </button>
                                                                                            <button type="submit" 
                                                                                                    class="px-3 py-1 text-sm bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                                                                                                Reply
                                                                                            </button>
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                        
                                                                        <!-- Comment Actions -->
                                                                        <div class="flex space-x-2">
                                                                            @if($comment->user_id === auth()->user()->id || auth()->user()->role === 'teacher' || auth()->user()->role === 'admin')
                                                                                <!-- Edit Button -->
                                                                                @if($comment->user_id === auth()->user()->id)
                                                                                    <button type="button" 
                                                                                            onclick="toggleEditForm('{{ $comment->id }}')"
                                                                                            class="text-sm text-blue-600 hover:text-blue-800">
                                                                                        Edit
                                                                                    </button>
                                                                                @endif
                                                                                
                                                                                <!-- Delete Button -->
                                                                                <form action="{{ route('projects.comments.destroy', [$project, $comment]) }}" method="POST" class="inline">
                                                                                    @csrf
                                                                                    @method('DELETE')
                                                                                    <button type="submit" 
                                                                                            onclick="return confirm('Are you sure you want to delete this comment?')"
                                                                                            class="text-sm text-red-600 hover:text-red-800">
                                                                                        Delete
                                                                                    </button>
                                                                                </form>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <!-- Edit Form -->
                                                                    @if($comment->user_id === auth()->user()->id)
                                                                        <div id="edit-form-{{ $comment->id }}" class="mt-4 p-4 bg-white border border-gray-300 rounded-lg hidden">
                                                                            <form action="{{ route('projects.comments.update', [$project, $comment]) }}" method="POST">
                                                                                @csrf
                                                                                @method('PUT')
                                                                                <div class="grid grid-cols-1 gap-4">
                                                                                    <div>
                                                                                        <textarea name="content" rows="3" 
                                                                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">{{ $comment->content }}</textarea>
                                                                                    </div>
                                                                                    <div>
                                                                                        <select name="comment_type" 
                                                                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                                                                                            <option value="general" {{ $comment->comment_type === 'general' ? 'selected' : '' }}>General</option>
                                                                                            <option value="feedback" {{ $comment->comment_type === 'feedback' ? 'selected' : '' }}>Feedback</option>
                                                                                            <option value="question" {{ $comment->comment_type === 'question' ? 'selected' : '' }}>Question</option>
                                                                                            <option value="answer" {{ $comment->comment_type === 'answer' ? 'selected' : '' }}>Answer</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="mt-4 flex justify-end space-x-2">
                                                                                    <button type="button" 
                                                                                            onclick="toggleEditForm('{{ $comment->id }}')"
                                                                                            class="px-3 py-1 text-sm bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">
                                                                                        Cancel
                                                                                    </button>
                                                                                    <button type="submit" 
                                                                                            class="px-3 py-1 text-sm bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                                                                                        Update
                                                                                    </button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    @endif
                                                                    
                                                                    <!-- Replies -->
                                                                    @if($comment->replies->isNotEmpty())
                                                                        <div class="mt-4 ml-8 space-y-3 border-l-2 border-gray-100 pl-4">
                                                                            @foreach($comment->replies as $reply)
                                                                                <div class="bg-gray-50 rounded-lg p-3 border border-gray-200">
                                                                                    <div class="flex items-start justify-between">
                                                                                        <div class="flex-1">
                                                                                            <div class="flex items-center space-x-2 mb-2">
                                                                                                <div class="w-6 h-6 bg-gradient-to-r from-green-500 to-blue-500 rounded-full flex items-center justify-center">
                                                                                                    <span class="text-xs font-semibold text-white">{{ strtoupper(substr($reply->user->name, 0, 2)) }}</span>
                                                                                                </div>
                                                                                                <div>
                                                                                                    <h5 class="font-medium text-gray-900 text-xs">{{ $reply->user->name }}</h5>
                                                                                                    <p class="text-xs text-gray-600">{{ ucfirst($reply->user->role) }}</p>
                                                                                                </div>
                                                                                                <span class="text-xs text-gray-500">{{ $reply->created_at->diffForHumans() }}</span>
                                                                                            </div>
                                                                                            <p class="text-gray-700 text-sm">{{ $reply->content }}</p>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            @endforeach
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            @endforeach
                                                            </div>
                                                        @endif
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Comments Section -->
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <div class="flex items-center justify-between mb-4">
                        <button type="button" 
                                onclick="toggleProjectComments()"
                                class="inline-flex items-center space-x-2 text-lg font-semibold text-gray-900 hover:text-indigo-600 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                            <span>{{ __('Comments') }}</span>
                        </button>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                            {{ $project->comments->count() }} {{ $project->comments->count() === 1 ? 'comment' : 'comments' }}
                        </span>
                    </div>
                    
                    <!-- Comment Form -->
                    @if(auth()->user()->role === 'teacher' || auth()->user()->role === 'student')
                        <div id="project-comment-form" class="bg-gray-50 rounded-lg p-4 mb-4 hidden">
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
                                <div class="mt-3 flex justify-end">
                                    <button type="submit" 
                                        class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg transition-colors duration-200 shadow-md hover:shadow-lg">
                                        {{ __('Post Comment') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    @endif

                    <!-- Comments List -->
                    <div id="project-comments-list" class="hidden max-h-64 overflow-y-auto space-y-3">
                        @if($project->comments->isEmpty())
                            <p class="text-gray-500 text-center py-4">{{ __('No comments yet. Be the first to comment!') }}</p>
                        @else
                            @foreach($project->comments as $comment)
                                @include('projects.partials.comment', ['comment' => $comment])
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

                    function toggleProjectComments() {
                        const form = document.getElementById('project-comment-form');
                        const list = document.getElementById('project-comments-list');
                        
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
                </script>
            </div>
        </div>
    </div>
</x-app-layout>
