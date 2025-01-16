@extends('components.admin.navbar')

@section('content')
<div class="p-4 rounded-lg mt-14">
    <div class="container mx-auto p-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">สร้างข่าวงานศพ</h1>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('funeral-news.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- ชื่อเจ้าหน้าที่ -->
            <div>
                <label for="officer_name" class="block text-gray-700 font-medium">ชื่อเจ้าหน้าที่</label>
                <input type="text" id="officer_name" name="officer_name" value="{{ old('officer_name') }}" class="w-full p-2 border rounded" required>
            </div>

            <!-- สถานที่ทำงาน -->
            <div>
                <label for="officer_location" class="block text-gray-700 font-medium">สถานที่ทำงาน</label>
                <input type="text" id="officer_location" name="officer_location" value="{{ old('officer_location') }}" class="w-full p-2 border rounded" required>
            </div>

            <!-- ชื่อผู้เสียชีวิต -->
            <div>
                <label for="deceased" class="block text-gray-700 font-medium">ชื่อผู้เสียชีวิต</label>
                <input type="text" id="deceased" name="deceased" value="{{ old('deceased') }}" class="w-full p-2 border rounded" required>
            </div>

            <!-- ความสัมพันธ์ -->
            <div>
                <label for="relationship" class="block text-gray-700 font-medium">ความสัมพันธ์</label>
                <input type="text" id="relationship" name="relationship" value="{{ old('relationship') }}" class="w-full p-2 border rounded" required>
            </div>

            <!-- สถานที่จัดงานศพ -->
            <div>
                <label for="funeral_location" class="block text-gray-700 font-medium">สถานที่จัดงานศพ</label>
                <input type="text" id="funeral_location" name="funeral_location" value="{{ old('funeral_location') }}" class="w-full p-2 border rounded" required>
            </div>

            <!-- วันที่เริ่มตั้งศพ -->
            <div>
                <label for="start_funeral" class="block text-gray-700 font-medium">วันที่เริ่มตั้งศพ</label>
                <input type="date" id="start_funeral" name="start_funeral" value="{{ old('start_funeral') }}" class="w-full p-2 border rounded">
            </div>

            <!-- วันที่สิ้นสุดตั้งศพ -->
            <div>
                <label for="end_funeral" class="block text-gray-700 font-medium">วันที่สิ้นสุดตั้งศพ</label>
                <input type="date" id="end_funeral" name="end_funeral" value="{{ old('end_funeral') }}" class="w-full p-2 border rounded">
            </div>

            <!-- เวลาสวดอภิธรรม -->
            <div>
                <label for="pray_funeral" class="block text-gray-700 font-medium">เวลาสวดอภิธรรม</label>
                <input type="time" id="pray_funeral" name="pray_funeral" value="{{ old('pray_funeral') }}" class="w-full p-2 border rounded">
            </div>

            <!-- วันที่พิธีฌาปนกิจ -->
            <div>
                <label for="cremation_ceremony" class="block text-gray-700 font-medium">วันที่พิธีฌาปนกิจ</label>
                <input type="date" id="cremation_ceremony" name="cremation_ceremony" value="{{ old('cremation_ceremony') }}" class="w-full p-2 border rounded">
            </div>

            <!-- สถานที่พิธีฌาปนกิจ -->
            <div>
                <label for="cremation_ceremon_location" class="block text-gray-700 font-medium">สถานที่พิธีฌาปนกิจ</label>
                <input type="text" id="cremation_ceremon_location" name="cremation_ceremon_location" value="{{ old('cremation_ceremon_location') }}" class="w-full p-2 border rounded" required>
            </div>

            <!-- สถานะ -->
            <div>
                <label for="funeral_news_status" class="block text-gray-700 font-medium">สถานะ</label>
                <select id="funeral_news_status" name="funeral_news_status" class="w-full p-2 border rounded" required>
                    <option value="start" {{ old('funeral_news_status') === 'start' ? 'selected' : '' }}>เริ่ม</option>
                    <option value="stop" {{ old('funeral_news_status') === 'stop' ? 'selected' : '' }}>หยุด</option>
                </select>
            </div>

           <!-- พวงหรีด -->
<div>
    <label class="block text-gray-700 font-medium mb-4">เลือกพวงหรีด</label>
    <div class="grid grid-cols-6 gap-4">
        @foreach ($wreaths as $wreath)
            <label class="relative cursor-pointer group">
                <input type="radio" name="wreath_id" value="{{ $wreath->id }}" class="absolute opacity-0 peer">
                <img src="{{ asset($wreath->wreath_images) }}" alt="พวงหรีด" class="w-32 h-32 object-cover border-2 border-transparent peer-checked:border-blue-500 peer-checked:shadow-md">
            </label>
        @endforeach
    </div>
</div>

            <!-- หมายเหตุ -->
<div>
    <label for="notes" class="block text-gray-700 font-medium">หมายเหตุ</label>
    <div id="notes-container">
        <div class="flex items-center space-x-4 note-item">
            <input type="text" name="notes[]" class="w-full p-2 border rounded" placeholder="หมายเหตุ">
            <button type="button" class="text-red-500 hover:text-red-700 remove-note">ลบ</button>
        </div>
    </div>
    <button type="button" id="add-note" class="mt-2 bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">เพิ่มหมายเหตุ</button>
</div>

            <!-- ปุ่มบันทึกและยกเลิก -->
            <div class="flex justify-end">
                <a href="{{ route('funeral-news.index') }}" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">ยกเลิก</a>
                <button type="submit" class="ml-4 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">บันทึก</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const notesContainer = document.getElementById('notes-container');
        const addNoteButton = document.getElementById('add-note');
    
        // ฟังก์ชันเพิ่มรายการหมายเหตุใหม่
        addNoteButton.addEventListener('click', function () {
            const newNote = document.createElement('div');
            newNote.classList.add('flex', 'items-center', 'space-x-4', 'note-item');
            newNote.innerHTML = `
                <input type="text" name="notes[]" class="w-full p-2 border rounded" placeholder="หมายเหตุ">
                <button type="button" class="text-red-500 hover:text-red-700 remove-note">ลบ</button>
            `;
            notesContainer.appendChild(newNote);
    
            // เพิ่มฟังก์ชันลบให้กับปุ่มใหม่
            newNote.querySelector('.remove-note').addEventListener('click', function () {
                newNote.remove();
            });
        });
    
        // ฟังก์ชันลบรายการหมายเหตุ
        notesContainer.addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-note')) {
                e.target.parentElement.remove();
            }
        });
    });
    </script>
    
@endsection
