@extends('components.admin.navbar')

@section('content')
<div class="p-4 rounded-lg mt-14">
    <div class="max-w-lg mx-auto bg-white p-8 rounded-lg shadow-md">
        <!-- Title -->
        <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">แก้ไขรูปพวงหรีด</h1>
        
        <!-- Success Message -->
        @if(session('success'))
            <p class="text-green-600 bg-green-100 border border-green-400 rounded p-4 mb-4 text-center">
                {{ session('success') }}
            </p>
        @endif

        <!-- Error Message -->
        @if ($errors->any())
            <div class="text-red-600 bg-red-100 border border-red-400 rounded p-4 mb-4">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form -->
        <form action="{{ route('wreath.update', $wreath->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Current Image -->
            <div class="text-center">
                <h2 class="text-gray-700 font-medium mb-4">รูปภาพปัจจุบัน:</h2>
                <img src="{{ asset($wreath->wreath_images) }}" alt="Current Wreath Image" class="max-w-xs max-h-72 rounded-lg shadow-md border border-gray-300 mx-auto">
            </div>

            <!-- File Input -->
            <div>
                <label for="wreath_images" class="block text-gray-700 font-medium">เลือกรูปภาพใหม่ (ถ้ามี):</label>
                <input 
                    type="file" 
                    id="wreath_images" 
                    name="wreath_images" 
                    accept="image/*" 
                    onchange="previewImage(event)" 
                    class="mt-2 block w-full text-gray-700 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-blue-200">
            </div>

            <!-- Image Preview -->
            <div id="preview" class="mt-4 flex justify-center">
                <p class="text-gray-500 italic">ภาพตัวอย่างจะแสดงที่นี่</p>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-end space-x-4">
                <a href="/wreath" class="bg-red-400 text-white font-bold py-2 px-4 rounded-lg hover:bg-red-500 shadow-md">
                    ยกเลิก
                </a>
                <button type="submit" class="bg-green-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-green-700 shadow-md">
                    บันทึกการเปลี่ยนแปลง
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Preview Script -->
<script>
    function previewImage(event) {
        const preview = document.getElementById('preview');
        preview.innerHTML = ''; // Clear existing preview
        const file = event.target.files[0];
        if (file) {
            const img = document.createElement('img');
            img.src = URL.createObjectURL(file);
            img.classList.add('max-w-xs', 'max-h-72', 'rounded-lg', 'shadow-md', 'border', 'border-gray-300');
            preview.appendChild(img);
        }
    }
</script>
@endsection
