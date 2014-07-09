<?php
    //start the session
    session_start();
    
    //include user database connection details
    require_once(LIB_DIR . 'loginconnection.php');
    
    //array to store validation errors
    $errmsgArr = array();
    
    //validation error flag
    $errFlag = false;
    
    //get data from POST
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    //validate input
    if ($username == '') {
        $errmsgArr[] = 'Username missing';
        $errFlag = true;
    }
    if ($password == '') {
        $errmsgArr[] = 'Password missing';
        $errFlag = true;
    }
    
    //redirects back to login on missing information
    if ($errFlag) {
        $_SESSION['ERRMSG_ARR'] = $errmsgArr;
        session_write_close();
        header('location: /login/index.php');
        exit();
    }
    
    try {
        //look up entered username and password in users table using a prepared statement
        $stmt = $db->prepare('SELECT * FROM users WHERE userName = :userName AND userPW = :userPW');
        $stmt->bindValue(':userName', $username, PDO::PARAM_STR);
        $stmt->bindValue(':userPW', $password, PDO::PARAM_STR);
        $stmt->execute();
    
        //count number of rows in results
        $count = $stmt->rowCount();
        
        if($count > 0) {
            //login succesful!
            session_regenerate_id();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            $_SESSION['SESS_USER_ID'] = $user['userId'];
            $_SESSION['SESS_USER_PW'] = $user['userPW'];
            $_SESSION['SESS_USER_FIRST'] = $user['userFirst'];
            $_SESSION['SESS_USER_LAST'] = $user['userLast'];
            $_SESSION['SESS_USER_PROGRAM'] = $user['userProgram'];
            session_write_close();
            header('location: /dashboard/index.php');
            exit();
        } else {
            //Login failed
            $errmsgArr[] = 'Username and/or password not found';
            $errFlag = true;
            if ($errFlag) {
                $_SESSION['ERRMSG_ARR'] = $errmsgArr;
                session_write_close();
                header('location: /login/index.php');
                exit();
            }
        }
    } catch(PDOException $e) {
        echo $e->getMessage();
        die();
    }
?>