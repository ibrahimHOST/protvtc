<?php

define('ServerName', 'localhost');
define('UserName', 'root');
define('password', '');
define('DataBase', 'DBtvtc');
//      --- --   --  --    -- (SreverInfo)  --   --  --  --  --  -- ---   

$varp_se = new mysqli(ServerName, UserName, password);
$sql = "CREATE DATABASE IF NOT EXISTS DBtvtc";
$createDT = mysqli_query($varp_se, $sql);

//      --- --   --  --    -- (CreateServer)  --   --  --  --  --  -- ---   

$conn = new mysqli(ServerName, UserName, password, DataBase);


//      --- --   --  --    --   -- (createTableInfoUsers)  --  --  --  --  -- ---              


    


        $sql =
            "CREATE TABLE IF NOT EXISTS user 
            (
                id varchar (20) unique,
                password varchar (50)
            )
            ";


    $sql =
        "CREATE TABLE IF NOT EXISTS groub 
        (
            id int (6) AUTO_INCREMENT primary key,
            gr_name varchar (50)
        )
        ";
$create = mysqli_query($conn, $sql);


    $sql =
        "CREATE TABLE IF NOT EXISTS stud 
            (
                id varchar (20) primary key,
                email varchar (50) unique,
                name varchar (50),
                pass varchar (50),
                groub_id varchar (50) references groub(id)
            )
            ";
$create = mysqli_query($conn, $sql);

    $sql =
        "CREATE TABLE IF NOT EXISTS emp 
            (
                id varchar (50) primary key,
                name varchar (50),
                pass varchar (50)
            )
            ";
$create = mysqli_query($conn, $sql);


    $sql =
        "CREATE TABLE IF NOT EXISTS groub_tasks 
            (
                task_id int (10) AUTO_INCREMENT primary key,
                file_name varchar(255),
                uploded_on datetime,
                stud_name varchar(50),
                stud_id varchar (20) references stud(id),
                gr_id varchar (50) references groub(id)
            )
            ";
    // if ($create = mysqli_query($conn, $sql)){
    //     echo 'table created';
    // }

    
    $sql = 
            "CREATE OR REPLACE TRIGGER AFTER_INSERT_stud
                after insert on stud
                for each row
            begin
                insert into user (id,password) values (new.id,new.pass);
            end;
            ";   

    $sql = 
            "CREATE OR REPLACE TRIGGER AFTER_INSERT_emp
                after insert on emp
                for each row
            begin
                insert into user (id,password) values (new.id,new.pass);
            end;
            ";   


?>
