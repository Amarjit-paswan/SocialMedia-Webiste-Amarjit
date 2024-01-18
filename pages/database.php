<?php 
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../php mail/Exception.php';
require '../php mail/PHPMailer.php';
require '../php mail/SMTP.php';




class Users{
    private $database_conn = '';

    public function __construct()
    {
        $this->database_conn = new mysqli('localhost','root','','social_media');
    }

 

    public function addUser($name,$gender,$email,$password,$image_path,$otp){
        $check_email = "SELECT * FROM users WHERE user_email = '$email'";
        $result_check = $this->database_conn->query($check_email);

        if($result_check->num_rows > 0){
            echo "email exists";
        }else{
            function otpMail($m_name,$m_email,$m_otp){
                $mail = new PHPMailer(true);
            
                try{
                    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      
                    $mail->isSMTP();                                            //Send using SMTP
                    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                    $mail->Username   = 'amarjitp594@gmail.com';                     //SMTP username
                    $mail->Password   = 'qnqi dgyc edgw sgiz';                               //SMTP password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                    $mail->Port       = 465;   
                    
                    $mail->setFrom('amarjitp594@gmail.com', 'AJ_Media');
                    $mail->addAddress($m_email); 
            
                    $mail->isHTML(true);                                  //Set email format to HTML
                    $mail->Subject = 'Registration OTP Mail..';
                    $mail->Body    = "Hello $m_name Welcome to AJ_Media. This is your OTP <b> $m_otp </b>";
            
                    $mail->send();
                }catch(Exception $e){
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
            }
            
             otpMail($name,$email,$otp);

                $sql_add = "INSERT INTO users(user_name, gender, user_email, password, image_path,otp) VALUES ('$name','$gender','$email','$password','$image_path','$otp')";
                $result_add = $this->database_conn->query($sql_add);
        
                if($result_add){
                    echo "add";
                    $_SESSION['email'] = $email;
                  
                }else{
                    return false;
                    die();
                }
            
           
        }
       
    }

    public function checkOTP($email,$otp){
        $sql_otp = "SELECT * FROM users WHERE user_email = '$email'";
        $result_otp = $this->database_conn->query($sql_otp);

        if($result_otp->num_rows > 0){
            $row = $result_otp->fetch_assoc();

            if($row['otp'] == $otp){
                
                $sql_update = "UPDATE users SET otp = '', status = 'Active' WHERE user_email = '$email'";
                $result_update = $this->database_conn->query($sql_update);

                if($result_update){

                    echo "right otp";
                }else{
                    return false;
                    die();
                }
              

              
            }else{

                echo $this->database_conn->error;
                return false;
            }
        }
    }

    public function login($email,$password){
        $sql_login = "SELECT * FROM users WHERE user_email = '$email' AND password = '$password'";
        $result_login = $this->database_conn->query($sql_login);
        
        if($result_login->num_rows > 0){
            $row = $result_login->fetch_assoc();


            $_SESSION['id'] = $row['id'];
      

          
            $_SESSION['status'] = $row['status'];

            if($row['status'] === 'Active'){
                echo "verify";
              
            }else{
                echo "not verify";
                return false;
                die();
            }
        }
    }

    public function forgotemail($email){
        $sql_forgot = "SELECT * FROM users WHERE user_email = '$email'";
        $result_forgot = $this->database_conn->query($sql_forgot);

        if($result_forgot->num_rows > 0){
            
            function otpMail($m_email){
                $mail = new PHPMailer(true);
            
                try{
                    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      
                    $mail->isSMTP();                                            //Send using SMTP
                    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                    $mail->Username   = 'amarjitp594@gmail.com';                     //SMTP username
                    $mail->Password   = 'qnqi dgyc edgw sgiz';                               //SMTP password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                    $mail->Port       = 465;   
                    
                    $mail->setFrom('amarjitp594@gmail.com', 'AJ_Media');
                    $mail->addAddress($m_email); 
            
                    $mail->isHTML(true);                                  //Set email format to HTML
                    $mail->Subject = 'Registration OTP Mail..';
                    $mail->Body    = " Welcome to AJ_Media.<br>This is your Password Reset link below<br><a href = 'http://localhost/social media/pages/cng_pass.php'>Reset Password </a>";
            
                    $mail->send();
                }catch(Exception $e){
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
            }
            
             otpMail($email);
             echo "Find";

             $row = $result_forgot->fetch_assoc();

             $_SESSION['fgt_email'] = $row['user_email'];
        }else{
            return false;
            die();
        }
    }

    public function ChangePass($password){
        $fgt_email = $_SESSION['fgt_email'];
        $sql_cngPass = "UPDATE users SET password = '$password' WHERE user_email = '$fgt_email'";
        $result_cngPass = $this->database_conn->query($sql_cngPass);

        if($result_cngPass){
            echo "ChangePass";
        }else{
            echo $this->database_conn->error;
            return false;
            die();

        }
    }


    public function profileCng($name,$password,$address,$bio,$image){
        $login_id = $_SESSION['id'];
        if (isset($_FILES['W_img']) && $_FILES['W_img']['error'] == UPLOAD_ERR_OK) {
            $target_dir = "../images/";
            $target_file = $target_dir . basename($_FILES["W_img"]["name"]);
    
            // Move the uploaded file to the target directory
            if (move_uploaded_file($_FILES["W_img"]["tmp_name"], $target_file)) {
                $image_path = $_FILES["W_img"]["name"];
            } else {
                // Handle upload error if needed
                echo "Sorry, there was an error uploading your file.";
                return false;
            }
        } else {
            // No new image selected, keep the existing image path
            $existingUser = $this->fetchDetail($login_id);
            $image_path = $existingUser['image_path'];
        }
        $sql_pr_update = "UPDATE users SET user_name = '$name', password = '$password', address = '$address', bio = '$bio', image_path = '$image_path' WHERE id = '$login_id'";
        $result_pr_update = $this->database_conn->query($sql_pr_update);

        if($result_pr_update){
            // echo json_encode(['status' =>'success']);
            echo "profile";
        }else{
            echo $this->database_conn->error;
            return false;
            die();
        }

    }

    public function fetchDetail(){
        $rowname = $_SESSION['id'];
     $sql_fetch = "SELECT * FROM users WHERE id = '$rowname'";
     $result_fetch = $this->database_conn->query($sql_fetch);

     if($result_fetch){
        return $result_fetch->fetch_assoc();
     }else{
        return false;
     }
    }

    //Post story code start here
    public function postStory($image){
        $user_post_id =  $_SESSION['id'];
        $sql_fetch = "SELECT * FROM stories WHERE user_id = $user_post_id";
        $result_str_fetch = $this->database_conn->query($sql_fetch);

        if($result_str_fetch->num_rows == 1){
            $sql_udpate_stry = "UPDATE stories SET content = '$image' WHERE user_id = $user_post_id" ;
            $result_update_stry = $this->database_conn->query($sql_udpate_stry);

            if($result_update_stry){
                if(move_uploaded_file($_FILES['Post_story']['tmp_name'],"../images/story_img/".$image)){
    
                    echo "story add";
                }else{
                    echo "story failed";
                    return false;
                }
            }
        }else{
            $sql_story = "INSERT INTO stories (user_id,content) VALUES ($user_post_id,'$image')";
            $result_story = $this->database_conn->query($sql_story);
    
            if($result_story){
                if(move_uploaded_file($_FILES['Post_story']['tmp_name'],"../images/story_img/".$image)){
    
                    echo "story add";
                }else{
                    echo "story failed";
                    return false;
                }
            }else{
                echo $this->database_conn->error;
                return false;
                die();
            }
        }
       
    }
    //Post story code end here

    // Fetch My story
    public function fetchStory(){
        $user_post_id =  $_SESSION['id'];
        $sql_fetch_stry = "SELECT * FROM stories WHERE user_id = '$user_post_id' ";
        $result_fetch_stry = $this->database_conn->query($sql_fetch_stry);

        if($result_fetch_stry && $result_fetch_stry->num_rows > 0){
            return $result_fetch_stry->fetch_assoc();

        }else{
            return false;
            die();
        }
    }

    public function fetchfrndStory(){
        $user_post_id =  $_SESSION['id'];
        $sql_fetch_frndstry = "SELECT stories.content,users.user_name,users.image_path FROM stories JOIN users ON  stories.user_id = users.id JOIN friendship ON (users.id = friendship.friend_id AND friendship.login_id = $user_post_id) OR (users.id = friendship.login_id AND friendship.friend_id = $user_post_id) WHERE stories.story_id != '$user_post_id' ORDER BY stories.created_at DESC ";
        $result_fetch_frndstry = $this->database_conn->query($sql_fetch_frndstry);

        if($result_fetch_frndstry){
           return $result_fetch_frndstry->fetch_all(MYSQLI_ASSOC);
        }else{
            return false;
            die();
        }

    }

    public function postFile($file){
        $user_post_id =  $_SESSION['id'];
        $sql_postfile = "INSERT INTO posts (user_id,post_content) VALUES ($user_post_id,'$file')";
        $result_postfile = $this->database_conn->query($sql_postfile);

        if($result_postfile){
            if(move_uploaded_file($_FILES['Post_file']['tmp_name'],"../images/post_img/".$file)){
                echo "post add";
            }else{
                return false;
                die();
            }
        }else{
            return false;
            die();
        }

    }


    public function fetchFile(){
        $user_post_id =  $_SESSION['id'];
        $sql_fetchfile = "SELECT users.*, posts.*,post_likes.* FROM posts JOIN users ON posts.user_id = users.id LEFT JOIN friendship ON (users.id = friendship.friend_id AND friendship.login_id = $user_post_id) OR (users.id = friendship.login_id AND friendship.friend_id = $user_post_id) LEFT JOIN post_likes ON posts.post_id = post_likes.postlike_id  AND post_likes.loginuser_id = $user_post_id  WHERE (friendship.friendship_id IS NOT NULL OR posts.user_id = $user_post_id)  ORDER BY posts.post_date DESC";
        $result_fetchfile = $this->database_conn->query($sql_fetchfile);

        if($result_fetchfile && $result_fetchfile->num_rows > 0){
            return $result_fetchfile->fetch_all(MYSQLI_ASSOC);
        }else{
            return false;
            die();
        }
    }
    public function fetchFile2(){
        $user_post_id =  $_SESSION['id'];
        $sql_fetchfile = "SELECT users.*, posts.* FROM posts JOIN users ON posts.user_id = users.id LEFT JOIN friendship ON (users.id = friendship.friend_id AND friendship.login_id = $user_post_id) OR (users.id = friendship.login_id AND friendship.friend_id = $user_post_id) WHERE (friendship.friendship_id IS NOT NULL OR posts.user_id = $user_post_id)   IS NOT NULL ORDER BY posts.post_date DESC";
        $result_fetchfile = $this->database_conn->query($sql_fetchfile);

        $postsrc = '';
        if($result_fetchfile){
            $posts =  $result_fetchfile->fetch_assoc();

           

           
                $postsrc .= '<div class="col-12 viewPost-container rounded  p-3 bg-white shadow-lg my-4">
                <div class=" d-flex justify-content-between align-items-center w-100">
                        <div class="post_profile m-3 mt- d-flex ">
                            <img src="../images/'.$posts['image_path'].'"  class="rounded-circle" >
                            <div class="name-deail mt-2 ">
                                <h4 class="text-primary">'. $posts['user_name'].'</h4>
                                <div><i class="fa-solid fa-earth-americas"></i> Public </div>
                            </div>
                        </div>
                        <i class="fa-solid fa-ellipsis-vertical me-4 fs-1"></i>
                        
                    
                   
                </div>

                <div class="viewImg w-100 p-2">
                    <img src="../images/post_img/'.$posts['post_content'].'" alt="" srcset="" class="w-100 rounded ">
                    <div class="emoji-btn mt-3 ms-3 d-flex justify-content-between align-items-center">
                        <div class="like-btn d-flex ">
                            <i class="fa-solid fa-thumbs-up fs-1 me-3"></i>
                            <p class="fs-2 fw-bold">Like</p>
                        </div>
                        <div class="comment-btn d-flex text-secondary align-items-center justify-content-center  ">
                            <i class="fa-solid fa-comment fs-1 me-3 "></i>
                            <p class="fs-2 fw-bold">Comment</p>
                        </div>
                    </div>

                    <div class="comment-postbtn w-100 p-3  rounded">
                        <form action="" class="d-flex justify-content-between">
                            <input type="text" name="" id="" class="w-100" placeholder="Enter Comment......">
                            <input type="submit" value="Post Comment" class="ms-2 btn btn-primary ">
                        </form>
                        
                    </div>
                </div>
            </div>
            ';

            echo  $postsrc;
        }
            
     
    }

    public function fetchFriend(){
        $user_post_id =  $_SESSION['id'];
        $sql_fetchFriend = "SELECT users.id,users.user_name,users.image_path,friendship.friendship_id FROM users LEFT JOIN friendship ON(users.id = friendship.friend_id AND friendship.login_id = $user_post_id) OR (users.id = friendship.login_id AND friendship.friend_id = $user_post_id) WHERE id != $user_post_id";
        $result_fetchFriend = $this->database_conn->query($sql_fetchFriend);

        if($result_fetchFriend && $result_fetchFriend->num_rows > 0){
            return $result_fetchFriend->fetch_all(MYSQLI_ASSOC);
        }else{
            return false;
            die();
        }
    }

    public function fetchloginUserDetail(){
        $user_post_id =  $_SESSION['id'];
        $sql_loginUserDetail = "SELECT * FROM posts WHERE user_id = $user_post_id ORDER BY post_date DESC";
        $result_loginUserDetail = $this->database_conn->query($sql_loginUserDetail);

        $postImg = '';
        if($result_loginUserDetail){
            $loginUserDetail = $result_loginUserDetail->fetch_all(MYSQLI_ASSOC);
            foreach($loginUserDetail as $loginUserDetail){
                $postImg .= ' <img src="../images/post_img/'.$loginUserDetail['post_content'].'" alt="" srcset="">';

            }
            echo $postImg;
        }else{
            echo $this->database_conn->error;
        }
    }

    public function addFriend($friendSelct_id){
        $user_post_id =  $_SESSION['id'];
        $sql_addFriend = "INSERT INTO friendship (login_id,friend_id) VALUES ($user_post_id,$friendSelct_id)";
        $result_addFriend = $this->database_conn->query($sql_addFriend);

        if($result_addFriend){
            echo "add Friend";
        }else{
            return false;
            die();
        }
    }

    public function fetchMyFriend(){
        $user_post_id =  $_SESSION['id'];
        $sql_myFriend = "SELECT users.id,users.user_name,users.image_path FROM users JOIN friendship ON (users.id = friendship.friend_id AND friendship.login_id = $user_post_id) OR (users.id = friendship.login_id AND friendship.friend_id = $user_post_id) WHERE friendship.friendship_id IS NOT NULL";

        $result_myFriend = $this->database_conn->query($sql_myFriend);

        if($result_myFriend && $result_myFriend->num_rows > 0){
            return $result_myFriend->fetch_all(MYSQLI_ASSOC);
        }else{
            return false;
            die();
        }
    }

    public function sendMessage($receiverID,$msgText){
        $senderID =  $_SESSION['id'];
        $sql_sendMsg = "INSERT INTO messages (sender_id,receiver_id,message_content) VALUES($senderID,$receiverID,'$msgText')";
        $result_sendMsg = $this->database_conn->query($sql_sendMsg);

        if($result_sendMsg){
            echo "send";
        }else{
            echo $this->database_conn->error;
            return false;
            die();
        }
    }

    public function getMessage($receiverId){
        $senderID =  $_SESSION['id'];
        $sql_getMessge = "SELECT messages.*,users.image_path,users.id FROM messages INNER JOIN users ON messages.sender_id = users.id WHERE (sender_id = $senderID AND receiver_id = $receiverId) OR (sender_id = $receiverId AND receiver_id = $senderID) ORDER BY messages.messageCreated_at ASC ";
        $result_getMessage = $this->database_conn->query($sql_getMessge);

        $message = '';
        if($result_getMessage){
            while($msgRow = $result_getMessage->fetch_assoc()){
                if($msgRow['sender_id'] == $senderID){
                    $message .= ' <div class="chat-me-container  w-100 p-2 px-3">
                    <div class="chatingMe float-end d-flex ">
                        <div class="MyMsg  d-flex align-items-center p-1 px-3 ">
                            <p class="m-0 p-0">'. $msgRow['message_content'] .'</p>
                        </div>
                        <img src="../images/'. $msgRow['image_path'] .'"  class="rounded-circle">

                    </div>
                </div>';
                }else{
                    $message .= ' <div class="chat-friend-container w-100 p-2 px-3">
                    <div class="chatingFriend friendimg d-flex ">
                        <img src="../images/'. $msgRow['image_path'] .'" class="rounded-circle">
                        <div class="friendMsg d-flex align-items-center p-1 px-3 ">
                            <p class="m-0 p-0">'. $msgRow['message_content'] .'</p>
                        </div>
                    </div>
                </div>';
                }
            }
            echo $message;
        }
    }

    public function likebtn($postId){
        $login_id = $_SESSION['id'];

        $sql_check_like = "SELECT * FROM post_likes WHERE postlike_id = $postId AND loginuser_id = $login_id";
        $result_check_like = $this->database_conn->query($sql_check_like);
        if($result_check_like->num_rows > 0){
            die();
        }else{

        $sql_likebtn = "INSERT INTO post_likes (postlike_id,loginuser_id) VALUES ($postId,$login_id)";
        $reusult_likebtn = $this->database_conn->query($sql_likebtn);

        if($reusult_likebtn){
            echo "liked";
        }else{
            echo $this->database_conn->error;
            die();
        }
    }

    }

    public function fetchlikeUser($post_id){
        $sql_likeUser = "SELECT * FROM post_likes WHERE postlike_id = $post_id";
        $result_likeUser = $this->database_conn->query($sql_likeUser);

        $likecount = '';
        if($result_likeUser){
             $like =  $result_likeUser->num_rows;
           
             return $like;
        }else{
            return false;
            die();
        }
    }


    public function fetchCommentcount($post_id){
        $sql_commentcount = "SELECT * FROM comments WHERE cPost_id = $post_id";
        $result_commentcount = $this->database_conn->query($sql_commentcount);

        if($result_commentcount){
            $comment = $result_commentcount->num_rows;
            return $comment;
        }else{
            return false;
            die();
        }
    }


    public function commentSend($post_id,$commentText){
        $Cuser_id = $_SESSION['id'];
        $sql_commentsend = "INSERT INTO comments (cPost_id,cUser_id,comment_text) VALUES($post_id,$Cuser_id,'$commentText')";
        $result_commentsend = $this->database_conn->query($sql_commentsend);

        if($result_commentsend){
            echo 'commentSent';
        }else{
            echo $this->database_conn->error;
            die();
        }
    }

    public function fetchComment($postId){
        $Cuser_id = $_SESSION['id'];
        $sql_fetchComment = "SELECT users.id,users.user_name,users.image_path,comments.* FROM users JOIN comments ON users.id = comments.cUser_id WHERE comments.cPost_id = $postId ORDER BY comments.comment_date ASC ";
        $result_fetchComment = $this->database_conn->query($sql_fetchComment);

        $commentMsg = '';
        if($result_fetchComment){
            $comments = $result_fetchComment->fetch_all(MYSQLI_ASSOC);

            foreach($comments as $comment ){
                $commentMsg .= ' <div class="commentUser d-flex my-3 ">
                <img src="../images/'. $comment['image_path'] .'" class="rounded-circle" alt="" srcset="">
                <div class = "d-flex flex-column ">
                    <div class="cmtName p-2">
                        <p class="m-0 text-white">'. $comment['comment_text'] .'</p>
                    </div>
                        <h6>'. $comment['user_name'] .'</h6>
                </div>
            </div>';
            }

            echo $commentMsg;
        
        }else{
            echo $this->database_conn->error;
            die();
        }
    }

}

?>