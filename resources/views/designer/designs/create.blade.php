@extends('layouts.app')

@section('title', 'Upload New Design')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 py-8">
    <div class="container mx-auto px-4">
        <div class="max-w-7xl mx-auto">
            <!-- Back Button & Header -->
            <div class="flex items-center mb-8">
                <a href="{{ route('designer.designs.index') }}" 
                   class="flex items-center justify-center w-12 h-12 bg-white/80 backdrop-blur-sm rounded-xl shadow-lg hover:bg-white transition-all duration-300 mr-6 group">
                    <svg class="w-6 h-6 text-gray-600 group-hover:text-blue-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </a>
                <div>
                    <h1 class="text-4xl font-bold text-gray-900 mb-2">Upload New Design</h1>
                    <p class="text-gray-600 text-lg">Share your creative work with the world</p>
                </div>
            </div>

            <!-- Modern Form -->
            <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 p-8">
                <form action="{{ route('designer.designs.store') }}" method="POST" enctype="multipart/form-data">
                <form action="{{ route('designer.designs.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- Left Column -->
                        <div class="space-y-8">
                            <!-- Title -->
                            <div class="space-y-3">
                                <label for="title" class="block text-sm font-bold text-gray-900 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                    </svg>
                                    Design Title <span class="text-red-500 ml-1">*</span>
                                </label>
                                <input type="text" 
                                       id="title" 
                                       name="title" 
                                       value="{{ old('title') }}"
                                       class="w-full px-4 py-4 border border-gray-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-gray-50/50 transition-all text-lg font-medium @error('title') border-red-500 ring-red-500 @enderror"
                                       placeholder="Enter your design title"
                                       required>
                                @error('title')
                                    <p class="mt-2 text-sm text-red-600 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Description -->
                            <div class="space-y-3">
                                <label for="description" class="block text-sm font-bold text-gray-900 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                                    </svg>
                                    Description <span class="text-red-500 ml-1">*</span>
                                </label>
                                <textarea id="description" 
                                          name="description" 
                                          rows="6"
                                          class="w-full px-4 py-4 border border-gray-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-gray-50/50 transition-all text-lg resize-none @error('description') border-red-500 ring-red-500 @enderror"
                                          placeholder="Describe your design in detail..."
                                          required>{{ old('description') }}</textarea>
                                @error('description')
                                    <p class="mt-2 text-sm text-red-600 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Price and Category Row -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Price -->
                                <div class="space-y-3">
                                    <label for="price" class="block text-sm font-bold text-gray-900 flex items-center">
                                        <svg class="w-5 h-5 mr-2 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                        </svg>
                                        Price (USD) <span class="text-red-500 ml-1">*</span>
                                    </label>
                                    <div class="relative">
                                        <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-500 text-lg font-bold">$</span>
                                        <input type="number" 
                                               id="price" 
                                               name="price" 
                                               value="{{ old('price') }}"
                                               step="0.01"
                                               min="0"
                                               max="999999.99"
                                               class="w-full pl-8 pr-4 py-4 border border-gray-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-gray-50/50 transition-all text-lg font-medium @error('price') border-red-500 ring-red-500 @enderror"
                                               placeholder="0.00"
                                               required>
                                    </div>
                                    @error('price')
                                        <p class="mt-2 text-sm text-red-600 flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                            </svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <!-- Category -->
                                <div class="space-y-3">
                                    <label for="category" class="block text-sm font-bold text-gray-900 flex items-center">
                                        <svg class="w-5 h-5 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                        </svg>
                                        Category
                                    </label>
                                    <select id="category" 
                                            name="category"
                                            class="w-full px-4 py-4 border border-gray-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-gray-50/50 transition-all text-lg font-medium @error('category') border-red-500 ring-red-500 @enderror">
                                        <option value="" class="text-gray-500">Select a category</option>
                                        @foreach($categories as $key => $category)
                                            <option value="{{ $key }}" {{ old('category') == $key ? 'selected' : '' }}>
                                                {{ $category }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category')
                                        <p class="mt-2 text-sm text-red-600 flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                            </svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Tags -->
                            <div class="space-y-3">
                                <label for="tags" class="block text-sm font-bold text-gray-900 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                    </svg>
                                    Tags
                                </label>
                                <input type="text" 
                                       id="tags" 
                                       name="tags" 
                                       value="{{ old('tags') }}"
                                       class="w-full px-4 py-4 border border-gray-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-gray-50/50 transition-all text-lg font-medium @error('tags') border-red-500 ring-red-500 @enderror"
                                       placeholder="elegant, formal, evening, trendy">
                                <p class="mt-2 text-sm text-gray-500 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Separate multiple tags with commas
                                </p>
                                @error('tags')
                                    <p class="mt-2 text-sm text-red-600 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="space-y-8">
                            <!-- Image Upload -->
                            <div class="space-y-3">
                                <label for="image" class="block text-sm font-bold text-gray-900 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    Design Image <span class="text-red-500 ml-1">*</span>
                                </label>
                                <div class="relative">
                                    <div class="flex justify-center px-8 pt-12 pb-12 border-2 border-dashed border-gray-300 rounded-2xl hover:border-blue-400 transition-all duration-300 bg-gray-50/30 hover:bg-blue-50/30 group @error('image') border-red-500 @enderror">
                                        <div class="space-y-6 text-center">
                                            <div class="w-20 h-20 mx-auto bg-gradient-to-br from-blue-100 to-indigo-100 rounded-2xl flex items-center justify-center group-hover:from-blue-200 group-hover:to-indigo-200 transition-all">
                                                <svg class="w-10 h-10 text-blue-600" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                            </div>
                                            <div>
                                                <label for="image" class="relative cursor-pointer bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-8 py-4 rounded-xl font-bold hover:from-blue-700 hover:to-indigo-700 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500 transition-all shadow-lg hover:shadow-xl">
                                                    <span>Choose Image</span>
                                                    <input id="image" 
                                                           name="image" 
                                                           type="file" 
                                                           accept="image/*"
                                                           class="sr-only"
                                                           required
                                                           onchange="previewImage(this)">
                                                </label>
                                                <p class="mt-3 text-sm text-gray-500">or drag and drop your image here</p>
                                            </div>
                                            <p class="text-xs text-gray-400 font-medium">PNG, JPG, GIF up to 5MB</p>
                                        </div>
                                    </div>
                                </div>
                                @error('image')
                                    <p class="mt-2 text-sm text-red-600 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            
                            <!-- Image Preview -->
                            <div id="imagePreview" class="hidden">
                                <div class="bg-white/60 backdrop-blur-sm rounded-2xl p-6 border border-gray-200">
                                    <p class="text-sm font-bold text-gray-900 mb-4 flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Image Preview
                                    </p>
                                    <img id="previewImg" src="" alt="Preview" class="w-full h-80 object-cover rounded-xl shadow-lg">
                                </div>
                            </div>

                            <!-- Upload Tips -->
                            <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl p-6 border border-blue-200">
                                <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Upload Tips
                                </h3>
                                <ul class="space-y-2 text-sm text-gray-700">
                                    <li class="flex items-start">
                                        <svg class="w-4 h-4 mr-2 mt-0.5 text-green-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Use high-quality images (minimum 1200x800px)
                                    </li>
                                    <li class="flex items-start">
                                        <svg class="w-4 h-4 mr-2 mt-0.5 text-green-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Ensure good lighting and clear details
                                    </li>
                                    <li class="flex items-start">
                                        <svg class="w-4 h-4 mr-2 mt-0.5 text-green-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Show your design from the best angle
                                    </li>
                                    <li class="flex items-start">
                                        <svg class="w-4 h-4 mr-2 mt-0.5 text-green-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Use descriptive titles and tags
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex items-center justify-between pt-8 mt-8 border-t border-gray-200/50">
                        <a href="{{ route('designer.designs.index') }}" 
                           class="px-8 py-4 text-lg font-bold text-gray-700 bg-gray-100 border border-gray-200 rounded-2xl hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-all shadow-lg hover:shadow-xl">
                            Cancel
                        </a>
                        <button type="submit" 
                                class="group relative px-12 py-4 text-lg font-bold text-white bg-gradient-to-r from-blue-600 to-indigo-600 border border-transparent rounded-2xl hover:from-blue-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all shadow-lg hover:shadow-2xl transform hover:scale-105">
                            <div class="absolute inset-0 bg-gradient-to-r from-blue-500 to-indigo-500 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-2xl"></div>
                            <span class="relative flex items-center">
                                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                </svg>
                                Upload Design
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function previewImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            const preview = document.getElementById('imagePreview');
            const previewImg = document.getElementById('previewImg');
            
            previewImg.src = e.target.result;
            preview.classList.remove('hidden');
            
            // Add fade in animation
            preview.style.opacity = '0';
            preview.style.transform = 'translateY(10px)';
            setTimeout(() => {
                preview.style.transition = 'all 0.3s ease-out';
                preview.style.opacity = '1';
                preview.style.transform = 'translateY(0)';
            }, 10);
        }
        
        reader.readAsDataURL(input.files[0]);
    }
}

// Add drag and drop functionality
const dropZone = document.querySelector('[class*="border-dashed"]');
const fileInput = document.getElementById('image');

['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
    dropZone.addEventListener(eventName, preventDefaults, false);
});

function preventDefaults(e) {
    e.preventDefault();
    e.stopPropagation();
}

['dragenter', 'dragover'].forEach(eventName => {
    dropZone.addEventListener(eventName, highlight, false);
});

['dragleave', 'drop'].forEach(eventName => {
    dropZone.addEventListener(eventName, unhighlight, false);
});

function highlight(e) {
    dropZone.classList.add('border-blue-500', 'bg-blue-50');
}

function unhighlight(e) {
    dropZone.classList.remove('border-blue-500', 'bg-blue-50');
}

dropZone.addEventListener('drop', handleDrop, false);

function handleDrop(e) {
    const dt = e.dataTransfer;
    const files = dt.files;
    
    fileInput.files = files;
    previewImage(fileInput);
}
</script>
@endsection