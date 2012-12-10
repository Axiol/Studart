<?php $this->set("title_for_layout", "Modifier son compte"); ?>

<div class="row">
  <section id="signup" class="span6 offset3">
    <h1>Modifier son compte</h1>
    <?php echo $this->Session->flash(); ?>

    <?php
      $grav_email = AuthComponent::user("mail");
      $grav_size = 100;
      $grav_url = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $grav_email ) ) ) . "?s=" . $grav_size;
    ?>
    <section id="modifAva"><img class="img-polaroid" src="<?php echo $grav_url ?>" width="100"><p>Votre avatar est géré par le service Gravatar. Pour le modifier, rendez vous <a href="https://fr.gravatar.com/" title="Se rendre sur le site de Gravatar">à cette adresse</a>.</p></section>
    
    <?php
      echo $this->Form->create("User",array("class" => "form-horizontal"));
      
        echo $this->Form->input("firstname",array(
          "div" => "control-group",
          "class" => "input-xlarge",
          "label" => array(
            "class" => "control-label",
            "text" => "Prénom : "
          ),
          "between" => "<div class='controls'>",
          "after" => "</div>"
        ));
        echo $this->Form->input("lastname",array(
          "div" => "control-group",
          "class" => "input-xlarge",
          "label" => array(
            "class" => "control-label",
            "text" => "Nom : "
          ),
          "between" => "<div class='controls'>",
          "after" => "</div>"
        ));
        
        echo $this->Form->input("description",array(
          "div" => "control-group",
          "class" => "input-xlarge",
          "label" => array(
            "class" => "control-label",
            "text" => "Bio : "
          ),
          "between" => "<div class='controls'>",
          "after" => "</div>",
          "type" => "textarea"
        ));
        echo $this->Form->input("local",array(
          "div" => "control-group",
          "class" => "input-xlarge",
          "label" => array(
            "class" => "control-label",
            "text" => "Localisation : "
          ),
          "between" => "<div class='controls'>",
          "after" => "</div>"
        ));
        
        echo $this->Form->input("twitter",array(
          "div" => "control-group",
          "class" => "input-xlarge",
          "label" => array(
            "class" => "control-label",
            "text" => "Twitter : "
          ),
          "between" => "<div class='controls'>",
          "after" => "</div>"
        ));
        echo $this->Form->input("facebook",array(
          "div" => "control-group",
          "class" => "input-xlarge",
          "label" => array(
            "class" => "control-label",
            "text" => "Facebook : "
          ),
          "between" => "<div class='controls'>",
          "after" => "</div>"
        ));
        echo $this->Form->input("gplus",array(
          "div" => "control-group",
          "class" => "input-xlarge",
          "label" => array(
            "class" => "control-label",
            "text" => "Google+ : "
          ),
          "between" => "<div class='controls'>",
          "after" => "</div>"
        ));
        echo $this->Form->input("github",array(
          "div" => "control-group",
          "class" => "input-xlarge",
          "label" => array(
            "class" => "control-label",
            "text" => "Github : "
          ),
          "between" => "<div class='controls'>",
          "after" => "</div>"
        ));
        echo $this->Form->input("website",array(
          "div" => "control-group",
          "class" => "input-xlarge",
          "label" => array(
            "class" => "control-label",
            "text" => "Site Web : "
          ),
          "between" => "<div class='controls'>",
          "after" => "</div>"
        ));
        
        ?><section id="modifPass">
        <p>Si vous souhaitez modifier votre mot de passe, remplissez ces deux champs, sinon, laissez les vide.</p><?php
        echo $this->Form->input("pass1",array(
          "div" => "control-group",
          "class" => "input-xlarge",
          "label" => array(
            "class" => "control-label",
            "text" => "Mot de passe : "
          ),
          "between" => "<div class='controls'>",
          "after" => "</div>"
        ));
        echo $this->Form->input("pass2",array(
          "div" => "control-group",
          "class" => "input-xlarge",
          "label" => array(
            "class" => "control-label",
            "text" => "Confirmer : "
          ),
          "between" => "<div class='controls'>",
          "after" => "</div>"
        ));
        ?></section><?php
    ?>
    <div class="controls">
      <?php
        echo $this->Form->end(
          array(
            "label" => "Enregistrer",
            "class" => "btn"
          )
        );
      ?>
    </div>
  </section>
</div>