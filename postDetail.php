<?php
//共通変数・関数ファイルを読込み
require('functions.php');

debug('「「「「「「「「「「「「「「「「「「「「「「「');
debug('===投稿詳細ページ===');
debug('「「「「「「「「「「「「「「「「「「「「「「「');
debugLogStart();


$p_id = (!empty($_GET['p_id'])) ? $_GET['p_id'] : '' ;
// $viewData = '';

// if(empty($viewData)){
//   error_log('エラー発生:指定ページに不正な値が入りました');
//   header("Location:index.php"); 
// }
// debug('取得したDBデータ：'.print_r($viewData,true));

if(!empty($_POST)){
  debug('POST送信があります。');

  //ログイン認証
  require('auth.php');

  try {
    $dbh = dbConnect();
    $sql = 'INSERT INTO favorite (post_id, user_id, create_date) VALUES (:p_id, :u_id, :create_date) ';
    $data = array(':post_id' => $p_id, ':user_id' => $_SESSION['user_id'], ':create_date' => date('Y:m:d H:i:s'));

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
          <form action="" method="post" class="c-form">
            <label class="c-form-label">
              タイトル
            <input type="text" name="username" value="<?php echo sanitize($viewData['post_title']); ?>" class="c-form-item">
            </label>

            <label class="c-form-label">
              
              <textarea name="" id="" cols="20" rows="15" class="c-form-item" placeholder="お気に入りのフレーズは？"></textarea>
            </label>

            <label class="c-form-label">
              曲名
              <input type="text" name="anthem" value="" class="c-form-item">
            </label>

            <label class="c-form-label">
              アーティスト
              <input type="text" name="anthem" value="" class="c-form-item" disabled>
            </label>

            
            <input type="submit" value="お気に入りに登録する" class="">
            
          </form>

          <div class="p-comment">
            <form action="" method="post" class="">
              <label class="p-comment-label">
                コメント
                <div class="msg-area">
                
                </div>
                <input type="text" name="comment" value="">
                <input type="submit" value="送信" class="">
                </label>
            </form>
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