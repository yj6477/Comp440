(1-1)
CREATE TABLE Department (
	DepartmentID int NOT NULL,
	DepartmentName varchar(25) NOT NULL UNIQUE,
	PRIMARY KEY(DepartmentID)
);
CREATE TABLE Employee (
	EmployeeID int,
    LastName varchar(25) NOT NULL,
    DeptID int,
    PRIMARY KEY(EmployeeID),
    FOREIGN KEY (DeptID) REFERENCES Department(DepartmentID)  
);

(1-2)
INSERT INTO Department(DepartmentID, DepartmentName) VALUES (31,'Sales'),(33,'Engineering'),(34,'Clerical'),(35,'Marketing');
INSERT INTO Employee(EmployeeID,LastName,DeptID) VALUES (1,'Rafferty',31),(2,'Jones',33),(3,'Heinsenberg',33),(4,'Robinson',34)
,(5,'Smith',34),(6,'Williams',NULL),(7,'Brown',NULL);

(1-3)
ALTER TABLE Employee ADD FirstName varchar(25) NOT NULL;
UPDATE Employee SET FirstName = 'John' WHERE EmployeeID = '1';
UPDATE Employee SET FirstName = 'Mary' WHERE EmployeeID = '2';
UPDATE Employee SET FirstName = 'David' WHERE EmployeeID = '3';
UPDATE Employee SET FirstName = 'Bob' WHERE EmployeeID = '4';
UPDATE Employee SET FirstName = 'Peter' WHERE EmployeeID = '5';
UPDATE Employee SET FirstName = 'Alice' WHERE EmployeeID = '6';
UPDATE Employee SET FirstName = 'Heather' WHERE EmployeeID = '7';

(1-4)
a) SELECT * FROM Employee CROSS JOIN Department on Employee.DeptID = Department.DepartmentID
b) SELECT * FROM Employee INNER JOIN Department on Employee.DeptID = Department.DepartmentID
c) SELECT * FROM Employee LEFT JOIN Department on Employee.DeptID = Department.DepartmentID
d) SELECT * FROM Employee RIGHT JOIN Department on Employee.DeptID = Department.DepartmentID

(1-5)
DELETE FROM Employee WHERE Employee.DeptID IS NULL

(1-6) And how you can solve the problem (5 pts).

DELETE FROM Department WHERE Department.DepartmentName = 'Sales'

This statement does not work because entries in Department are referenced by a foregin key, namely Employee.DeptID.

TO fix this, we can add the on delete cascade option to the foregin key
First you delete the exisiting by 

ALTER TABLE Employee DROP FOREIGN KEY`employee_ibfk_1`, 
ALTER TABLE Employee ADD FOREIGN KEY (DeptID) REFERENCES Department(DepartmentID) ON DELETE CASCADE

This a fix to this problem. First we take off the foreign key constraint. Then we 
then add it again with the option on delete cascade 


(2-1)
1) SELECT name, salary FROM instructor AS I WHERE salary > (SELECT avg(salary) FROM instructor)
   
   SELECT I.name, I.salary
	FROM (SELECT name, salary, (SELECT AVG(salary) FROM instructor) as _avg FROM instructor
	HAVING _avg > salary) as I

2) SELECT dept_name, min(salary), max(salary), avg(salary) FROM instructor GROUP BY dept_name

SELECT I.dept_name, I._min, J._max, K._avg
FROM(SELECT dept_name, min(salary) as _min FROM instructor GROUP BY dept_name) as I, 
(SELECT dept_name, max(salary) as _max FROM instructor GROUP BY dept_name) as J, 
(SELECT dept_name, avg(salary) as _avg FROM instructor GROUP BY dept_name) as K
WHERE I.dept_name = J.dept_name AND J.dept_name = K.dept_name	

3) SELECT name, tot_cred FROM student WHERE tot_cred > 30 AND tot_cred < 100 ORDER BY name

SELECT I.name, I.tot_cred
FROM (SELECT name, tot_cred FROM student WHERE tot_cred > 30) AS I INNER JOIN
(SELECT name, tot_cred FROM student WHERE tot_cred < 100) as J
WHERE I.name = J.name AND I.tot_cred = J.tot_cred
ORDER BY name

4)Select I.name, I.dept_name, D.building
FROM instructor as I, department as D
WHERE I.dept_name = D.dept_name
ORDER BY D.building

SELECT name, dept_name, (SELECT D.building FROM department as D where I.dept_name = D.dept_name) as building
FROM instructor as I
ORDER BY building

5)SELECT S.name, T.course_ID, T.grade
FROM student as S, takes as T
WHERE S.ID = T.ID
ORDER BY S.name

SELECT S.name, T.course_ID, T.grade
FROM (SELECT ID, course_ID, grade FROM takes as T) as T INNER JOIN student as S
ON S.ID = T.ID  
ORDER BY S.name 

6)SELECT name, salary
FROM instructor
WHERE salary = (SELECT salary FROM instructor ORDER BY salary DESC LIMIT 1 OFFSET 1)

SELECT name, salary
FROM instructor
WHERE name = (SELECT name FROM instructor ORDER BY salary DESC LIMIT 1 OFFSET 1)

7)UPDATE course SET credits = credits+1 WHERE course_ID IN
(SELECT N.course_id
FROM(SELECT C.course_id, S.semester, S.year
FROM course as C, Section as S
WHERE C.course_ID = S.course_ID
HAVING S.semester = 'Fall' AND S.year = '2010') as N)

8) DELETE FROM instructor WHERE name NOT IN
(SELECT DISTINCT TEMP.name
FROM (SELECT I.name FROM instructor as I, teaches as TE
WHERE I.ID = TE.ID )as TEMP)

PRoject 
1) SELECT subject, description, postuser, pdate 
FROM Blogs, Comments 
WHERE Blogs.blogid = Comments.blogid AND Blogs.postuser = 'user' AND Comments.sentiment = 'positive';
2) SELECT COUNT(postuser), postuser
FROM Blogs 
GROUP BY postuser  
ORDER BY `COUNT(postuser)`  DESC
LIMIT 1

3)SELECT T.leader FROM
(SELECT *
FROM Follows
WHERE Follows.follower = 'irottery4') as T, 
(SELECT * 
FROM Follows
WHERE Follows.follower = 'cheathorn9') as S
WHERE T.leader = S.leader

4)SELECT username 
FROM Users
WHERE username NOT IN (SELECT DISTINCT postuser
FROM Blogs)

5)SELECT username 
FROM Users as U 
WHERE U.username IN (Select DISTINCT author FROM Comments) 
AND U.username IN
(SELECT T.author 
FROM
(SELECT author, count(sentiment) as totalComments FROM Comments GROUP BY author) as T, 
(SELECT author, count(sentiment) as negativeComments FROM Comments WHERE sentiment = 'negative' GROUP BY author) as S
WHERE T.author = S.author and T.totalComments = S.negativeComments)

6)SELECT username 
FROM Users as U 
WHERE U.username IN (Select DISTINCT postuser FROM Blogs) 
AND username NOT IN
(SELECT *
FROM Blogs as B, Comments as C
WHERE B.blogid = C.blogid AND C.sentiment = 'negative')












