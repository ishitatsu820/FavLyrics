  <!-- ヘッダー -->
  <header class="header">
    <div class="header-logo">
      <h1><a href="index.php">Fav Lyrics</a></h1>
    </div>

    <div class="nav">
      <ul class="nav-menu">
        <?php
          if(empty($_SESSION['user_id'])){            
        ?>
        <li class="nav-item"><a href="login.php">ログイン</a></li>
        <li class="nav-item" ><a href="signup.php">ユーザー登録</a></li>
        <?php
          }else{
        ?>
        <li class="nav-item"><a href="mypage.php">マイページ</a></li>
        <li class="nav-item" ><a href="logout.php">ログアウト</a></li>
        <?php
          }
        ?>
      </ul>
    </div>
  </header>