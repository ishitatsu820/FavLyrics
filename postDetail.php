<?php
//共通変数・関数ファイルを読込み
require('functions.php');

debug('「「「「「「「「「「「「「「「「「「「「「「「');
debug('===投稿詳細ページ===');
debug('「「「「「「「「「「「「「「「「「「「「「「「');
debugLogStart();

require('auth.php');



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
            <input type="text" name="username" value="" class="c-form-item">
            </label>
            <div class="msg-area">
          
            </div>
            <label class="c-form-label">
              
              <textarea name="" id="" cols="20" rows="15" class="c-form-item" placeholder="お気に入りのフレーズは？"></textarea>
            </label>
            <div class="msg-area">
                    
            </div>
            <div class="msg-area">
                    
            </div>
            <label class="c-form-label">
              曲名
              <input type="text" name="anthem" value="" class="c-form-item">
            </label>
            <div class="msg-area">
                    
            </div>
            <label class="c-form-label">
              アーティスト
              <input type="text" name="anthem" value="" class="c-form-item">
            </label>
            <div class="msg-area">
                    
            </div>
            
            <input type="submit" value="編集する" class="">
            
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