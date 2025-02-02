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
        DB::unprepared('
        DROP PROCEDURE IF EXISTS TeacherSchedule;
        CREATE PROCEDURE TeacherSchedule(
            IN teacher_id INT,
            IN selected_week INT
        )
        BEGIN
            select 
            case
				when m.code like "%TUT_%" then "TUT"
                when m.code like "%GUA_%" then "GUA" 
                else m.code
            end as event, 
            s.day as day, s.hour as hour, "module" as type, null as status, null as meeting_id
            from modules m
                inner join schedules s on s.module_id = m.id
            where m.user_id = teacher_id
        UNION
            select "REU" as event, m.day as day, m.time as hour, 
            case
                when m.user_id = p.user_id then "creator"
                else "guest"
            end as type,
            m.status as status, m.id as meeting_id 
            from meetings m 
                inner join participants p on m.id = p.meeting_id 
            where p.user_id = teacher_id and m.week = selected_week and m.day between 1 and 5
            order by day asc, hour asc;
        END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS TeacherSchedule;');
    }
};
