<?php
//共通変数・関数ファイルを読込み
require('functions.php');

debug('「「「「「「「「「「「「「「「「「「「「「「「');
debug('===プロフィール編集===');
debug('「「「「「「「「「「「「「「「「「「「「「「「');
debugLogStart();

require('auth.php');

// まずデータ取得
$dbFormData = getUser($_SESSION['user_id']);
debug('取得したユーザー情報：'.print_r($dbFormData, true));




// それからPOST送信があった場合
if(!empty($_POST)){
  debug('POST送信があります。');
  debug('POST情報：'.print_r($_POST,true));
// edbug('FILE情報：'.print_r($_FILES,true));
  $username = $_POST['username'];
  $age = $_POST['age'];
  $self_introduction = $_POST['self_introduction'];
  $anthem = $_POST['anthem'];

  if($dbFormData['username'] !== $username){
    validMaxLen($username, 'username');
  }
  if($dbFormData['age'] !== $age){
    validMaxLen($age, 'age');
    validNumber($age, 'age');
  }
  if($dbFormData['selfintroduction'] !== $self_introduction){
    validMaxLen($self_introduction, 'self_introduction');
  }
  if($dbFormData['anthem'] !== $anthem){
    validMaxLen($anthem, 'anthem');
  }
  if(empty($err_msg)){
    debug('バリデーションOK！');

    try {
      $dbh = dbConnect();
      $sql = 'UPDATE users SET username = :u_name, age = :age, selfintroduction = :si, anthem = :anthem WHERE id = :u_id AND delete_flg = 0';
      $data = array(':u_name' => $username , ':age' => $age, ':si' => $self_introduction,  'anthem' => $anthem, ':u_id' => $dbFormData['id']);

      $stmt = queryPost($dbh, $sql, $data);

      if($stmt){
        $_SESSION['msg_success'] = SUC02;
        debug('プロフィール編集完了。マイページへ遷移します。');
        header("Location:mypage.php");
      }


    } catch (Exception $e) {
      error_log('エラー発生！：'.$e->getMessage());
      $err_msg['common'] = MSG07;
    }
  }
}

debug('処理終わり <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<');
?>
<?php
  $pageTitle = 'プロフィール編集';
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
        <div class="section-title"><h2>プロフィール編集</h2></div>
        
        
        <div class="section-contents">
          <form action="" method="POST" class="c-form">
            <label class="c-form-label">
              ユーザーネーム<span class="msg-area"><?php if(!empty($err_msg['username'])) echo $err_msg['username'] ; ?></span>
            <input type="text" name="username" value="<?php echo getFormData('username'); ?>" class="c-form-item" >
            </label>

            <label class="c-form-label">
              年齢<span class="msg-area"><?php if(!empty($err_msg['age'])) echo $err_msg['age'] ; ?></span>
              <input type="number" name="age" value="<?php echo getFormData('age'); ?>" min="0" max="120" class="c-form-item">
            </label>

            <label class="c-form-label">
              自己紹介<span class="msg-area"><?php if(!empty($err_msg['self_introduction'])) echo $err_msg['self_introduction'] ; ?></span>
              <textarea name="self_introduction" cols="30" rows="5" class="c-form-item"><?php echo getFormData('selfintroduction'); ?></textarea>
            </label>

            <label class="c-form-label">
              アンセム<span class="msg-area"><?php if(!empty($err_msg['anthem'])) echo $err_msg['anthem'] ; ?></span>
              <input type="text" name="anthem" value="<?php echo getFormData('anthem'); ?>" class="c-form-item">
            </label>

            <input type="submit" value="変更する" class="">
          </form>          
          
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