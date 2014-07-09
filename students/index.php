<?php
    require_once(LOGIN_DIR . 'auth.php'); //checks if user is logged in
    get_header();
?>
<div id="contentWrapper" class="tableArea">
    <div id="content" class="tableRow">
        <div id="sidebar" class="tableCell">
            <?php get_sidebar();?>
        </div>
        <div id="main" class="tableCell">
            <?php 
                $sql = '
                    SELECT
                        students.studentID AS "ID",
                        students.studentStatus AS "Status",
                        students.studentLast AS "Last Name",
                        students.studentFirst AS "First Name",
                        grades.gradeName AS "Grade",
                        homerooms.homeroomName AS "HR",
                        teams.teamName AS "Team",
                        students.studentParents AS "Parent(s)",
                        students.studentAddress AS "Address",
                        students.studentCity AS "City",
                        students.studentST AS "ST",
                        students.studentZIP AS "ZIP",
                        students.studentPhone1 AS "Phone 1",
                        students.studentPhone2 AS "Phone 2",
                        students.studentEmail1 AS "Email 1",
                        students.studentEmail2 AS "Email 2"
                    FROM 
                        students
                    INNER JOIN
                        grades ON students.studentGradeID = grades.gradeID
                    INNER JOIN
                        homerooms ON students.studentHRID = homerooms.homeroomID
                    INNER JOIN
                        teams ON students.studentTeamID = teams.teamID
                    ORDER BY
                        students.studentLast
                ';
                display_table($sql,'students');
            ?>
        </div>
    </div>
</div>

<script>
    //row click event handler
    $("tr").click(function() {
        window.location.href="editStudent.php?context=edit&return=0&id=" + $(this).attr("id");
    });

</script>

<?php //markup continues on footer.php ?>