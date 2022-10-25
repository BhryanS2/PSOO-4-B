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

create table if not exists posts (
  id int auto_increment primary key,
  title varchar(255) not null,
  content text not null,
  user_id int not null,
  created_at timestamp default current_timestamp,
  updated_at timestamp default current_timestamp on update current_timestamp,
  foreign key (user_id) references users(id)
);

create table if not exists comments (
  id int auto_increment primary key,
  content text not null,
  user_id int not null,
  post_id int not null,
  created_at timestamp default current_timestamp,
  updated_at timestamp default current_timestamp on update current_timestamp,
  foreign key (user_id) references users(id),
  foreign key (post_id) references posts(id)
);

create table if not exists likes (
  id int auto_increment primary key,
  user_id int not null,
  post_id int not null,
  created_at timestamp default current_timestamp,
  updated_at timestamp default current_timestamp on update current_timestamp,
  foreign key (user_id) references users(id),
  foreign key (post_id) references posts(id)
);