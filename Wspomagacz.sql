create or replace table equipment
(
    id   int auto_increment
        primary key,
    name tinytext not null
);

create or replace table exercises
(
    id   int auto_increment
        primary key,
    name tinytext not null
);

create or replace table custom_exercise_equipment
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

create or replace table exercise_equipment
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

create or replace table muscles
(
    id   int auto_increment
        primary key,
    name tinytext not null
);

create or replace table custom_exercise_muscles
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

create or replace table exercise_muscles
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

create or replace table training_statuses
(
    id   int auto_increment
        primary key,
    name tinytext not null
);

create or replace table user_genders
(
    id   int auto_increment
        primary key,
    name tinytext not null
);

create or replace table user_statuses
(
    id   int auto_increment
        primary key,
    name tinytext not null
);

create or replace table users
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

create or replace table custom_exercises
(
    id      int auto_increment
        primary key,
    name    tinytext not null,
    user_id int      not null,
    constraint custom_exercises_users_id_fk
        foreign key (user_id) references users (id)
);

create or replace table trainings
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

create or replace table training_exercises
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

create or replace table training_exercises_sets
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

create or replace table user_exercise_personal_best
(
    id          int auto_increment
        primary key,
    user_id     int   not null,
    exercise_id int   not null,
    training_id int   not null,
    weight      float not null,
    constraint user_exercise_personal_best_exercises_id_fk
        foreign key (exercise_id) references exercises (id),
    constraint user_exercise_personal_best_trainings_id_fk
        foreign key (training_id) references trainings (id),
    constraint user_exercise_personal_best_users_id_fk
        foreign key (user_id) references users (id)
);

create or replace table user_weights
(
    id      int auto_increment
        primary key,
    user_id int                                   not null,
    weight  float                                 not null,
    date    timestamp default current_timestamp() not null on update current_timestamp(),
    constraint user_weights_users_id_fk
        foreign key (user_id) references users (id)
);