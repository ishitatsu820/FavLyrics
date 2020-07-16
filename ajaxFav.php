<?php
//共通変数・関数ファイルを読込み
require('functions.php');

debug('「「「「「「「「「「「「「「「「「「「「「「「');
debug('===Ajax処理===');
debug('「「「「「「「「「「「「「「「「「「「「「「「');
startDebugLog();

// POSTがあり、ユーザー情報があり、ログインしている場合
if(isset($_POST['postId']) && isset($_SESSION['user_id']) && isLogin()){
  debug('POST送信があります。');
  $p_id = $_POST['postId'];

  debug('商品ID：'.$p_id);

  try {
    $dbh = dbConnect();
    $sql = 'SELECT * FROM favorite WHERE post_id = :p_id AND user_id = :u_id AND delete_flg = 0';
    $data = array(':p_id' => $p_id, ':u_id' => $_SESSION['user_id']);

    $stmt = queryPost($dbh, $sql, $data);
    $resultCount = $stmt->rowCount();
    debug($resultCount);

    //レコードが1件でもある場合
    if(!empty($resultCount)){
      $sql = 'DELETE FROM favorite WHERE post_id = :p_id AND user_id = :u_id';
      $data = array(':p_id' => $p_id, 'u_id' => $_SESSION['user_id']);
      $stmt = queryPost($dbh, $sql, $data);
      
    }else{
      //レコードが無い場合
      $sql = 'INSERT into favorite (post_id, user_id, create_date) values (:p_id, :u_id, :create_date)';
      $data = array(':p_id' => $p_id, ':u_id' => $_SESSION['user_id'], ':create_date' => date('Y:m:d H:i:s'));
      $stmt = queryPost($dbh, $sql, $data);
    }
    if($stmt){
      debug('かんりょう！！');
      $_SESSION['msg_success'] = SUC05;

    }else{
      debug('しっぱい！！');
    }

  
  } catch (Exception $e) {
    error_log('エラー発生：'. $e -> getMessage());
    $err_msg['common'] = MSG07;
  }

}
?>