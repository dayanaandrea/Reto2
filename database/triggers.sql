USE laravel;

DELIMITER //
DROP TRIGGER IF EXISTS AfterMeetingInsert;

CREATE TRIGGER AfterMeetingInsert
AFTER INSERT ON meetings
FOR EACH ROW
BEGIN
    INSERT INTO participants (meeting_id, user_id, status, created_at, updated_at)
    VALUES (NEW.id, NEW.user_id, "pendiente", NOW(), NOW());
END//