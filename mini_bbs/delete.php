<?php
session_start();
require('dbconnect.php');

if(isset($_SESSION['id'])){
    $id = $_REQUEST['id'];

    $messages = $db->prepare('SELECT * FROM posts WHERE id=?');
    $messages->execute(array($id));
    $message = $messages->fetch();
//＄postで投稿した本人（DBから取得してきたメンバーID）と今ログインしている人（sessionに入っているID）が等しい時だけ削除できる。
    if($message['member_id'] == $_SESSION['id']){
        $del = $db->prepare('DELETE FROM posts WHERE id=?');
        $del->execute(array($id));
    }
}

header('Location: index.php');
exit();
?>