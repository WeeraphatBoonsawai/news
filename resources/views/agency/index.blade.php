@extends('components.admin.navbar')

@section('content')
<div class="container mx-auto mt-16 p-6 bg-white shadow-lg rounded-lg">
    <h1 class="text-[#7d8a99] text-4xl font-bold mt-2 mb-6">
        รายการหน่วยงาน
    </h1>

    <!-- ปุ่มเพิ่มข่าว -->
    <div class="flex justify-between items-center mb-6">
        <a href="{{ route('agency.create') }}" class="bg-[#26806c] text-white px-4 py-2 rounded-lg hover:bg-[#5DB996]">
            เพิ่มหน่วยงาน
        </a>
    </div>

    @if(session('success'))
        <p class="text-green-600 bg-green-100 border border-green-400 rounded p-4 mb-4">
            {{ session('success') }}
        </p>
    @endif

    <table class="table-auto w-full bg-white shadow rounded-lg mt-4">
        <thead>
            <tr class="bg-gray-200 text-gray-700">
                <th class="px-4 py-2">รหัส</th>
                <th class="px-4 py-2">ชื่อหน่วยงาน</th>
                <th class="px-4 py-2">การจัดการ</th>
            </tr>
        </thead>
        <tbody>
            @foreach($agencies as $agency)
                <tr class="hover:bg-gray-100">
                    <td class="border px-4 py-2">{{ $agency->id }}</td>
                    <td class="border px-4 py-2">{{ $agency->agency_name }}</td>
                    <td class="border px-4 py-2 text-center">
                        <a href="{{ route('agency.edit', $agency->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">แก้ไข</a>
                      
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

</div>
@endsection
