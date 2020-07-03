<?php
//共通変数・関数ファイルを読込み
require('functions.php');

debug('「「「「「「「「「「「「「「「「「「「「「「「');
debug('===退会===');
debug('「「「「「「「「「「「「「「「「「「「「「「「');
startDebugLog();

require('auth.php');

if(!empty($_POST)){
  debug('POST送信があります。');

  try {
    $dbh = dbConnect();

    $sql1 = 'UPDATE users SET delete_flg = 1 WHERE id = :us_id';
    // $sql2 = 'UPDATE post SET delete_flg = 1 WHERE user_id = :us_id';
    // $sql3 = 'UPDATE favorite SET delete_flg = 1 WHERE user_id = :us_id';

    $data = array(':us_id' => $_SESSION['user_id']);

    $stmt1 = queryPost($dbh, $sql1, $data);
    // $stmt2 = queryPost($dbh, $sql2, $data);
    // $stmt3 = queryPost($dbh, $sql3, $data);

    //usersテーブル削除
    if($stmt1){
      session_destroy();
      debug('セッション変数の中身：' .print_r($_SESSION, true));
      debug('TOPページへ遷移します。');
      header('Location:index.php');

    }else{
      debug('クエリ失敗です。');
      $err_msg['common'] = MSG07;
    }

    //postテーブル削除

    //favoriteテーブル削除


  } catch (Exception $e) {
    error_log('エラー発生！！：' .$e->getMessage());
    $err_msg['common'] = MSG07;
  }


}
?>
<?php
  $pageTitle = '退会';
  require('head.php');
?>
<body>
  <!-- ヘッダー -->
  <?php
    require('header.php');
  ?>


  <!-- メインコンテンツ -->
  <section class="container">
    <div class="section-title"><h2>退会</h2></div>

    <div class="section-contents">
      <form action="" method="POST" class="c-form">
        <input type="submit" value="退会する" class="" name='withdrawal'>
      </form>
    </div>
  </section>

  <!-- フッター -->
  <?php
    require('footer.php');  
  ?>