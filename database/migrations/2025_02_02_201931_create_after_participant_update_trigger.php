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
        DROP TRIGGER IF EXISTS AfterParticipantUpdate;
        CREATE TRIGGER AfterParticipantUpdate
        AFTER UPDATE ON participants
        FOR EACH ROW
        BEGIN
            DECLARE accepted_count INT;
            DECLARE rejected_count INT;
            DECLARE pending_count INT;
            DECLARE total_count INT;
            DECLARE current_status VARCHAR(255);
            
            SELECT status INTO current_status
            FROM meetings
            WHERE id = NEW.meeting_id;

            IF current_status NOT IN ("cancelada", "forzada") THEN
                SELECT COUNT(*) INTO accepted_count
                FROM participants
                WHERE meeting_id = NEW.meeting_id AND status = "aceptada";
                
                SELECT COUNT(*) INTO rejected_count
                FROM participants
                WHERE meeting_id = NEW.meeting_id AND status = "rechazada";
                
                SELECT COUNT(*) INTO pending_count
                FROM participants
                WHERE meeting_id = NEW.meeting_id AND status = "pendiente";
                
                SELECT COUNT(*) INTO total_count
                FROM participants
                WHERE meeting_id = NEW.meeting_id;

                IF rejected_count = total_count THEN
                    UPDATE meetings SET status = "rechazada" WHERE id = NEW.meeting_id;
                ELSEIF accepted_count = total_count THEN
                    UPDATE meetings SET status = "confirmada" WHERE id = NEW.meeting_id;
                ELSEIF accepted_count > 0 THEN
                    UPDATE meetings SET status = "aceptada" WHERE id = NEW.meeting_id;
                ELSE
                    UPDATE meetings SET status = "pendiente" WHERE id = NEW.meeting_id;
                END IF;
            END IF;
        END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS AfterParticipantUpdate;');
    }
};
