--usuarios con conversion de cuenta gratuita a paga
SELECT concat(subs.name, ' ', subs.lastname) as "Suscriptor",
   subs.created_at as "suscrito",
   subty.name as "tipo de cuenta",
   sust.startdate as "conversion",
   (SELECT count(sust.id)
    FROM  subscriber_subscription_type sust, subscription_types subty
    WHERE sust.subscription_id = subty.id
        AND sust.closedate is null
        AND subty.type = 'Pago') as "Total pago",
   (SELECT count(sust.id)
    FROM  subscriber_subscription_type sust, subscription_types subty
    WHERE sust.subscription_id = subty.id
        AND sust.closedate is null
        AND subty.type = 'Gratuita') as "Total gratuito"
FROM Subscribers subs, subscriber_subscription_type sust, subscription_types subty
WHERE subs.id = sust.subscriber_id
    AND sust.subscription_id = subty.id
    AND subty.type = 'Pago'
    AND sust.subscriber_id IN  (SELECT sust.subscriber_id
                                FROM Subscribers subs, subscriber_subscription_type sust, subscription_types subty
                                WHERE subs.id = sust.subscriber_id
                                    AND sust.subscription_id = subty.id
                                    AND subty.type = 'Gratuita'
                                    AND sust.closedate is not null)
    AND sust.startdate >= '2019-02-10'
    AND sust.startdate <= '2019-06-10';


----- publico general con cuentas suscrita
SELECT concat(subs.name, ' ', subs.lastname) as "Suscriptor",
    user.username,
    user.email,
   subs.created_at as "suscrito",
   subty.name as "tipo de cuenta",
   (SELECT count(sust.id)
    FROM  subscriber_subscription_type sust, subscription_types subty
    WHERE sust.subscription_id = subty.id
        AND sust.closedate is null
        AND subty.type = 'Pago') as "Total pago",
   (SELECT count(sust.id)
    FROM  subscriber_subscription_type sust, subscription_types subty
    WHERE sust.subscription_id = subty.id
        AND sust.closedate is null
        AND subty.type = 'Gratuita') as "Total gratuito"
FROM users user, Subscribers subs, subscriber_subscription_type sust, subscription_types subty
WHERE subs.id = sust.subscriber_id
    AND sust.subscription_id = subty.id
    AND subs.user_id = user.id
    AND sust.closedate is null
    AND sust.created_at >= '1990-02-10'
    AND sust.created_at<= '2019-06-10';

--Uso de cuentas de Pago
SELECT distinct(pame.name) AS "Metodo de Pago"
FROM  payment_method_records pamr, payment_methods pame
WHERE  pame.id = pamr.paymentmethod_id
UNION
SELECT distinct(pame.name) AS "Metodo de Pago"
FROM  payment_method_records pamr, payment_methods pame
WHERE  pame.id != pamr.paymentmethod_id;

SELECT count(pamr.paymentmethod_id) AS "Total"
FROM  payment_method_records pamr, payment_methods pame
WHERE  pame.id = pamr.paymentmethod_id
    AND pame.name = 'MasterCard';
