<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2025-04-04 08:44:02 --> Severity: Warning --> mysqli::real_connect(): (HY000/1044): Access denied for user 'root'@'192.168.1.65' to database 'smart_japan_new' /Applications/MAMP/htdocs/Smart-Japan/system/database/drivers/mysqli/mysqli_driver.php 203
ERROR - 2025-04-04 08:44:02 --> Unable to connect to the database
ERROR - 2025-04-04 08:44:02 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /Applications/MAMP/htdocs/Smart-Japan/system/core/Exceptions.php:271) /Applications/MAMP/htdocs/Smart-Japan/system/core/Common.php 564
ERROR - 2025-04-04 09:17:14 --> Severity: Notice --> Undefined variable: client_data /Applications/MAMP/htdocs/Smart-Japan/application/views/modules/general_settings/edit_client.php 16
ERROR - 2025-04-04 09:17:14 --> Severity: Notice --> Undefined variable: client_id /Applications/MAMP/htdocs/Smart-Japan/application/views/modules/general_settings/edit_client.php 60
ERROR - 2025-04-04 09:17:14 --> Severity: Notice --> Undefined variable: client_data /Applications/MAMP/htdocs/Smart-Japan/application/views/modules/general_settings/edit_client.php 63
ERROR - 2025-04-04 09:17:14 --> Severity: Notice --> Undefined variable: client_data /Applications/MAMP/htdocs/Smart-Japan/application/views/modules/general_settings/edit_client.php 69
ERROR - 2025-04-04 09:17:14 --> Severity: Notice --> Undefined variable: countries /Applications/MAMP/htdocs/Smart-Japan/application/views/modules/general_settings/edit_client.php 90
ERROR - 2025-04-04 09:17:14 --> Severity: Warning --> Invalid argument supplied for foreach() /Applications/MAMP/htdocs/Smart-Japan/application/views/modules/general_settings/edit_client.php 90
ERROR - 2025-04-04 09:17:14 --> Severity: Notice --> Undefined variable: client_data /Applications/MAMP/htdocs/Smart-Japan/application/views/modules/general_settings/edit_client.php 103
ERROR - 2025-04-04 09:17:14 --> Severity: Notice --> Undefined variable: staff_details /Applications/MAMP/htdocs/Smart-Japan/application/views/modules/general_settings/edit_client.php 112
ERROR - 2025-04-04 09:17:14 --> Severity: Warning --> Invalid argument supplied for foreach() /Applications/MAMP/htdocs/Smart-Japan/application/views/modules/general_settings/edit_client.php 112
ERROR - 2025-04-04 09:34:24 --> Query error: Unknown column 'u.first_name' in 'field list' - Invalid query: SELECT `c`.*, `d`.`account_verify`, `u`.`first_name` as `manager`
FROM `clients` AS `c`
LEFT JOIN `documents` AS `d` ON `d`.`client_id` = `c`.`id`
LEFT JOIN `user_details` AS `u` ON `c`.`manager` = `u`.`id`
ORDER BY `c`.`id` DESC
