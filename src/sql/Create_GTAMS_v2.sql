/*
Austin Vo
4-12-2016
COP 4710 - Group 19 Project - Create Database.

Current Version: Create_GTAMS_v2
Previous Version: Create_GTAMS_v1

This script creates the initial GTAMS database.

REMEMBER TO CREATE A SCHEMA gtams BEFORE RUNNING THIS CODE!

I have note made any constraints or triggers for this database because
I don't know how much that will complicate things.
*/

USE gtams;

/*
Entity.

Contains a general info on a student applicant.
*/
CREATE TABLE IF NOT EXISTS gtams.APPLICANT (
	PID 			VARCHAR(50) 	NOT NULL
	,stu_first_name VARCHAR(50) 	NOT NULL
	,stu_last_name	VARCHAR(50) 	NOT NULL
	,stu_email 		VARCHAR(50)		NULL
	,stu_phone 		VARCHAR(12) 	NULL
	,PHD_CS 		BOOLEAN 		NOT NULL	DEFAULT FALSE
	,semesters_grad	INT 			NULL
	,SPEAK 			INT 			NULL
	,semesters_GTA 	INT 			NULL
	,GPA 			DECIMAL(1, 1)	NULL

	,CONSTRAINT PK_APPLICANT
		PRIMARY KEY (PID)
);

/*
Psuedo-Relationship between gtams.ADVISOR and gtams.APPLICANT
because gtams.ADVISOR does not exist.

I did not want to create a table to hold all possible advisors.

Contains a student applicant's current advisor.
Each student can only have 1 current advisor.
*/
CREATE TABLE IF NOT EXISTS gtams.CURRENT_ADV (
	PID 			VARCHAR(50)	NOT NULL
	,adv_first_name VARCHAR(50)	NOT NULL
	,adv_last_name	VARCHAR(50)	NOT NULL
	,adv_email 		VARCHAR(50)	NULL
    
    ,CONSTRAINT PK_CURRENT_ADV
		PRIMARY KEY (PID)
	,CONSTRAINT FK_CURRENT_ADV
		FOREIGN KEY (PID)
		REFERENCES gtams.APPLICANT(PID)
        ON UPDATE CASCADE
        ON DELETE CASCADE
);

/*
Psuedo-Relationship between gtams.ADVISOR and gtams.APPLICANT
because gtams.ADVISOR does not exist.

I did not want to create a table to hold all possible advisors.

Contains all of a student applicant's previous advisors that are not the current advisor.
Since a student will not know the faculty_id of their advisors and 
each student can have many previous advisors,
I made [adv_first_name] and [adv_last_name] part of this table's primary key.
*/
CREATE TABLE IF NOT EXISTS gtams.PREVIOUS_ADV (
	PID				VARCHAR(50)	NOT NULL
	,adv_first_name VARCHAR(50)	NOT NULL
	,adv_last_name	VARCHAR(50)	NOT NULL
	,adv_email 		VARCHAR(50)	NULL
    ,start_date 	DATE		NULL
    ,end_date		DATE		NULL
	
    ,CONSTRAINT PK_PREVIOUS_ADV
		PRIMARY KEY (PID, adv_first_name, adv_last_name)
	,CONSTRAINT FK_PREVIOUS_ADV
		FOREIGN KEY (PID)
		REFERENCES gtams.APPLICANT(PID)
        ON UPDATE CASCADE
        ON DELETE CASCADE
);

/*
Psuedo-Relationship between gtams.PUBLICATIONS and gtams.APPLICANT
because gtams.PUBLICATIONS does not exist.

I did not want to create a table to hold all possible publications.

Contains all of a student applicant's publications.
Since a student can have multiple publications,
I made [pub_title] and [pub_date]  part of this table's primary key.
[citations] are basically comments.
*/
CREATE TABLE IF NOT EXISTS gtams.PUBLISHED_PUB (
	PID 		VARCHAR(50)		NOT NULL
    ,pub_title	VARCHAR(100)	NOT NULL
	,pub_date 	DATE			NOT NULL
	,citations	VARCHAR(100)	NULL

	,CONSTRAINT PK_PUBLISHED_PUB
		PRIMARY KEY (PID, pub_title, pub_date)
	,CONSTRAINT FK_PUBLISHED_PUB
		FOREIGN KEY (PID)
		REFERENCES gtams.APPLICANT(PID)
        ON UPDATE CASCADE
        ON DELETE CASCADE
);

/*
Psuedo-Relationship between gtams.COURSES and gtams.APPLICANT
because gtams.COURSES does not exist.

I did not want to create a table to hold all possible courses.

Contains all of a student applicants completed courses and their grades.
Since a student can have multiple completed courses,
I made [course_id] part of this table's primary key.
[grade] will contain letter grades lik 'A', 'A+', 'B-', etc.
*/
CREATE TABLE IF NOT EXISTS gtams.COMPLETED_COURSES (
	PID 		VARCHAR(50)	NOT NULL
    ,course_id	VARCHAR(50)	NOT NULL
    ,grade		VARCHAR(2)	NULL

	,CONSTRAINT PK_COMPLETED_COURSES
		PRIMARY KEY (PID, course_id)
	,CONSTRAINT FK_COMPLETED_COURSES
		FOREIGN KEY (PID)
		REFERENCES gtams.APPLICANT(PID)
        ON UPDATE CASCADE
        ON DELETE CASCADE
);

/*
Entity.

Contains all info on the graduate committee.
If [gc_chair] == TRUE, then that persion is the Chair of the committee.
*/
CREATE TABLE IF NOT EXISTS gtams.GRADUATE_COMMITTEE (
	faculty_id 		VARCHAR(50)	NOT NULL
    ,gc_first_name	VARCHAR(50)	NOT NULL
    ,gc_last_name	VARCHAR(2)	NOT NULL
    ,gc_email		VARCHAR(50) NULL
    ,gc_chair 		BOOLEAN 	NOT NULL	DEFAULT FALSE

	,CONSTRAINT PK_GRADUATE_COMMITTEE
		PRIMARY KEY (faculty_id)
);

/*
Entity.

Contains all info on the GTA Sessions in which a student applies for and
is evaluated by the graduate committee to become a GTA.
[app_deadline] is the deadline when students can send in there GTA applications.
[letter_deadline] is the deadline when students must have there reference letters.
*/
CREATE TABLE IF NOT EXISTS gtams.GTA_SESSION (
	session_id			VARCHAR(50)	NOT NULL
    ,app_deadline		DATE		NOT NULL
    ,letter_deadline	DATE		NOT NULL

	,CONSTRAINT PK_GTA_SESSION
		PRIMARY KEY (session_id)
);

/*
Actual Relationship between gtams.GTA_SESSION and gtams.GRADUATE_COMMITTEE.

Contains a list of each session that a graduate committee member is a member of.
Since a session can have multiple committee members,
I made [faculty_id] a part of this table's primary key.
*/
CREATE TABLE IF NOT EXISTS gtams.MEMBER (
	session_id	VARCHAR(50)	NOT NULL
	,faculty_id	VARCHAR(50)	NOT NULL

	,CONSTRAINT PK_MEMBER
		PRIMARY KEY (session_id, faculty_id)
	,CONSTRAINT FK_MEMBER1
		FOREIGN KEY (session_id)
        REFERENCES gtams.GTA_SESSION(session_id)
        ON UPDATE CASCADE
        ON DELETE CASCADE
	,CONSTRAINT FK_MEMBER2
		FOREIGN KEY (faculty_id)
        REFERENCES gtams.GRADUATE_COMMITTEE(faculty_id)
        ON UPDATE CASCADE
        ON DELETE CASCADE
);

/*
Actual Relationship between gtams.GTA_SESSION and gtams.APPLICANT.

Contains info on each student applicant's application to a GTA session.
Since a student can apply to multiple GTA sessions,
I made [session_id] a part of this table's primary key.
*/
CREATE TABLE IF NOT EXISTS gtams.APPLICATION (
	session_id			VARCHAR(50)	NOT NULL
    ,PID				VARCHAR(50)	NOT NULL
    ,app_status 		VARCHAR(50) NULL
    ,past_deadline 		BOOLEAN 	NOT NULL	DEFAULT FALSE
    ,letter_received 	BOOLEAN 	NOT NULL	DEFAULT FALSE
    ,letter_received_ts	TIMESTAMP	NULL
    ,nominator_name 	VARCHAR(50)	NULL
    ,rank_from_nom 		INT 		NULL
    ,app_created_ts 	TIMESTAMP	NOT NULL

	,CONSTRAINT PK_APPLICATION
		PRIMARY KEY (session_id, PID)
	,CONSTRAINT FK_APPLICATION1
		FOREIGN KEY (session_id)
        REFERENCES gtams.GTA_SESSION(session_id)
        ON UPDATE CASCADE
        ON DELETE CASCADE
	,CONSTRAINT FK_APPLICATION2
		FOREIGN KEY (PID)
        REFERENCES gtams.APPLICANT(PID)
        ON UPDATE CASCADE
        ON DELETE CASCADE
);

/*
Actual Relationship between gtams.GTA_SESSION, gtams.APPLICATION, and gtams.MEMBER.

For each GTA session, all committee members in that session will score all the
student applications for that GTA session.
The primary key will match the above description.
*/
CREATE TABLE IF NOT EXISTS gtams.SCORES (
	session_id	VARCHAR(50)		NOT NULL
    ,PID		VARCHAR(50)		NOT NULL
    ,faculty_id	VARCHAR(50)		NOT NULL
    ,score		INT 			NOT NULL	DEFAULT 0
    ,comments	VARCHAR(100)	NULL
    
	,CONSTRAINT PK_SCORES
		PRIMARY KEY (session_id, PID, faculty_id)
	,CONSTRAINT FK_SCORES1
		FOREIGN KEY (session_id)
        REFERENCES gtams.GTA_SESSION(session_id)
        ON UPDATE CASCADE
        ON DELETE CASCADE
	,CONSTRAINT FK_SCORES2
		FOREIGN KEY (PID)
        REFERENCES gtams.APPLICATION(PID)
        ON UPDATE CASCADE
        ON DELETE CASCADE
	,CONSTRAINT FK_SCORES3
		FOREIGN KEY (faculty_id)
        REFERENCES gtams.MEMBER(faculty_id)
        ON UPDATE CASCADE
        ON DELETE CASCADE
);

/*
Entity.

Contains the administrators of the GTAMS database.
*/
CREATE TABLE IF NOT EXISTS gtams.ADMINISTRATORS (
	faculty_id			VARCHAR(50)	NOT NULL
    ,admin_first_name	VARCHAR(50)	NOT NULL
    ,admin_last_name	VARCHAR(50)	NOT NULL
    ,admin_email		VARCHAR(50)	NULL

	,CONSTRAINT PK_ADMINISTRATORS
		PRIMARY KEY (faculty_id)
);

/*
Entity.

Contains the login information for GTA administrators and graduate committee members.
The [faculty_id] of this table should contain the UNION of [faculty_id]
from both gtamas.ADMINISTRATORS and gtams.GRADUATE_COMMITTEE.
*/
CREATE TABLE IF NOT EXISTS gtams.LOGIN (
	faculty_id		VARCHAR(50)	NOT NULL
    ,login_email	VARCHAR(50)	NOT NULL
    ,login_password	VARCHAR(50)	NOT NULL

	,CONSTRAINT PK_LOGIN
		PRIMARY KEY (faculty_id)
);

/*
# MUST DROP THESE TABLES IN THIS EXACT ORDER!
DROP TABLE IF EXISTS gtams.CURRENT_ADV;
DROP TABLE IF EXISTS gtams.PREVIOUS_ADV;
DROP TABLE IF EXISTS gtams.PUBLISHED_PUB;
DROP TABLE IF EXISTS gtams.COMPLETED_COURSES;
DROP TABLE IF EXISTS gtams.SCORES;
DROP TABLE IF EXISTS gtams.MEMBER;

DROP TABLE IF EXISTS gtams.APPLICATION;
DROP TABLE IF EXISTS gtams.ADMINISTRATORS;
DROP TABLE IF EXISTS gtams.LOGIN;
DROP TABLE IF EXISTS gtams.GTA_SESSION;
DROP TABLE IF EXISTS gtams.APPLICANT;
DROP TABLE IF EXISTS gtams.GRADUATE_COMMITTEE;
*/