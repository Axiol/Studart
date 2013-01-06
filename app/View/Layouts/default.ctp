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
    <h1 class="hide">StudArt</h1>
    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <?php echo $this->Html->link("StudArt","/",array('class' => 'brand', 'title' => 'StudArt')); ?>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li class="home <?php if($this->request->controller == "posts" && $this->request->action == "index"){ echo "active"; } ?>"><?php echo $this->Html->link("Accueil","/",array("title" => "Retour à la page d'accueil")); ?></li>
              <li class="about <?php if($this->request->controller == "pages" && $this->request->action == "about"){ echo "active"; } ?>"><?php echo $this->Html->link("À Propos",array("controller" => "pages", "action" => "about"),array("title" => "Savoir ce qu'est ce site")); ?></li>
              <li class="contact <?php if($this->request->controller == "contact" && $this->request->action == "index"){ echo "active"; } ?>"><?php echo $this->Html->link("Contact",array("controller" => "contact", "action" => "index"),array("title" => "Entrer en contact avec l'équipe")); ?></li>
            </ul>
            <ul class="nav pull-right">
              <?php if(AuthComponent::user("id")): ?>
                <?php
                  $grav_email = AuthComponent::user("mail");
                  $grav_size = 25;
                  $grav_url = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $grav_email ) ) ) . "?s=" . $grav_size;
                ?>
                <li><a title="Voir son profil" href="<?php echo $this->Html->url(array("action" => "view","controller" => "users",AuthComponent::user("id"))); ?>"><img src="<?php echo $grav_url ?>" width="25"> <?php echo AuthComponent::user("username") ?></a></li>
                <li><?php echo $this->Html->link("Ajouter",array("action" => "add","controller" => "posts"),array("title" => "Publier quelque chose")); ?></li>
                <li><?php echo $this->Html->link("Se déconnecter",array("action" => "logout","controller" => "users"),array("title" => "Se déconnecter")); ?></li>
              <?php else: ?>
                <li><?php echo $this->Html->link("S'inscrire",array("action" => "signup","controller" => "users"),array("title" => "S'inscrire sur StudArt")); ?></li>
                <li><?php echo $this->Html->link("Se connecter",array("action" => "login","controller" => "users"),array("title" => "Se connecter")); ?></li>
              <?php endif; ?>
              <li class="visible-desktop"><a title="Lancer une recherche" href="#searchModal" role="button" data-toggle="modal"><i class="icon-search icon-large"></i></a></li>
              <li class="hidden-desktop">
                <?php echo $this->Form->create("Post",array("action" => "search"));
                echo $this->Form->input("keyword",array(
                  "label" => "",
                  "type" => "search",
                  "placeholder" => "Recherche..."
                ));
                echo $this->Form->end(); ?>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    
    <div class="container">
    
      <?php echo $this->fetch('content'); ?>

      <div class="modal" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h3 id="myModalLabel">Faire une recherche</h3>
        </div>
        <div class="modal-body">
          <?php
            echo $this->Form->create("Post", array("url" => array("action" => "search", "id" => "searchForm")));

            echo $this->Form->input("keyword",array(
              "div" => "control-group",
              "class" => "input-xlarge",
              "id" => "modalKey",
              "required" => "required",
              "label" => array(
                "class" => "control-label",
                "text" => "Qu'elle est votre recherche : "
              ),
              "between" => "<div class='controls'>",
              "after" => "</div>"
            ));

            echo $this->Form->end();
          ?>
          <p id="whatPro">Ou vous souhaitez peut-être faire une recherche pas tag ?</p>
          <section>
            <h1 class="hide">Faire une recherche par tag</h1>
            <?php foreach ($Alltags as $tag): ?>
              <a class="tagsWrap" href="<?php echo $this->Html->url(array('action' => 'tag', $tag['Tag']['name'])) ?>" title="Voir les autres posts ayant ce tag"><span class="tags"><?php echo $tag['Tag']["name"]." (".$tag['Tag']["count"].")"; ?></span></a>
            <?php endforeach; ?>
          </section>
        </div>
        <div class="modal-footer">
          <button onclick="document.getElementById('PostIndexForm').submit();" class="btn btn-primary">Rechercher</button>
        </div>
      </div>
  
      <footer>
        <p>&copy; StudArt 2012</p>
        <p>par <?php echo $this->Html->link("A•rnaud", "http://a.rnaud.be"); ?></p>
      </footer>
      
    </div>
     
    <?php
      echo $this->Html->script(array('jquery-ck', 'isotope-ck', 'jquery.autocomplete-ck', 'bootstrap-alert-ck', 'bootstrap-modal-ck', 'bootstrap-dropdown-ck', 'bootstrap-tab-ck', 'bootstrap-button-ck', 'bootstrap-collapse-ck', 'bootstrap-typeahead-ck', 'scripts-ck'));
      if ($this->request->controller == "posts" && $this->request->action == "add") { ?>
        <script type="text/javascript">
          $(function(){
            $("input#PostTags").autocomplete({
              serviceUrl:'service/autocomplete.ashx',
              minChars:2,
              delimiter: ",",
              maxHeight:400,
              width:300,
              zIndex: 9999,
              deferRequestBy: 0,
              params: { country:'Yes' },
              noCache: false,
              lookup: [
                <?php foreach ($tagsSug as $tag):
                  echo "'".$tag['Tag']["name"]."',";
                endforeach; ?>
              ]
            });
          });
        </script>
      <?php }
    ?>
    
    <?php echo $this->element('debug'); ?>
    
  </body>
</html>