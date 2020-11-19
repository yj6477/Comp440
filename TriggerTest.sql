DROP TRIGGER IF EXISTS atMost1CommentPerBlog;
DELIMITER $$
CREATE TRIGGER `atMost1CommentPerBlog` BEFORE INSERT ON `Comments` FOR EACH ROW BEGIN
      DECLARE rowcount INT;
      SELECT COUNT(*) INTO rowcount FROM commnets
      WHERE New.blogid =  Comments.blogid AND New.author = Comments.author;
      IF (rowcount >= 1) THEN
         signal sqlstate '45000' set message_text = 'Only 1 comment per blog.';
      END IF;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS atMost3CommentsPerDay;
DELIMITER $$
CREATE TRIGGER `atMost3CommentsPerDay` BEFORE INSERT ON `Comments` FOR EACH ROW BEGIN
      DECLARE rowcount INT;
      SELECT COUNT(*) INTO rowcount FROM comments
      WHERE author = NEW.author AND cdate = CURDATE();
      IF (rowcount >= 3) THEN
        signal sqlstate '45000' set message_text = 'You can not post more than three comments a day! Please try tomorrow.';
      END IF;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS noSelfComment;
DELIMITER $$
CREATE TRIGGER `noSelfComment` BEFORE INSERT ON `Comments` FOR EACH ROW BEGIN
      DECLARE rowcount INT;
      SELECT COUNT(*) INTO rowcount FROM blogs,comments
      WHERE Comments.blogid = Blogs.blogid AND New.author = Blogs.postuser;
      IF (rowcount >= 1) THEN
         signal sqlstate '45000' set message_text = 'No self comment.';
      END IF;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS atMost2BlogsPerDay;
DELIMITER $$
CREATE TRIGGER `atMost2BlogsPerDay` BEFORE INSERT ON `Blogs` FOR EACH ROW BEGIN
      DECLARE rowcount INT;
      SELECT COUNT(*) INTO rowcount FROM blogs
      WHERE postuser = NEW.postuser AND pdate = CURDATE();
      IF (rowcount >= 2) THEN
         signal sqlstate '45000' set message_text = 'You can not post more than two belogs a day! Please try tomorrow.';
      END IF;
END
$$
DELIMITER ;
