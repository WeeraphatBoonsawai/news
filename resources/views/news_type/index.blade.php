@extends('components.admin.navbar')

@section('content')
<div class="container mx-auto mt-16 p-6 bg-white shadow-lg rounded-lg">
    <h1 class="text-[#7d8a99] text-4xl font-bold mt-2 mb-6">
        รายการประเภทข่าว
    </h1>

    <!-- ปุ่มเพิ่มข่าว -->
    <div class="flex justify-between items-center mb-6">
        <a href="{{ route('news_type.create') }}" class="bg-[#26806c] text-white px-4 py-2 rounded-lg hover:bg-[#5DB996]">
            เพิ่มประเภทข่าว
        </a>
    </div>



    @if(session('success'))
        <p class="text-green-600 bg-green-100 p-4 rounded mb-4">
            {{ session('success') }}
        </p>
    @endif


    <table class="table-auto w-full bg-white shadow rounded-lg mt-4">
        <thead>
            <tr class="bg-gray-200 text-gray-700">
                <th class="px-4 py-2">#</th>
                <th class="px-4 py-2">ชื่อประเภท</th>
                <th class="px-4 py-2">การจัดการ</th>
            </tr>
        </thead>
        <tbody>
            @foreach($newsTypes as $type)
                <tr class="hover:bg-gray-100">
                    <td class="border px-4 py-2">{{ $type->id }}</td>
                    <td class="border px-4 py-2">{{ $type->type_name }}</td>
                    <td class="border px-4 py-2 text-center">
                        <a href="{{ route('news_type.edit', $type->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">แก้ไข</a>
                       
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

</div>
@endsection
