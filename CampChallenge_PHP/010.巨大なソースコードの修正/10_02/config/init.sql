/* SQL */

/* ソースコ−度修正で使用するテーブル */
create table user_t (
    userID int auto_increment primary key,
    name varchar(255),
    birthday date,
    tell varchar(255),
    type int,
    comment text,
    newDate datetime
);
