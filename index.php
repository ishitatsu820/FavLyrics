<?php
//共通変数・関数ファイルを読込み
require('functions.php');

debug('「「「「「「「「「「「「「「「「「「「「「「「');
debug('===TOPページ===');
debug('「「「「「「「「「「「「「「「「「「「「「「「');
debugLogStart();


debug('処理終わり <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<');
?>
<?php
  $pageTitle = 'TOP';
  require('head.php');
?>
<body class="bg-colorB">
  <!-- ヘッダー -->
  <?php
    require('header.php');
  ?>

  <!-- メインコンテンツ -->


  <div class="hero">
    <div class="hero-title">
      <h2>Let's share your best music, best lyrics.</h2>
    </div>
  </div>
  
  
  <section id="about" class="container">
    <div class="section-title">
      <h2>About</h2>
    </div>
    
    <div class="section-contents p-about">
      Fav Lyricsは自分のお気に入りの曲の歌詞を共有できるサービスです。もちろん他の人のお気に入りの歌詞を見ることもできます。一人のときに聞いた曲、友達・恋人と一緒に聴いた曲、ライブ会場で聞いた曲、懐かしい曲、メジャーな曲、周りの人が知らないようなマイナーな曲、テンションが上がる曲、泣けてくる曲...その時感じた想いとともに、お気に入りの歌詞を共有してみませんか。
    </div>
    
  </section>
  
  <section id="posts" class="container">
    <div class="section-title">
      <h2>投稿一覧</h2>
    </div>
    
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

  
  <!-- フッター -->
  <?php
    require('footer.php');
  ?>