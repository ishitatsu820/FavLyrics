<?php
//共通変数・関数ファイルを読込み
require('functions.php');

debug('「「「「「「「「「「「「「「「「「「「「「「「');
debug('===マイページ===');
debug('「「「「「「「「「「「「「「「「「「「「「「「');
debugLogStart();

//ログイン認証
require('auth.php');





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
    <div class="sidebar">
      <div class="sidebar-item">
        <a href="">新規投稿</a> 
      </div>
      <div class="sidebar-item">
        <a href="">プロフィール編集</a>
      </div>
      <div class="sidebar-item">
        <a href="">パスワード変更</a>
      </div>
      <div class="sidebar-item">
        <a href="">退会</a>
      </div>
    </div>
  </div>
    
    
  <!-- フッター -->
  <?php
  require('footer.php');  
  ?>