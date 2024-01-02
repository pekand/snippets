/*
DROP DATABASE test1 WITH (FORCE);

CREATE DATABASE IF NOT EXISTS test1;
*/

drop table users;

CREATE TABLE IF NOT EXISTS users (
  id SERIAL PRIMARY KEY,
  firstname TEXT NOT NULL,
  lastname TEXT NOT NULL,
  email TEXT NOT NULL,
  loginname TEXT NOT NULL UNIQUE,
  password TEXT NOT NULL
);

CREATE EXTENSION IF NOT EXISTS pgcrypto;

DO $$
BEGIN
  FOR i IN 1..100000 LOOP
    INSERT INTO "users" (firstname, lastname, email, loginname, password) 
    VALUES (
      concat('firstname', i),
      concat('lastname', i),
      concat('email', i),
      concat('loginname', i),
      encode(gen_random_bytes(10), 'hex')
    );
  END LOOP;
END $$;

select firstname || ' ' || lastname as full_name , LENGTH(firstname) dlzka , u.* from users u ORDER BY full_name asc limit 10;

/* ORDER BY sort_expresssion [ASC | DESC] [NULLS FIRST | NULLS LAST] */ 

/* https://www.postgresqltutorial.com/postgresql-tutorial/postgresql-select-distinct/ */
/* SELECT DISTINCT column1 FROM table_name; */
