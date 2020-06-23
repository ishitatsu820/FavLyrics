<?php
//共通変数・関数ファイルを読込み
require('functions.php');

debug('「「「「「「「「「「「「「「「「「「「「「「「');
debug('===パスワード変更===');
debug('「「「「「「「「「「「「「「「「「「「「「「「');
debugLogStart();


debug('処理終わり <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<');
?>
<?php
  $pageTitle = 'パスワード変更';
 require('head.php');
?>
<body>
  <!-- ヘッダー -->
  <?php
    require('header.php'); 
  ?>


  <!-- メインコンテンツ -->
  <section class="container">
      <div class="section-title"><h2>パスワード変更</h2></div>
  
      <div class="section-contents">
        <form action="" method="POST" class="c-form">
          <label class="c-form-label">
            新しいPassword
            <input type="password" name="password" value="" class="c-form-item">
          </label>
          <div class="msg-area">
                      
          </div>
          <label class="c-form-label">
            新しいPassword（再入力） 
            <input type="password" name="password" value="" class="c-form-item">
          </label>
          <div class="msg-area">
                      
          </div>
          <input type="submit" value="変更する" class="">
        </form>

      </div>
    </section>

  <!-- フッター -->
  <?php
    require('footer.php');
  ?>