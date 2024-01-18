$(document).ready(function(){

    // Password Show Toogle start
    $('.fa-eye').click(function(e){
        e.preventDefault();

        if($('#s_password').prop('type') === 'password'){
            $('#s_password').prop('type','text');
            $('.fa-eye').addClass('active');
           

        }else{
            $('#s_password').prop('type','password');
            $('.fa-eye').removeClass('active');
           


        }

        if($('#l_password').prop('type') === 'password'){
            $('#l_password').prop('type','text');
            $('.fa-eye').addClass('active');
           

        }else{
            $('#l_password').prop('type','password');
            $('.fa-eye').removeClass('active');
        }

      
    })


    $('.eye').click(function(e){
        e.preventDefault();

        if($('#cng_password').prop('type') === 'password'){
            $('#cng_password').prop('type','text');
            $('.eye').addClass('active2');
           

        }else{
            $('#cng_password').prop('type','password');
            $('.eye').removeClass('active2');
        }

      $('.eye2').click(function(e){
        e.preventDefault();
        if($('#cnf_password').prop('type') === 'password'){
            $('#cnf_password').prop('type','text');
            $('.eye2').addClass('active');
           

        }else{
            $('#cnf_password').prop('type','password');
            $('.eye2').removeClass('active');
        }
      })
    })
    // Password Show Toogle end


    function imageExt(img){
        let extension = ['png','jpeg','jpg'];

        let f_ext = img.split('.');
        let l_ext = f_ext.pop();

        let in_ext = extension.includes(l_ext);

        return in_ext;
    }
    // Set OTP Character to number start
    $('#v_otp').on('input',function(){
        let serilaize = $(this).val().replace(/[^0-9]/g,'');
        $(this).val(serilaize);
    })
    // Set OTP Character to number end

    //Signup data store in database start
    $('#s_submit').click(function(e){
        e.preventDefault();

        let name = $('#s_name').val();
        let email = $('#s_email').val();
        let password = $('#s_password').val();
        let image = $('#s_file').val();
        let email_regx = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        let otp_num = Math.floor(Math.random() * (99999 - 10000 + 1)) + 10000;
        $('#s_otp').val(otp_num);

        let newForm = new FormData($('#signForm')[0]);
        newForm.append('action','sign');
        


        if(name === '' || email === '' || password === '' || image === ''){
            $('.error').removeClass('d-none');
            $('.error').html('All Fields are Require..');
            setTimeout(function(){
                $('.error').addClass('d-none');
                
            },3000)
        }else if(name.length < 4){
            $('.error').removeClass('d-none');
            $('.error').html('Name must be 4 or more..');
            setTimeout(function(){
                $('.error').addClass('d-none');
                
            },3000)
        }else if(!email_regx.test(email)){
            $('.error').removeClass('d-none');
            $('.error').html('Enter Valid Email..');
            setTimeout(function(){
                $('.error').addClass('d-none');
                
            },3000)
        }else if( !imageExt(image)){
            $('.error').removeClass('d-none');
            $('.error').html('Image type will be PNG,JPEG,JPG..');
            setTimeout(function(){
                $('.error').addClass('d-none');
            },3000)
        }else{

            $.ajax({
                url:'action.php',
                type:'post',
                data:newForm,
                contentType:false,
                processData:false,
                beforeSend:function(){
                    $('.d-active').removeClass('d-none');
                    console.log('Processing');
                },
                success:function(res){
                    if(res === 'email exists'){
                        $('.error').removeClass('d-none');
                        $('.error').html('Email already Exists..');
                        setTimeout(function(){
                            $('.error').addClass('d-none');
                        },3000)
                    }else{
                        console.log(otp_num);
                        $('#signForm').trigger('reset');
                        window.location.href = '../pages/verify_email.php';
                        console.log(res);
                    }
                }
            })
        }
    })
    //Signup data store in database end


    // OTP verify start
    setTimeout(function(){
        $('.alert-success').addClass('d-none');
    },2500)
    $('#v_submit').click(function(e){
        e.preventDefault();

        let otp = $('#v_otp').val();
        let otpform = new FormData($('#otpForm')[0]);
        otpform.append('action','otp');

        if(otp === ''){
             $('.alert-success').addClass('d-none');

            $('.notice').removeClass('d-none');
            $('.notice').html('Enter OTP..');
            setTimeout(() => {
            $('.notice').addClass('d-none');
                
            }, 2000);
        }else{
            $.ajax({
                url:'action.php',
                type:'POST',
                data:otpform,
                contentType:false,
                processData:false,
                success:function(res){
                    if(res === 'right otp'){
                        $('.d-active').removeClass('d-none');
                        setTimeout(function(){
                            $('.d-active').addClass('d-none');
                            window.location.href = 'login.php';
                        },2500);
                        console.log('success');
                    }else{
                        $('.alert-success').addClass('d-none');

                        $('.notice').removeClass('d-none');
                        $('.notice').html('Invalid OTP..');
                        setTimeout(() => {
                            $('.notice').addClass('d-none');
                                
                            }, 2000);
                    }
                }
            })
        }
    })
    // OTP verify end
    

    //login 
    $('#l_submit').click(function(e){
        e.preventDefault();

        let email = $('#l_email').val();
        let password = $('#l_password').val();

        let loginForm = new FormData($('#loginForm')[0]);
        loginForm.append('action','login');

        if(email === '' || password === ''){
            $('.l_error').removeClass('d-none');
            $('.l_error').html('Enter All Details');
           setTimeout(function(){
            $('.l_error').addClass('d-none');

           },2500);
        }else{
            $.ajax({
                url:'action.php',
                type:'POST',
                data:loginForm,
                contentType:false,
                processData:false,
                success:function(res){
                  if(res === 'verify'){
                    $('.d-active').removeClass('d-none');
                    setTimeout(function(){
                        $('.d-active').addClass('d-none');
                        window.location.href = 'welcome.php';
                    },2500);
                  }
                  else if(res === 'not verify'){
                        $('.l_error').removeClass('d-none');
                        $('.l_error').html('Your Email is not Verified');
                       setTimeout(function(){
                        $('.l_error').addClass('d-none');
            
                       },2500);
                        console.log('verify failed');
                    }else{
                        $('.l_error').removeClass('d-none');
                        $('.l_error').html('Email and Password is not valid..');
                       setTimeout(function(){
                        $('.l_error').addClass('d-none');
            
                       },2500);
                    }
                }
            })
        }

    })

    //Forgot Password code start
    $('#forgot_submit').click(function(e){
        e.preventDefault();

        let email = $('#forgot_email').val();
        let forgotForm = new FormData($('#forgotForm')[0]);
        forgotForm.append('action','forgot');

        if(email === ''){
            $('.l_error').removeClass('d-none');
            $('.l_error').html('Please! Fill Email Box..');
            setTimeout(function(){
                $('.l_error').addClass('d-none');
            },2500);
        }else{
            $.ajax({
                url:'action.php',
                type:'POST',
                data:forgotForm,
                contentType:false,
                processData:false,
                beforeSend:function(){
                    $('.d-active').removeClass('d-none');
                 
                },
                success:function(res){
                    if(res === 'Find'){
                        $('.d-active').addClass('d-none');

                        $('.alert-success').removeClass('d-none');
                        $('.alert-success').html('Check Email! Change Password link has been sent.');
                        $('#forgotForm').trigger('reset');
                        setTimeout(function(){

                            $('.alert-success').addClass('d-none');
                        },4000)
                    }else{
                        $('.d-active').addClass('d-none');
                        $('.l_error').removeClass('d-none');
                        $('.l_error').html('Your Email is not Registered..');
                        setTimeout(function(){
                            $('.l_error').addClass('d-none');

                        },2500);
}
                }
            })
        }
    })
    //Forgot Password code end


    // Change Password code start
    $('#cng_submit').click(function(e){
        e.preventDefault();
        let password = $('#cng_password').val();
        let conf_password = $('#cnf_password').val();
        let cngeForm = new FormData($('#cng_passForm')[0]);
        cngeForm.append('action','cngPass');

        if(password === '' || conf_password === ''){
            $('.l_error').removeClass('d-none');
            $('.l_error').html('Fill All Details!.');
            setTimeout(function(){
                $('.l_error').addClass('d-none');
            },2500);
        }else if(password != conf_password){
            $('.l_error').removeClass('d-none');
            $('.l_error').html('Password are not Matched.');
            setTimeout(function(){
                $('.l_error').addClass('d-none');
            },2500);
        }else{
            $.ajax({
                url:'action.php',
                type:'POST',
                data:cngeForm,
                contentType:false,
                processData:false,
                success:function(res){
                    if(res === 'ChangePass'){
                        $('.d-active').removeClass('d-none');
                        setTimeout(function(){
                            $('.d-active').addClass('d-none');
                            $('.alert-success').removeClass('d-none');
                            $('.alert-success').html('Password has been Changed!.');
                            $('#cng_passForm').trigger('reset');
                            setTimeout(function(){
    
                                $('.alert-success').addClass('d-none');
                                window.location.href = 'welcome.php';
                            },2500);
                        },2500);
                    }else{
                        console.log('failed');
                    }
                }
            })
        }
    })
    // Change Password code end


    // Welcome.php code start
    $('#openfile').click(function(e){
        e.preventDefault();
        $('#showfile').click();
    });

    let currentImage = $('#currentImagePath').val();

    $('#previewImage').attr('src','../images/'+currentImage);
    $('#showfile').change(function(){
        let file = this.files[0];

        if(file){
            let reader = new FileReader();
            reader.onload = function(e){
                $('#previewImage').attr('src',e.target.result);
            }
            reader.readAsDataURL(file);
        }else{
            let currentImage = $('#currentImagePath').val();
            $('#previewImage').attr('src', '../images/' + currentImage);
        }

        // reader.readAsDataURL(file);
    })
    ;
    $('#w_submit').click(function(e){
        e.preventDefault();

        let profileForm = new FormData($('#profileForm')[0]);
        profileForm.append('action','profile_cng');
        let name = $('#w_name').val();

        if(name.length < 4){
            $('.l_error').removeClass('d-none');
            $('.l_error').html('Name Must be 4 letter or more...');
            setTimeout(function(){
                $('.l_error').addClass('d-none');
            },3000);
        }else {
            let fileInput = $('#showfile')[0];
            let currentImage = $('#currentImagePath').val();
    
            if (fileInput.files.length > 0) {
                // New image selected, update preview
                let file = fileInput.files[0];
                let reader = new FileReader();
                reader.onload = function (e) {
                    $('#previewImage').attr('src', e.target.result);
                };
                reader.readAsDataURL(file);
    
                // Append new image to the form data
                profileForm.append('W_img', file);
            } else {
                // No new image selected, keep the current image path
                profileForm.append('W_img', currentImage);
            }

            $.ajax({
                url:'action.php',
                type:'POST',
                data:profileForm,
                contentType:false,
                processData:false,
                success:function(res){
                    // try{
                        // let response = JSON.parse(res);
                        if(res === 'profile'){
                            $('.l_success').removeClass('d-none');
                            $('.l_success').html('Profile has Updated..');
                                setTimeout(function(){
                            $('.l_success').addClass('d-none');
                            
                            },3000);
                            let updatedImageSrc = $('#previewImage').attr('src');
                            $('.profile img').attr('src', updatedImageSrc);
                        }else{
                            console.log('not updated');
                            console.log(res);
                        }
                    // }catch(error){
                    //     console.error('Error parsing JOSN', error);
                    // }
                
                }
            })
        }

       
    })

    $('.sidebar .list-group-item a').click(function(e){
        e.preventDefault();
        $('.sidebar .list-group-item a').removeClass(' btn-primary');
        $(this).addClass(' btn-primary');
        $(this).find('i').addClass('text-white');
        $('.sidebar .list-group-item a').not(this).find('i').removeClass('text-white');
    })


    //Post Story features
    //Preview Select Images
    let input = $('#post_story');
    let modal = $('#storyModal');
    input.change(function(e){
        e.preventDefault();
        let fileObject = this.files[0];
        let fileReader = new FileReader();

        fileReader.readAsDataURL(fileObject);

        fileReader.onload = function(){
            let image_src = fileReader.result;
            let image = $('#story_img');
            image.attr('src',image_src);
            image.removeClass('d-none');
        };
    })
    let input2 = $('#post_file');
    let modal2 = $('#postModal');
    input2.change(function(e){
        e.preventDefault();
        let fileObject = this.files[0];
        let fileReader = new FileReader();

        fileReader.readAsDataURL(fileObject);

        fileReader.onload = function(){
            let image_src = fileReader.result;
            let image = $('#post_img');
            image.attr('src',image_src);
            image.removeClass('d-none');
        };
    })

    modal.on('hidden.bs.modal', function () {
        // Reset the value of the input field when the modal is closed
        input.val('');
        let image = $('#story_img');
        image.attr('src','');
        image.addClass('d-none');
        $('.story_success').addClass('d-none');


    });
    modal2.on('hidden.bs.modal', function () {
        // Reset the value of the input field when the modal is closed
        input2.val('');
        let image = $('#post_img');
        image.attr('src','');
        image.addClass('d-none');
        $('.story_success').addClass('d-none');


    });
    $('#storyPost_btn').click(function(e){
        e.preventDefault();
        // $('#post_story').click();

        let story_img = $('#post_story').val();
        let story_formData = new FormData($('#myStory_Form')[0]);
        story_formData.append('action','storyPost');
        if(story_img != ''){
            $.ajax({
                url:'action.php',
                type:'POST',
                data:story_formData,
                contentType:false,
                processData:false,
                success:function(res){
                    if(res === 'story add'){
                        $('.story_success').removeClass('d-none');
                        $('.story_success').html('Story Uploaded Successfully');
                        $('#myStory_Form').trigger('reset');
                        // $('#story_img').addClass('d-none');
                        fetchloadfile();
                        console.log('Story Added Succesfully');
                    }else{
                        console.log('Story Added Failed...');

                    }
                }

    
            })
        }
     
    })

function fetchloadfile(){
    $.ajax({
        url:'action.php',
        type:'POST',
        data:{action:'fetchPost'},
        success:function(res){
         
            $(res).hide();
            $('.viewPost-main').prepend(res);
            $(res).fadeIn('slow');
            console.log(res);
          
        }
    })
}

$('#liveToastBtn').click(function () {
    let toastElement = $('.toast');
   
    toastElement.addClass('show');

    var toast = new bootstrap.Toast(toastElement[0]);
    toast.show();

  });
// fetchloadfile();

    $('#filePost_btn').click(function(e){
        e.preventDefault();
        let post_file = $('#post_file').val();
        let postfile_FormData = new FormData($('#myPost_Form')[0]);
        postfile_FormData.append('action','postfile');
        let toastElement = $('.toast');

        if(post_file != ''){
            $.ajax({
                url:'action.php',
                type:'POST',
                data:postfile_FormData,
                contentType:false,
                processData:false,
                success:function(res){
                    if(res == 'post add'){
                        $('.post_d-active').removeClass('d-none');
                        setTimeout(function(){
                            $('.post_d-active').addClass('d-none');
                            $('#myPost_Form').trigger('reset');
                            fetchloadfile();
                            $('.modal').modal('hide');
                            toastElement.addClass('show');
                            $('.toast-body').html('✅ Post Added Successfully!.')

                            var toast = new bootstrap.Toast(toastElement[0]);
                            toast.show();
                            fetchloginPost();

                        
                            // Reset the 'show' class after the toast is hidden
                            // setTimeout(function () {
                            //   toastElement.removeClass('show');
                            // }, 3000); // Adjust the timeout based on how long you want the toast to be visible
                            

                        },3000);
                        console.log('Post Successfully aded');
                    }else{
                        console.log('Post failed');
                    }
                }
            })
        }
    })

    $('#messagebtn2').click(function(e){
        e.preventDefault();
        let messageIndex = 0;
        if(messageIndex === 0){
            $('.viewProfile-container').addClass('d-none');
            $('.story-container').addClass('d-none');
            $('.chatConversation-container').removeClass('d-none');
            messageIndex = 1; 
        }else{
            $('.viewProfile-container').removeClass('d-none');
            $('.story-container').removeClass('d-none');
            $('.chatConversation-container').addClass('d-none');
            messageIndex = 0; 
        }
    });
    $('#viewProfilebtn,#profilebtn').click(function(e){
        e.preventDefault();
        let viewIndex = 0;
        if(viewIndex === 0){
            $('.story-container').addClass('d-none');
            $('.chatConversation-container').addClass('d-none');

            $('.list-group-item a').removeClass('btn-primary');
            $('.list-group-item').find('i').removeClass('text-white');
            $('#profilebtn a').addClass('btn-primary');
            $('#profilebtn').find('i').addClass('text-white');
            $('.viewProfile-container').removeClass('d-none');
            viewIndex = 1;
        }else{
            $('.story-container').removeClass('d-none');
            $('.chatConversation-container').removeClass('d-none');

            $('.viewProfile-container').addClass('d-none');

            viewIndex = 0;
        }
    })
    $('#homebtn').click(function(e){
        e.preventDefault();
        let homeIndex = 0;
        if(homeIndex === 0){
            $('.viewProfile-container').addClass('d-none');
            $('.chatConversation-container').addClass('d-none'); 
            $('.story-container').removeClass('d-none');
            homeIndex = 1;
        }else{
            $('.story-container').addClass('d-none');
            $('.viewProfile-container').removeClass('d-none');
            $('.chatConversation-container').removeClass('d-none'); 

            homeIndex = 0;
        }
    })
fetchloginPost();

function fetchloginPost(){
    $.ajax({
        url:'action.php',
        type:'POST',
        data:{action:'loginUserPost'},
        success:function(res){
            $('.viewProfile-allPost').prepend(res);
        }
    })
}

    
    if($('.addFriendbtn').each(function(){
        let addbutton = $(this);

        if(addbutton.hasClass('beFriend')){
            addbutton.removeClass('btn-primary');
            addbutton.addClass('btn-secondary');
        }
    }))

    $('body').on('click','.addfriendbtn',(function(e){
        e.preventDefault();
        let addFriendForm = new FormData($(this).closest('form')[0]);
        addFriendForm.append('action','addFriend');
        let addButton = $(this);
        let friendId = addButton.data('friend-id');

        $.ajax({
            url:'action.php',
            type:'POST',
            data:addFriendForm,
            contentType:false,
            processData:false,
            success:function(res){
                if(res == 'add Friend'){
                    addButton.val('Friend');
                    addButton.removeClass('btn-primary');
                    addButton.addClass('btn-secondary');
                    addButton.addClass('beFriend');
                    $('.addfriendbtn[data-friend-id = "' + friendId + '"]').not(addButton).val('Friend').removeClass('btn-primary').addClass('btn-secondary');
                    console.log('Succesfully Friend added');
                }else{
                    console.log('Friend Failed');
                }
            }

        })
    }))


    // Click on Friend Chat
    $('body').on('click','.friend-detail',function(e){
        e.preventDefault();
        let FriendId = $(this).data('friend-id');
        let FriendName = $(this).find('p').text();
        let FriendImg = $(this).find('img').attr('src');
        console.log(FriendName);
        $('.chatDefault').addClass('d-none');
        $('.chating').removeClass('d-none');


        $('#FriendName2').text(FriendName);
        $('#clickFriendId').val(FriendId);
        $('#FriendImge').attr('src',FriendImg);
        fetchMessage();
        // $('#FriendImge2').attr('src',FriendImg);
    })


    //Send Message to database
    function fetchMessage(){
        let receiverId = $('#clickFriendId').val();
        $.ajax({
            url:'action.php',
            type:'POST',
            data:{action:'fetchMessage',receiver:receiverId},
            success:function(res){
                $('.chating-conversation').html(res);
            }
        })
    }
  

    $('#msgbtn').click(function(e){
        e.preventDefault();
        let msgBox = $('#msgtext').val();
        let msgForm = new FormData($('#sendMsgForm')[0]);
        msgForm.append('action','sendMessage');

        if(msgBox != ''){
            $.ajax({
                url:'action.php',
                type:'POST',
                data:msgForm,
                contentType:false,
                processData:false,
                success:function(res){
                    if(res == 'send'){
                        
                        fetchMessage();
                        $('#msgtext').val('');
                        console.log('Message Succesfully send');
                    }else{
                        console.log('Message Failed');
                        console.log(res);
                    }
                }
            })
        }
    })

    $('.like-btn2').click(function(e){
        
        e.preventDefault();
        let likebtn = $(this);
        let PostId = $(this).data('post-id');
        $.ajax({
            url:'action.php',
            type:'POST',
            data:{action:'addLike',Postid:PostId},
            success:function(res){
                if(res == 'liked'){
                     likebtn.addClass('text-primary');
                    // likebtn.remove();
                     likebtn.removeClass('like-btn2');
                     getlike(PostId,likebtn);
                }
                console.log(res);
            }
        })
    })

    $('.cmtbtn').click(function(e){
        e.preventDefault();
        let btnclick = $(this);
        // let commentBox =  $(this).find('.cmtText').val();
        let cid =  $(this).find('.cmtpost_id').val();
        let commentbox = $(this).closest('form').find('.cmtText').val();
        // let comtForm = new FormData($(this).closest('')[0]);
        let comtForm = $(this).data('comment-id2');
        // comtForm.append('action','commentMsg');

        if(commentbox != ''){
            $.ajax({
                url:'action.php',
                type:'POST',
                data:{action:'commentMsg',cpost_id:comtForm,commentTxt:commentbox},
                // contentType:false,
                // processData:false,
                success:function(res){
                    if(res == 'commentSent'){
                        $('.cmtText').val('');
                        getcommentcount(comtForm,btnclick);
                        fetchComment(comtForm);
                        console.log('comment Sent');
                    }else{
                        console.log(res);
                    }
                }
            })
        }
      
    })

    $('.comment-btn').click(function(e){
        e.preventDefault();
        let comtid = $(this).data('comment-id');
        fetchComment(comtid);
    })

    function fetchComment(cmtpst){
        // let cmtpst = $('#cmtpost_id').val();
        $.ajax({
            url:'action.php',
            type:'POST',
            data:{action:'fetchComt',comtPost:cmtpst},
            success:function(res){
                $('.comment-body').html(res);
                console.log(res);
            }
        })
    }
    function getlike(post_like,clickbtn){
        $.ajax({
            url:'action.php',
            type:'post',
            data:{action:'getlike',postlike:post_like},
            success:function(res){
                console.log(res);
                clickbtn.closest('.viewPost-container').find('.personliked').html('<span>' + res + ' Likes</span>');
            }
        })
    }

    function getcommentcount(post_cmt,clickbtn){
        $.ajax({
            url:'action.php',
            type:'post',
            data:{action:'countcomt',Postcmt:post_cmt},
            success:function(res){
                clickbtn.closest('.viewPost-container').find('.personcomment').html('<span>' + res + ' Comment</span>');
            }
        })
    }

   

});
