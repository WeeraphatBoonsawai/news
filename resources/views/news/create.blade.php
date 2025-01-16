@extends('components.admin.navbar')

@section('content')
<div class="p-4 rounded-lg mt-14">
    <div class="max-w-4xl mx-auto bg-white p-8 rounded shadow-md">
        <h1 class="text-2xl font-bold mb-6">เพิ่มข่าวใหม่</h1>
        <label class="block text-sm mb-2">
            ขอแจ้งวิธีการลงข่าวประชาสัมพันธ์แล้วระบบสามารถนำส่งใน Line Notify ได้ โดย พิมพ์ข่าวจากหน้าฟอร์ม โดยไม่มีการ copy
            จากที่อื่นแล้วนำมาวางให้แบบฟอร์มลงข่าว ซึ่งโอกาสที่จะทำให้ข่าวถูกนำส่งไปยัง Line Notofy มากกว่า 99.99%
        </label>
        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 text-red-600 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- หัวข้อข่าวและลิงก์ข่าว -->
            <div class="flex space-x-4 mb-4">
                <div class="flex-1">
                    <label for="news_title" class="block font-medium">หัวข้อข่าว</label>
                    <input type="text" id="news_title" name="news_title" value="{{ old('news_title') }}" class="w-full p-2 border rounded" required>
                </div>
                <div class="flex-1">
                    <label for="news_link" class="block font-medium">ลิงก์ข่าว</label>
                    <input type="url" id="news_link" name="news_link" value="{{ old('news_link') }}" class="w-full p-2 border rounded" required>
                </div>
            </div>

            <!-- รายละเอียดข่าว -->
            <div class="mb-4">
                <label for="news_detail" class="block font-medium">รายละเอียดข่าว</label>
                <textarea id="news_detail" name="news_detail" rows="4" class="w-full p-2 border rounded" required>{{ old('news_detail') }}</textarea>
            </div>

            <!-- สถานะข่าว และวันที่ -->
            <div class="flex space-x-4 mb-4">
                <div class="flex-1">
                    <label for="news_status" class="block font-medium">สถานะข่าว</label>
                    <select id="news_status" name="news_status" class="w-full p-2 border rounded" required>
                        <option value="start" {{ old('news_status') === 'start' ? 'selected' : '' }}>เริ่มประชาสัมพันธ์</option>
                        <option value="stop" {{ old('news_status') === 'stop' ? 'selected' : '' }}>หยุดประชาสัมพันธ์</option>
                    </select>
                </div>
                <div class="flex-1">
                    <label for="start_announcing" class="block font-medium">วันที่เริ่มประกาศ</label>
                    <input type="date" id="start_announcing" name="start_announcing" value="{{ old('start_announcing') }}" class="w-full p-2 border rounded" required>
                </div>
                <div class="flex-1">
                    <label for="end_announcing" class="block font-medium">วันที่สิ้นสุดประกาศ</label>
                    <input type="date" id="end_announcing" name="end_announcing" value="{{ old('end_announcing') }}" class="w-full p-2 border rounded" required>
                </div>
            </div>

            <!-- ประเภทข่าว และหน่วยงาน -->
            <div class="flex space-x-4 mb-4">
                <div class="flex-1">
                    <label for="news_type_id" class="block font-medium">ประเภทข่าว</label>
                    <select id="news_type_id" name="news_type_id" class="w-full p-2 border rounded" required>
                        @foreach ($newsTypes as $type)
                            <option value="{{ $type->id }}" {{ old('news_type_id') == $type->id ? 'selected' : '' }}>{{ $type->type_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex-1">
                    <label for="agency_id" class="block font-medium">หน่วยงาน</label>
                    <select id="agency_id" name="agency_id" class="w-full p-2 border rounded" required>
                        @foreach ($agencies as $agency)
                            <option value="{{ $agency->id }}" {{ old('agency_id') == $agency->id ? 'selected' : '' }}>{{ $agency->agency_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- ไฟล์แนบ -->
            <div class="mb-6">
                <label class="block text-lg font-semibold mb-2">ไฟล์แนบ (รูปภาพหรือ PDF)</label>
                <div id="file-input-container" class="space-y-2">
                    <div class="file-input-group flex items-center space-x-4">
                        <input type="file" name="files[]" class="flex-1 p-2 border rounded">
                    </div>
                </div>
                <button type="button" id="add-file-button" class="mt-4 px-4 py-2 bg-green-500 text-white font-medium rounded hover:bg-green-600">
                    เพิ่มไฟล์
                </button>
            </div>

            <!-- ปุ่มบันทึก -->
            <div class="text-right">
                <a href="{{ route('news.index') }}" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">ยกเลิก</a>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">บันทึก</button>
            </div>
        </form>
    </div>
</div>


<style>
    #file-input-container .file-input-group input[type="file"] {
        max-width: calc(100% - 60px); /* Reserve space for the remove button */
    }
    .remove-file-button {
        transition: background-color 0.2s, color 0.2s;
    }
</style>

<script>
    document.getElementById('add-file-button').addEventListener('click', function () {
        const container = document.getElementById('file-input-container');
        const fileInputGroup = document.createElement('div');
        fileInputGroup.className = 'file-input-group flex items-center space-x-4';

        fileInputGroup.innerHTML = `
            <input type="file" name="files[]" class="flex-1 p-2 border border-gray-300 rounded shadow-sm">
            <button type="button" class="remove-file-button px-3 py-1 text-red-500 border border-red-500 rounded hover:bg-red-100">ลบ</button>
        `;

        fileInputGroup.querySelector('.remove-file-button').addEventListener('click', function () {
            fileInputGroup.remove();
        });

        container.appendChild(fileInputGroup);
    });
</script>
@endsection
