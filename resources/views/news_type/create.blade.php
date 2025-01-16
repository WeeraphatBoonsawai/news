@extends('components.admin.navbar')

@section('content')
<div class="p-4 rounded-lg mt-14">

<div class="container mx-auto p-8">
    <h1 class="text-2xl font-bold mb-6">เพิ่มประเภทข่าว</h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('news_type.store') }}" method="POST" class="bg-white shadow-md rounded-lg p-8">
        @csrf
        <div class="mb-4">
            <label for="type_name" class="block text-gray-700 font-medium mb-2">ชื่อประเภท</label>
            <input 
                type="text" 
                name="type_name" 
                id="type_name" 
                class="w-full border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-blue-200"
                required>
        </div>

        <div class="flex justify-end space-x-4">
            <a href="{{ route('news_type.index') }}" class="bg-red-400 text-white px-4 py-2 rounded hover:bg-red-500">ยกเลิก</a>
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">บันทึก</button>
        </div>
    </form>
</div>

</div>
@endsection