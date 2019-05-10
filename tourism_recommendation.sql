create table admin
(
    id        int auto_increment
        primary key,
    firstName varchar(100) not null,
    lastName  varchar(100) not null,
    username  varchar(100) not null,
    email     varchar(100) not null,
    password  varchar(100) not null,
    gender    varchar(100) not null,
    role      varchar(100) null
);

create table destination
(
    id          int auto_increment
        primary key,
    name        varchar(100)   not null,
    location    varchar(100)   not null,
    description varchar(10000) not null,
    image       varchar(100)   not null
);

create table event
(
    id          int auto_increment
        primary key,
    eventName   varchar(100)   not null,
    location    varchar(100)   not null,
    date        date           null,
    description varchar(10000) not null,
    image       varchar(100)   not null
);

create table feedback
(
    id       int auto_increment
        primary key,
    datetime timestamp default CURRENT_TIMESTAMP not null,
    user_id  int                                 not null,
    feedback text                                not null
);

create table user
(
    id        int auto_increment
        primary key,
    firstName varchar(100) not null,
    lastName  varchar(100) not null,
    username  varchar(100) null,
    email     varchar(100) not null,
    password  varchar(100) null,
    gender    varchar(100) not null
);

create table destination_rating_info
(
    id             int auto_increment
        primary key,
    user_id        int         null,
    destination_id int         null,
    rating_action  varchar(10) null,
    constraint destination_id
        foreign key (destination_id) references destination (id)
            on update cascade on delete cascade,
    constraint user_id
        foreign key (user_id) references user (id)
            on update cascade on delete cascade
);

create table destination_review
(
    id                int auto_increment
        primary key,
    user_id_fk        int                                 not null,
    destination_id_fk int                                 not null,
    review            text                                not null,
    datetime          timestamp default CURRENT_TIMESTAMP not null,
    constraint destination_id_fk
        foreign key (destination_id_fk) references destination (id)
            on update cascade on delete cascade,
    constraint user_id_fk
        foreign key (user_id_fk) references user (id)
            on update cascade on delete cascade
);

create table user_post
(
    id       int auto_increment
        primary key,
    datetime timestamp default CURRENT_TIMESTAMP not null,
    user_id  int                                 null,
    title    varchar(100)                        not null,
    post     text                                null,
    image    varchar(100)                        null
);

create index user_id
    on user_post (user_id);

