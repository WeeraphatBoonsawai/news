@extends('components.admin.navbar')

@section('content')

<div class="p-4 rounded-lg mt-16">
    <div class="grid grid-cols-4 gap-4 mb-4">
      
         <div class=" justify-center h-36 bg-[#20a68a] shadow-md rounded-lg p-6 flex flex-col items-center">
            <h2 class="text-2xl text-white font-medium">การรายงาน</h2>
            <p class="text-2xl text-gray-200 font-bold mt-4">0</p>
        </div>

        <div class=" justify-center h-36 bg-[#20a68a] shadow-md rounded-lg p-6 flex flex-col items-center">
         <h2 class="text-2xl text-white font-medium">จำนวนสมาชิก</h2>
         <p class="text-2xl text-gray-200 font-bold mt-4">{{ number_format($totalUsers) }}</p>
        </div>

        <div class="justify-center h-36 bg-[#20a68a] shadow-md rounded-lg p-6 flex flex-col items-center">
         <h2 class="text-2xl text-white font-medium">จำนวนคนดูของเดือนนี้</h2>
         <p class="text-2xl text-gray-200 font-bold mt-4">{{ number_format($totalViews) }}</p>
        </div>

        <div class="justify-center h-36 bg-[#20a68a] shadow-md rounded-lg p-6 flex flex-col items-center">
         <h2 class="text-2xl text-white font-medium">จำนวนข่าวทั้งหมด</h2>
         <p class="text-2xl text-gray-200 font-bold mt-4">{{ number_format($totalNews) }}</p>
        </div>

    </div>
</div>

<div class="p-4 rounded-lg">
    <div class="container mx-auto p-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Dashboard - จำนวนคนอ่านแต่ละข่าว (ตามช่วงเดือน)</h1>

        @php
            use Carbon\Carbon;
        @endphp

        <!-- ฟอร์มเลือกเดือน -->
        <form method="GET" action="{{ route('dashboard') }}" class="mb-6 flex space-x-4">
            <div>
                <label for="month" class="block text-gray-700 font-medium">เดือน</label>
                <select name="month" id="month" class="border rounded p-2">
                    @foreach (range(1, 12) as $m)
                        <option value="{{ $m }}" {{ $month == $m ? 'selected' : '' }}>
                            {{ Carbon::create()->month($m)->translatedFormat('F') }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="year" class="block text-gray-700 font-medium">ปี</label>
                <select name="year" id="year" class="border rounded p-2">
                    @foreach (range(Carbon::now()->year - 5, Carbon::now()->year) as $y)
                        <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>
                            {{ $y }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="flex items-end">
                <button type="submit" class="bg-[#26806c] text-white px-4 py-2 rounded hover:bg-[#5DB996]">
                    ดูข้อมูล
                </button>
            </div>
        </form>

                <!-- แสดงจำนวนคนอ่านทั้งหมด -->
<div class="bg-green-100 border-l-4 border-green-500 text-green-800 p-4 rounded mb-6 shadow-md">
    <h2 class="text-lg font-bold">ยอดจำนวนคนอ่านทั้งหมดในเดือนนี้</h2>
    <p class="text-2xl font-bold">{{ number_format($totalViews) }} คน</p>
</div>

        <!-- กราฟ -->
        <canvas id="viewsChart" width="400" height="200"></canvas>


    </div>
</div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('viewsChart').getContext('2d');

    // ฟังก์ชันช่วยตัดข้อความให้จำกัดจำนวนตัวอักษร
    const truncateText = (text, maxLength) => {
        return text.length > maxLength ? text.substr(0, maxLength) + '...' : text;
    };

    // ตัดข้อความก่อนส่งไปที่ Chart.js
    const truncatedLabels = @json($labels).map(label => truncateText(label, 15)); // จำกัด 15 ตัวอักษร

    const viewsChart = new Chart(ctx, {
        type: 'bar', // ประเภทกราฟแท่ง
        data: {
            labels: truncatedLabels, // ใช้ข้อความที่ถูกตัดแล้ว
            datasets: [{
                label: 'จำนวนคนอ่าน',
                data: @json($data), // จำนวน views
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            indexAxis: 'y', // แสดงกราฟแนวนอน
            scales: {
                x: {
                    beginAtZero: true // แกน X เริ่มจาก 0
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            // แสดงเฉพาะข้อความที่ถูกตัดใน Tooltip (เหมือนแกน Y)
                            return context.label + ': ' + context.raw;
                        }
                    }
                }
            }
        }
    });
</script>

@endsection
