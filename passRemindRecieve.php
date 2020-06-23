<?php
//共通変数・関数ファイルを読込み
require('functions.php');

debug('「「「「「「「「「「「「「「「「「「「「「「「');
debug('===パスワード変更===');
debug('「「「「「「「「「「「「「「「「「「「「「「「');
debugLogStart();

if(!empty($_POST)){
  debug('POST送信がありました。');

  $password = $_POST['password'];
  $password_re = $_POST['password_re'];
  $auth_key = $_POST['auth_key'];

  validRequired($password, 'password');
  validRequired($password_re, 'password_re');
  validRequired($auth_key, 'auth_key');
  debug('未入力チェックOK');

  if(empty($err_msg)){
    validPass($password, 'password');
    validPass($password_re, 'password_re');
    validHalf($auth_key, 'auth_key');
    validLength($auth_key, 'auth_key');

    if(empty($err_msg)){
      debug('バリデーションOK。');


      if($auth_key !== $_SESSION['auth_key']){
        $err_msg['common'] = MSG15;
      }
      if(time() > $_SESSION['auth_key_limit']){
        $err_msg['common'] = MSG16;
      }
      if(empty($err_msg)){
        try {
          $dbh = dbConnect();
          $sql = 'UPDATE users SET password = :password WHERE email = :email AND delete_flg = 0';
          $data = array(':password' => password_hash($password, PASSWORD_DEFAULT) , ':email' => $_SESSION['auth_email'] );
  
          $stmt = queryPost($dbh, $sql, $data);

          if($stmt){
            debug('クエリ成功');

            session_unset();
            $_SESSION['msg_success'] = SUC03;
            debug('セッション変数の中身：'.print_r($_SESSION,true));

            header("Location:login.php"); //ログインページへ            
          }else{
            debug('クエリに失敗しました。');
            $err_msg['common'] = MSG07;            
          }
        } catch (Exception $e) {
          error_log('エラー発生！！：'.$e->getMessage());
          $err_msg['common'] = MSG07;
        }

      }

    }
  }
  
}

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
          <label class="c-form-label <?php if(!empty($err_msg['password'])) echo 'err'; ?>">
            新しいPassword<span class="msg-area"><?php if(!empty($err_msg['password'])) echo $err_msg['password'] ; ?></span>
            <input type="password" name="password" value="" class="c-form-item">
          </label>
          <label class="c-form-label <?php if(!empty($err_msg['password_re'])) echo 'err'; ?>">
            新しいPassword（再入力）<span class=" msg-area"><?php if(!empty($err_msg['password_re'])) echo $err_msg['password_re'] ; ?></span>
            <input type="password" name="password_re" value="" class="c-form-item">
          </label>
          <label class="c-form-label <?php if(!empty($err_msg['auth_key'])) echo 'err'; ?>">
            認証キー<span class="msg-area"><?php if(!empty($err_msg['auth_key'])) echo $err_msg['auth_key'] ; ?></span>
            <input type="text" name="auth_key" value="" class="c-form-item">
          </label>
          <div class="pass-policy">
            <h3><パスワードポリシー></h3>
            <ul>
              <li>6文字以上256文字以内</li>
              <li>半角英数字のみ</li>
            </ul>
          </div>
          <input type="submit" value="変更する" class="">
        </form>

      </div>
    </section>

  <!-- フッター -->
  <?php
    require('footer.php');
  ?>