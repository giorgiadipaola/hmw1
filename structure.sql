CREATE table courses(
	   id integer primary key auto_increment,
	   coursename varchar(255) not null unique,
           nsubs integer default 0,
	   teacher varchar(255),
	   schedule1 varchar(255),
	   schedule2 varcahr(255),
	   img_src varchar(255),
           content json
) Engine = InnoDB;

INSERT INTO courses(coursename, teacher, schedule1, schedule2,img_src) values('WEB PROGRAMMING', 'Simone Palazzo', 'TUE-11:00 am', 'THU-11:00 am','coding1.jpeg');
INSERT INTO courses(coursename, teacher, schedule1, schedule2,img_src) values('MACHINE LEARNING', 'Giovanni Schembra', 'MON-03:00 pm', 'FRI-11:00 am','machine.jpeg');
INSERT INTO courses(coursename, teacher, schedule1, schedule2,img_src) values('MATHEMATICS', 'Andrea Scapellato', 'WEN-11:00 am', 'FRI-9:00 am','mathematics.jpg');
INSERT INTO courses(coursename, teacher, schedule1, schedule2,img_src) values('STARTUP AND BUSINESS MODELS', 'Paolo Loreto', 'MON-11:00 am', 'THU-06:00 pm','startup.jpg');
INSERT INTO courses(coursename, teacher, schedule1, schedule2,img_src) values('DATA BASE', 'Daniela Giordano', 'WEN-06:00 am', 'SAT-03:00 pm','database.png');
INSERT INTO courses(coursename, teacher, schedule1, schedule2,img_src) values('ARTS', 'Vincent Van Gogh', 'MON-01:00 pm', 'THU-02:00 pm','arts.png');
INSERT INTO courses(coursename, teacher, schedule1, schedule2,img_src) values('DATA BASE', 'Daniela Giordano', 'WEN-06:00 am', 'SAT-03:00 pm','database.png');
INSERT INTO courses(coursename, teacher, schedule1, schedule2,img_src) values('SOFT SKILLS', 'Vibes', 'FRI-05:00 pm', 'TUE-02:00 pm','softskills.jpg');
CREATE TABLE users (
    id integer primary key auto_increment,
    username varchar(16) not null unique,
    password varchar(255) not null,
    email varchar(255) not null unique,
    name varchar(255) not null,
    surname varchar(255) not null,
    nposts integer default 0,
    ncourses integer default 0
) Engine = InnoDB;


CREATE TABLE subscriptions(
    user integer not null,
    course integer not null,
    index xuser(user),
    index xpost(course),
    foreign key(user) references users(id) on delete cascade on update cascade,
    foreign key(course) references courses(id) on delete cascade on update cascade,
    primary key(user, course)
) Engine = InnoDB;

DELIMITER //
CREATE TRIGGER subs_trigger
AFTER INSERT ON subscriptions
FOR EACH ROW
BEGIN
UPDATE courses
SET nsubs = nsubs + 1
WHERE id = new.course;
END //
DELIMITER ;
DELIMITER //
CREATE TRIGGER subs_trigger2
AFTER INSERT ON subscriptions
FOR EACH ROW
BEGIN
UPDATE users
SET ncourses = ncourses + 1
WHERE id = new.user;
END //
DELIMITER ;

DELIMITER //
CREATE TRIGGER unsubs_trigger
AFTER DELETE ON subscriptions
FOR EACH ROW
BEGIN
UPDATE courses
SET nsubs = nsubs - 1
WHERE id = old.course;
END //
DELIMITER ;

DELIMITER //
CREATE TRIGGER unsubs_trigger2
AFTER DELETE ON subscriptions
FOR EACH ROW
BEGIN
UPDATE users 
SET ncourses = ncourses - 1
WHERE id = old.user;
END //
DELIMITER ;