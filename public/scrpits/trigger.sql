----------------------------Version Local desarrollo
-- Trigger para crear usuario wp en sistema
CREATE OR REPLACE TRIGGER new_admin_user
AFTER INSERT ON wp_users
FOR EACH ROW
BEGIN
    DECLARE maxAdminUserId INT;

    SELECT max(id) INTO maxAdminUserId
    FROM wp_users;

    INSERT INTO users (name, email, password, username, type) VALUES (
        (SELECT user_login FROM wp_users WHERE id = maxAdminUserId),
        (SELECT user_email FROM wp_users WHERE id = maxAdminUserId),
        MD5('Macpecri123#'),
        (SELECT user_nicename FROM wp_users WHERE id = maxAdminUserId ),
        'Admin');

END;

---Version de entrega
CREATE TRIGGER new_admin_user
AFTER INSERT ON wp_users
FOR EACH ROW

BEGIN
    DECLARE maxAdminUserId INT;

    SELECT max(`id`) INTO maxAdminUserId
    FROM wp_users;

    INSERT INTO `users` (name, email, password, username, `type`) VALUES (
        (SELECT user_login FROM wp_users WHERE `id` = maxAdminUserId),
        (SELECT user_email FROM wp_users WHERE `id`= maxAdminUserId),
        MD5('Macpecri123#'),
        (SELECT user_nicename FROM wp_users WHERE `id` = maxAdminUserId ),
        'Admin');

END;
