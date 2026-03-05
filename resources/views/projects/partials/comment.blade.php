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
            <div class="bg-white dark:bg-gray-800 rounded-2xl rounded-bl-none p-4 shadow-sm border border-gray-100 dark:border-gray-700 group-hover:shadow-md transition-shadow duration-200">
                <!-- Comment Header -->
                <div class="flex items-center justify-between mb-2">
                    <div class="flex items-center space-x-2">
                        <h4 class="font-semibold text-gray-900 dark:text-white text-sm">{{ $comment->user->name }}</h4>
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-200">
                            {{ ucfirst($comment->user->role) }}
                        </span>
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                            {{ $comment->comment_type === 'feedback' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 
                               ($comment->comment_type === 'question' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200' : 
                               ($comment->comment_type === 'answer' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200' : 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200')) }}">
                            {{ ucfirst($comment->comment_type) }}
                        </span>
                    </div>
                    <div class="flex items-center space-x-2 text-xs text-gray-500 dark:text-gray-400">
                        <span>{{ $comment->created_at->diffForHumans() }}</span>
                        <span>•</span>
                        <span>{{ $comment->replies->count() }} {{ $comment->replies->count() === 1 ? 'reply' : 'replies' }}</span>
                    </div>
                </div>
                
                <!-- Comment Body -->
                <div class="text-gray-800 dark:text-gray-200 text-sm leading-relaxed whitespace-pre-wrap">
                    {{ $comment->content }}
                </div>
                
                <!-- Comment Actions -->
                <div class="flex items-center justify-between mt-3 pt-3 border-t border-gray-100 dark:border-gray-700">
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
    
    <!-- Reply Form (moved outside of replies section) -->
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

<script>
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

function toggleDocumentCommentForm(documentId) {
    const form = document.getElementById('document-comment-form-' + documentId);
    if (form) {
        form.classList.toggle('hidden');
    }
}
</script>
