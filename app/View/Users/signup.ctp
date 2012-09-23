<?php $this->set("title_for_layout", "S'enregistrer"); ?>

<div class="row">
  <section id="signup" class="span6 offset3">
    <h1>S'enregistrer</h1>
    <?php echo $this->Session->flash(); ?>
    <?php
      echo $this->Form->create("User",array("class" => "form-horizontal"));
        echo $this->Form->input("username",array(
          "div" => "control-group",
          "class" => "input-xlarge",
          "label" => array(
            "class" => "control-label",
            "text" => "Login : "
          ),
          "between" => "<div class='controls'>",
          "after" => "</div>"
        ));
        echo $this->Form->input("mail",array(
          "div" => "control-group",
          "class" => "input-xlarge",
          "label" => array(
            "class" => "control-label",
            "text" => "Email : "
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
      <?php
        echo $this->Form->end(
          array(
            "label" => "S'enregistrer",
            "class" => "btn"
          )
        );
      ?>
    </div>
  </section>
</div>