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
        DROP TRIGGER IF EXISTS AfterMeetingInsert;
        CREATE TRIGGER AfterMeetingInsert
        AFTER INSERT ON meetings
        FOR EACH ROW
        BEGIN
            INSERT INTO participants (meeting_id, user_id, status, created_at, updated_at)
            VALUES (NEW.id, NEW.user_id, "pendiente", NOW(), NOW());
        END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS AfterMeetingInsert;');
    }
};
