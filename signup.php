<?php
//共通変数・関数ファイルを読込み
require('functions.php');

debug('「「「「「「「「「「「「「「「「「「「「「「「');
debug('===ユーザー登録ページ===');
debug('「「「「「「「「「「「「「「「「「「「「「「「');
debugLogStart();

if(!empty($_POST)){

  //変数にデータを入力
  $email = $_POST['email'];
  $password = $_POST['password'];
  $password_re = $_POST['password_re'];

  // バリデーション 必須
  validRequired($email, 'email');
  validRequired($password, 'password');
  validRequired($password_re, 'password_re');
  
  if(empty($err_msg)){
    // メール
    validEmail($email, 'email');
    validMaxLen($email, 'email');
    validEmailDup($email);

    // パスワード
    validPass($password,'password');
    validPass($password_re,'password_re');

    if(empty($err_msg)){
      // パスワード同値確認
      validMatch($password, $password_re, 'password_re');
      

      if(empty($err_msg)){
        debug('バリデーションOKです。');

        try {
          $dbh = dbConnect();
          $sql = 'INSERT INTO users (email, password, create_date, login_time) VALUES(:email, :pass, :create_date, :login_time)';
          $data = array(':email' => $email, ':pass' => password_hash($password, PASSWORD_DEFAULT), ':create_date' => date('Y-m-d H:i:s'), ':login_time' =>date('Y-m-d H:i:s'));

          $stmt =queryPost($dbh, $sql, $data);

          // クエリ成功の場合
          if($stmt){

            $sesLimit = 60*60;    //セッション有効期限をデフォルト1時間とする
            $_SESSION['login_date'] =time();
            $_SESSION['login_limit'] = $sesLimit;
            $_SESSION['user_id'] = $dbh->lastInsertId();

            debug('セッション変数の中身：'.print_r($_SESSION, true));

            header("Location:mypage.php");
          }
        } catch (Exception $e) {
          error_log('エラー発生：'. $e->getMessage());
          $err_msg['common'] = MSG07;
        }
      }
    }

  }

}

debug('処理終わり <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<');
?>


<?php
  //head読み込み
  $pageTitle = 'ユーザー登録';
  require('head.php');
?>

<body>

  <!-- ヘッダー -->
  <?php
  require('header.php');
  ?>
  <!-- メインコンテンツ -->

  <section class="container">
    <div class="section-title"><h2>ユーザー登録</h2></div>

    <div class="section-contents">
      <form action="" method="POST" class="c-form">
        
        <label class="c-form-label <?php if(!empty($err_msg['email'])) echo 'err'; ?>">
          Email<span class="msg-area"><?php if(!empty($err_msg['email'])) echo $err_msg['email'] ; ?> </span>
          <input type="text" name="email" value="<?php if(!empty($_POST['email'])) echo $_POST['email']; ?>" class="c-form-item">
        </label>
        
        <label class="c-form-label <?php if(!empty($err_msg['password'])) echo 'err'; ?>">
          Password<span class="msg-area"><?php if(!empty($err_msg['password'])) echo $err_msg['password'] ; ?> </span>
          <input type="password" name="password" value="" class="c-form-item">
        </label>
        
        <label class="c-form-label <?php if(!empty($err_msg['password_re'])) echo 'err'; ?>">
          Password（再入力）<span class="msg-area"><?php if(!empty($err_msg['password_re'])) echo $err_msg['password_re'] ; ?> </span>
          <input type="password" name="password_re" value="" class="c-form-item">
        </label>

        <div class="pass-policy">
          <h3><パスワードポリシー></h3>
          <ul>
            <li>6文字以上256文字以内</li>
            <li>半角英数字のみ</li>
          </ul>
        </div>
        <input type="submit" value="登録する" class="">
      </form>
    </div>
  </section>

<?php
  require('footer.php');  
?>