<?php $this->set("title_for_layout", "Editer son compte"); ?>

<div class="row">
  <section id="signup" class="span6 offset3">
    <h1>Modifier son compte</h1>
    <?php echo $this->Session->flash(); ?>
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
    ?>
    <div class="controls">
      <?php
        echo $this->Form->end(
          array(
            "label" => "Modifier",
            "class" => "btn"
          )
        );
      ?>
    </div>
  </section>
</div>