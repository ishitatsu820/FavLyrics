<?php
//共通変数・関数ファイルを読込み
require('functions.php');

debug('「「「「「「「「「「「「「「「「「「「「「「「');
debug('===新規投稿ページ===');
debug('「「「「「「「「「「「「「「「「「「「「「「「');
debugLogStart();

// require('auth.php');

$p_id = (!empty($_GET['p_id'])) ? $_GET['p_id'] : '';
$dbFormData = (!empty($p_id)) ? getPost($_SESSION['user_id'], $p_id) : '';
$edit_Flg = (empty($dbFormData)) ? false : true ;

$dbCategoryData = getCategory();
debug('商品ID：'.$p_id);
debug('DBフォームデータ：'.print_r($dbFormData,true ));
debug('カテゴリーデータ：'.print_r($dbCategoryData, true));

if(!empty($p_id) && empty($dbFormData)){
  debug('GETパラメータの商品IDが違います。マイページへ遷移します。');
  header("Location:mypage.php");
}

if(!empty($_POST)){
  debug('POST送信があります。');
  debug('POST情報：'.print_r($_POST,true));
  debug('FILE情報：'.print_r($_FILES,true));

  $title = $_POST['title'];


}

debug('処理終わり <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<');
?>
<?php
  $pageTitle = '新規投稿';
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
        <div class="section-title"><h2>新規投稿</h2></div>
        
        <div class="section-contents">
          <form action="" method="POST" class="c-form">
            <label class="c-form-label <?php if(!empty($err_msg['post_title'])) echo 'err'; ?>">
              タイトル<span class="msg-area"><?php if(!empty($err_msg['post_title'])) echo $err_msg['post_title'] ; ?></span>
            <input type="text" name="post_title" value="" class="c-form-item">
            </label>

            <label class="c-form-label <?php if(!empty($err_msg['fav_lyrics'])) echo 'err'; ?>">
            <span class="msg-area"><?php if(!empty($err_msg['fav_lyrics'])) echo $err_msg['fav_lyrics'] ; ?></span>
              <textarea name="fav_lyrics" id="" cols="10" rows="15" class="c-form-item" placeholder="お気に入りのフレーズは？"></textarea>
            </label>

            <label class="c-form-label <?php if(!empty($err_msg['music_title'])) echo 'err'; ?>">
              曲名<span class="msg-area"><?php if(!empty($err_msg['music_title'])) echo $err_msg['music_title'] ; ?></span>
              <input type="text" name="music_title" value="" class="c-form-item">
            </label>

            <label class="c-form-label <?php if(!empty($err_msg['artist'])) echo 'err'; ?>">
              アーティスト名<span class="msg-area"><?php if(!empty($err_msg['artist'])) echo $err_msg['artist'] ; ?></span>
              <input type="text" name="artist" value="" class="c-form-item">
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
