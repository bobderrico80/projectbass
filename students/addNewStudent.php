<?php
	get_header();
?>
		<div id="contentWrapper" class="tableArea">
			<div id="content" class="tableRow">
				<div id="sidebar" class="tableCell">
					<?php get_sidebar();?>
				</div>
				<div id="main" class="tableCell">
					<h1>Add New Student</h1>
					<?php
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
						
						//If there were errors...
						if ($errFlag) {
							//Set error message to be displayed on the form
							?>
								<div class="formError">
									<h1>Student was unsuccessfully added due to the following error(s):</h1>
									<p><?php
										foreach ($errMsgs as $msg) {
											echo $msg . "<br>";
										}
									?></p>
								</div>
							<?php
						} else { //if there are no errors...
							//Get variables from POST
							$studentFirst = $_POST['studentFirst'];
							$studentLast = $_POST['studentLast'];
							$studentGradeID = $_POST['studentGradeID'];
							$studentHRID = $_POST['studentHRID'];
							$studentTeamID = $_POST['studentTeamID'];
							$studentParents = $_POST['studentParents'];
							$studentAddress = $_POST['studentAddress'];
							$studentCity = $_POST['studentCity'];
							$studentST = $_POST['studentST'];
							$studentZIP = $_POST['studentZIP'];
							$studentPhone1 = $_POST['studentPhone1'];
							$studentPhone2 = $_POST['studentPhone2'];
							$studentEmail1 = $_POST['studentEmail1'];
							$studentEmail2 = $_POST['studentEmail2'];
							
							//Prepare statement
							$userdb = $_SESSION['SESS_USER_DB'];
							if(!$stmt = mysqli_prepare($userdb, '
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
								VALUES ("active", ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?) 
							')) {
								die(mysqli_error($userdb));
							}
							
							//Bind parameters
							if(!mysqli_stmt_bind_param($stmt, 'ssiiisssssssss', $studentLast, $studentFirst, $studentGradeID, $studentHRID, $studentTeamID, $studentParents, $studentAddress, $studentCity, $studentST, $studentZIP, $studentPhone1, $studentPhone2, $studentEmail1, $studentEmail2)) {
								die(mysqli_error($userdb));
							}
							
							//Execute
							if(!mysqli_stmt_execute($stmt)) {
								die(mysqli_error($userdb));
							}
							
							//Display success message
							?>
								<?php echo mysqli_error($userdb); // display error message for debugging purposes ?>
								<div class="formSuccess">
									<h1>New student, <?php echo $studentFirst . ' ' . $studentLast; ?>, successfully added!</h1>
									<p><a href="index.php">View the student list</a>, or add another student below:</p>
								</div>
							<?php
						}
					
					}	
					?>
					<form name="addNewStudent" action="addNewStudent.php" method="post">
						<fieldset>
							<legend>Name</legend>
							<label for="studentFirst">First:</label><input type="text" name="studentFirst" autofocus="autofocus"/><span class="formError">*</span><br>
							<label for="studentLast">Last:</label><input type="text" name="studentLast"/><span class="formError">*</span>
						</fieldset>
						<fieldset>
							<legend>School Info</legend>
							<label for="studentGradeID">Grade:</label>
							<select name="studentGradeID">
								<?php
									get_list_contents('
										SELECT
											gradeID,
											gradeName
										FROM
											grades
										ORDER BY
											gradeName;
									');
								?>
							</select><br>
							<label for="studentHRID">Homeroom:</label>
							<select name="studentHRID">
								<?php
									get_list_contents('
										SELECT
											homeroomID,
											homeroomName
										FROM
											homerooms
										ORDER BY
											homeroomName
									');
								?>
							</select><br>
							<label for="studentTeamID">Team:</label>
							<select name="studentTeamID">
								<?php
									get_list_contents('
										SELECT
											teamID,
											teamName
										FROM
											teams
										ORDER BY
											teamName
									');
								?>
							</select><br>
						</fieldset>
						<fieldset>
							<legend>Contact Information</legend>
							<label for="studentParents">Parent(s):</label><input type="text" name="studentParents"/><br>
							<label for="studentAddress">Street Address:</label><input type="text" name="studentAddress"/><br>
							<label for="studentCity">City:</label><input type="text" name="studentCity"/><br>
							<label for="studentST">State:</label>
							<select name="studentST">
								<?php
									get_list_states();
								?>
							</select><br>
							<label for="studentZIP">ZIP:</label><input type="text" name="studentZIP" class="zip" placeholder="12345-6789" maxlength="10"/><br>
							<label for="studentPhone1">Phone 1:</label><input type="text" name="studentPhone1" class="phone" placeholder="123-456-7890" maxlength="12"/><br>
							<label for="studentPhone2">Phone 2:</label><input type="text" name="studentPhone2" class="phone" placeholder="123-456-7890" maxlength="12"/><br>
							<label for="studentEmail1">Email 1:</label><input type="text" name="studentEmail1"/><br>
							<label for="studentEmail2">Email 2:</label><input type="text" name="studentEmail2"/><br>
						</fieldset>
						<input type="submit" value="Add Student"/> <input type="reset" value="Clear Form"/>
					</form>
					<p><span class="formError">* - Required Fields</span></p>
				</div>
			</div>
		</div>
<?php //markup continues on footer.php ?>