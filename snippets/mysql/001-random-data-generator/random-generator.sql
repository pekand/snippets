
DROP TABLE IF EXISTS your_table;
DROP PROCEDURE IF EXISTS prepare_data;
CREATE TABLE your_table (
id int NOT NULL PRIMARY KEY AUTO_INCREMENT, 
val1 int,
val2 int,
val3 int);

DELIMITER $$
CREATE PROCEDURE prepare_data()
BEGIN
  DECLARE i INT DEFAULT 100;

    DECLARE MinVal INT DEFAULT 1;
    DECLARE MaxVal INT DEFAULT 1000000000000;

  WHILE i < 100000 DO  
    INSERT IGNORE INTO your_table (val1,val2,val3) VALUES (
        MinVal + CEIL(RAND() * (MaxVal - MinVal)),
        MinVal + CEIL(RAND() * (MaxVal - MinVal)),
        MinVal + CEIL(RAND() * (MaxVal - MinVal))
    );
    SET i = i + 1;
  END WHILE;
END$$
DELIMITER ;

CALL prepare_data();
