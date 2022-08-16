CREATE DATABASE test;
USE test;

create table users
(   
    user_id integer not null,
    send_messages boolean default false,
    service_api boolean default false,
    debug boolean default false
);

insert users(user_id, send_messages, service_api, debug)values (1,false,false,false);
insert users(user_id, send_messages, service_api, debug) values (2,false,false,false);
insert users(user_id, send_messages, service_api, debug) values (3,false,false,false);

create table groups
(   
    group_id bigint AUTO_INCREMENT primary key,
    name varchar(255) not null,
    send_messages boolean default false,
    service_api boolean default false,
    debug boolean default false
);

create table groups_n_users(
    id bigint AUTO_INCREMENT primary key,
    name_group varchar(255) not null,
    user_id integer not null
);