<?php
//共通変数・関数ファイルを読込み
require('functions.php');

debug('「「「「「「「「「「「「「「「「「「「「「「「');
debug('===マイページ===');
debug('「「「「「「「「「「「「「「「「「「「「「「「');
debugLogStart();

//ログイン認証
require('auth.php');

$currentPageNum_post = (!empty($_GET['p'])) ? $_GET['p'] : 1;
if(!is_int((int)$currentPageNum_post)){
  error_log('エラー発生：指定ページ（登録一覧）に不正な値が入りました。');
  header("Location:mypage.php");
}

// $currentPageNum_fav = (!empty($_GET['p'])) ? $_GET['p'] : 1;
// if(!is_int((int)$currentPageNum_fav)){
//   error_log('エラー発生：指定ページ（お気に入り一覧）に不正な値が入りました。');
//   header("Location:mypage.php");
// }


// 表示件数
$listSpan = 10;
// 現在の表示レコードの先頭を算出
$currentMinNum_post = (($currentPageNum_post-1)*$listSpan);
// DBから投稿データを取得
$dbMyPostData = getPostList($currentMinNum_post);
debug('現在のページ：'.$currentPageNum_post);

// // 現在の表示レコードの先頭を算出
// $currentMinNum_fav = (($currentPageNum_fav-1)*$listSpan);
// // DBから投稿データを取得
// $dbMyfavoriteData = getPostList($currentMinNum_fav);
// debug('現在のページ：'.$currentPageNum_fav);




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

  <!-- メイン -->
  <div class="main">

    <!-- メインコンテンツ -->
    <div class="center">
      <section class="section">
        <div class="section-title"><h2>登録一覧</h2></div>
        
        
        <div class="section-contents p-posts">
        <?php
        foreach ($dbMyPostData['data'] as $key => $val):
        ?>
        <a href="" class="c-item">
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
      </section>


      <section class="section">
        <div class="section-title"><h2>お気に入り</h2></div>
        
        
        <div class="section-contents p-posts">
          <div class="c-item">
            <div class="c-item-title">
              <h3>走りたくなる曲</h3>
            </div>
            <div class="c-item-subtitle">
              <h4>PRAYING RUN <br> by <span class="artist">UVERworld</span></h4>
            </div>
            <div class="c-item-text">
              <p>走って、走って、走る。ただひたすらに...</p>
            </div>
          </div>
          
          <div class="c-item">
            <div class="c-item-title">
              <h3>幸せとは</h3>
            </div>
            <div class="c-item-subtitle">
              <h4>御影意志 <br> by <span class="artist">UVERworld</span></h4>
            </div>
            <div class="c-item-text">
              <p>気づかない幸せが、そこにある。</p>
            </div>
          </div>
          
          <div class="c-item">
            <div class="c-item-title">
              <h3>始まりの合唱</h3>
            </div>
            <div class="c-item-subtitle">
              <h4>0 choir <br> by <span class="artist">UVERworld</span></h4>
            </div>
            <div class="c-item-text">
              <p>おっおっおっおっおっおっおっおっ ゼーロクワイヤ！</p>
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