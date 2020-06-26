<?php
//共通変数・関数ファイルを読込み
require('functions.php');

debug('「「「「「「「「「「「「「「「「「「「「「「「');
debug('===パスワードリマインド送信===');
debug('「「「「「「「「「「「「「「「「「「「「「「「');
debugLogStart();

if(!empty($_POST)){

  $email = $_POST['email'];

  validRequired($email, 'email');

  if(empty($err_msg)){
    debug('未入力チェックOK。');

    validEmail($email, 'email');
    validMaxLen($email, 'email');

    if(empty($err_msg)){
      debug('バリデーションOK。');

      try {
        
        $dbh = dbConnect();
        $sql = 'SELECT count(*) FROM users WHERE email = :email AND delete_flg = 0';
        $data = array(':email' => $email);

        $stmt = queryPost($dbh, $sql, $data);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if($stmt && array_shift($result)){
          debug('クエリ成功しました。DBに登録があります。');
          $_SESSION['msg_success'] = SUC03;

          $auth_key = makeRandKey();
          
          //メールを送信
          $from = 'ishitatsu820@gmail.com';
          $to = $email;
          $subject = '【パスワード再発行認証】｜Fav Lyrics';
          //EOTはEndOfFileの略。ABCでもなんでもいい。先頭の<<<の後の文字列と合わせること。最後のEOTの前後に空白など何も入れてはいけない。
          //EOT内の半角空白も全てそのまま半角空白として扱われるのでインデントはしないこと
          $comment = <<<EOT
本メールアドレス宛にパスワード再発行のご依頼がありました。
下記のURLにて認証キーをご入力頂くとパスワードが再発行されます。

パスワード再発行認証キー入力ページ：http://localhost:8888/fav_lyrics/passRemindRecieve.php
認証キー：{$auth_key}
※認証キーの有効期限は30分となります

認証キーを再発行されたい場合は下記ページより再度再発行をお願い致します。
http://localhost:8888/fav_lyrics/passRemindSend.php

////////////////////////////////////////

URL  http://fav_lyrics.com/
E-mail info@webukatu.com
////////////////////////////////////////
EOT;

          sendMail($from, $to, $subject, $comment);

          $_SESSION['auth_key'] = $auth_key;
          $_SESSION['auth_email'] = $email;
          $_SESSION['auth_key_limit'] = time()+(60*30);
          debug('セッション変数の中身：'.print_r($_SESSION,true));

          header('Location:passremindRecieve.php');

        }else{
          debug('クエリに失敗したかDBに登録のないEmailが入力されました。');
          $err_msg['common'] = MSG07;
        }

      } catch (Exception $e) {
        error_log('エラー発生！！：' .$e->getMessage());
        $err_msg['common'] = MSG07;
      }

    }

  }
}
debug('処理終わり <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<');
?>
<?php
  $pageTitle = 'パスワードリマインド';
  require('head.php');
?>
<body>
  <!-- ヘッダー -->
  <?php 
    require('header.php');
  ?>


  <!-- メインコンテンツ -->
  <section class="container">
      <div class="section-title"><h2>パスワードリマインド</h2></div>
  
      <div class="section-contents">
        <form action="" method="POST" class="c-form">
          <label class="c-form-label <?php if(!empty($err_msg['email'])) echo 'err'; ?>">
            Email<span><?php if(!empty($err_msg['email'])) echo $err_msg['email'] ; ?> </span>
            <input type="text" name="email" value="" class="c-form-item">
          </label>
          <input type="submit" value="送信" class="">
        </form>

      </div>
    </section>

  <!-- フッター -->
  <?php
    require('footer.php');
  ?>