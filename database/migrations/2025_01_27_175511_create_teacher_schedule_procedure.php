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
        DB::unprepared('
        DROP PROCEDURE IF EXISTS TeacherSchedule;
            CREATE PROCEDURE TeacherSchedule(
                IN teacher_id INT,
                IN selected_week INT
            )
            BEGIN
                select m.code as event, s.day as day, s.hour as hour, "module" as type, null as status, null as meeting_id
                from users u 
                    inner join modules m on m.user_id = u.id
                    inner join schedules s on s.module_id = m.id
                where u.id = teacher_id
            UNION
                select "Reunión" as event, m.day as day, m.time as hour, "own_meeting" as type, m.status as status, m.id as meeting_id
                from users u 
                    inner join meetings m on m.user_id = u.id
                where u.id = teacher_id and m.week = selected_week
            UNION
                select "Reunión" as event, m.day as day, m.time as hour, "invited_meeting" as type, m.status as status, m.id as meeting_id
                from users u 
                    inner join participants p on p.user_id = u.id
                    inner join meetings m on m.id = p.meeting_id
                where u.id = teacher_id and m.week = selected_week
            order by day asc, hour asc;

            END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP PROCEDURE TeacherSchedule;');
    }
};
