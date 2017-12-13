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
