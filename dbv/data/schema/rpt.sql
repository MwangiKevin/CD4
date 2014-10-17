CREATE DEFINER=`root`@`localhost` PROCEDURE `rpt`()
BEGIN
	CALL `cd4tz`.`equipment_pie`(0, 0);
END