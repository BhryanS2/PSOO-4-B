drop database if exists `PSOO_alojamento`;

create database if not exists `PSOO_alojamento`;

use `PSOO_alojamento`;

create table blocos (
  id int not null auto_increment,
  name varchar(255) not null,
  pisos int not null,
  quartos int not null,
  primary key (id)
);

create table quartos (
  id int not null auto_increment,
  name varchar(255) not null,
  leitos int not null,
  piso int not null,
  blocoId int not null,
  primary key (id),
  foreign key (blocoId) references blocos(id)
);

create table if not exists alunos (
  id int auto_increment primary key,
  name varchar(255) not null,
  leito int not null,
  blocoId int not null,
  quartoId int not null,
  created_at timestamp default current_timestamp,
  updated_at timestamp default current_timestamp on update current_timestamp,
  foreign key (blocoId) references blocos(id),
  foreign key (quartoId) references quartos(id)
);