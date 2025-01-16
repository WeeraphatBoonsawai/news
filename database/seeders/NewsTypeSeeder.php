<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NewsTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('news_type')->insert
        ([
            ['type_name' => 'ข่าวประชาสัมพันธ์'],
            ['type_name' => 'ข่าวแสดงความเสียใจ'],
            ['type_name' => 'ข่าวที่มีกำหนดวันแสดงข้อมูล'],
            ['type_name' => 'ข่าวด่วน'],
            ['type_name' => 'ดูงานจากหน่วยงานภายนอก'],
            ['type_name' => 'เพิ่มหัวข้อข่าว'],
            ['type_name' => 'เพิ่มหน่วยงาน'],
            ['type_name' => 'ประกวดราคา/จัดซื้อจัดจ้าง/จ้างเหมา'],
            ['type_name' => 'คณะกรรมการบริหาร'],
            ['type_name' => 'กฎหมายที่ควรทราบ'],
            ['type_name' => 'ข่าวรับสมัครงาน'],
            ['type_name' => 'ข่าวภายนอก'],
            ['type_name' => 'คณะกรรมการ Nl'],
            ['type_name' => 'คณะกรรมการทีมนำคุณธรรม'],
            ['type_name' => 'ภาพกิจกรรม'],
            ['type_name' => 'เชิญประชุม'],
            ['type_name' => 'คณะกรรมเภสัชกรรมและการบำบัด PTC'],
            ['type_name' => 'คณะกรรมการกลุ่มนวดกรรม'],
            ['type_name' => 'คณะกรรมการศูนย์จิตอาสา'],
            ['type_name' => 'ระเบียบ'],
            ['type_name' => 'วิเคราะห์ต้นทุน รพ.'],
            ['type_name' => 'จัดระบบภายในโรงพยาบาล'],
            ['type_name' => 'วิดีโอ'],
            ['type_name' => 'ตารางเวรแพทย์'],
            ['type_name' => 'ระบบคุณธรรมและความโปร่งใสในการดำเนินงาน'],
            ['type_name' => 'ประกาศจากโรงพยาบาลพระปกเกล้า'],
        ]);
    }
}
