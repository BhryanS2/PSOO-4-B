drop database if exists `PSOO`;

create database if not exists `PSOO`;

use `PSOO`;

create table if not exists users (
  id int auto_increment primary key,
  name varchar(255) not null,
  email varchar(255) not null,
  password varchar(255) not null,
  created_at timestamp default current_timestamp,
  updated_at timestamp default current_timestamp on update current_timestamp
);

create table if not exists questions (
  id int auto_increment primary key,
  content text not null,
  user_id int not null,
  lesson_id int not null,
  tags text not null,
  created_at timestamp default current_timestamp,
  updated_at timestamp default current_timestamp on update current_timestamp
);

create table if not exists lesson (
  -- $stmt->bindParam(":name", $name);
  -- $stmt->bindParam(":description", $description);
  -- $stmt->bindParam(":user_id", $userId);
  id int auto_increment primary key,
  name varchar(255) not null,
  description text not null,
  user_id int not null,
  created_at timestamp default current_timestamp,
  updated_at timestamp default current_timestamp on update current_timestamp
);