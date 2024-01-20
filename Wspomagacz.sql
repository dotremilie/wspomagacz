create table equipment
(
    id   int auto_increment
        primary key,
    name tinytext not null
);

create table exercises
(
    id   int auto_increment
        primary key,
    name tinytext not null
);

create table custom_exercise_equipment
(
    id                 int auto_increment
        primary key,
    custom_exercise_id int not null,
    equipment_id       int not null,
    constraint custom_exercise_equipment_custom_exercises_id_fk
        foreign key (custom_exercise_id) references exercises (id),
    constraint custom_exercise_equipment_muscles_id_fk
        foreign key (equipment_id) references equipment (id)
);

create table exercise_equipment
(
    id           int auto_increment
        primary key,
    exercise_id  int           not null,
    equipment_id int default 1 not null,
    constraint exercise_equipment_exercises_id_fk
        foreign key (exercise_id) references exercises (id),
    constraint exercise_equipment_muscles_id_fk
        foreign key (equipment_id) references equipment (id)
);

create table muscles
(
    id   int auto_increment
        primary key,
    name tinytext not null
);

create table custom_exercise_muscles
(
    id                 int auto_increment
        primary key,
    custom_exercise_id int not null,
    muscle_id          int not null,
    strength           int not null,
    constraint exercise_muscles_uk
        unique (custom_exercise_id, muscle_id),
    constraint custom_exercise_muscles_custom_exercises_id_fk
        foreign key (custom_exercise_id) references exercises (id),
    constraint custom_exercise_muscles_muscles_id_fk
        foreign key (muscle_id) references muscles (id)
);

create table exercise_muscles
(
    id          int auto_increment
        primary key,
    exercise_id int           not null,
    muscle_id   int default 1 not null,
    strength    int default 0 not null,
    constraint exercise_muscles_uk
        unique (exercise_id, muscle_id),
    constraint exercise_muscles_exercises_id_fk
        foreign key (exercise_id) references exercises (id),
    constraint exercise_muscles_muscles_id_fk
        foreign key (muscle_id) references muscles (id)
);

create table training_statuses
(
    id   int auto_increment
        primary key,
    name tinytext not null
);

create table user_genders
(
    id   int auto_increment
        primary key,
    name tinytext not null
);

create table user_statuses
(
    id   int auto_increment
        primary key,
    name tinytext not null
);

create table users
(
    id             int auto_increment
        primary key,
    username       tinytext                              not null,
    password_hash  char(60)                              not null,
    email          tinytext                              not null,
    gender         int                                   not null,
    status         int       default 2                   not null,
    last_logged_at timestamp                             null,
    created_at     timestamp default current_timestamp() not null,
    modified_at    timestamp default current_timestamp() not null on update current_timestamp(),
    constraint users_username_uk
        unique (username) using hash,
    constraint users_user_genders_id_fk
        foreign key (gender) references user_genders (id),
    constraint users_user_statuses_id_fk
        foreign key (status) references user_statuses (id)
);

create table custom_exercises
(
    id      int auto_increment
        primary key,
    name    tinytext not null,
    user_id int      not null,
    constraint custom_exercises_users_id_fk
        foreign key (user_id) references users (id)
);

create table trainings
(
    id              int auto_increment
        primary key,
    user_id         int                    not null,
    name            tinytext               not null,
    burned_calories int  default 0         not null,
    date            date default curdate() null,
    status          int  default 1         not null,
    started_at      timestamp              null,
    finished_at     timestamp              null,
    constraint trainings_training_statuses_id_fk
        foreign key (status) references training_statuses (id),
    constraint trainings_users_id_fk
        foreign key (user_id) references users (id)
            on delete cascade
);

create table training_exercises
(
    id          int auto_increment
        primary key,
    training_id int           not null,
    exercise_id int           not null,
    status      int default 1 not null,
    `order`     int           not null,
    constraint training_exercises_exercises_id_fk
        foreign key (exercise_id) references exercises (id),
    constraint training_exercises_training_statuses_id_fk
        foreign key (status) references training_statuses (id),
    constraint training_exercises_trainings_id_fk
        foreign key (training_id) references trainings (id)
            on delete cascade
);

create table training_exercises_sets
(
    id                   int auto_increment
        primary key,
    training_exercise_id int             not null,
    `order`              int             not null,
    repetitions          int   default 0 not null,
    weight               float default 0 not null,
    constraint training_exercises_sets_training_exercises_id_fk
        foreign key (training_exercise_id) references training_exercises (id)
            on delete cascade
);

create table user_exercise_personal_best
(
    id          int auto_increment
        primary key,
    user_id     int   not null,
    exercise_id int   not null,
    training_id int   not null,
    weight      float not null,
    constraint user_exercise_personal_best_pk
        unique (user_id, exercise_id),
    constraint user_exercise_personal_best_exercises_id_fk
        foreign key (exercise_id) references exercises (id),
    constraint user_exercise_personal_best_trainings_id_fk
        foreign key (training_id) references trainings (id),
    constraint user_exercise_personal_best_users_id_fk
        foreign key (user_id) references users (id)
);

create table user_weights
(
    id      int auto_increment
        primary key,
    user_id int                                   not null,
    weight  float                                 not null,
    date    timestamp default current_timestamp() not null on update current_timestamp(),
    constraint user_weights_users_id_fk
        foreign key (user_id) references users (id)
);


INSERT INTO equipment (name)
VALUES ('Brak'),
       ('Hantle'),
       ('Ławka prosta'),
       ('Ławka skośna'),
       ('Mata fitness'),
       ('Sztanga'),
       ('Wyciąg górny'),
       ('Wyciąg dolny'),
       ('Maszyna do wysciskania nogami'),
       ('Maszyna do rozpiętek'),
       ('Rowerek'),
       ('Orbitrek'),
       ('Shoulder press'),
       ('Drążek');


INSERT INTO exercises (name)
VALUES ('Przysiady'),
       ('Wykroki'),
       ('Wspięcia na palce'),
       ('Wyciskanie sztangi'),
       ('Wyciskanie skośne'),
       ('Pompki'),
       ('Rozpiętki'),
       ('Brzuszki'),
       ('Deska'),
       ('Unoszenie nóg w leżeniu'),
       ('Martwy ciąg'),
       ('Wiosłowanie'),
       ('Pull-up'),
       ('Podciąganie sztangi'),
       ('Unoszenie hantli bokiem'),
       ('Shoulder press'),
       ('Francuzy'),
       ('Dipy'),
       ('Wyciskanie hantli nad głową'),
       ('Uginanie ramion z hantlami'),
       ('Uginanie ramion ze sztangą'),
       ('Hip trust'),
       ('Wykroki w miejscu'),
       ('Unoszenie hantli bokiem'),
       ('Uginanie nprzedramion ze sztangą'),
       ('Podciąganie na drążku'),
       ('Wyciskanie hantli siedząc w górę'),
       ('Wznosy nóg na drążku'),
       ('Bułgary');



INSERT INTO exercise_equipment (exercise_id, equipment_id)
VALUES (1, 1),
       (2, 1),
       (3, 2),
       (4, 6),
       (5, 2),
       (6, 1),
       (7, 10),
       (8, 1),
       (9, 1),
       (10, 1),
       (11, 6),
       (12, 6),
       (13, 14),
       (14, 6),
       (15, 2),
       (16, 13),
       (17, 6),
       (18, 14),
       (19, 2),
       (20, 2),
       (21, 6),
       (22, 3),
       (23, 2),
       (24, 12),
       (25, 6),
       (26, 14),
       (27, 2),
       (28, 14),
       (29, 2);

INSERT INTO muscles (name)
VALUES ('Klatka piersiowa'),
       ('Brzuch'),
       ('Plecy'),
       ('Ramiona'),
       ('Biceps'),
       ('Triceps'),
       ('Barki'),
       ('Przedramiona'),
       ('Pośladki'),
       ('Łydki'),
       ('Uda');



INSERT INTO exercise_muscles (exercise_id, muscle_id, strength)
VALUES (1, 3, 2),
       (1, 9, 1),
       (2, 9, 2),
       (2, 10, 1),
       (3, 9, 2),
       (3, 10, 1),
       (4, 1, 3),
       (4, 4, 2),
       (5, 1, 3),
       (5, 4, 2),
       (6, 1, 2),
       (6, 4, 1),
       (7, 1, 2),
       (7, 4, 1),
       (8, 2, 3),
       (9, 2, 2),
       (10, 2, 2),
       (11, 3, 3),
       (11, 10, 2),
       (12, 3, 3),
       (12, 4, 2),
       (13, 3, 3),
       (13, 4, 2),
       (14, 4, 3),
       (15, 4, 3),
       (16, 4, 3),
       (17, 4, 2),
       (18, 6, 3),
       (19, 4, 3),
       (20, 5, 2),
       (21, 5, 2),
       (22, 9, 3),
       (23, 10, 2);

INSERT INTO training_statuses (name)
VALUES ('Planowany'),
       ('W trakcie'),
       ('Zakończony');


INSERT INTO user_genders (name)
VALUES ('Mężczyzna'),
       ('Kobieta'),
       ('Wolę nie podawać');

INSERT INTO user_statuses (name)
VALUES ('Aktywny'),
       ('Nieaktywny'),
       ('Zawieszony');
