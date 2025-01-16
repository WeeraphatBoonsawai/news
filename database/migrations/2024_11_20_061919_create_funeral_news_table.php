<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('funeral_news', function (Blueprint $table) {
            $table->id();
            $table->string('officer_name'); // ชื่อเจ้าหน้าที่
            $table->string('officer_location'); // สถานที่ทำงาน
            $table->string('deceased'); // ชื่อผู้เสียชีวิต
            $table->string('relationship'); // ความสัมพันธ์
            $table->string('funeral_location'); // สถานที่จัดงานศพ
            $table->date('start_funeral')->nullable(); // เริ่มตั้งศพวันที่
            $table->date('end_funeral')->nullable(); // สิ้นสุดตั้งศพวันที่
            $table->time('pray_funeral')->nullable(); // เวลาสวดอภิธรรม (เก็บเฉพาะเวลา)
            $table->date('cremation_ceremony')->nullable(); // วันที่พิธีฌาปนกิจ
            $table->string('cremation_ceremon_location'); // สถานที่พิธีฌาปนกิจ
            $table->enum('funeral_news_status',['start','stop'])->default('start');
            $table->unsignedBigInteger('wreath_id'); // เชื่อมกับตาราง พวงหรีด
            $table->timestamps();

            $table->foreign('wreath_id')->references('id')->on('wreath');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('funeral_news');
    }
};
