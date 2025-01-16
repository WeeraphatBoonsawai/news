@extends('components.admin.navbar')

@section('content')
<div class="p-4 rounded-lg mt-14">
    <div class="container mx-auto p-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">แก้ไขข่าวงานศพ</h1>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('funeral-news.update', $funeralNews->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- ชื่อเจ้าหน้าที่ -->
            <div>
                <label for="officer_name" class="block text-gray-700 font-medium">ชื่อเจ้าหน้าที่</label>
                <input type="text" id="officer_name" name="officer_name" value="{{ old('officer_name', $funeralNews->officer_name) }}" class="w-full p-2 border rounded" required>
            </div>

            <!-- สถานที่ทำงาน -->
            <div>
                <label for="officer_location" class="block text-gray-700 font-medium">สถานที่ทำงาน</label>
                <input type="text" id="officer_location" name="officer_location" value="{{ old('officer_location', $funeralNews->officer_location) }}" class="w-full p-2 border rounded" required>
            </div>

            <!-- ชื่อผู้เสียชีวิต -->
            <div>
                <label for="deceased" class="block text-gray-700 font-medium">ชื่อผู้เสียชีวิต</label>
                <input type="text" id="deceased" name="deceased" value="{{ old('deceased', $funeralNews->deceased) }}" class="w-full p-2 border rounded" required>
            </div>

            <!-- ความสัมพันธ์ -->
            <div>
                <label for="relationship" class="block text-gray-700 font-medium">ความสัมพันธ์</label>
                <input type="text" id="relationship" name="relationship" value="{{ old('relationship', $funeralNews->relationship) }}" class="w-full p-2 border rounded" required>
            </div>

            <!-- สถานที่จัดงานศพ -->
            <div>
                <label for="funeral_location" class="block text-gray-700 font-medium">สถานที่จัดงานศพ</label>
                <input type="text" id="funeral_location" name="funeral_location" value="{{ old('funeral_location', $funeralNews->funeral_location) }}" class="w-full p-2 border rounded" required>
            </div>

            <!-- วันที่เริ่มตั้งศพ -->
            <div>
                <label for="start_funeral" class="block text-gray-700 font-medium">วันที่เริ่มตั้งศพ</label>
                <input type="date" id="start_funeral" name="start_funeral" value="{{ old('start_funeral', $funeralNews->start_funeral) }}" class="w-full p-2 border rounded">
            </div>

            <!-- วันที่สิ้นสุดตั้งศพ -->
            <div>
                <label for="end_funeral" class="block text-gray-700 font-medium">วันที่สิ้นสุดตั้งศพ</label>
                <input type="date" id="end_funeral" name="end_funeral" value="{{ old('end_funeral', $funeralNews->end_funeral) }}" class="w-full p-2 border rounded">
            </div>

            <!-- เวลาสวดอภิธรรม -->
            <div>
                <label for="pray_funeral">เวลาในการสวดอภิธรรม:</label>
            <input type="time" name="pray_funeral" id="pray_funeral" value="{{ old('pray_funeral', $funeralNews->pray_funeral ?? '') }}">
            </div>

            <!-- วันที่พิธีฌาปนกิจ -->
            <div>
                <label for="cremation_ceremony" class="block text-gray-700 font-medium">วันที่พิธีฌาปนกิจ</label>
                <input type="date" id="cremation_ceremony" name="cremation_ceremony" value="{{ old('cremation_ceremony', $funeralNews->cremation_ceremony) }}" class="w-full p-2 border rounded">
            </div>

            <!-- สถานที่พิธีฌาปนกิจ -->
            <div>
                <label for="cremation_ceremon_location" class="block text-gray-700 font-medium">สถานที่พิธีฌาปนกิจ</label>
                <input type="text" id="cremation_ceremon_location" name="cremation_ceremon_location" value="{{ old('cremation_ceremon_location', $funeralNews->cremation_ceremon_location) }}" class="w-full p-2 border rounded" required>
            </div>

            <!-- สถานะ -->
            <div>
                <label for="funeral_news_status" class="block text-gray-700 font-medium">สถานะ</label>
                <select id="funeral_news_status" name="funeral_news_status" class="w-full p-2 border rounded" required>
                    <option value="start" {{ old('funeral_news_status', $funeralNews->funeral_news_status) === 'start' ? 'selected' : '' }}>เริ่ม</option>
                    <option value="stop" {{ old('funeral_news_status', $funeralNews->funeral_news_status) === 'stop' ? 'selected' : '' }}>หยุด</option>
                </select>
            </div>

            <!-- พวงหรีด -->
            <div>
                <label for="wreath_id" class="block text-gray-700 font-medium">พวงหรีด</label>
                <select id="wreath_id" name="wreath_id" class="w-full p-2 border rounded" required>
                    @foreach ($wreaths as $wreath)
                        <option value="{{ $wreath->id }}" {{ old('wreath_id', $funeralNews->wreath_id) == $wreath->id ? 'selected' : '' }}>{{ $wreath->wreath_images }}</option>
                    @endforeach
                </select>
            </div>

            <!-- หมายเหตุ -->
            <div>
                <label class="block text-gray-700 font-medium">หมายเหตุ</label>
                <ul id="note-list" class="space-y-2">
                    @foreach ($funeralNews->notes as $note)
                        <li class="flex space-x-2">
                            <input type="text" name="notes[{{ $note->id }}][note_text]" value="{{ $note->note_text }}" class="w-full p-2 border rounded">
                            <button type="button" class="remove-note text-red-500">ลบ</button>
                        </li>
                    @endforeach
                </ul>
                <button type="button" id="add-note" class="mt-2 bg-green-500 text-white px-4 py-2 rounded">เพิ่มหมายเหตุ</button>
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

document.addEventListener('DOMContentLoaded', function() {
    const noteList = document.getElementById('note-list');
    const addNoteButton = document.getElementById('add-note');

    // เพิ่มหมายเหตุใหม่
    addNoteButton.addEventListener('click', function() {
        const newNote = document.createElement('li');
        newNote.classList.add('flex', 'space-x-2');

        newNote.innerHTML = `
            <input type="text" name="notes[new][][note_text]" class="w-full p-2 border rounded">
            <button type="button" class="remove-note text-red-500">ลบ</button>
        `;

        noteList.appendChild(newNote);
    });

    // ลบหมายเหตุ
    document.addEventListener('click', function(event) {
    if (event.target.classList.contains('remove-note')) {
        const noteItem = event.target.closest('li');
        if (noteItem) {
            // สร้าง hidden input สำหรับ _delete
            const noteInput = noteItem.querySelector('input[name^="notes"]');
            if (noteInput) {
                const noteId = noteInput.name.match(/\[(\d+)\]/)[1]; // ดึง note id
                const deleteInput = document.createElement('input');
                deleteInput.type = 'hidden';
                deleteInput.name = `notes[${noteId}][_delete]`;
                deleteInput.value = '1';
                noteItem.appendChild(deleteInput);
            }
            noteItem.style.display = 'none'; // ซ่อน element
        }
    }
});
});
</script>
@endsection
