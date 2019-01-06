Create table users (
    user_id INT(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    user_firs VARCHAR(256) NOT NULL,
    user_last VARCHAR(256) NOT NULL,
    user_email VARCHAR(256) NOT NULL,
    user_uid VARCHAR(256) NOT NULL,
    user_pwd VARCHAR(256) NOT NULL
)
Insert into users (user_firs, user_last, user_email, user_uid, user_pwd)
values ('Bichiu','Stefan','stefan@yahoo.com','bich123','test2');
Insert into users (user_firs, user_last, user_email, user_uid, user_pwd)
values ('Piciorea','Vlad','vlad.piciorea@yahoo.com','vlad123','test1');