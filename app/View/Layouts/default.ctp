<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title><?php echo $title_for_layout ?> :: StudArt</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Gallerie pour jeunes graphistes">
    <meta name="author" content="Arnaud Delante">

    <?php
      echo $this->Html->meta('icon');
      echo $this->Html->css('bootstrap');
      echo $this->Html->css('responsive');
    ?>

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    
  </head>

  <body><!-- <?php echo $this->request->controller; echo $this->request->action; ?> -->
    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <?php echo $this->Html->link("StudArt","/",array('class' => 'brand')); ?>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li class="home <?php if($this->request->controller == "posts" && $this->request->action == "index"){ echo "active"; } ?>"><?php echo $this->Html->link("Accueil","/"); ?></li>
              <li class="about"><a href="#about">À Propos</a></li>
              <li class="contact"><a href="#contact">Contact</a></li>
            </ul>
            <ul class="nav pull-right">
              <!-- <li><a href="#"><span class="alert-msg">2</span><span class="hidden-desktop">nouveaux messages</span></a></li> -->
              <?php if(AuthComponent::user("id")): ?>
                <?php
                  $grav_email = AuthComponent::user("mail");
                  $grav_size = 25;
                  $grav_url = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $grav_email ) ) ) . "?s=" . $grav_size;
                ?>
                <li><a href="<?php echo $this->Html->url(array("action" => "view","controller" => "users",AuthComponent::user("id"))); ?>"><img src="<?php echo $grav_url ?>" width="25"> <?php echo AuthComponent::user("username") ?></a></li>
                <li><?php echo $this->Html->link("Poster",array("action" => "add","controller" => "posts")); ?></li>
                <li><?php echo $this->Html->link("Se déconnecter",array("action" => "logout","controller" => "users")); ?></li>
              <?php else: ?>
                <li><?php echo $this->Html->link("S'inscrire",array("action" => "signup","controller" => "users")); ?></li>
                <li><?php echo $this->Html->link("Se connecter",array("action" => "login","controller" => "users")); ?></li>
              <?php endif; ?>
            </ul>
          </div>
        </div>
      </div>
    </div>
    
    <div class="container">
    
      <?php echo $this->fetch('content'); ?>
  
      <footer>
        <p>&copy; StudArt 2012</p>
      </footer>
      
    </div>
     
    <?php
      echo $this->Html->script(array('jquery', 'jtruncate', 'isotope', 'bootstrap-transition', 'bootstrap-alert', 'bootstrap-modal', 'bootstrap-dropdown', 'bootstrap-scrollspy', 'bootstrap-tab', 'bootstrap-tooltip', 'bootstrap-popover', 'bootstrap-button', 'bootstrap-collapse', 'bootstrap-carousel', 'bootstrap-typeahead'));
    ?>

    <script type="text/javascript">
      $("#projectModal").modal({
        backdrop: false
      });
      $("#projectModal").modal("hide");

      $(window).load(function(){
        // $('#last .post').wookmark({
        //   container: $('#last'),
        //   offset: 30
        // });
        $('#lastWrap').isotope({
          itemSelector : '.post',
          layoutMode : 'fitRows'
        });
      });

      // $(function(){
      //   $("form#PostAddForm input#PostVisuel").change(function(){
      //     $("div#visuForm").html(this.value);
      //   });
      // });

      function prevVisu(input) {
        if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function(e){
            $("div#visuForm").html("<img class='img-polaroid' src='" + e.target.result + "' alt='Preview du visuel'>");
          };
          reader.readAsDataURL(input.files[0]);
        }
      }

      var uvOptions = {};
      (function() {
        var uv = document.createElement('script'); uv.type = 'text/javascript'; uv.async = true;
        uv.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'widget.uservoice.com/OhK0RfUhGvMIRwKYbLSw.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(uv, s);
      })();
    </script>
    
    <?php echo $this->element('debug'); ?>
    
  </body>
</html>