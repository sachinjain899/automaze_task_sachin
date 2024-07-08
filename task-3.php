SELECT 
    GROUP_CONCAT(
        DISTINCT 
        CONCAT(
            'MAX(CASE WHEN up.property_id = ', 
            p.id, 
            ' THEN ',
            CASE
                WHEN p.type = 'string' THEN 'up.value_string'
                WHEN p.type = 'int' THEN 'up.value_int'
                WHEN p.type = 'datetime' THEN 'up.value_datetime'
            END,
            ' END) AS `', 
            p.name, 
            '`'
        )
    ) INTO @sql
FROM 
    properties p
JOIN
    users_properties up ON p.id = up.property_id;

SET @sql = CONCAT(
    'SELECT u.id AS user_id, u.email, ', 
    @sql, 
    ' FROM users u 
    LEFT JOIN users_properties up ON u.id = up.user_id 
    LEFT JOIN properties p ON up.property_id = p.id 
    GROUP BY u.id, u.email'
);

PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;