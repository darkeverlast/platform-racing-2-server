<?php

header("Content-type: text/plain");

require_once '../fns/all_fns.php';

$friend_name = $_POST['target_name'];
$safe_friend_name = htmlspecialchars($friend_name);
$ip = get_ip();

try {
    
    // post check
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception("Invalid request method.");
    }
    
    // rate limiting
    rate_limit('friends-list-'.$ip, 3, 2);
    
    // connect
    $db = new DB();
    
    // check their login
    $user_id = token_login($db, false);
    
    // more rate limiting
    rate_limit('friends-list-'.$user_id, 3, 2);
    
    // get the new friend's id
    $friend_id = name_to_id($db, $friend_name);
    
    // create the magical one sided friendship
    $db->call('friends_insert', array($user_id, $friend_id));
    
    // tell it to the world
    echo "message=$safe_friend_name has been added to your friends list!";            
}

catch(Exception $e){
    $error = $e->getMessage();
    echo "error=$error";
}

?>
