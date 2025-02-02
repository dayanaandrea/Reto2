<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared("
        DROP PROCEDURE IF EXISTS StudentSchedule;
            CREATE PROCEDURE StudentSchedule(
                IN student_id INT
            )
            BEGIN 
                select m.name as module, s.day, s.hour 
                from users u 
                inner join enrollments e on u.id =e.user_id
                inner join modules m on e.module_id = m.id 
                inner join schedules s on s.module_id = m.id 
                where u.id= student_id ;
            END
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS StudentSchedule;');
    }
};
