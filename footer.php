  <footer id="footer">
    © 2020 ISHITATSU.
  </footer>
  <script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>
  <script>
  $(function(){
    // var $ftr = $('#footer');
    // if( window.innerHeight > $ftr.offset().top + $ftr.outerHeight() ){
    //   $ftr.attr({'style': 'position:fixed; top:' + (window.innerHeight - $ftr.outerHeight()) +'px;' });
    // }
    // メッセージ表示
    var $jsShowMsg = $('#js-show-msg');
    var msg = $jsShowMsg.text();
    if(msg.replace(/^[\s　]+|[\s　]+$/g, "").length){
      $jsShowMsg.slideToggle('slow');
      setTimeout(function(){ $jsShowMsg.slideToggle('slow'); }, 5000);
    }
    
    // テキストエリアカウント
    var $countUp = $('#js-count'),
        $countView = $('#js-count-view');
    $countUp.on('keyup', function(e){
      $countView.html($(this).val().length);
    });
    
    var $fav,
        favPostId;
    $fav = $('.js-click-fav') || null;

    favPostId = $fav.data('postid') || null;

    if(favPostId !== undefined && favPostId !== null){
      $fav.on('click', function(){
        var $this = $(this);
        $.ajax({
          type: "POST",
          url: "ajaxFav.php",
          data: {postId : favPostId}
        }).done(function(data){
          console.log('Ajax success');
          $this.toggleClass('fas');
        }).fail(function(msg){
          console.log('Ajax Error');
        });
      });
    }
  });
</script>
</body>
</html>

