<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Si el nuevo valor es NULL, mantenemos el valor existente en la BD
     */
    public function up(): void
    {
        DB::unprepared('
        DROP TRIGGER IF EXISTS PreventNullUpdate;
        CREATE TRIGGER PreventNullUpdate
        BEFORE UPDATE ON users
        FOR EACH ROW

        BEGIN
           
            IF NEW.role_id IS NULL THEN SET NEW.role_id = OLD.role_id; END IF;
            IF NEW.name IS NULL THEN SET NEW.name = OLD.name; END IF;
            IF NEW.email IS NULL THEN SET NEW.email = OLD.email; END IF;
            IF NEW.email_verified_at IS NULL THEN SET NEW.email_verified_at = OLD.email_verified_at; END IF;
            IF NEW.password IS NULL THEN SET NEW.password = OLD.password; END IF;
            IF NEW.remember_token IS NULL THEN SET NEW.remember_token = OLD.remember_token; END IF;
            IF NEW.created_at IS NULL THEN SET NEW.created_at = OLD.created_at; END IF;
            IF NEW.updated_at IS NULL THEN SET NEW.updated_at = OLD.updated_at; END IF;
            IF NEW.deleted_at IS NULL THEN SET NEW.deleted_at = OLD.deleted_at; END IF;
            IF NEW.lastname IS NULL THEN SET NEW.lastname = OLD.lastname; END IF;
            IF NEW.pin IS NULL THEN SET NEW.pin = OLD.pin; END IF;
            IF NEW.address IS NULL THEN SET NEW.address = OLD.address; END IF;
            IF NEW.phone1 IS NULL THEN SET NEW.phone1 = OLD.phone1; END IF;
            IF NEW.phone2 IS NULL THEN SET NEW.phone2 = OLD.phone2; END IF;
            IF NEW.photo IS NULL THEN SET NEW.photo = OLD.photo; END IF;
            IF NEW.intensive IS NULL THEN SET NEW.intensive = OLD.intensive; END IF;
            IF NEW.registered IS NULL THEN SET NEW.registered = OLD.registered; END IF;
        END;
        ');

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS PreventNullUpdate;');
    }
};
