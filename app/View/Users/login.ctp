<?php $this->set("title_for_layout", "Se connecter"); ?>

<div class="row">
  <section id="signup" class="span6 offset3">
    <h1>Se connecter</h1>
    <?php echo $this->Session->flash(); ?>
    <?php
      echo $this->Form->create("User",array("class" => "form-horizontal"));
        echo $this->Form->input("username",array(
          "div" => "control-group",
          "class" => "input-xlarge",
          "autofocus" => "autofocus",
          "label" => array(
            "class" => "control-label",
            "text" => "Login : "
          ),
          "between" => "<div class='controls'>",
          "after" => "</div>"
        ));
        echo $this->Form->input("password",array(
          "div" => "control-group",
          "class" => "input-xlarge",
          "label" => array(
            "class" => "control-label",
            "text" => "Mot de passe : "
          ),
          "between" => "<div class='controls'>",
          "after" => "</div>"
        ));
    ?>
    <div class="controls">
      <div class="whatmdp"><?php echo $this->Html->link("Mot de passe oublié ?",array("action" => "password","controller" => "users")); ?></div>
      <?php
        echo $this->Form->end(
          array(
            "label" => "Se connecter",
            "class" => "btn"
          )
        );
      ?>
    </div>
  </section>
</div>