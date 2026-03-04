<div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
    <div class="flex items-start justify-between">
        <div class="flex-1">
            <div class="flex items-center space-x-2 mb-2">
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                    {{ $comment->comment_type === 'feedback' ? 'bg-green-100 text-green-800' : 
                       ($comment->comment_type === 'question' ? 'bg-yellow-100 text-yellow-800' : 
                       ($comment->comment_type === 'answer' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800')) }}">
                    {{ ucfirst($comment->comment_type) }}
                </span>
                <span class="text-sm text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
            </div>
            <div class="flex items-center space-x-2 mb-2">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-indigo-100 rounded-full flex items-center justify-center">
                        <span class="text-sm font-medium text-indigo-700">{{ strtoupper(substr($comment->user->name, 0, 2)) }}</span>
                    </div>
                </div>
                <div>
                    <h4 class="font-medium text-gray-900">{{ $comment->user->name }}</h4>
                    <p class="text-sm text-gray-600">{{ ucfirst($comment->user->role) }}</p>
                </div>
            </div>
            <div class="text-gray-700 leading-relaxed">
                {{ $comment->content }}
            </div>
            
            <!-- Reply Form -->
            @if(auth()->user()->role === 'teacher' || auth()->user()->role === 'student')
                <div class="mt-3 pt-3 border-t border-gray-200">
                    <button type="button" 
                            onclick="toggleReplyForm('{{ $comment->id }}')"
                            class="text-sm text-indigo-600 hover:text-indigo-800 font-medium">
                        Reply
                    </button>
                </div>
                
                <div id="reply-form-{{ $comment->id }}" class="mt-3 hidden">
                    <form action="{{ route('projects.comments.store', $project) }}" method="POST" class="space-y-2">
                        @csrf
                        <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                        <div class="grid grid-cols-1 md:grid-cols-6 gap-4">
                            <div class="md:col-span-4">
                                <textarea name="content" rows="2" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500"
                                    placeholder="Write your reply..."></textarea>
                            </div>
                            <div class="md:col-span-2">
                                <select name="comment_type" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                                    <option value="general">General</option>
                                    <option value="feedback">Feedback</option>
                                    <option value="question">Question</option>
                                    <option value="answer">Answer</option>
                                </select>
                            </div>
                        </div>
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
                <div class="grid grid-cols-1 md:grid-cols-6 gap-4">
                    <div class="md:col-span-4">
                        <textarea name="content" rows="3" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">{{ $comment->content }}</textarea>
                    </div>
                    <div class="md:col-span-2">
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
        <div class="mt-4 ml-6 space-y-3">
            @foreach($comment->replies as $reply)
                @include('projects.partials.comment', ['comment' => $reply])
            @endforeach
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
