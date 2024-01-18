<?php 


include 'database.php';
$test = new Users();

if(isset($_POST['action']) && $_POST['action'] == 'sign'){
    $name = $_POST['S_name'];
    $gender = $_POST['gender'];
    $email = $_POST['S_email'];
    $password = $_POST['S_password'];
    $image = $_FILES['S_file']['name'];
    $image_tmp = $_FILES['S_file']['tmp_name'];
    $otp = $_POST['otp'];
    if(move_uploaded_file($image_tmp,"../images/".$image)){

        $test->addUser($name,$gender,$email,$password,$image,$otp);
    }else{
        echo "Sorry image is not insert";
    }
    
}

if(isset($_POST['action']) && $_POST['action'] == 'otp'){
    $v_otp = $_POST['V_otp'];
    $v_email = $_SESSION['email'];

    $test->checkOTP($v_email,$v_otp);
}

if(isset($_POST['action']) && $_POST['action'] == 'login'){
    $email = $_POST['L_email'];
    $password = $_POST['L_password'];

    $test->login($email,$password);
}

if(isset($_POST['action']) && $_POST['action'] == 'forgot'){
    $f_email = $_POST['Forgot_email'];

    $test->forgotemail($f_email);
}

if(isset($_POST['action']) && $_POST['action'] == 'cngPass'){
    $password = $_POST['Cng_password'];

    $test->ChangePass($password);
}

if(isset($_POST['action']) && $_POST['action'] == 'profile_cng'){
    $name = $_POST['W_name'];
    $password = $_POST['W_password'];
    $address = $_POST['W_address'];
    $bio = $_POST['W_bio'];
    $image = $_FILES['W_img']['name'];

    $test->profileCng($name,$password,$address,$bio,$image);
}

if(isset($_POST['action']) && $_POST['action'] == 'storyPost'){
    $img_name = $_FILES['Post_story']['name'];

    $test->postStory($img_name);
}

if(isset($_POST['action']) && $_POST['action'] == 'postfile'){
    $file_name = $_FILES['Post_file']['name'];

    $test->postFile($file_name);
}

if(isset($_POST['action']) && $_POST['action'] == 'fetchPost'){
    $test->fetchFile2();
}
if(isset($_POST['action']) && $_POST['action'] == 'loginUserPost'){
    $test->fetchloginUserDetail();
}

if(isset($_POST['action']) && $_POST['action'] == 'addFriend'){
    $selectFriend = $_POST['friendid'];
    $test->addFriend($selectFriend);
}

if(isset($_POST['action']) && $_POST['action'] == 'sendMessage'){
    $receiverid = $_POST['senderId'];
    $msgtext = $_POST['msgText'];

    $test->sendMessage($receiverid,$msgtext);
}

if(isset($_POST['action']) && $_POST['action'] == 'fetchMessage'){
    $receiverid = $_POST['receiver'];

    $test->getMessage($receiverid);
}

if(isset($_POST['action']) && $_POST['action'] == 'addLike'){
    $postid = $_POST['Postid'];

    $test->likebtn($postid);
}
if(isset($_POST['action']) && $_POST['action'] == 'getlike'){
    $postid = $_POST['postlike'];

    $newlike =  $test->fetchlikeUser($postid);
    echo $newlike;
}

if(isset($_POST['action']) && $_POST['action'] == 'commentMsg'){
    $post_id = $_POST['cpost_id'];
    $commentText = $_POST['commentTxt'];

    $test->commentSend($post_id,$commentText);
}

if(isset($_POST['action']) && $_POST['action'] == 'fetchComt'){
    $post_idCmt = $_POST['comtPost'];
    $test->fetchComment($post_idCmt);
}

if(isset($_POST['action']) && $_POST['action'] == 'countcomt'){
    $postid = $_POST['Postcmt'];

    $newpost =  $test->fetchCommentcount($postid);
    echo $newpost;
}


?>