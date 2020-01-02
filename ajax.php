<?php
include_once 'all.php';

header('Content-Type: application/json');

/*
PHP FUNCTIONS I USE
time: https://www.php.net/manual/en/function.time.php
intval: https://www.php.net/manual/en/function.intval.php
trim: https://www.php.net/manual/en/function.trim.php
htmlspecialchars: https://www.php.net/manual/en/function.htmlspecialchars.php
filter_var: https://www.php.net/manual/en/function.filter-var.php
nl2br: https://www.php.net/manual/en/function.nl2br.php
json_encode: https://www.php.net/manual/en/function.json-encode.php
 */

// Get POST data
$postid = intval($_POST['postid']); // convert the into integer
$name = htmlspecialchars(trim($_POST['name']));
$email = trim($_POST['email']);
$comment = htmlspecialchars(trim($_POST['comment']));
$commentime = time();

// php validations
if ($postid < 1) { // invalid post id
    echo json_encode(array("status" => false, "error" => "Invalid post ID. Your comment cannot be posted."));
    exit;
}
if (strlen($name) < 1) { // empty name
    echo json_encode(array("status" => false, "error" => "Please enter your name."));
    exit;
}
if (strlen($email) < 1 || !filter_var($email, FILTER_VALIDATE_EMAIL)) { // empty or invalid email address
    echo json_encode(array("status" => false, "error" => "Please enter a valid email."));
    exit;
}
if (strlen($comment) < 1) { // empty comment
    echo json_encode(array("status" => false, "error" => "Please enter your comment."));
    exit;
}

// insert comment into the databsae
$sql = $db->prepare('INSERT INTO comments (`postid`,`name`,`email`,`comment`,`unixtime`) VALUES(?, ?, ?, ?, ?)');
$sql->bind_param('isssi', $postid, $name, $email, $comment, $commentime);
$sql->execute();
$sql->close();

// return success message
echo json_encode(array("status" => true, "name" => $name, "comment" => nl2br($comment), "time" => date('d/m/Y', time())));
