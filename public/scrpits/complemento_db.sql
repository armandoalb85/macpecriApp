-- Trigger para crear usuario wp en sistema
CREATE OR REPLACE TRIGGER new_admin_user
AFTER INSERT ON wp_users
FOR EACH ROW
BEGIN

    INSERT INTO users (name, email, password, username) VALUES (
        (SELECT user_login FROM wp_users WHERE id = (SELECT max(id) FROM wp_users )),
        (SELECT user_email FROM wp_users WHERE id = (SELECT max(id) FROM wp_users )),
        MD5('Macpecri123#'),
        (SELECT user_nicename FROM wp_users WHERE id = (SELECT max(id) FROM wp_users )));

END;

---- Procedimiento para migrar usuarios Wp
CREATE OR REPLACE PROCEDURE migrate_admin_wp_users()
BEGIN

DECLARE countValue INT;
DECLARE totalRegister INT;

    SET countValue = 1;

    SELECT cont(id) INTO totalRegister
    FROM wp_users;

    WHILE countValue <= totalRegister DO

        INSERT INTO users (name, email, password, username) VALUES (
        (SELECT user_login FROM wp_users WHERE id = countValue ),
        (SELECT user_email FROM wp_users WHERE id = countValue ),
        MD5('Macpecri123#'),
        (SELECT user_nicename FROM wp_users WHERE id = countValue ));

        SET countValue = countValue + 1;

    END WHILE;

END;
