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
  $edit_flg = true;
}else{
  $edit_flg = false;
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