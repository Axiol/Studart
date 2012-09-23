<?php $this->set("title_for_layout", "Récupérer sur mot de passe"); ?>

<div class="row">
  <section id="signup" class="span6 offset3">
    <h1>Récupérer votre mot de passe</h1>
    <?php echo $this->Session->flash(); ?>
    <?php
      echo $this->Form->create("User",array("class" => "form-horizontal"));
        echo $this->Form->input("mail",array(
          "div" => "control-group",
          "label" => array(
            "class" => "control-label",
            "text" => "Votre email : "
          ),
          "between" => "<div class='controls'>",
          "after" => "</div>"
        ));
    ?>
    <div class="controls">
      <?php
        echo $this->Form->end(
          array(
            "label" => "Envoyer",
            "class" => "btn"
          )
        );
      ?>
    </div>
  </section>
</div>