$(document).ready(function () {

    $('#save').click(function (e) {
        var postID = $(this).attr("data-post-id");
        var postSubject = $("#post-subject").val();
        var skipImageCheck = $('#post-image-check-skip').prop('checked');
        var postImage = document.getElementById('post-image');
        var postContent = $("#post-content").val();

        if (validatePost(postID, "0", postSubject, postImage, skipImageCheck, postContent)) {
            var formData = new FormData();
            formData.append('postID', postID);
            formData.append('postSubject', postSubject);
            formData.append('postContent', postContent);
            formData.append('skipImageCheck', skipImageCheck);

            if (!skipImageCheck) {
                var fullFileName = postImage.files[0]['name'];
                var fileName = fullFileName.substr(0, (fullFileName.indexOf('.')));
                var fileExtension = fullFileName.substr((fullFileName.lastIndexOf('.') + 1));

                formData.append('SelectedFile', postImage.files[0]);
                formData.append('fileName', fileName);
                formData.append('fileExtension', fileExtension);
            }


            $.ajax({
                url: 'php/savePost.php',
                data: formData,
                contentType: false,
                processData: false,
                type: 'POST',
                success: function (response) {
                    console.log(response)
                    if (response == "true"){
                        location.reload();
                    } else {
                        $('#alert-heading').text("Error: Create Post");
                        $('#alert-messages').append("An error occurred while trying to create your post, " +
                            "please try again and if problem persists please contact tech support.");
                    }
                },
                error: function (response) {
                    alert(response);
                }
            });
        }
    });


    $('#enable').click(function (e) {
        var postID = $(this).attr('data-post-id');

        $('#confirmation-heading').text("Confirm: Enable");
        $('#confirmation-messages').text("Are you sure you want to enable this post?");
        $('#confirmation-button').html("<button class=\"btn btn-secondary btn-success\" type=\"button\" data-dismiss=\"modal\">Cancel</button>"
            +"<button class=\"btn btn-secondary btn-danger\" type=\"button\" data-post-id='"+postID+"' data-dismiss=\"modal\" id=\"confirm-enable\">Continue</button>");

    });

    $(document).on("click", "#confirm-enable", function(){
        var postID = $(this).attr('data-post-id');

        $('#alert-heading').text("Error: Validation");

        if (postID.length == 0) {
            $('#alert-messages').text("Oops! Something terrible happened and this post cannot be " +
                "updated, please contact tech support urgently.<br/>");
        } else {
            var formData = new FormData();
            formData.append('postID', postID);
            formData.append('updateType', "enable");
            $.ajax({
                url: 'php/updatePost.php',
                data: formData,
                contentType: false,
                processData: false,
                type: 'POST',
                success: function (response) {
                    console.log(response)
                    if (response == "true"){
                        location.reload();
                    } else {
                        $('#alert-heading').text("Error: Create Post");
                        $('#alert-messages').append("An error occurred while trying to update your post, " +
                            "please try again and if problem persists please contact tech support.");
                    }
                },
                error: function (response) {
                    alert(response);
                }
            });
        }
    });

    $('#disable').click(function (e) {
        var postID = $(this).attr('data-post-id');

        $('#confirmation-heading').text("Confirm: Disable");
        $('#confirmation-messages').text("Are you sure you want to disable this post?");
        $('#confirmation-button').html("<button class=\"btn btn-secondary btn-success\" type=\"button\" data-dismiss=\"modal\">Cancel</button>"
            +"<button class=\"btn btn-secondary btn-danger\" type=\"button\" data-post-id='"+postID+"' data-dismiss=\"modal\" id=\"confirm-disable\">Continue</button>");

    });

    $(document).on("click", "#confirm-disable", function(){
        var postID = $(this).attr('data-post-id');

        $('#alert-heading').text("Error: Validation");

        if (postID.length == 0) {
            $('#alert-messages').text("Oops! Something terrible happened and this post cannot be " +
                "updated, please contact tech support urgently.<br/>");
        } else {
            var formData = new FormData();
            formData.append('postID', postID);
            formData.append('updateType', "disable");
            $.ajax({
                url: 'php/updatePost.php',
                data: formData,
                contentType: false,
                processData: false,
                type: 'POST',
                success: function (response) {
                    console.log(response)
                    if (response == "true"){
                        location.reload();
                    } else {
                        $('#alert-heading').text("Error: Create Post");
                        $('#alert-messages').append("An error occurred while trying to update your post, " +
                            "please try again and if problem persists please contact tech support.");
                    }
                },
                error: function (response) {
                    alert(response);
                }
            });
        }
    });

    $('#delete').click(function (e) {
        var postID = $(this).attr('data-post-id');

        $('#confirmation-heading').text("Confirm: Delete");
        $('#confirmation-messages').text("Are you sure you want to delete this post? This action cannot be undone.");
        $('#confirmation-button').html("<button class=\"btn btn-secondary btn-success\" type=\"button\" data-dismiss=\"modal\">Cancel</button>"
            + "<button class=\"btn btn-secondary btn-danger\" type=\"button\" data-post-id='" + postID + "' data-dismiss=\"modal\" id=\"confirm-delete\">Continue</button>");
    });

    $(document).on("click", "#confirm-delete", function(){
        var postID = $(this).attr('data-post-id');

        $("#alert-messages").empty();
        $('#alert-heading').text("Error: Validation");

        if (postID.length == 0) {
            $('#alert-messages').text("Oops! Something terrible happened and this post cannot be " +
                "updated, please contact tech support urgently.<br/>");
        } else {
            var formData = new FormData();
            formData.append('postID', postID);
            formData.append('updateType', "delete");
            $.ajax({
                url: 'php/updatePost.php',
                data: formData,
                contentType: false,
                processData: false,
                type: 'POST',
                success: function (response) {
                    console.log(response)
                    if (response == "true"){
                        window.location.replace("posts.php");
                    } else {
                        $('#alert-heading').text("Error: Create Post");
                        $('#alert-messages').append("An error occurred while trying to create your post, " +
                            "please try again and if problem persists please contact tech support.");
                    }
                },
                error: function (response) {
                    alert(response);
                }
            });
        }
    });

    $('#create').click(function (e) {
        var postCompany = $("#post-company").val();
        var postSubject = $("#post-subject").val();
        var postImage = document.getElementById('post-image');
        var postContent = $("#post-content").val();

        if (validatePost(1, postCompany, postSubject, postImage, false, postContent)) {
            var formData = new FormData();
            var fullFileName = postImage.files[0]['name'];
            var fileName = fullFileName.substr(0, (fullFileName.indexOf('.')));
            var fileExtension = fullFileName.substr((fullFileName.lastIndexOf('.') + 1));

            formData.append('postCompany', postCompany);
            formData.append('postSubject', postSubject);
            formData.append('postContent', postContent);
            formData.append('SelectedFile', postImage.files[0]);
            formData.append('fileName', fileName);
            formData.append('fileExtension', fileExtension);


            $.ajax({
                url: 'php/createPost.php',
                data: formData,
                contentType: false,
                processData: false,
                type: 'POST',
                success: function (response) {
                    if (response == "true"){
                        window.location.replace("posts.php");
                    } else {
                        $('#alert-heading').text("Error: Create Post");
                        $('#alert-messages').append("An error occurred while trying to create your post, " +
                            "please try again and if problem persists please contact tech support.");
                    }
                }
            });

        }
    });

    function validatePost(postID, postCompany, postSubject, postImage, skipImageCheck, postContent) {
        var valid = true;

        $("#alert-messages").empty();
        $('#alert-heading').text("Error: Validation");

        if (postID.length == 0) {
            $('#alert-messages').text("Oops! Something terrible happened and this post cannot be " +
                "updated, please contact tech support urgently.<br/>");
            valid = false;
        } else {
            if (postCompany.length == 0) {
                $('#alert-messages').append("Please select company.<br/>");
                valid = false;
            }
            if (postSubject.length == 0) {
                $('#alert-messages').append("Please enter subject.<br/>");
                valid = false;
            }
            if (!skipImageCheck) {
                if (postImage.length == 0 || postImage.files.length == 0) {
                    $('#alert-messages').append("Please upload image.<br/>");
                    valid = false;
                }
            }
            if (postContent.length == 0) {
                $('#alert-messages').append("Please enter post content.<br/>");
                valid = false;
            }
        }


        return valid;
    }
});