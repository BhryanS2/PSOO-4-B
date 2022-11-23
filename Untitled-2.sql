-- DELETE FROM `lesson` WHERE name like 'Test';
-- delete from lesson all names that start with 'Test'
DELETE FROM
  `lesson`
WHERE
  name like 'Test%';

INSERT INTO
  `questions`(
    `id`,
    `content`,
    `user_id`,
    `lesson_id`,
    `created_at`,
    `updated_at`
  )
VALUES
  (
    '[value-1]',
    '[value-2]',
    '[value-3]',
    '[value-4]',
    '[value-5]',
    '[value-6]'
  ) -- Um segmento de reta está dividido em duas partes na proporção áurea quando o todo está para uma das partes na mesma razão em que essa parte está para a outra. Essa constante de proporcionalidade é comumente representada pela letra grega φ, e seu valor é dado pela solução positiva da equação φ2 = φ + 1. Assim como a potência φ2 , as potências superiores de φ podem ser expressas da forma aφ + b, em que a e b são inteiros positivos, como apresentado no quadro.
  -- A potência φ = 7, escrita na forma aφ + b (a e b são inteiros positivos), é
  -- lesson id = 20 -> Física
  -- user id = 1 -> admin
  -- INSERT INTO `questions`(`id`, `content`, `user_id`, `lesson_id`, `created_at`, `updated_at`) VALUES ('[value-1]','[value-2]','[value-3]','[value-4]','[value-5]','[value-6]')
INSERT INTO
  `questions`(`content`, `user_id`, `lesson_id`)
VALUES
  (
    'Um segmento de reta está dividido em duas partes na proporção áurea quando o todo está para uma das partes na mesma razão em que essa parte está para a outra. Essa constante de proporcionalidade é comumente representada pela letra grega φ, e seu valor é dado pela solução positiva da equação φ2 = φ + 1. Assim como a potência φ2 , as potências superiores de φ podem ser expressas da forma aφ + b, em que a e b são inteiros positivos, como apresentado no quadro.
A potência φ = 7, escrita na forma aφ + b (a e b são inteiros positivos), é',
    '1',
    '20'
  );

-- SELECT * FROM `questions` WHERE content like '%potência%';
-- insert alternative for question id = 4
-- INSERT INTO `alternatives`(`id`, `content`, `question_id`, `isCorrect`, `created_at`, `updated_at`) VALUES ('[value-1]','[value-2]','[value-3]','[value-4]','[value-5]','[value-6]')
-- A -> 5φ + 3
-- B -> 7φ + 2
-- C -> 9φ + 6
-- D -> 11φ + 7
-- E -> 13φ + 8 -> correct
INSERT INTO
  `alternatives`(`content`, `question_id`, `isCorrect`)
VALUES
  ('5φ + 3', '4', '0'),
  ('7φ + 2', '4', '0'),
  ('9φ + 6', '4', '0'),
  ('11φ + 7', '4', '0'),
  ('13φ + 8', '4', '1');