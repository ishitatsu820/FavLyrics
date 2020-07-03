<?php
//共通変数・関数ファイルを読込み
require('functions.php');

debug('「「「「「「「「「「「「「「「「「「「「「「「');
debug('===ログインページ===');
debug('「「「「「「「「「「「「「「「「「「「「「「「');
startDebugLog();

if(!empty($_POST)){
  //POST送信があった場合
  debug('POST送信がありました。');

  $email = $_POST['email'];
  $password = $_POST['password'];
  $auto_login = (!empty($_POST['auto_login'])) ? true :false;

  validRequired($email, 'email');
  validRequired($password, 'password');

  if(empty($err_msg)){
    validEmail($email, 'email');
    validPass($password, 'password');

    if(empty($err_msg)){
      debug('バリデーションOKです。');
      
      try {
        
        $dbh = dbConnect();
        $sql = 'SELECT password, id  FROM users WHERE email = :email AND delete_flg = 0 ';
        $data = array(':email' => $email );

        // クエリ実行
        $stmt = queryPost($dbh, $sql, $data);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        debug('クエリ実行結果：'.print_r($result, true));

        // パスワード照合
        if(!empty($result) && password_verify($password, array_shift($result)) ){
          debug('パスワードがマッチしました。');

          $sesLimit = 60*60;
          // 最終ログインを現在日時へ
          $_SESSION['login_date'] = time();

          if($auto_login){
            //自動ログインにチェックがある場合
            debug('自動ログインにチェックがあります。');
            $_SESSION['login_limit'] = $sesLimit * 24 * 3;

          }else{
            debug('自動ログインにチェックはありません。');
            $_SESSION['login_limit'] = $sesLimit ;

          }

          $_SESSION['user_id'] = $result['id'];
          debug('セッションIDの中身：' .print_r($_SESSION, true));
          debug('マイページへ遷移します。');
          header('Location:mypage.php');



        }else{
          debug('パスワードがアンマッチです。');
          $err_msg['password'] = MSG09;
        }

      } catch (Exception $e) {
        error_log('エラー発生：'. $e->getMessage());
        $err_msg['common'] = MSG07;

      }
    }
  }
}
debug('処理終わり <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<');
?>
<?php
 $pageTitle = 'ログイン';
 require('head.php');
?>
<body>
  <!-- ヘッダー -->
  <?php
  require('header.php');
  ?>

  <!-- メインコンテンツ -->
  <section class="container">
    <div class="section-title"><h2>ログイン</h2></div>

    <div class="section-contents">
      <form action="" method="POST" class="c-form">
        <label class="c-form-label <?php if(!empty($err_msg['email'])) echo 'err'; ?>">
          Email<span class="msg-area"><?php if(!empty($err_msg['email'])) echo $err_msg['email'] ; ?> </span>
          <input type="text" name="email" value="<?php if(!empty($_POST['email'])) echo $_POST['email']; ?>" class="c-form-item">
        </label>

        <label class="c-form-label <?php if(!empty($err_msg['email'])) echo 'err'; ?>">
          Password<span class="msg-area"><?php if(!empty($err_msg['password'])) echo $err_msg['password'] ; ?> </span>
          <input type="password" name="password" value="" class="c-form-item">
        </label>

        <label class="c-form-label">
          <input type="checkbox" name="auto_login" class="">
          次回から自動でログイン
        </label>
        <input type="submit" value="ログイン" class="">
      </form>
      <div class="text-center">
        Passwordを忘れた方は<a href="passRemindSend.php">こちら</a>
      </div>
    </div>
  </section>
  
<!-- フッター -->
<?php
  require('footer.php');
?>