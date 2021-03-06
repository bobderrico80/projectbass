<?php
    require_once(LOGIN_DIR . 'auth.php'); //checks if user is logged in

    //checks to see if form has been submitted
    if ($_SERVER['REQUEST_METHOD']=='POST') {
    
        //Validate form
                        
        $errFlag = false;
                        
        //Check if first name is complete
        if (empty($_POST['studentFirst'])) {
            $errMsgs['studentFirstErr'] = "Student's first name is required.";
            $errFlag = true;
        }

        //Check if last name is complete
        if (empty($_POST['studentLast'])) {
            $errMsgs['studentLastErr'] = "Student's last name is required.";
            $errFlag = true;
        }
                        
        //If there were no errors...
        if (!$errFlag) { 
            
            //If context is 'edit'
            if ($_GET['context'] == 'edit') {
                
                //Get variables from POST
                $values = array (
                    ':studentLast'=>$_POST['studentLast'],
                    ':studentFirst'=>$_POST['studentFirst'],
                    ':studentGradeID'=>$_POST['studentGradeID'],
                    ':studentHRID'=>$_POST['studentHRID'],
                    ':studentTeamID'=>$_POST['studentTeamID'],
                    ':studentParents'=>$_POST['studentParents'],
                    ':studentAddress'=>$_POST['studentAddress'],
                    ':studentCity'=>$_POST['studentCity'],
                    ':studentST'=>$_POST['studentST'],
                    ':studentZIP'=>$_POST['studentZIP'],
                    ':studentPhone1'=>$_POST['studentPhone1'],
                    ':studentPhone2'=>$_POST['studentPhone2'],
                    ':studentEmail1'=>$_POST['studentEmail1'],
                    ':studentEmail2'=>$_POST['studentEmail2'],
                    ':studentID'=>$_POST['studentID']
                );
                
                //UPDATE existing student WHERE ID matches the hidden input element
                try {
                    $userdb = userConnect();
                    $stmt = $userdb->prepare ('
                        UPDATE students
                        SET
                            studentLast = :studentLast,
                            studentFirst = :studentFirst,
                            studentGradeID = :studentGradeID,
                            studentHRID = :studentHRID,
                            studentTeamID = :studentTeamID,
                            studentParents = :studentParents,
                            studentAddress = :studentAddress,
                            studentCity = :studentCity,
                            studentST = :studentST,
                            studentZIP = :studentZIP,
                            studentPhone1 = :studentPhone1,
                            studentPhone2 = :studentPhone2,
                            studentEmail1 = :studentEmail1,
                            studentEmail2 = :studentEmail2
                        WHERE studentID = :studentID
                    ');
                    $stmt->execute($values);
                } catch(PDOException $e) {
                    echo $e->getMessage();
                    die();
                }
            } else { //if context is 'add' or something else
            
                //Get variables from POST
                $values = array (
                    ':studentLast'=>$_POST['studentLast'],
                    ':studentFirst'=>$_POST['studentFirst'],
                    ':studentGradeID'=>$_POST['studentGradeID'],
                    ':studentHRID'=>$_POST['studentHRID'],
                    ':studentTeamID'=>$_POST['studentTeamID'],
                    ':studentParents'=>$_POST['studentParents'],
                    ':studentAddress'=>$_POST['studentAddress'],
                    ':studentCity'=>$_POST['studentCity'],
                    ':studentST'=>$_POST['studentST'],
                    ':studentZIP'=>$_POST['studentZIP'],
                    ':studentPhone1'=>$_POST['studentPhone1'],
                    ':studentPhone2'=>$_POST['studentPhone2'],
                    ':studentEmail1'=>$_POST['studentEmail1'],
                    ':studentEmail2'=>$_POST['studentEmail2'],
                );

                //INSERT as a new row into the students database
                try {
                    $userdb = userConnect();
                    $stmt = $userdb->prepare('
                        INSERT INTO
                            students (
                                studentStatus,
                                studentLast,
                                studentFirst,
                                studentGradeID,
                                studentHRID,
                                studentTeamID,
                                studentParents,
                                studentAddress,
                                studentCity,
                                studentST,
                                studentZIP,
                                studentPhone1,
                                studentPhone2,
                                studentEmail1,
                                studentEmail2
                            )
                        VALUES (
                            "active",
                            :studentLast,
                            :studentFirst,
                            :studentGradeID,
                            :studentHRID,
                            :studentTeamID,
                            :studentParents,
                            :studentAddress,
                            :studentCity,
                            :studentST,
                            :studentZIP,
                            :studentPhone1,
                            :studentPhone2,
                            :studentEmail1,
                            :studentEmail2
                        )
                    ');
                    $stmt->execute($values);
                } catch(PDOException $e) {
                    echo $e->getMessage();
                    die();
                }
            }
        }
        
        //redirects to students/index.php based on GET return value
        if ($_GET['return'] == 0) {
            header("Location: index.php");
        }
        
    }
    
    //Gets field values based on ID if context is edit
    if (($_GET['context'] == 'edit') && isset($_GET['id'])) {
        
        //SELECT from user table where student ID = ID value from GET
        try {
            $userdb = userConnect();
            $stmt = $userdb->prepare('SELECT * FROM students WHERE studentID = ?');
            $stmt->execute(array($_GET['id']));
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    
    //Page output begins here
    get_header();
?>
<div id="contentWrapper" class="tableArea">
    <div id="content" class="tableRow">
        <div id="sidebar" class="tableCell">
            <?php get_sidebar();?>
        </div>
        <div id="main" class="tableCell">
            <?php  
                if($_GET['context'] == 'add') {
                    echo '<h1>Add New Student</h1>';
                }
                
                if($_GET['context'] == 'edit') {
                    echo '<h1>Edit Student</h1>';
                }
            ?>
            
            <?php
                //Displays error message if there was an error from previous submission
                if ($_SERVER['REQUEST_METHOD']=='POST' && $errFlag) {
                    ?>
                        <div class="formError">
                            <h1>Student was unsuccessfully added due to the following error(s):</h1>
                            <p><?php
                                    foreach ($errMsgs as $msg) {
                                        echo $msg . "<br>";
                                    }
                                ?>
                            </p>
                        </div>
                    <?php
                }
                
                //Displays success message from previous submission
                if ($_SERVER['REQUEST_METHOD']=='POST' && !$errFlag) {
                    ?>
                        <div class="formSuccess">
                            <h1> New student, <?php echo $_POST['studentFirst'] . ' ' . $_POST['studentLast']; ?>, successfully added!</h1>
                            <p><a href="index.php">View the student list</a>, or add another student below:</p>
                        </div>
                    <?php
                }
                
                //determine form action based on context
                if ($_GET['context'] == 'edit') {
                    $action = 'editStudent.php?context=edit&return=0';
                } else {
                    $action = 'editStudent.php?context=add&return=1';
                }
            
            ?>
            <form id="editStudent" name="editStudent" action="<?php echo $action; ?>" method="post">
                <fieldset>
                    <legend>Name</legend>
                    <label for="studentFirst">First:</label><input type="text" name="studentFirst" id="studentFirst" value="<?php echo $result['studentFirst'];?>" autofocus="autofocus"/><span class="formError" id="firstWarning">Required</span><br>
                    <label for="studentLast">Last:</label><input type="text" name="studentLast" id="studentLast" value="<?php echo $result['studentLast'];?>"/><span class="formError" id="lastWarning">Required</span> 
                </fieldset>
                <fieldset>
                    <legend>School Info</legend>
                    <label for="studentGradeID">Grade:</label>
                    <select name="studentGradeID" id="studentGradeID">
                        <?php
                            get_list_contents('
                                SELECT
                                    gradeID,
                                    gradeName
                                FROM
                                    grades
                                ORDER BY
                                    gradeName;
                            ', $result['studentGradeID']);
                        ?>
                    </select><br>
                    <label for="studentHRID">Homeroom:</label>
                    <select name="studentHRID" id="studentHRID">
                        <?php
                            get_list_contents('
                                SELECT
                                    homeroomID,
                                    homeroomName
                                FROM
                                    homerooms
                                ORDER BY
                                    homeroomName
                            ', $result['studentHRID']);
                        ?>
                    </select><br>
                    <label for="studentTeamID">Team:</label>
                    <select name="studentTeamID" id="studentTeamID">
                        <?php
                            get_list_contents('
                                SELECT
                                    teamID,
                                    teamName
                                FROM
                                    teams
                                ORDER BY
                                    teamName
                            ', $result['studentTeamID']);
                        ?>
                    </select><br>
                </fieldset>
                <fieldset>
                    <legend>Contact Information</legend>
                    <label for="studentParents">Parent(s):</label><input type="text" id="studentParents" name="studentParents" value="<?php echo $result['studentParents'];?>"/><br>
                    <label for="studentAddress">Street Address:</label><input type="text" id="studentAddress" name="studentAddress" value="<?php echo $result['studentAddress'];?>"/><br>
                    <label for="studentCity">City:</label><input type="text" id="studentCity" name="studentCity" value="<?php echo $result['studentCity'];?>"/><br>
                    <label for="studentST">State:</label>
                    <select name="studentST" id="studentST">
                        <?php
                            get_list_states($result['studentST']);
                        ?>
                    </select><br>
                    <label for="studentZIP">ZIP:</label><input type="text" id="studentZIP" name="studentZIP" class="zip" placeholder="12345-6789" maxlength="10"  value="<?php echo $result['studentZIP'];?>"/><br>
                    <label for="studentPhone1">Phone 1:</label><input type="text" id="studentPhone1" name="studentPhone1" class="phone" placeholder="123-456-7890" maxlength="12" value="<?php echo $result['studentPhone1'];?>"/><br>
                    <label for="studentPhone2">Phone 2:</label><input type="text" id="studentPhone2" name="studentPhone2" class="phone" placeholder="123-456-7890" maxlength="12" value="<?php echo $result['studentPhone2'];?>"/><br>
                    <label for="studentEmail1">Email 1:</label><input type="text" id="studentEmail1" name="studentEmail1" value="<?php echo $result['studentEmail1'];?>"/><br>
                    <label for="studentEmail2">Email 2:</label><input type="text" id="studentEmail2" name="studentEmail2" value="<?php echo $result['studentEmail2'];?>"/><br>
                </fieldset>
                <?php
                    //sets text on submit button based on context
                    if($_GET['context'] == 'edit') {
                        $submitval = 'Save';
                    } else {
                        $submitval = 'Add Student';
                    }
                ?>
                <div class="buttonContainer">
                    <input type="submit" value="<?php echo $submitval ?>"/> <input type="button" value="Cancel" id="cancel"/>
                </div>
                <input type="hidden" name="studentID" value="<?php echo $_GET['id'];?>"/>
            </form>
            
            <?php
                //sets checkbox based on return mode GET value
                if (($_GET['return'] == '1') || !isset($_GET['return'])) {
                    $checked = 'checked';
                }
                
                //displays checkbox only on 'add' contet
                if (($_GET['context'] == 'add')) {
                
                ?>
            
                <div class="buttonContainer">
                    <input type="checkbox" id="returnMode" name="returnMode" <?php echo $checked;?>><label for="returnMode" class="cbLabel">Add another student after saving.</label>
                </div>
                <?php
                }
            ?>
        </div>
    </div>
</div>

<script>

    //function to validate required fields
    function validateField(fieldName, warningName) {
        if ($("#" + fieldName).val() === "") {
            $("#" + warningName).show();
        } else {
            $("#" + warningName).hide();
        }
    }
    
    //checks required fields on load
    validateField("studentFirst", "firstWarning");
    validateField("studentLast", "lastWarning");
    
    //checks required field on blur
    $("#studentFirst").blur(function(){validateField("studentFirst", "firstWarning");});
    $("#studentLast").blur(function(){validateField("studentLast", "lastWarning");});
    
    //event listener for cancel button
    $("#cancel").click(function (){
        window.location.href = "index.php";
    });
    
    //event listener for return mode checkbox
    $("#returnMode").click(function(){
        if ($(this).is(":checked")) {
            $("#editStudent").attr("action","editStudent.php?context=add&return=1");
        } else {
            $("#editStudent").attr("action","editStudent.php?context=add&return=0");
        }
    });
    
    //event listener for grade listbox
    $("#studentGradeID").change(function(){
        $.ajax({
            url : "/ajax/ajaxUpdateSelectOptions.php",
            data : { 
                column: "homeroomName",
                table: "homerooms",
                lookup: "homeroomGradeID",
                id : $(this).val()
            },
            type : "GET",
            success: function(response) {
                $("#studentHRID").html(response);
            }
        });
    });
    

</script>
<?php //markup continues on footer.php ?>