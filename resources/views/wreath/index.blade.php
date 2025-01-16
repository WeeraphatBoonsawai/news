@extends('components.admin.navbar')

@section('content')
<div class="container mx-auto mt-16 p-6 bg-white shadow-lg rounded-lg">
    <h1 class="text-[#7d8a99] text-4xl font-bold mt-2 mb-6">
        รายการพวงหรีด
    </h1>

    <!-- ปุ่มเพิ่มข่าว -->
    <div class="flex justify-between items-center mb-6">
        <a href="/wreath/upload" class="bg-[#26806c] text-white px-4 py-2 rounded-lg hover:bg-[#5DB996]">
            เพิ่มพวงหรีด
        </a>
    </div>

        @if(session('success'))
            <p class="text-green-600 bg-green-100 border border-green-400 rounded p-4 mb-4">
                {{ session('success') }}
            </p>
        @endif

        <!-- Wreath Table -->
        <div class="overflow-x-auto">
            <table class="table-auto w-full bg-white shadow-md rounded-lg">
                <thead class="bg-gray-200 text-gray-700">
                    <tr>
                        <th class="px-4 py-2 border">รหัส</th>
                        <th class="px-4 py-2 border">รูปภาพ</th>
                        <th class="px-4 py-2 border">การดำเนินการ</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($wreaths as $wreath)
                        <tr class="hover:bg-gray-100">
                            <td class="px-4 py-2 border text-center">{{ $wreath->id }}</td>
                            <td class="px-4 py-2 border text-center">
                                <img src="{{ asset($wreath->wreath_images) }}" alt="Wreath Image" class="w-[180px] h-[120px] object-cover mx-auto rounded">
                            </td>
                            <td class="px-4 py-2 border text-center">
                                <a href="{{ route('wreath.edit', $wreath->id) }}" class="bg-yellow-600 text-white px-4 py-2 rounded hover:bg-yellow-700">
                                    แก้ไข
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-6 flex justify-end">
            {{ $wreaths->links() }}
        </div>
    
</div>
@endsection
