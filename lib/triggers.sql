create table movie_log(
     mov_id int,
     mov_title varchar(50),
     mov_time int,
     mov_lang varchar(50),
     mov_dt_rel date,
     mov_rel_country varchar(5),
     mov_plot varchar(250),
     lastinserted time);

drop trigger if exists movie_trigger;

delimiter $$
CREATE TRIGGER movie_trigger
after delete on movie
for each row
BEGIN
insert into movie_log values(old.mov_id,old.mov_title,old.mov_time,
old.mov_lang,old.mov_dt_rel,old.mov_rel_country,old.mov_plot,curtime());
END$$
delimiter ;