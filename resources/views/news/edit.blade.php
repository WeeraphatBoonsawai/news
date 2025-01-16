@extends('components.admin.navbar')

@section('content')
<div class="p-4 rounded-lg mt-14">
    <div class="container mx-auto p-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">แก้ไขข่าว</h1>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('news.update', $news->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="flex space-x-4">
                <!-- หัวข้อข่าว -->
                <div class="flex-1">
                    <label for="news_title" class="block text-gray-700 font-medium">หัวข้อข่าว</label>
                    <input type="text" id="news_title" name="news_title" value="{{ old('news_title', $news->news_title) }}" class="w-full p-2 border rounded" required>
                </div>
                <!-- ลิงก์ข่าว -->
                <div class="flex-1">
                    <label for="news_link" class="block text-gray-700 font-medium">ลิงก์ข่าว</label>
                    <input type="url" id="news_link" name="news_link" value="{{ old('news_link', $news->news_link) }}" class="w-full p-2 border rounded" required>
                </div>
            </div>
            
            <!-- รายละเอียดข่าว -->
            <div>
                <label for="news_detail" class="block text-gray-700 font-medium">รายละเอียดข่าว</label>
                <textarea id="news_detail" name="news_detail" class="w-full p-2 border rounded" required>{{ old('news_detail', $news->news_detail) }}</textarea>
            </div>
            
            <!-- สถานะข่าว, วันที่เริ่มประกาศ, วันที่สิ้นสุด -->
            <div class="flex space-x-4">
                <div class="flex-1">
                    <label for="news_status" class="block text-gray-700 font-medium">สถานะ</label>
                    <select id="news_status" name="news_status" class="w-full p-2 border rounded" required>
                        <option value="start" {{ old('news_status', $news->news_status) === 'start' ? 'selected' : '' }}>เริ่ม</option>
                        <option value="stop" {{ old('news_status', $news->news_status) === 'stop' ? 'selected' : '' }}>หยุด</option>
                    </select>
                </div>
                <div class="flex-1">
                    <label for="start_announcing" class="block text-gray-700 font-medium">วันที่เริ่มประกาศ</label>
                    <input type="date" id="start_announcing" name="start_announcing" value="{{ old('start_announcing', $news->start_announcing) }}" class="w-full p-2 border rounded" required>
                </div>
                <div class="flex-1">
                    <label for="end_announcing" class="block text-gray-700 font-medium">วันที่สิ้นสุดประกาศ</label>
                    <input type="date" id="end_announcing" name="end_announcing" value="{{ old('end_announcing', $news->end_announcing) }}" class="w-full p-2 border rounded" required>
                </div>
            </div>
            
            <!-- ประเภทข่าว และหน่วยงาน -->
            <div class="flex space-x-4">
                <div class="flex-1">
                    <label for="news_type_id" class="block text-gray-700 font-medium">ประเภทข่าว</label>
                    <select id="news_type_id" name="news_type_id" class="w-full p-2 border rounded" required>
                        @foreach ($newsTypes as $type)
                            <option value="{{ $type->id }}" {{ old('news_type_id', $news->news_type_id) == $type->id ? 'selected' : '' }}>{{ $type->type_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex-1">
                    <label for="agency_id" class="block text-gray-700 font-medium">หน่วยงาน</label>
                    <select id="agency_id" name="agency_id" class="w-full p-2 border rounded" required>
                        @foreach ($agencies as $agency)
                            <option value="{{ $agency->id }}" {{ old('agency_id', $news->agency_id) == $agency->id ? 'selected' : '' }}>{{ $agency->agency_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <!-- ไฟล์ที่อัปโหลด -->
            <div>
                <label class="block text-gray-700 font-medium">ไฟล์ที่อัปโหลด</label>
                <ul id="uploaded-file-list" class="list-none space-y-4">
                    @foreach ($news->news_file as $file)
                        <li class="flex items-center space-x-4 border p-3 rounded">
                            <a href="{{ asset('files/news/' . $file->news_file) }}" target="_blank" class="text-blue-500 underline">{{ $file->news_file }}</a>
                            <input type="file" name="update_files[{{ $file->id }}]" class="block border p-2 rounded w-1/2">
                            <button type="button" class="delete-uploaded-file text-red-500 hover:underline" data-file-id="{{ $file->id }}">ลบ</button>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- เพิ่มไฟล์ใหม่ -->
            <div>
                <label class="block text-gray-700 font-medium">เพิ่มไฟล์ใหม่</label>
                <div id="file-input-container">
                    <div class="file-input-group mb-2 flex items-center space-x-4">
                        <input type="file" name="files[]" class="w-full p-2 border rounded">
                        <button type="button" class="remove-file-button text-red-500 hover:underline">ลบ</button>
                    </div>
                </div>
                <button type="button" id="add-file-button" class="mt-2 px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">เพิ่มไฟล์</button>
            </div>

            <!-- ปุ่มบันทึกและยกเลิก -->
            <div class="flex justify-end">
                <a href="{{ route('news.index') }}" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">ยกเลิก</a>
                <button type="submit" class="ml-4 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">บันทึก</button>
            </div>
        </form>
    </div>

    <script>
        // เพิ่ม input สำหรับไฟล์ใหม่
        document.getElementById('add-file-button').addEventListener('click', function () {
            const container = document.getElementById('file-input-container');
            const newFileInput = document.createElement('div');
            newFileInput.classList.add('file-input-group', 'mb-2', 'flex', 'items-center', 'space-x-4');
            newFileInput.innerHTML = `
                <input type="file" name="files[]" class="w-full p-2 border rounded">
                <button type="button" class="remove-file-button text-red-500 hover:underline">ลบ</button>
            `;
            container.appendChild(newFileInput);

            // แนบ Event Listener ให้กับปุ่มลบที่เพิ่มใหม่
            attachRemoveEvent(newFileInput.querySelector('.remove-file-button'));
        });

        // ฟังก์ชันสำหรับจัดการการลบ input ไฟล์
        function attachRemoveEvent(button) {
            button.addEventListener('click', function () {
                const parent = button.parentElement;
                parent.remove();
            });
        }

        // แนบ Event Listener ให้กับปุ่มลบที่มีอยู่ในหน้า
        document.querySelectorAll('.remove-file-button').forEach(attachRemoveEvent);

        // การลบไฟล์ที่อัปโหลดแล้ว
document.querySelectorAll('.delete-uploaded-file').forEach(button => {
    button.addEventListener('click', function () {
        const fileId = this.getAttribute('data-file-id');
        const listItem = this.parentElement;
        if (confirm('คุณแน่ใจหรือไม่ที่จะลบไฟล์นี้?')) {
            // สร้าง input ซ่อนเพื่อส่งข้อมูลไฟล์ที่ต้องการลบ
            const deleteInput = document.createElement('input');
            deleteInput.type = 'hidden';
            deleteInput.name = `delete_files[]`;
            deleteInput.value = fileId;
            listItem.appendChild(deleteInput);

            // ซ่อนรายการไฟล์
            listItem.style.display = 'none';
        }
    });
});

        
    </script>
</div>
@endsection
