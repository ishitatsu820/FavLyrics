  <footer id="footer">
    © 2020 ISHITATSU.
  </footer>
  <script src="node_modules/jquery/dist/jquery.min.js"></script>
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
    
  });
</script>
</body>
</html>

