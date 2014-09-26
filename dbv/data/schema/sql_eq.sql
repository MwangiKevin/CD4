CREATE DEFINER=`root`@`localhost` PROCEDURE `sql_eq`()
BEGIN
			SELECT `description` as `equipment`,`id` FROM `equipment` WHERE `category`= '1' ORDER BY `description` ASC; 
		END