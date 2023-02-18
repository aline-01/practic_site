create database if not exists weblog_corp;
use weblog_corp;

create table if not exists users(
    id int(11) not null auto_increment,
    name varchar(70) not null,
    username varchar(120) not null,
    password varchar(255) not null,
    email varchar(255) not null,
    primary key(id)
);

create table if not exists blogs(
    id int(11) not null auto_increment,
    image_addr varchar(250) not null,
    title varchar(160) not null,
    content mediumtext not null,
    `date` varchar(80) not null,
    writer int(10) not null,
    foreign key(writer) references users(id),
    primary key(id)
);

create table if not exists comments(
    id int(11) not null auto_increment,
    name varchar(30) not null,
    email varchar(255) default "None",
    content varchar(255) not null,
    blog_id int(11) not null,
    accepted int(1) default 0,
    foreign key(blog_id) references blogs(id),
    primary key(id)
);

create table if not exists social_media(
    id int(11) not null auto_increment,
    youtube varchar(100) default "None",
    twitter varchar(100) default "None",
    instgram varchar(100) default "None",
    aparat varchar(100) default "None",
    telegram varchar(100) default "None",
    primary key(id)
);

create table if not exists view(
    id int(11) not null auto_increment,
    blog_id int(11) not null,
    foreign key(blog_id) references blogs(id),
    primary key(id)
);

