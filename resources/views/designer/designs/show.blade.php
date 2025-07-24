@extends('layouts.app')

@section('title', $design->title)

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 py-8">
    <div class="container mx-auto px-4">
        <!-- Breadcrumb & Header -->
        <div class="mb-6">
            <nav class="flex items-center space-x-2 text-sm text-gray-500 mb-4">
                <a href="{{ route('designer.designs.index') }}" class="hover:text-gray-700 transition-colors">
                    Designs
                </a>
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                </svg>
                <span class="text-gray-900 font-medium">{{ $design->title }}</span>
            </nav>
            
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <h1 class="text-2xl font-bold text-gray-900">{{ $design->title }}</h1>
                    <div class="flex items-center space-x-2">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $design->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            <span class="w-1.5 h-1.5 mr-1.5 rounded-full {{ $design->is_active ? 'bg-green-400' : 'bg-red-400' }}"></span>
                            {{ $design->is_active ? 'Active' : 'Inactive' }}
                        </span>
                        @if($design->is_featured)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800">
                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                                Featured
                            </span>
                        @endif
                    </div>
                </div>
                
                <!-- Action Buttons -->
                <div class="flex items-center space-x-3">
                    <a href="{{ route('designer.designs.edit', $design) }}" 
                       class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Edit
                    </a>
                    
                    <form action="{{ route('designer.designs.toggle-status', $design) }}" 
                          method="POST" 
                          class="inline"
                          onsubmit="return confirm('Are you sure you want to {{ $design->is_active ? 'deactivate' : 'activate' }} this design?')">
                        @csrf
                        @method('PATCH')
                        <button type="submit" 
                                class="inline-flex items-center px-4 py-2 bg-{{ $design->is_active ? 'amber' : 'green' }}-600 text-white text-sm font-medium rounded-lg hover:bg-{{ $design->is_active ? 'amber' : 'green' }}-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-{{ $design->is_active ? 'amber' : 'green' }}-500 transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $design->is_active ? 'M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L18.364 5.636M5.636 18.364l12.728-12.728' : 'M5 13l4 4L19 7' }}"></path>
                            </svg>
                            {{ $design->is_active ? 'Deactivate' : 'Activate' }}
                        </button>
                    </form>
                    
                    <div class="relative">
                        <button type="button" class="inline-flex items-center px-3 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" onclick="toggleDropdown()">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"></path>
                            </svg>
                        </button>
                        <div id="dropdown" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 z-10">
                            <div class="py-1">
                                <button onclick="copyToClipboard('{{ url()->current() }}')" class="flex items-center w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-2m-4-4v8a2 2 0 01-2 2H6a2 2 0 01-2-2v-4a2 2 0 012-2h2m8-4h2a2 2 0 012 2v4a2 2 0 01-2 2h-2m-4-4h2a2 2 0 012 2v4a2 2 0 01-2 2h-2m-4-4v4a2 2 0 01-2 2H6a2 2 0 01-2-2v-4a2 2 0 012-2h4z"></path>
                                    </svg>
                                    Copy Link
                                </button>
                                <form action="{{ route('designer.designs.destroy', $design) }}" 
                                      method="POST" 
                                      class="w-full"
                                      onsubmit="return confirm('Are you sure you want to delete this design? This action cannot be undone.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="flex items-center w-full px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="bg-green-50 border-l-4 border-green-400 p-4 mb-6">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-green-700">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Main Content -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left Column - Image & Basic Info -->
            <div class="lg:col-span-1 space-y-6">
                <!-- Design Image -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="aspect-square bg-gray-50 flex items-center justify-center">
                        <img src="{{ $design->image_url }}" 
                             alt="{{ $design->title }}" 
                             class="w-full h-full object-cover">
                    </div>
                </div>

                <!-- Price & Quick Actions -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <div class="text-center">
                        <div class="text-3xl font-bold text-gray-900 mb-2">${{ number_format($design->price, 2) }}</div>
                        <p class="text-sm text-gray-500 mb-4">Design Price</p>
                        
                        <div class="space-y-3">
                            @if($design->category)
                                <div class="flex items-center justify-between text-sm">
                                    <span class="text-gray-500">Category</span>
                                    <span class="font-medium text-gray-900">{{ $design->category }}</span>
                                </div>
                            @endif
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-gray-500">Status</span>
                                <span class="font-medium {{ $design->is_active ? 'text-green-600' : 'text-red-600' }}">
                                    {{ $design->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Statistics -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Performance</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="text-center">
                            <div class="text-2xl font-bold text-gray-900">0</div>
                            <div class="text-xs text-gray-500">Views</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-gray-900">0</div>
                            <div class="text-xs text-gray-500">Likes</div>
                        </div>
                    </div>
                    <p class="text-xs text-gray-400 mt-4 text-center italic">
                        Statistics coming soon
                    </p>
                </div>
            </div>

            <!-- Right Column - Details -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Description -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">Description</h2>
                    <div class="prose prose-gray max-w-none">
                        <p class="text-gray-700 leading-relaxed">{{ $design->description ?: 'No description provided.' }}</p>
                    </div>
                </div>

                <!-- Tags -->
                @if($design->tags && count($design->tags) > 0)
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <h2 class="text-xl font-semibold text-gray-900 mb-4">Tags</h2>
                        <div class="flex flex-wrap gap-2">
                            @foreach($design->tags as $tag)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-50 text-blue-700 border border-blue-200">
                                    #{{ $tag }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Metadata -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">Information</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Created</dt>
                                <dd class="mt-1 text-sm font-medium text-gray-900">
                                    {{ $design->created_at->format('M j, Y') }}
                                    <span class="text-gray-500">at {{ $design->created_at->format('g:i A') }}</span>
                                </dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Last Updated</dt>
                                <dd class="mt-1 text-sm font-medium text-gray-900">
                                    {{ $design->updated_at->format('M j, Y') }}
                                    <span class="text-gray-500">at {{ $design->updated_at->format('g:i A') }}</span>
                                </dd>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Featured Status</dt>
                                <dd class="mt-1 text-sm font-medium text-gray-900">
                                    {{ $design->is_featured ? 'Featured Design' : 'Standard Design' }}
                                </dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">ID</dt>
                                <dd class="mt-1 text-sm font-mono text-gray-500">#{{ $design->id }}</dd>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Additional Actions -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">Quick Actions</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <button onclick="copyToClipboard('{{ url()->current() }}')" 
                                class="inline-flex items-center justify-center px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-100 transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-2m-4-4v8a2 2 0 01-2 2H6a2 2 0 01-2-2v-4a2 2 0 012-2h2m8-4h2a2 2 0 012 2v4a2 2 0 01-2 2h-2m-4-4h2a2 2 0 012 2v4a2 2 0 01-2 2h-2m-4-4v4a2 2 0 01-2 2H6a2 2 0 01-2-2v-4a2 2 0 012-2h4z"></path>
                            </svg>
                            Copy Share Link
                        </button>
                        <a href="{{ route('designer.designs.edit', $design) }}" 
                           class="inline-flex items-center justify-center px-4 py-3 bg-blue-50 border border-blue-200 rounded-lg text-sm font-medium text-blue-700 hover:bg-blue-100 transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            Edit Design
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        // Show success feedback
        const button = event.target.closest('button');
        const originalText = button.innerHTML;
        button.innerHTML = '<svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>Copied!';
        button.classList.add('bg-green-50', 'border-green-200', 'text-green-700');
        
        setTimeout(() => {
            button.innerHTML = originalText;
            button.classList.remove('bg-green-50', 'border-green-200', 'text-green-700');
        }, 2000);
    }, function(err) {
        console.error('Could not copy text: ', err);
        alert('Failed to copy link. Please try again.');
    });
}

function toggleDropdown() {
    const dropdown = document.getElementById('dropdown');
    dropdown.classList.toggle('hidden');
}

// Close dropdown when clicking outside
document.addEventListener('click', function(event) {
    const dropdown = document.getElementById('dropdown');
    const button = event.target.closest('button');
    
    if (!button || !button.onclick || button.onclick.toString().indexOf('toggleDropdown') === -1) {
        dropdown.classList.add('hidden');
    }
});
</script>
@endsection