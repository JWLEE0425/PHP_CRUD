<?php
session_start();
if(session_destroy())  //　ログアウトする時、sessionを終了.
{
    header("Location: login.php");  //　ログイン画面に戻る。
    
}
?>