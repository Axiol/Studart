$("#projectModal").modal({
  backdrop: false
});
$("#projectModal").modal("hide");
$("#searchModal").modal();
$("#searchModal").modal("hide");

$(window).load(function(){
  if($(window).width() > 767){
    $('#lastWrap').isotope({
      itemSelector : '.post',
      layoutMode : 'masonry'
    });
  }
});

$(function(){
  $("span.delAja a").click(function(e){
    e.preventDefault();
    $.get($(this).attr("href"));
    $(this).parent().fadeOut();
    return false;
  });
  $("li.liUnlike a.likeCTRL").click(function(e){
    e.preventDefault();
    $.get($(this).attr("href"));
    $("li.liUnlike").addClass("hide");
    $("li.liLike").removeClass("hide");
    $("a.likeCount span").text(Number($("li.liUnlike a.likeCount span").text()) - 1);
    return false;
  });
  $("li.liLike a.likeCTRL").click(function(e){
    e.preventDefault();
    $.get($(this).attr("href"));
    $("li.liLike").addClass("hide");
    $("li.liUnlike").removeClass("hide");
    $("a.likeCount span").text(Number($("li.liLike a.likeCount span").text()) + 1);
    return false;
  });
  $('.sharePopup').click(function() {
    var width  = 575,
        height = 400,
        left   = ($(window).width()  - width)  / 2,
        top    = ($(window).height() - height) / 2,
        url    = this.href,
        opts   = 'status=1' +
                 ',width='  + width  +
                 ',height=' + height +
                 ',top='    + top    +
                 ',left='   + left;
    
    window.open(url, 'twitter', opts);
    return false;
  });
});

function prevVisu(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e){
      $("div#visuForm").html("<img class='img-polaroid' src='" + e.target.result + "' alt='Preview du visuel'>");
    }
    reader.readAsDataURL(input.files[0]);
  }
}
function modelPath(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e){
      $("#PostPathModel").attr("value", e.target.result);
    }
    reader.readAsDataURL(input.files[0]);
  }
}

var uvOptions = {};
(function() {
  var uv = document.createElement('script'); uv.type = 'text/javascript'; uv.async = true;
  uv.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'widget.uservoice.com/OhK0RfUhGvMIRwKYbLSw.js';
  var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(uv, s);
})();