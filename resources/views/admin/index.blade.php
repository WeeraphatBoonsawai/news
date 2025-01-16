@extends('components.admin.navbar')

@section('content')
<div class="p-4 rounded-lg  mt-14">
<div class="relative bg-gradient-to-r from-green-600 to-green-600 h-screen text-white ">
    <div class="absolute inset-0">
      <img src="/images/background.jpg" 
      alt="Background Image" class="object-cover object-center w-full h-full" />
      <div class="absolute inset-0"></div>
    </div>
  </div>
</div>

<div class="p-4 rounded-lg ">
    <div class="grid grid-cols-4 gap-4 mb-4">
      
         <div class=" justify-center h-36 bg-[#20a68a] shadow-md rounded-lg p-6 flex flex-col items-center">
            <h2 class="text-2xl text-white font-medium">การรายงาน</h2>
            <p class="text-2xl text-gray-200 font-bold mt-4">3</p>
        </div>

        <div class=" justify-center h-36 bg-[#20a68a] shadow-md rounded-lg p-6 flex flex-col items-center">
         <h2 class="text-2xl text-white font-medium">จำนวนสมาชิก</h2>
         <p class="text-2xl text-gray-200 font-bold mt-4">34</p>
        </div>

        <div class="justify-center h-36 bg-[#20a68a] shadow-md rounded-lg p-6 flex flex-col items-center">
         <h2 class="text-2xl text-white font-medium">จำนวนคนดู</h2>
         <p class="text-2xl text-gray-200 font-bold mt-4">411241124124</p>
        </div>

        <div class="justify-center h-36 bg-[#20a68a] shadow-md rounded-lg p-6 flex flex-col items-center">
         <h2 class="text-2xl text-white font-medium">จำนวนข่าวทั้งหมด</h2>
         <p class="text-2xl text-gray-200 font-bold mt-4">14124</p>
        </div>

    </div>
</div>
@endsection