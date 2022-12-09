drop database if exists `PSOO`;

create database if not exists `PSOO`;

use `PSOO`;

drop table if exists users;

drop table if exists questions;

drop table if exists lesson;

drop table if exists alternatives;

drop table if exists answers;

create table if not exists users (
  id int auto_increment primary key,
  name varchar(255) not null,
  email varchar(255) not null,
  password varchar(255) not null,
  role varchar(255) not null,
  created_at timestamp default current_timestamp,
  updated_at timestamp default current_timestamp on update current_timestamp
) charset = utf8 collate = utf8_general_ci engine = innodb;

create table if not exists questions (
  id int auto_increment primary key,
  content text not null,
  lesson_id int not null,
  explanation text not null,
  created_at timestamp default current_timestamp,
  updated_at timestamp default current_timestamp on update current_timestamp
) charset = utf8 collate = utf8_general_ci engine = innodb;

create table if not exists lesson (
  id int auto_increment primary key,
  name varchar(255) not null,
  description text not null,
  created_at timestamp default current_timestamp,
  updated_at timestamp default current_timestamp on update current_timestamp
) charset = utf8 collate = utf8_general_ci engine = innodb;

create table if not exists alternatives (
  id int auto_increment primary key,
  content text not null,
  question_id int not null,
  isCorrect boolean not null,
  created_at timestamp default current_timestamp,
  updated_at timestamp default current_timestamp on update current_timestamp
) charset = utf8 collate = utf8_general_ci engine = innodb;

create table if not exists answers (
  id int auto_increment primary key,
  user_id int not null,
  question_id int not null,
  alternative_id int not null,
  correct boolean not null,
  created_at timestamp default current_timestamp,
  updated_at timestamp default current_timestamp on update current_timestamp
) charset = utf8 collate = utf8_general_ci engine = innodb;

INSERT INTO
  `lesson` (`name`, `description`)
VALUES
  ('Biologia', 'matéria de humanas'),
  ('História', 'matéria de humanas'),
  ('Espanhol', 'matéria de humanas'),
  ('Português', 'matéria de humanas'),
  ('Sociologia', 'matéria de humanas'),
  ('Geografia', 'matéria de humanas'),
  ('Educação Física', 'matéria de exatas'),
  ('Física', 'matéria de exatas'),
  ('Programação', 'matéria de exatas'),
  ('Matemática', 'matéria de exatas'),
  ('Química', 'matéria de exatas'),
  (
    'Projeto de Software Orientado a Objeto',
    'matéria de exatas'
  ),
  ('Projetos Integradores', 'matéria de exatas'),
  ('Tecnologias Web', 'matéria de exatas');

set
  @fisica_id = (
    select
      id
    from
      lesson
    where
      name = 'Física'
  );

set
  @matematica_id = (
    select
      id
    from
      lesson
    where
      name = 'Matemática'
  );

INSERT INTO
  `questions` (`content`, `lesson_id`, `explanation`)
VALUES
  (
    'Um segmento de reta está dividido em duas partes na proporção áurea quando o todo está para uma das partes na mesma razão em que essa parte está para a outra. Essa constante de proporcionalidade é comumente representada pela letra grega φ, e seu valor é dado pela solução positiva da equação φ2 = φ + 1. Assim como a potência φ2 , as potências superiores de φ podem ser expressas da forma aφ + b, em que a e b são inteiros positivos, como apresentado no quadro.\r\nA potência φ = 7, escrita na forma aφ + b (a e b são inteiros positivos), é',
    @fisica_id,
    'Explicação não disponível'
  ),
  (
    'A soma dos ângulos internos de um polígono convexo é igual a',
    @matematica_id,
    'Explicação não disponível'
  );

INSERT INTO
  `alternatives` (
    `content`,
    `question_id`,
    `isCorrect`
  )
VALUES
  ('5φ + 3', 1, 0),
  ('7φ + 2', 1, 0),
  ('9φ + 6', 1, 0),
  ('11φ + 7', 1, 0),
  ('13φ + 8', 1, 1),
  ('180°', 2, 0),
  ('360°', 2, 0),
  ('540°', 2, 0),
  ('720°', 2, 1),
  ('900°', 2, 0);

INSERT INTO
  `users` (
    `id`,
    `name`,
    `email`,
    `password`,
    `role`,
    `created_at`,
    `updated_at`
  )
VALUES
  (
    1,
    'admin',
    'admin@admin.com',
    MD5('123'),
    'admin',
    '2022-10-29 16:21:42',
    '2022-10-29 16:21:42'
  );