<?php
//共通変数・関数ファイルを読込み
require('functions.php');

debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
debug('「　ユーザー登録ページ　');
debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
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
        try {
          $dbh = dbConnect();

          $sql = 'INSERT INTO users (email, password, login_time, create_date) VALUES(:email, :pass, :login_time, :create_date) ';
          $data = array(':email' => $email ,':pass' => password_hash($password, PASSWORD_DEFAULT), ':login_time' =>date('Y-m-d H:i:s'), ':create_date' => date('Y-m-d H:i:s'));

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

debug('処理終わり <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<')
?>


<?php
  //head読み込み
  $pageTitle = 'ユーザー登録';
  require('head.php');
?>

<body>

  <!-- メインコンテンツ -->

  <section class="container">
    <div class="section-title"><h2>ユーザー登録</h2></div>

    <div class="section-contents">
      <form action="" method="POST" class="c-form">
        <label class="c-form-label">
          Email
          <input type="text" name="email" value="" class="c-form-item">
        </label>
        <div class="msg-area">
          
        </div>
        <label class="c-form-label">
          Password
          <input type="password" name="password" value="" class="c-form-item">
        </label>
        <div class="msg-area">
                    
        </div>
        <label class="c-form-label">
          Password（再入力）
          <input type="password" name="password_re" value="" class="c-form-item">
        </label>
        <div class="msg-area">
                    
        </div>
        <input type="submit" value="登録する" class="">
      </form>
    </div>
  </section>
  <!-- フッター -->
  <footer class="footer">
    © 2020 ISHITATSU.
  </footer>

</body>
</html>