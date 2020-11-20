CREATE TRIGGER `atMost1CommentPerBlog` BEFORE INSERT ON `comments`
FOR EACH ROW BEGIN
      DECLARE rowcount INT;
      SELECT COUNT(*) INTO rowcount FROM comments
      WHERE New.blogid =  Comments.blogid AND New.author = Comments.author;
      IF (rowcount >= 1) THEN
         signal sqlstate '45000' set message_text = 'Only 1 comment per blog.';
      END IF;
END

CREATE TRIGGER `atMost2BlogsPerDay` BEFORE INSERT ON `blogs`
 FOR EACH ROW BEGIN
      DECLARE rowcount INT;
      SELECT COUNT(*) INTO rowcount FROM blogs
      WHERE postuser = NEW.postuser AND pdate = CURDATE();
      IF (rowcount >= 2) THEN
         signal sqlstate '45000' set message_text = 'You can not post more than two blogs a day! Please try tomorrow.';
      END IF;
END

CREATE TRIGGER `atMost3CommentsPerDay` BEFORE INSERT ON `comments`
 FOR EACH ROW BEGIN
      DECLARE rowcount INT;
      SELECT COUNT(*) INTO rowcount FROM comments
      WHERE author = NEW.author AND cdate = CURDATE();
      IF (rowcount >= 3) THEN
        signal sqlstate '45000' set message_text = 'You can not post more than three comments a day! Please try tomorrow.';
      END IF;
END

CREATE TRIGGER `noSelfComment` BEFORE INSERT ON `comments`
 FOR EACH ROW BEGIN	
	DECLARE rowcount INT;
    SELECT COUNT(*) INTO rowcount FROM blogs,comments	
    WHERE NEW.blogid = Blogs.blogid AND New.author = Blogs.postuser;
    IF (rowcount >= 1) THEN	
    	signal SQLSTATE '45000' set MESSAGE_TEXT = 'No self comment.';
        END IF;
END
