<?php
include_once 'all.php';
$postid = 1;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Simple PHP comment script</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>



        <div class="container" style="margin-top:200px;min-height:2000px">
            <h1>Test post title here</h1>
            <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</p><h3>Section 1.10.32 of "de Finibus Bonorum et Malorum", written by Cicero in 45 BC</h3><p>"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?"</p>
            <h3>1914 translation by H. Rackham</h3>
            <p>"But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?"</p>

            <p>More information: <a href="https://www.emrerothzerg.com/blog/simple-php-comment-script">https://www.emrerothzerg.com/blog/simple-php-comment-script</a></p>
            c
            <p>Download the script: <a href="https://github.com/emrerothzerg/simple-php-comment-script">https://github.com/emrerothzerg/simple-php-comment-script</a></p>

            <br><br><br>
            <h2>Write a comment</h2>

            <div class="comment-area">
                <input type="hidden" value="<?=$postid?>" id="postid"/>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="email">Email Address</label>
                        <input type="email" class="form-control" id="email">
                    </div>
                </div>
                <div class="form-group">
                    <label for="comment">Comment</label>
                    <textarea id="comment" class="form-control" rows="10"></textarea>
                </div>
                <div class="text-right">
                    <button type="button" class="btn btn-primary js-post-comment">Comment</button>
                </div>
            </div>



            <br><br><br>
            <h2>Comments</h2>

            <hr>
            <div id="comment-list">
                <?php
                    // list comments
                    $sql = $db->query("select * from comments where postid='$postid' order by `unixtime` desc");
                    while ($comment = mysqli_fetch_assoc($sql)) {
                        ?>
                        <div class="col-md-12 col-md-offset-0">
                            <p class="comment-sender">
                                <span><b><?=$comment['name']?></b></span>
                                -
                                <span class="text-muted"><?=date('d/m/Y', $comment['unixtime'])?></span>
                            </p>
                            <div class="comment">
                                <p><?=nl2br($comment['comment'])?></p>
                            </div>
                            <hr>
                        </div>
                    <?php
                }
                ?>
            </div>


        </div>



<style>
    .comment-sender{
        font-size:15px;
        color:#999
    }
</style>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script>
    $(document).ready(function(){
        $(".js-post-comment").click(function(){
            var data = {
                postid: parseInt($('#postid').val()) || 0, // if it's an invalid post id, set it 0
                name: $.trim($('#name').val()), //  get name and remove empty spaces at the end and begining of the value
                email: $.trim($('#email').val()), //  get email and remove empty spaces at the end and begining of the value
                comment: $.trim($('#comment').val()) //  get comment and remove empty spaces at the end and begining of the value
            }

            if(data.postid < 1){ // invalid post id
                alert("Invalid post ID. Your comment cannot be posted.");
                return false;
            }

            if(data.name.length < 1){ // if the name field is empty, show the error
                alert("Please enter your name.");
                $('#name').focus();
                return false;
            }

            if(data.email.length < 1){ // if the email field is empty, show the error
                alert("Please enter your email.");
                $('#email').focus();
                return false;
            }

            if(!/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(data.email)){ // check if it's a valid email address or not
                alert("Please enter a valid email.");
                $('#email').focus();
                return false;
            }

            if(data.comment.length < 1){ // if the comment field is empty, show the error
                alert("Please enter your comment.");
                $('#comment').focus();
                return false;
            }

            // all good! post the data
            $.post('./ajax.php',data, function(result){
                if(result.status === true){
                    // empty the fields
                    $('#name').val();
                    $('#email').val();
                    $('#comment').val();

                    // display the comment without refreshing the page
                    $('#comment-list').prepend('<div class="col-md-12 col-md-offset-0"> <p class="comment-sender"> <span><b>'+result.name+'</b></span> - <span class="text-muted">'+result.time+'</span> </p> <div class="comment"> <p>'+result.comment+'</p> </div> <hr> </div>');
                }else{
                    alert(result.error);
                }
            });

        });



    });
</script>
</body>
</html>
