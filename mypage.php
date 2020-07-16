<?php
//共通変数・関数ファイルを読込み
require('functions.php');

debug('「「「「「「「「「「「「「「「「「「「「「「「');
debug('===マイページ===');
debug('「「「「「「「「「「「「「「「「「「「「「「「');
startDebugLog();

//ログイン認証
require('auth.php');

$currentPageNum_post = (!empty($_GET['post'])) ? $_GET['post'] : 1;
if(!is_int((int)$currentPageNum_post)){
  error_log('エラー発生：指定ページ（登録一覧）に不正な値が入りました。');
  header("Location:mypage.php");
}

$currentPageNum_fav = (!empty($_GET['fav'])) ? $_GET['fav'] : 1;
if(!is_int((int)$currentPageNum_fav)){
  error_log('エラー発生：指定ページ（お気に入り一覧）に不正な値が入りました。');
  header("Location:mypage.php");
}


// 表示件数
$listSpan = 10;
// の表示レコードの先頭を算出
$currentMinNum_post = (($currentPageNum_post-1)*$listSpan);
// DBから投稿データを取得
$dbMyPostData = getMyPost($currentMinNum_post, $listSpan, $_SESSION['user_id']);
debug('現在の投稿一覧ページ：'.$currentPageNum_post);

// 現在の表示レコードの先頭を算出
$currentMinNum_fav = (($currentPageNum_fav-1)*$listSpan);
// DBから投稿データを取得
$dbMyfavoritePost = getMyFav($currentMinNum_fav, $listSpan, $_SESSION['user_id']);
debug('現在のお気に入りページ：'.$currentPageNum_fav);



debug('処理終わり <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<');
?>
<?php
  $pageTitle = 'マイページ';
  require('head.php');
?>

<body>
  <!-- ヘッダー -->
  <?php
  require('header.php');
  ?>
  <p id="js-show-msg" style="display:none;" class="msg-slide">
    <?php echo getSessionFlash('msg_success'); ?>
  </p>
  <!-- メイン -->
  <div class="main">

    <!-- メインコンテンツ -->
    <div class="center">
      <section class="section">
        <div class="section-title"><h2>投稿一覧</h2></div>
        
        
        <div class="section-contents p-posts">
        <?php
        foreach ($dbMyPostData['data'] as $key => $val):
        ?>
        <a href="postDetail.php?p_id=<?php echo $val['p_id'].'&u_id='.$val['u_id'].'&prev=mypage'.'&post='.$currentPageNum_post; ?>" class="c-item">
          <div class="c-item-title">
            <h3><?php echo sanitize($val['title']); ?></h3>
          </div>
          <div class="c-item-subtitle">
            <h4><?php echo sanitize($val['music_title']); ?><br> by <span class="artist"><?php echo sanitize($val['artist']); ?></span></h4>
          </div>
          <div class="c-item-text">
            <p><?php echo sanitize(mb_substr($val['lyrics'], 0, 29)); ?>...</p>
          </div>
        </a>
        <?php
          endforeach;
        ?>
        </div>
        <?php postPagination($currentPageNum_post, $dbMyPostData['my_total_page']); ?>
      </section>


      <section class="section">
        <div class="section-title"><h2>お気に入り</h2></div>
        <?php
        foreach ($dbMyfavoritePost['data'] as $key => $val):
        ?>
        <a href="postDetail.php?p_id=<?php echo $val['p_id'].'&u_id='.$val['u_id'].'&prev=mypage'.'&fav='.$currentPageNum_post; ?>" class="c-item">
          <div class="c-item-title">
            <h3><?php echo sanitize($val['title']); ?></h3>
          </div>
          <div class="c-item-subtitle">
            <h4><?php echo sanitize($val['music_title']); ?><br> by <span class="artist"><?php echo sanitize($val['artist']); ?></span></h4>
          </div>
          <div class="c-item-text">
            <p><?php echo sanitize(mb_substr($val['lyrics'], 0, 29)); ?>...</p>
          </div>
        </a>
        <?php
          endforeach;
        ?>
        
        <div class="section-contents p-posts">

        </div>
        <?php favPagination($currentPageNum_fav, $dbMyfavoritePost['fav_total_page']); ?>
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