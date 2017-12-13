DROP PROCEDURE `getSubjectsLessons`;
CREATE PROCEDURE `getSubjectsLessons`()
NOT DETERMINISTIC
READS SQL DATA
SQL SECURITY DEFINER
SELECT subjects.id, subjects.lvnr, subjects.title, subjects.groups_required, teachers.short, lessons.hours, lessons.group FROM subjects
  INNER JOIN lessons
    ON subjects.id = lessons.id_subjects
  INNER JOIN teachers
    ON lessons.id_teachers = teachers.id
      ORDER BY `subjects`.`lvnr` ASC


DROP PROCEDURE `insertTeacher`;
CREATE PROCEDURE `insertTeacher`(
  IN `f_name` CHAR(100),
  IN `l_name` CHAR(100),
  IN `short` CHAR(100)
)
    NOT DETERMINISTIC
    MODIFIES SQL DATA
    SQL SECURITY DEFINER
INSERT INTO `teachers` (`f_name`, `l_name`, `short`) VALUES (l_name, f_name, short);


DROP PROCEDURE `insertSubjects`;
CREATE PROCEDURE `insertSubjects`(
  IN `lvnr` CHAR(100),
  IN `title` CHAR(100),
  IN `groups_required` INT(11)
)
    NOT DETERMINISTIC
    MODIFIES SQL DATA
    SQL SECURITY DEFINER
INSERT INTO `subjects` (`lvnr`, `title`, `groups_required`) VALUES (lvnr, title, groups_required);


DROP PROCEDURE `insertLessons`;
CREATE PROCEDURE `insertLessons`(
  IN `id_teachers` INT(11),
  IN `hours` INT(11),
  IN `groups` CHAR(100),
  IN `id_subjects` INT(11)
)
    NOT DETERMINISTIC
    MODIFIES SQL DATA
    SQL SECURITY DEFINER
INSERT INTO `lessons` (`id_teachers`, `hours`, `group`, `id_subjects`) VALUES (id_teachers, hours, groups, id_subjects)
