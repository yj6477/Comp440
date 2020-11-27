USE Project;

SET FOREIGN_KEY_CHECKS=0;

DROP TABLE IF EXISTS Users;  
CREATE TABLE Users(
	username VARCHAR(20) NOT NULL,
	password VARCHAR(20),
	firstname VARCHAR(30),
	lastname VARCHAR(30),
	email VARCHAR(50) NOT NULL,
	PRIMARY KEY (username)
	);
DROP TABLE IF EXISTS Follows;
CREATE TABLE Follows(
	leader VARCHAR(20),
	follower VARCHAR(20),
	PRIMARY KEY (leader,follower),
	FOREIGN KEY(leader) references Users(username),
	FOREIGN KEY(follower) references Users(username)
	);

DROP TABLE IF EXISTS BlogTags;  
CREATE TABLE BlogTags(
	blogid INT NOT NULL,
	tag VARCHAR(20),
	PRIMARY KEY(blogid,tag),
	FOREIGN KEY (blogid) references Blogs(blogid)
	);

DROP TABLE IF EXISTS Comments;  
CREATE TABLE Comments(
	commentid INT NOT NULL AUTO_INCREMENT,
	sentiment VARCHAR(20),
	description VARCHAR(250),
	cdate DATE,
	blogid INT NOT NULL,
	author VARCHAR(20) NOT NULL,
	PRIMARY KEY(commentid),
	FOREIGN KEY(blogid) references Blogs(blogid),
	FOREIGN KEY(author) references Users(username)
	);

DROP TABLE IF EXISTS Blogs;  
CREATE TABLE Blogs(
	blogid INT NOT NULL AUTO_increment,
	subject VARCHAR(50),
	description VARCHAR(250),
	postuser VARCHAR(20) NOT NULL,
	pdate DATE,
	PRIMARY KEY(blogid),
	FOREIGN KEY (postuser) references Users(username)
);

INSERT INTO `users` (`username`, `password`, `firstname`, `lastname`, `email`) VALUES
('bdmytryk5', 'jYMks6i0MQeh', 'Bliss', 'Dmytryk', 'bdmytryk5@patch.com'),
('cheathorn9', 'zDA26lfoWJM', 'Cherilyn', 'Heathorn', 'cheathorn9@discovery.com'),
('eklemke0', 'tfdgkDi', 'Ethel', 'Klemke', 'eklemke0@bandcamp.com'),
('hgude2', '2DLOfAL', 'Hector', 'Gude', 'hgude2@fastcompany.com'),
('irottery4', 'q5MwiCsQr02', 'Isidro', 'Rottery', 'irottery4@exblog.jp'),
('john', 'pass1234', 'john', 'admin', 'john@admin.com'),
('kjeroch1', 'jKFEqKG0', 'Karalynn', 'Jeroch', 'kjeroch1@huffingtonpost.com'),
('mgebhardt8', 'Ch5tY4B2RQS', 'Marigold', 'Gebhardt', 'mgebhardt8@google.it'),
('ppach3', 'DcXvVyJp', 'Paulie', 'Pach', 'ppach3@yale.edu'),
('roriordan7', 'I4jKJ9BnP', 'Ruth', 'Riordan', 'roriordan7@oracle.com'),
('silent', 'silent123', 'silence', 'nopost', 'silence@nopost.com'),
('silentbro', 'silent456', 'brosilence', 'nopost', 'silencebro@nopost.com'),
('test', 'pass1234', 'test', 'comp440', 'test@csun.edu'),
('zeller6', 'lowlbJj7K', 'Zorah', 'Eller', 'zeller6@barnesandnoble.com');

DROP TABLE IF EXISTS Hobbies;
CREATE TABLE Hobbies(
	username VARCHAR(20),
	hobby varchar(50),
	PRIMARY KEY(username,hobby),
	FOREIGN KEY(username) references Users(username)
	);
INSERT INTO `hobbies` (`username`, `hobby`) VALUES
('bdmytryk5', 'dancing'),
('cheathorn9', 'swimming'),
('eklemke0', 'hiking'),
('hgude2', 'bowling'),
('irottery4', 'cooking'),
('kjeroch1', 'swimming'),
('mgebhardt8', 'hiking'),
('ppach3', 'movie'),
('roriordan7', 'movie'),
('test', 'cooking'),
('zeller6', 'calligraphy');

INSERT INTO `follows` (`leader`, `follower`) VALUES
('bdmytryk5', 'cheathorn9'),
('mgebhardt8', 'cheathorn9'),
('ppach3', 'hgude2'),
('bdmytryk5', 'irottery4'),
('eklemke0', 'irottery4'),
('test', 'irottery4'),
('test', 'john'),
('zeller6', 'john'),
('john', 'kjeroch1'),
('zeller6', 'kjeroch1'),
('test', 'mgebhardt8'),
('john', 'test'),
('zeller6', 'test');

INSERT INTO `blogs` (`blogid`, `subject`, `description`, `postuser`, `pdate`) VALUES
(1, 'We have granted to God', 'In the first place we have granted to God, and by this our present charter confirmed for us and our heirs forever that the English Church shall be free', 'eklemke0', '2020-07-05'),
(2, 'Fog everywhere', 'Fog up the river, where it flows among green aits and meadows; fog down the river; Fog on the Essex marshes, fog on the Kentish heights.', 'kjeroch1', '2020-10-10'),
(3, 'victorious wreaths', 'Now are our brows bound with victorious wreaths; Our bruised arms hung up for monuments; Our stern alarums changed to merry meetings, Our dreadful marches to delightful measures.', 'hgude2', '2020-04-15'),
(4, 'Eurypylus, son of Euaemon', 'And Eurypylus, son of Euaemon, killed Hypsenor, the son of noble Dolopion, who had been made priest of the river Scamander, and was honoured among the people as though he were a god.', 'ppach3', '2020-01-15'),
(5, 'The son of Tydeus', 'As for the son of Tydeus, you could not say whether he was more among the Achaeans or the Trojans. He rushed across the plain like a winter torrent that has burst its barrier in full flood', 'irottery4', '2020-09-15'),
(6, 'Pope Innocent III', 'Pope Innocent III, before the quarrel arose between us and our barons: and this we will observe, and our will is that it be observed in good faith by our heirs forever.', 'bdmytryk5', '2019-12-08'),
(7, 'Our kingdom', 'We have also granted to all freemen of our kingdom, for us and our heirs forever, all the underwritten liberties, to be had and held by them and their heirs, of us and our heirs forever.', 'zeller6', '2020-06-16'),
(8, 'Queer little streets', 'all the queer little streets and the pink and blue and yellow houses and the rosegardens and the jessamine and geraniums and cactuses and Gibraltar as a girl', 'roriordan7', '2020-05-26'),
(9, 'Medals you wear', 'Those medals you wear on your moth-eaten chest should be there for bungling at which you are best. So, stop that pigeon, stop that pigeon, stop that pigeon,', 'mgebhardt8', '2020-02-20'),
(10, 'Keep moving on', 'Every stop I make, I make a new friend. Can’t stay for long, just turn around and I’m gone again. Maybe tomorrow, I’ll want to settle down, Until tomorrow, I’ll just keep moving on.', 'cheathorn9', '2020-03-12'),
(11, 'The future of blockchain', 'Blockchain is a buzz word nowadays. We will take about the future world of blockchain', 'test', '2020-10-10'),
(12, 'Today is a lucky day.', 'I feel lucky today. My program shows no bug.', 'test', '2020-10-10'),
(13, 'Fog Chance People', 'Chance people on the bridges peeping over the parapets into a nether sky of fog, with fog all round them, as if they were up in a balloon and hanging in the misty clouds.', 'kjeroch1', '2020-10-10');

INSERT INTO `blogtags` (`blogid`, `tag`) VALUES
(1, 'God'),
(2, 'Fog'),
(3, 'victorious'),
(4, 'Eurypylus'),
(5, 'Tydeus'),
(6, 'pop III'),
(7, 'kingdom'),
(8, 'streets'),
(9, 'Medals'),
(10, 'moving on'),
(11, 'blockchain');

INSERT INTO `comments` (`commentid`, `sentiment`, `description`, `cdate`, `blogid`, `author`) VALUES
(1, 'positive', 'vestibulum proin eu mi nulla ac enim in', '2020-01-30', 1, 'kjeroch1'),
(2, 'negative', 'I don\'t like it. ', '2019-11-20', 11, 'hgude2'),
(3, 'negative', 'orci luctus et ultrices posuere cubilia curae', '2020-08-02', 2, 'ppach3'),
(4, 'negative', 'nulla dapibus dolor vel est donec odio justo sollicitudin', '2020-01-23', 3, 'irottery4'),
(5, 'positive', 'cras in purus eu magna vulputate luctus cum sociis natoque', '2020-03-19', 5, 'bdmytryk5'),
(6, 'positive', 'elementum eu interdum eu tincidunt in leo', '2019-12-14', 6, 'zeller6'),
(7, 'positive', 'ornare imperdiet sapien urna pretium nisl ut', '2020-10-22', 7, 'roriordan7'),
(8, 'positive', 'libero nullam sit amet turpis elementum ligula', '2020-09-23', 8, 'mgebhardt8'),
(9, 'positive', 'suspendisse potenti cras in purus eu', '2020-04-11', 9, 'cheathorn9'),
(10, 'negative', 'magna at nunc commodo placerat praesent blandit nam nulla', '2020-01-21', 10, 'eklemke0'),
(11, 'positive', 'Awesome. I strongly recommend the view.', '2020-06-10', 11, 'kjeroch1'),
(12, 'positive', 'feugiat non pretium quis lectus', '2020-11-14', 5, 'test'),
(13, 'positive', 'This is a nice blog. I like the comparison between blockchain and the Internet.', '2020-11-10', 11, 'eklemke0');

SET FOREIGN_KEY_CHECKS = 1;
-- DROP TRIGGER IF EXISTS atMost1CommentPerBlog;
-- DELIMITER $$
-- CREATE TRIGGER `atMost1CommentPerBlog` BEFORE INSERT ON `Comments` FOR EACH ROW BEGIN
--       DECLARE rowcount INT;
--       SELECT COUNT(*) INTO rowcount FROM commnets
--       WHERE New.blogid =  Comments.blogid AND New.author = Comments.author;
--       IF (rowcount >= 1) THEN
--          signal sqlstate '45000' set message_text = 'Only 1 comment per blog.';
--       END IF;
-- END
-- $$
-- DELIMITER ;
-- DROP TRIGGER IF EXISTS atMost3CommentsPerDay;
-- DELIMITER $$
-- CREATE TRIGGER `atMost3CommentsPerDay` BEFORE INSERT ON `Comments` FOR EACH ROW BEGIN
--       DECLARE rowcount INT;
--       SELECT COUNT(*) INTO rowcount FROM comments
--       WHERE author = NEW.author AND cdate = CURDATE();
--       IF (rowcount >= 3) THEN
--         signal sqlstate '45000' set message_text = 'You can not post more than three comments a day! Please try tomorrow.';
--       END IF;
-- END
-- $$
-- DELIMITER ;
-- DROP TRIGGER IF EXISTS noSelfComment;
-- DELIMITER $$
-- CREATE TRIGGER `noSelfComment` BEFORE INSERT ON `Comments` FOR EACH ROW BEGIN
--       DECLARE rowcount INT;
--       SELECT COUNT(*) INTO rowcount FROM Blogs
--       WHERE New.blogid = Blogs.blogid AND New.author = Blogs.postuser;
--       IF (rowcount >= 1) THEN
--          signal sqlstate '45000' set message_text = 'No self comment.';
--       END IF;
-- END
-- $$
-- DELIMITER ;
-- DROP TRIGGER IF EXISTS atMost2BlogsPerDay;
-- DELIMITER $$
-- CREATE TRIGGER `atMost2BlogsPerDay` BEFORE INSERT ON `Blogs` FOR EACH ROW BEGIN
--       DECLARE rowcount INT;
--       SELECT COUNT(*) INTO rowcount FROM blogs
--       WHERE postuser = NEW.postuser AND pdate = CURDATE();
--       IF (rowcount >= 2) THEN
--          signal sqlstate '45000' set message_text = 'You can not post more than two blogs a day! Please try tomorrow.';
--       END IF;
-- END
-- $$
-- DELIMITER ;
