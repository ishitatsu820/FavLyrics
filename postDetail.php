<?php
//共通変数・関数ファイルを読込み
require('functions.php');

debug('「「「「「「「「「「「「「「「「「「「「「「「');
debug('===投稿詳細ページ===');
debug('「「「「「「「「「「「「「「「「「「「「「「「');
startDebugLog();

//viewデータの取得
$p_id = (!empty($_GET['p_id'])) ? $_GET['p_id'] : '' ;
$viewData = getPostOne($p_id);
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
  $edit_flg = true;
}else{
  $edit_flg = false;
}

//コメントの取得
$commentData = getComment($p_id);
debug('取得コメントの中身：'.print_r($commentData,true));


if(!empty($_POST)){
  debug('POST送信があります。');
  require('auth.php');
  $comment = $_POST['comment'];
 
  try {
    $dbh = dbConnect();
    $sql = 'INSERT into comment (post_id, user_id, comment, create_date) VALUE (:p_id, :u_id, :comment, :create_date)';
    $data = array(':p_id' => $p_id, ':u_id' => $_SESSION['user_id'], ':comment' => $comment, ':create_date' => date('Y:m:d H:i:s'));

    $stmt = queryPost($dbh, $sql, $data);

  } catch (Exception $e) {
    error_log('エラー発生：'.$e->getMessage());
    $err_msg['common'] = MSG07; 
  }
  if($stmt){
    $_SESSION['msg_success'] = SUC04;
    debug('リダイレクトします。');
    header("Location:".$_SERVER['REQUEST_URI']);
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
          <div class="p-view">
            <div class="p-view-title"><?php echo sanitize($viewData['title']); ?><span class="fav"><i class="far fa-heart pink-heart js-click-fav <?php if(isLike($_SESSION['user_id'], $viewData['id'])){ echo 'fas'; } ?>" area-hidden="true" data-postid=<?php echo sanitize($viewData['id']); ?>></i></span></div>
            <div class="p-view-username"><a href=""><?php echo sanitize($viewData['username']); ?></a></div>
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
            <a href="newPost.php?p_id=<?php if($edit_flg) echo $p_id; ?>" class="next-link <?php if(!$edit_flg) echo 'display-none' ; ?>" ><?php echo '編集する'; ?></a>
            <a href="<?php echo ($prev_page === 'index') ? 'index' : 'mypage' ?>.php<?php echo appendGetParam(array('p_id','u_id','prev')); ?>">&lt; 一覧に戻る</a>

          </div>

          <div class="p-comment">
            <form action="" method="post" class="p-comment-form">
                コメント
                <input type="text" name="comment" value="">
                <input type="submit" value="送信">
            </form>
            <div class="p-comment-list">
              <ul>
                <?php
                  foreach ($commentData['data'] as $key => $val):
                ?>
                <li><span class="comment-user"><?php echo sanitize($val['username']); ?> </span><?php echo sanitize($val['comment']); ?></li>
                <?php
                  endforeach;
                ?>
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