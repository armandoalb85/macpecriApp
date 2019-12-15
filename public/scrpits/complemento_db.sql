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
