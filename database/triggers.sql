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

DROP TRIGGER IF EXISTS AfterParticipantUpdate;

CREATE TRIGGER AfterParticipantUpdate
AFTER UPDATE ON participants
FOR EACH ROW
BEGIN
    DECLARE accepted_count INT;
    DECLARE rejected_count INT;
    DECLARE pending_count INT;
    DECLARE total_count INT;
    
    SELECT COUNT(*) INTO accepted_count
    FROM participants
    WHERE meeting_id = NEW.meeting_id AND status = 'aceptada';
    
    SELECT COUNT(*) INTO rejected_count
    FROM participants
    WHERE meeting_id = NEW.meeting_id AND status = 'rechazada';
    
    SELECT COUNT(*) INTO pending_count
    FROM participants
    WHERE meeting_id = NEW.meeting_id AND status = 'pendiente';
    
    SELECT COUNT(*) INTO total_count
    FROM participants
    WHERE meeting_id = NEW.meeting_id;

    IF rejected_count = total_count THEN
        UPDATE meetings SET status = 'rechazada' WHERE id = NEW.meeting_id;
    ELSEIF accepted_count = total_count THEN
        UPDATE meetings SET status = 'confirmada' WHERE id = NEW.meeting_id;
    ELSEIF accepted_count > 0 THEN
        UPDATE meetings SET status = 'aceptada' WHERE id = NEW.meeting_id;
    ELSE
        UPDATE meetings SET status = 'pendiente' WHERE id = NEW.meeting_id;
    END IF;
END //

DELIMITER ;

SHOW triggers;