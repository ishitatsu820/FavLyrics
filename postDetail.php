<?php
//共通変数・関数ファイルを読込み
require('functions.php');

debug('「「「「「「「「「「「「「「「「「「「「「「「');
debug('===投稿詳細ページ===');
debug('「「「「「「「「「「「「「「「「「「「「「「「');
startDebugLog();


$p_id = (!empty($_GET['p_id'])) ? $_GET['p_id'] : '' ;
$viewData = getPostOne($_GET['p_id']);
debug('取得レコードの中身：'.print_r($viewData, true));
$prev_page = $_GET['prev'];

if(empty($viewData)){
  error_log('エラー発生:指定ページに不正な値が入りました');
  if($prev_page === 'index'){
    header("Location:index.php"); 
  }else{
    header("Location:mypage.php"); 
  }
}
//セッションのuser_idとget送信のユーザーIDが等しいなら編集($fav_flg == false)
//それ以外はお気に入り登録($fav_flg == true)
//ただし、ログインしていない場合はログイン
debug('u_id：'.$_GET['u_id']);
if($_SESSION['user_id'] === $_GET['u_id']){
  $fav_flg = false;
}else{
  $fav_flg = true;
}


if(!empty($_POST['submit'])){
  debug('POST送信があります。');
  require('auth.php');
  if($fav_flg){
    //お気に入り登録
    try {
      $dbh = dbConnect();
      $sql = 'INSERT INTO favorite (post_id, user_id, create_date) VALUES (:p_id, :u_id, :create_date) ';
      $data = array(':p_id' => $p_id, ':u_id' => $_SESSION['user_id'], ':create_date' => date('Y:m:d H:i:s'));
  
      $stmt = queryPost($dbh, $sql, $data);
  
      if($stmt){
        debug('お気に入り登録完了しました。');
        $_SESSION['msg_success'] = SUC05;
        header("Location:mypage.php");
      }
  
    } catch (Exception $e) {
      error_log('エラー発生：'.$e->getMessage());
      $err_msg = MSG07;
    }

  }else{
    debug('編集画面に移動します。');
    header("Location:newPost.php?p_id=".$p_id);
  }


}else{
  debug('ポスト送信されていません。');
}



debug('処理終わり <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<');
?>
<?php
  $pageTitle = '投稿詳細';
  require('head.php');
?>
<body>
  <!-- ヘッダー -->
  <?php
    require('header.php');
  ?>

  <!-- メイン -->
  <div class="main">

    
    <!-- メインコンテンツ -->
    <div class="center">
      <section class="section">
        <div class="section-title"><h2>投稿詳細</h2></div>
        
        
        <div class="section-contents">
          <div class="p-view">
            <div class="p-view-title"><h3><?php echo sanitize($viewData['title']); ?></h3></div><span class="p-view-username"><a href=""><?php echo sanitize($viewData['username']); ?></a></span>
            <div class="p-view-lyrics">
              <?php
                if(!empty($viewData['lyrics'])){
                  $viewData['lyrics'] = sanitize($viewData['lyrics']);
                  $reserch = array("\r\n", '\r', '\n', '　');
                  $viewData['lyrics'] = str_replace($reserch, "<br/>", $viewData['lyrics']);
                  echo $viewData['lyrics'];
                }
              ?>
            </div>
            <div class="p-view-music_property"><?php echo sanitize($viewData['music_title']); ?><span class="artist">   By   <?php echo sanitize($viewData['artist']); ?></span></div>

          </div>
          <form action="" method="post" class="float_right c-form">
            <input type="submit" name="submit" value="<?php echo (!$fav_flg) ? '編集する': 'お気に入り登録'; ?>" class="">
          </form>

          <div class="p-comment overflow_hidden">
            <!-- <form action="" method="post" class="">
              <label class="p-comment-label">
                コメント
                <div class="msg-area">
                
                </div>
                <input type="text" name="comment" value="">
                <input type="submit" value="送信" class="">
                </label>
            </form> -->
            <div class="p-comment-list">
              <ul>
                <li><span class="comment-user">あああ</span>てててててててええええええええええええええええええええええええええ</li>
                <li><span class="comment-user">H</span>僕も好きです。</li>
                <li><span class="comment-user">名無し</span>いいねえ</li>
              </ul>
            </div>
          </div>
          
        </div>
        
      </section>
    </div>
    
    
    <!-- サイドバー -->
    <?php
      require('sidebar.php');
    ?>
    
    
  <!-- フッター -->
  <?php
    require('footer.php');
  ?>