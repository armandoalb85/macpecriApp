---- boreado de datos
DELETE FROM subscriber_subscription_type;
DELETE FROM newsletter_subscriber;
DELETE FROM payment_account_statements;
DELETE FROM payment_method_records;
DELETE FROM payment_methods;
DELETE FROM ip_records;
DELETE FROM subscriber_histories;
DELETE FROM subscribers;
DELETE FROM subscription_types;
DELETE FROM users;
DELETE FROM newsletters;
--DELETE FROM subscription_messages;
DELETE FROM Subscribe_nows;
commit;
--Actualización de AUTO_INCREMENT
ALTER TABLE subscriber_subscription_type AUTO_INCREMENT = 1;
ALTER TABLE users AUTO_INCREMENT = 1;
ALTER TABLE subscribers AUTO_INCREMENT = 1;
ALTER TABLE subscription_types AUTO_INCREMENT = 1;
ALTER TABLE newsletters AUTO_INCREMENT = 1;
ALTER TABLE newsletter_subscriber AUTO_INCREMENT = 1;
ALTER TABLE payment_methods AUTO_INCREMENT = 1;
ALTER TABLE payment_method_records AUTO_INCREMENT = 1;
ALTER TABLE payment_account_statements AUTO_INCREMENT = 1;
ALTER TABLE ip_records AUTO_INCREMENT = 1;
ALTER TABLE subscriber_histories AUTO_INCREMENT = 1;
--ALTER TABLE subscription_messages AUTO_INCREMENT = 1;
ALTER TABLE Subscribe_nows AUTO_INCREMENT = 1;
commit;

-------- DOP TABLES
DROP TABLE subscriber_subscription_type;
DROP TABLE newsletter_subscriber;
DROP TABLE payment_account_statements;
DROP TABLE payment_method_records;
DROP TABLE payment_methods;
DROP TABLE ip_records;
DROP TABLE subscriber_histories;
DROP TABLE subscribers;
DROP TABLE subscription_types;
DROP TABLE users;
DROP TABLE newsletters;
--DROP TABLE subscription_messages;
DROP TABLE Subscribe_nows;
DROP TABLE password_resets;
DELETE FROM migrations;
commit;
