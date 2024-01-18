<?php 
    require 'database.php';

    if(!isset($_SESSION['id'])){
        header("Location: login.php");
        die();

    }

    $users = new Users();
    $row = $users->fetchDetail();
    $fetch_stry = $users->fetchStory();
    $frnd_stories = $users->fetchfrndStory();
    $fetch_postfile = $users->fetchFile();
    $fetch_Friend = $users->fetchFriend();
    $fetch_Myfriend = $users->fetchMyFriend();
    // $fetch_comment = $users->fetchComment();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
        <!-- bootstrap cdn for css -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- footstrap cdn -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
        <!-- css link -->
        <link rel="stylesheet" href="../css/style.css?<?=time()?>">
</head>
<body>
    <!-- Change Profile -->
    <!-- Modal -->

            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header ">
                        <h5 class="modal-title " id="exampleModalLabel">Change Profile</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body cg_profile py-1">
                        <div class="alert alert-danger d-none l_error" role="alert"></div>
                        <div class="alert alert-success d-none l_success" role="alert"></div>
                        <form action="" id="profileForm" class="col-12 d-flex justify-content-around">

                            <div class="col-4 d-flex flex-column justify-content-center align-items-center border-end border-4">
                                <h4>Profile Picture</h4>
                                <img src="../images/<?php echo  $row['image_path']; ?>" alt="" srcset="" class="rounded-circle border border-primary p-2 shadow my-3 " id="previewImage" >
                                <button class="btn btn-primary" id="openfile">Change Photo</button>
                                <input type="file" name="W_img" id="showfile" class="d-none" >
                                <input type="hidden" id="currentImagePath" value="<?php echo $row['image_path']; ?>">
                            </div>

                            <div class="col-8 p-3">
                                <div class="mb-3 d-flex justify-content-between align-items-center">
                                    <label for="" class="form-label me-2 fw-bold">Name:</label>
                                    <input type="text" name="W_name" id="w_name" class="form-control border border-secondary w-75" value="<?php echo $row['user_name']; ?>">
                                </div>
                                
                                <div class="mb-3 d-flex justify-content-between align-items-center">
                                    <label for="" class="form-label me-2 fw-bold">Email:</label>
                                    <input type="email" name="W_email" id="w_email" class="form-control border border-secondary w-75" value="<?php echo $row['user_email']; ?>" readonly>
                                </div>
                                <div class="mb-3 d-flex justify-content-between align-items-center">
                                    <label for="" class="form-label me-2 fw-bold">Password:</label>
                                    <input type="text" name="W_password" id="w_password" class="form-control border border-secondary w-75" value="<?php echo $row['password']; ?>">
                                </div>
                                <div class="mb-3 d-flex justify-content-between align-items-center">
                                    <label for="" class="form-label me-2 fw-bold">Address:</label>
                                    <input type="text" name="W_address" id="w_address" class="form-control border border-secondary w-75" placeholder="Enter Your Address.." value="<?php echo $row['address']; ?>">
                                </div>
                                <div class="mb-3 d-flex justify-content-between align-items-center">
                                    <label for="" class="form-label me-2 fw-bold">Bio:</label>
                                    <textarea name="W_bio" id="w_bio" class="form-control border bio border-secondary w-75" placeholder="Type Something about Yourself.." ><?php echo $row['bio']; ?></textarea>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <input type="submit" name="W_submit" id="w_submit" value="Update" class="btn btn-primary"></input>
                    </div>
                </div>
                </div>
            </div>
           

    <div class="container-fluid ">
        
        <!-- Navbar code strat -->
        <div class="row fixed-top">
            
            <div class="navbar   bg-primary d-flex justify-content-center align-items-center">

                <div class="col-7 ms-5">
                    <h5 class="text-white fs-3">Aj_Media</h5>
                </div>

                <div class="col-4 profile d-flex justify-content-center align-items-center ">
                    <div class="search w-75  bg-white mx-3  ">
                        <input type="text" name="" id="" placeholder="Search Anything...">
                    </div>
                    <div class="dropdown ">
                        <a class=" dropdown-toggle text-white" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="../images/<?php echo  $row['image_path']; ?>"  alt="" srcset="" class="rounded-circle " >
                        </a>
                        <ul class="dropdown-menu " aria-labelledby="dropdownMenuButton1">
                          <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">Change Profile</a></li>
                          <li><a class="dropdown-item text-primary" href="logout.php">Logout</a></li>
                        </ul>
                      </div>
                    
                </div>
                
            </div>
          
        </div>
        <!-- Navbar code end -->



        <div class="row home  ">
            <!-- Sidebar Menu -->
            <div class="col-2 sidebox  p-0">
                <ul class="list-group  list-group-flush sidebar ">

                    <li class="list-group-item w-100  border-0" id="homebtn"><a href="" class="btn btn-primary w-100 text-start"><i class="fa-solid fa-house fs-4 me-2 text-primary text-white"></i>Home</a></li>
                    <li class="list-group-item border-0" ><a href="" class="btn w-100 text-start"><i class="fa-solid fa-video me-2 fs-4 text-primary"></i>Feed</a></li>
                    <li class="list-group-item border-0 " id="messagebtn2"><a href="" class="btn w-100 text-start"><i class="fa-solid fa-message me-2 fs-4 text-primary"></i>Message</a></li>
                    <li class="list-group-item " id="profilebtn"><a href="" class="btn w-100 text-start"><i class="fa-solid fa-user me-2 fs-4 text-primary"></i>Profile</a></li>
                
                </ul>
            </div>
            <!-- Sidebar Menu end -->

            <!-- View My Profile Start -->
            <div class="col-6 viewProfile-container d-none bg-white  shadow-lg p-3 m-3">
               <div class="viewProfile-detail d-flex align-items-center ">
                <img src="../images/<?php echo  $row['image_path']; ?>" class="rounded-circle border border-4 m-4 me-5 p-2 border-primary" alt="" srcset="">
                <div class="viewProfile-Name">
                    <h4 class="fs-1 m-0"><?php echo  $row['user_name']; ?></h4>
                    <p class="m-0"><?php echo  $row['bio']; ?></p>
                    <div class="viewProfile-allbtn   w-100 py-3">
                        <button class="btn btn-primary">Posts</button>
                        <button class="btn btn-primary">Posts</button>
                        <button class="btn btn-primary">Posts</button>
                    </div>
                </div>
               </div>

                <div class="fs-2 p-3 mt-0 pt-0   py-0 w-100 text-center d-flex justify-content-center"><p class="border-bottom border-primary fw-bold border-3 w-50">Uploaded Posts</p> </div>

               <div class="viewProfile-allPost">
                  
               </div>
            </div>
            <!-- View My Profile end -->

            <!-- Chat Messagin Conversation start -->
            <div class="col-6 chatConversation-container d-none bg-white pt-0 shadow-lg p-3">
                <p class="m-0">My Friends</p>
                <div class="all-friend d-flex  p-1">
                    <?php 
                        foreach($fetch_Myfriend as $activeFriend){

                    ?>
                    <div class="friend-detail text-center" data-friend-id = "<?php echo $activeFriend['id']; ?>">
                        <img src="../images/<?php echo $activeFriend['image_path'];  ?>" alt="" srcset="" class="rounded-circle border border-4 p-1 border-success">
                        <p><?php echo $activeFriend['user_name'];  ?></p>
                    </div>
                    <?php  } ?>
                  
                </div>
                <div class="chatDefault  d-flex flex-column text-center align-items-center justify-content-center">
                    <img src="../images/facebook chat.png" alt="" srcset="">
                    <div class="defaultDetail">
                        <h1>Welcome to AJ_Media Chating App</h1>
                        <p class="fs-3 text-secondary">Start Conversation with your friends</p>
                    </div>
                </div>
                <div class="chating d-none  ">
                    <div class="col-12 chatUser-detail p-2 bg-primary d-flex">
                        <div class="chatName d-flex  align-items-center">
                            <img src="../images/review_2.png" id="FriendImge" class="rounded-circle" alt="" srcset="">
                            <div class="d-flex flex-column text-start align-items-center ">
                                <h5 class="m-0" id="FriendName2">Amarjit</h5>
                                <p class="m-0 text-white text-start">🟢Active</p>
                            </div>
                        </div>
                    </div>
                    <div class="chating-conversation border pt-3 d-flex flex-column">
                        <!-- <div class="chat-friend-container w-100 p-2 px-3">
                            <div class="chatingFriend friendimg d-flex ">
                                <img src="../images/review_2.png" id="FriendImge2" class="rounded-circle">
                                <div class="friendMsg  p-1 px-3 ">
                                    <p class="m-0 p-0">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nihil tenetur magnam sint atque velit eum, placeat tempora vitae molestiae temporibus.</p>
                                </div>
                            </div>
                        </div> -->
                        <!-- <div class="chat-me-container  w-100 p-2 px-3">
                            <div class="chatingMe float-end d-flex ">
                                <div class="MyMsg   p-1 px-3 ">
                                    <p class="m-0 p-0">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nihil tenetur magnam sint atque velit eum, placeat tempora vitae molestiae temporibus.</p>
                                </div>
                                <img src="../images/review_2.png"  class="rounded-circle">

                            </div>
                        </div> -->
                        <!-- <div class="chat-friend-container w-100 p-2 px-3">
                            <div class="chatingFriend friendimg d-flex ">
                                <img src="../images/review_2.png" class="rounded-circle">
                                <div class="friendMsg  p-1 px-3 ">
                                    <p class="m-0 p-0">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nihil tenetur magnam sint atque velit eum, placeat tempora vitae molestiae temporibus.</p>
                                </div>
                            </div>
                        </div> -->
                    </div>
                    <div class="chating-sendbtn  border   d-flex p-1">
                        <div class="plusIcon bg-white d-flex justify-content-center align-items-center rounded-circle mt-1 ms-1">
                            <i class="fa-solid fa-plus fs-5"></i>
                        </div>
                        <div class="textMsg  bg-white px-2 d-flex  align-items-center ">
                            <form action="" id="sendMsgForm" class="d-flex  ">
                                <input type="hidden" name="senderId" id="clickFriendId" style="width: 20px; border:2px solid black;">
                            <input type="text" name="msgText" id="msgtext"  placeholder="Type Message.......">
                            <input type="submit" id="msgbtn" value="Send" class="btn btn-primary">
                            </form>
                        </div>
                    </div>
                    
                </div>
            </div>
            <!-- Chat Messagin Conversation end -->

            <!-- Story Container start -->
            <div class="col-6  p-3 story-container  m-3">
                <div class="col-12 story ">
                    

                    
                        <div class="story-box post-story">
                             <div class="overlay">
                                <img src="../images/<?php echo  $row['image_path']; ?>" class="" alt="" >
                            </div>
                            <div class="icon d-flex justify-content-center align-items-center flex-column">
                                <div class="icon-btn bg-primary d-flex justify-content-center align-items-center fs-3 rounded-circle border border-white border-2" id="post_btn" data-bs-toggle="modal" data-bs-target="#storyModal">

                                    <i class="fa-solid fa-plus text-white" ></i>
                                </div>
                                <p class="text-white">Post story</p>
                            </div>
                         
                      

                                <!-- Modal -->
                                <div class="modal fade" id="storyModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="alert alert-success d-none story_success" role="alert"></div>

                                            <img src="" alt="" class="w-100 h-50 d-none" id="story_img">
                                            <form action="" enctype="multipart/form-data" id="myStory_Form">
                                                <input type="file" name="Post_story" id="post_story"  accept="image/*">
                                            
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <input type="submit" class="btn btn-primary" value="Add Story" name="StoryPost_btn" id="storyPost_btn">
                                        </div>
                                        </form>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <?php 
                            if($fetch_stry){
                        ?>
                        <div class="story-box my-view-story">
                             <div class="overlay">
                                <img src="../images/story_img/<?php echo  $fetch_stry['content'] ?>" class="" alt="" >
                            </div>
                            <div class="icon d-flex flex-column">
                                <div class="icon-btn d-flex justify-content-center align-items-center fs-3 rounded-circle border border-primary border-5 ">
                                <img src="../images/<?php echo  $row['image_path']; ?>" class="" alt="" >
                                    
                                </div>
                            </div>
                            <p class="text-white fw-bold">My story</p>    
                        </div>
                        <?php }?>
                        <?php foreach($frnd_stories as $frnd_stry){

                         ?>
                        <div class="story-box frnd-view-story">
                             <div class="overlay">
                                <img src="../images/<?php echo  $frnd_stry['content']; ?>" class="" alt="" >
                            </div>
                            <div class="icon d-flex flex-column">
                                <div class="icon-btn d-flex justify-content-center align-items-center fs-3 rounded-circle border border-primary border-5 ">
                                <img src="../images/<?php echo  $frnd_stry['image_path']; ?>" class="" alt="" >
                                    
                                </div>
                            </div>
                            <p class="text-white fw-bold"><?php echo $frnd_stry['user_name']; ?></p>    
                        </div>
                   <?php } ?>

                   
                </div>

                <!-- Add Post Box start -->
                 <!-- Modal -->
                    <div class="modal fade" id="postModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                <form action="" enctype="multipart/form-data" id="myPost_Form">
                                    <div class="modal-body">
                                            <div class="alert alert-success d-none story_success" role="alert">
                                                
                                            </div>
                                            <div class="post_d-active d-none mb-3 d-flex justify-content-center ">
                                                <button class="btn btn-primary" type="button" disabled>
                                                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                                    Loading...
                                                </button>
                                            </div>   

                                            <img src="" alt="" class="w-100 h-50 d-none" id="post_img">
                                        
                                            <input type="file" name="Post_file" id="post_file"  accept="image/*">
                                                
                                        </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <input type="submit" class="btn btn-primary" value="Add Post" name="filePost_btn" id="filePost_btn">
                                            </div>
                                        </div>
                                </form>
                        </div>
                    </div>
                <div class="col-12 post-container my-4  border rounded  d-flex align-items-center shadow-lg  bg-white p-3 pe-5">
                    <div class=" d-flex justify-content-between w-100">
                        <div class="post_profile m-3 mt-4 d-flex ">
                            <img src="../images/<?php echo  $row['image_path']; ?>" alt="" srcset="" class="rounded-circle" >
                            <div class="name-deail mt-1 ">
                                <h3 class="text-primary"><?php echo  $row['user_name']; ?></h3>
                                <div><i class="fa-solid fa-earth-americas"></i> Public </div>
                            </div>
                        </div>
                        
                        <div class="buttonClick d-flex align-items-center  ">

                            <button type="button" class="btn btn-primary mt-2"data-bs-toggle="modal" data-bs-target="#postModal" >Add Post</button>
                        </div>
                    </div>
                </div>
                <!-- Add Post Box end -->

                <div class="position-fixed end-0 top-1 w-50  p-3" style="z-index: 11">
                <div id="liveToast" class="toast " role="alert" aria-live="assertive" aria-atomic="true">

                    <div class="toast-body bg-success text-white  ">
                    ✅ Hello, world! This is a toast message.
                    </div>
                </div>
                </div>
                <!-- View Post Box start -->
                <div class="viewPost-main">


   <!-- Modal -->
                        <div class="modal fade" id="CommentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Posts Comment</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body comment-body">
                                
                                <!-- <div class="commentUser d-flex ">
                                    <img src="../images/review_2.png" class="rounded-circle" alt="" srcset="">
                                    <div class="cmtName p-2 ">
                                        <p class="m-0 text-white">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut, quod.</p>
                                        <h6>Amarjit</h6>
                                    </div>
                                </div> -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                            </div>
                        </div>
                        </div>
            
                    <?php if($fetch_postfile){ foreach($fetch_postfile as $post){
                        $fetch_likebtn = $users->fetchlikeUser($post['post_id']);
                        $fetch_commentcount = $users->fetchCommentcount($post['post_id']);

                    ?>
                    <div class="col-12 viewPost-container rounded  p-3 bg-white shadow-lg my-4">
                        <div class=" d-flex justify-content-between align-items-center w-100">
                            <div class="post_profile m-3 mt- d-flex ">
                                <img src="../images/<?php echo $post['image_path'] ?>"  class="rounded-circle" >
                                <div class="name-deail mt-2 ">
                                    <h4 class="text-primary"><?php echo $post['user_name'] ?></h4>
                                    <div><i class="fa-solid fa-earth-americas"></i> Public </div>
                                </div>
                            </div>
                            
                            <i class="fa-solid fa-ellipsis-vertical me-4 fs-1"></i>
                        </div>  
                    
                   
                

                

                        <div class="viewImg w-100 p-2">
                            <img src="../images/post_img/<?php echo $post['post_content']; ?>" alt="" srcset="" class="w-100 rounded ">
                            <div class="emoji-btn mt-3 ms-3 d-flex justify-content-between align-items-center">
                            <?php 
                                    if($post['postlike_id'] !== null){
                                        echo '                    <div class=" d-flex " >
                               
                                        <i class="fa-solid fa-thumbs-up text-primary fs-1 me-3"></i>
                                        <p class="fs-2 fw-bold text-primary">Like</p>
                                    </div>';
                                    }else{
                                        echo '<div class="like-btn like-btn2 d-flex" data-post-id="' . $post['post_id'] . '">

                               
                                        <i class="fa-solid fa-thumbs-up  fs-1 me-3"></i>
                                        <p class="fs-2 fw-bold">Like</p>
                                    </div>';
                                    }
                                ?>
            
                                <div class="comment-btn d-flex text-secondary align-items-center justify-content-center" data-comment-id = "<?php echo $post['post_id']; ?>" data-bs-toggle="modal" data-bs-target="#CommentModal">
                                    <i class="fa-solid fa-comment fs-1 me-3 "></i>
                                    <p class="fs-2 fw-bold">Comment</p>
                                </div>
                            </div>
                            <div class="count d-flex">
                                <p  class="personliked fs-4 ms-3">
                                <?php echo $fetch_likebtn." Likes"; ?> 
                                </p>
                                <p  class="personcomment fs-4 ms-3">
                                <?php echo $fetch_commentcount.  " Comment"; ?> 
                                </p>
                            </div>
                           
                            <div class="comment-postbtn w-100 p-3  rounded">
                                <form action="" autocomplete="off" class=" ComtForm d-flex justify-content-between">
                                    <input type="text" name="commentTxt" class="cmtText w-100"  placeholder="Enter Comment......">
                                    <input type="hidden" name="cpost_id" class="cmtpost_id" value="<?php echo $post['post_id'];  ?>" >
                                    <input type="submit"  value="Post Comment" class="ms-2 btn btn-primary cmtbtn " data-comment-id2="<?php echo $post['post_id']; ?>">

                                </form>
                                
                            </div>
                        </div>
                    </div>
                    <?php } }?>

                </div>
               
                <!-- View Post Box end -->

            </div>
            <!-- Story Container end -->

            <!-- Friend Details container Start -->
            <div class="col-3 p-2  bg-white shadow-lg friend-container ">
                
                <div class="col-12 d-flex justify-content-between w-100">
                        <div class="post_profile m-3 mx-2 d-flex ">
                            <img src="../images/<?php echo  $row['image_path']; ?>" alt="" srcset="" class="rounded-circle" >
                            <div class="name-deail mt-1 ">
                                <h4 class="text-primary "><?php echo  $row['user_name']; ?></h4>
                                <div><i class="fa-solid fa-earth-americas"></i> Public </div>
                            </div>
                        </div>
                        
                        <div class="buttonClick d-flex me-3 align-items-center" id="viewProfilebtn">

                            <button type="button" class="btn btn-primary mt-2">View Profile</button>
                        </div>
                    
                </div>

                <div class="col-12 px-2 py-3 w-100   ">
                    <p class="text-secondary fs-5 ">You Can Add Friend</p>
                </div>

                <div class=" col-12 myFriend-container">
                    <?php 

                    foreach($fetch_Friend as $friends){

                    ?>
                    <form action="" id="friendRequest">
                        <div class="friendBox d-flex align-items-center mb-4 justify-content-between">
                            <div class="friendDetail ms-3 d-flex">
                                <img src="../images/<?php echo $friends['image_path'];  ?>" alt="" class="rounded-circle">
                                <div class="friendName ms-2">
                                    <h5 class="m-0"><?php echo $friends['user_name'];  ?></h5>
                                    <div class="text-secondary"><i class="fa-solid fa-earth-americas text-secondary"></i> Public </div>
                                </div>
                                <input type="hidden" name="friendid" id="" value="<?php echo $friends['id'];  ?>">
                            </div>
                                <?php 
                                    if($friends['friendship_id'] !== null){
                                        echo "<input type = 'submit' class = 'btn btn-secondary me-4' value ='Friend'>";
                                    }else{
                                        echo " <input type='submit' class='btn btn-primary addfriendbtn me-4'  value='Add Friend'/>";
                                    }
                                ?>
                               
                        </div>
                    </form>
                    <?php } ?>
                   
                </div>
            </div>
            <!-- Friend Details container end -->
            
          

        </div>

    </div>



     <!-- jquery cdn -->
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
     <script src="../js/javascript.js?v=<?=time()?>"></script>
  
</body>
</html>