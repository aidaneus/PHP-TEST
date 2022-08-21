CREATE DATABASE test;
USE test;

create table users
(   
    user_id integer not null,
    send_messages varchar(255) not null,
    service_api varchar(255) not null,
    debug varchar(255) not null
);


insert users(user_id, send_messages, service_api, debug)values (1,'true','false','false');
insert users(user_id, send_messages, service_api, debug) values (2,'false','false','false');
insert users(user_id, send_messages, service_api, debug)values (3,'true','true','true');
create table groups
(   
    group_id bigint AUTO_INCREMENT primary key,
    name varchar(255) not null,
    send_messages varchar(255) not null,
    service_api varchar(255) not null,
    debug varchar(255) not null
);

insert groups(name, send_messages, service_api, debug)values ('test','true','false','false');
insert groups(name, send_messages, service_api, debug)values ('test2','block','false','true');
insert groups(name, send_messages, service_api, debug)values ('test3','true','true','true');

create table groups_n_users(
    id bigint AUTO_INCREMENT primary key,
    name_group varchar(255) not null,
    user_id integer not null
);

insert groups_n_users(name_group, user_id)values ('test',1);
insert groups_n_users(name_group, user_id)values ('test3',3);