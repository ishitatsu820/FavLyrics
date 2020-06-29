<?php
//共通変数・関数ファイルを読込み
require('functions.php');

debug('「「「「「「「「「「「「「「「「「「「「「「「');
debug('===新規投稿ページ===');
debug('「「「「「「「「「「「「「「「「「「「「「「「');
debugLogStart();

require('auth.php');

$p_id = (!empty($_GET['p_id'])) ? $_GET['p_id'] : '';
$dbFormData = (!empty($p_id)) ? getPost($_SESSION['user_id'], $p_id) : '';
$edit_flg = (empty($dbFormData)) ? false : true ;

$dbCategoryData = getCategory();
debug('商品ID：'.$p_id);
debug('DBフォームデータ：'.print_r($dbFormData,true ));
// debug('カテゴリーデータ：'.print_r($dbCategoryData, true));

if(!empty($p_id) && empty($dbFormData)){
  debug('GETパラメータの商品IDが違います。マイページへ遷移します。');
  header("Location:mypage.php");
}

if(!empty($_POST)){
  debug('POST送信があります。');
  debug('POST情報：'.print_r($_POST,true));
  // debug('FILE情報：'.print_r($_FILES,true));

  $post_title = $_POST['post_title'];
  $fav_lyrics = $_POST['fav_lyrics'];
  $music_title = $_POST['music_title'];
  $artist = $_POST['artist'];
  
  if(!$edit_flg){
    //新規登録の場合
    validRequired($post_title, 'post_title');
    validRequired($fav_lyrics, 'fav_lyrics');
    validRequired($music_title, 'music_title');
    validRequired($artist, 'artist');

    validMaxLen($post_title, 'post_title');
    validMaxLen($fav_lyrics, 'fav_lyrics');
    validMaxLen($music_title, 'music_title');
    validMaxLen($artist, 'artist');

  }else{
    //更新の場合(変更がある分だけバリデーション)
    if($dbFormData['post_title'] !== $post_title){
      validRequired($post_title, 'post_title');
      validMaxLen($post_title, 'post_title');
    }
    if($dbFormData['fav_lyrics'] !== $fav_lyrics){
      validRequired($fav_lyrics, 'fav_lyrics');
      validMaxLen($fav_lyrics, 'fav_lyrics');
    }
    if($dbFormData['music_title'] !== $music_title){
      validRequired($music_title, 'music_title');
      validMaxLen($music_title, 'music_title');
    }
    if($dbFormData['artist'] !== $artist){
      validRequired($artist, 'artist');
      validMaxLen($artist, 'artist');
    }

  }

  if(empty($err_msg)){
    debug('バリデーションOKです。');

    try {
      $dbh = dbConnect();

      if($edit_flg){
        debug('DB更新です。');
        $sql = 'UPDATE post SET title = :title, lyrics = :lyrics, artist = :artist, music_title = :music_title, update_date = :update_date WHERE user_id = :u_id AND id = :p_id AND delete_flg = 0';
        $data = array(':title' => $post_title, ':lyrics' => $fav_lyrics, ':artist' => $artist, ':music_title' => $music_title, ':update_date' => date('Y:m:d H:i:s'));
        
      }else{
        debug('DB新規登録です。');
        $sql = 'INSERT into post (title, lyrics, artist, music_title, user_id, create_date) values (:title, :lyrics, :artist, :music_title, :u_id, :create_date)';
        $data = array(':title' => $post_title, ':lyrics' => $fav_lyrics, ':artist' => $artist, ':music_title' => $music_title, ':u_id' => $_SESSION['user_id'], ':create_date' => date('Y:m:d H:i:s'));
      }

      debug('SQL：'.$sql);
      debug('DATA：'.print_r($data, true));

      $stmt = queryPost($dbh, $sql, $data);

      if($stmt){
        $_SESSION['msg_success'] = SUC04;
        debug('マイページへ遷移します。');
        header("Location:mypage.php");
      }

    } catch (Exception $e) {
      error_log('エラー発生：'.$e->getMessage());
      $err_msg['common'] = MSG07;
    }
  }
  


}

debug('処理終わり <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<');
?>
<?php
  $pageTitle = (!$edit_flg) ? '新規投稿':'投稿編集';
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
        <div class="section-title"><h2><?php echo (!$edit_flg) ? '新規投稿':'投稿編集'; ?></h2></div>
        
        <div class="section-contents">
          <form action="" method="POST" class="c-form">
            <label class="c-form-label <?php if(!empty($err_msg['post_title'])) echo 'err'; ?>">
              タイトル<span class="msg-area"><?php if(!empty($err_msg['post_title'])) echo $err_msg['post_title'] ; ?></span>
            <input type="text" name="post_title" value="<?php if(!empty($_POST['post_title'])) echo $_POST['post_title'] ; ?>" class="c-form-item">
            </label>

            <label class="c-form-label <?php if(!empty($err_msg['fav_lyrics'])) echo 'err'; ?>">
            <span class="msg-area"><?php if(!empty($err_msg['fav_lyrics'])) echo $err_msg['fav_lyrics'] ; ?></span>
              <textarea name="fav_lyrics" id="" cols="10" rows="15" class="c-form-item" placeholder="お気に入りのフレーズは？"><?php if(!empty($_POST['fav_lyrics'])) echo $_POST['fav_lyrics'] ; ?></textarea>
            </label>

            <label class="c-form-label <?php if(!empty($err_msg['music_title'])) echo 'err'; ?>">
              曲名<span class="msg-area"><?php if(!empty($err_msg['music_title'])) echo $err_msg['music_title'] ; ?></span>
              <input type="text" name="music_title" value="<?php if(!empty($_POST['music_title'])) echo $_POST['music_title'] ; ?>" class="c-form-item">
            </label>

            <label class="c-form-label <?php if(!empty($err_msg['artist'])) echo 'err'; ?>">
              アーティスト名<span class="msg-area"><?php if(!empty($err_msg['artist'])) echo $err_msg['artist'] ; ?></span>
              <input type="text" name="artist" value="<?php if(!empty($_POST['artist'])) echo $_POST['artist'] ; ?>" class="c-form-item">
            </label>
            
            <input type="submit" value="<?php echo (!$edit_flg) ? '投稿する' : '編集する'; ?>" class="">
          </form>          

          
        </div>
        
      </section>
    </div>
    
    
    <!-- サイドバー -->
    <?php
      require('sidebar.php')
    ?>
  </div>
    
    
  <!-- フッター -->
  <?php
    require('footer.php');
  ?>
