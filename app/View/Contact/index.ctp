<?php $this->set("title_for_layout", "Nous contacter"); ?>

<div class="row">
  <section id="signup" class="span6 offset3">
    <h1>Nous contacter</h1>
    <?php echo $this->Session->flash(); ?>
    <?php echo $this->Form->create("Post",array("class" => "form-horizontal"));
    echo $this->Form->input("nom",array(
      "div" => "control-group",
      "class" => "input-xlarge",
      "autofocus" => "autofocus",
      "required" => "required",
      "label" => array(
        "class" => "control-label",
        "text" => "Votre nom : "
      ),
      "between" => "<div class='controls'>",
      "after" => "</div>"
    ));

    echo $this->Form->input("mail",array(
      "div" => "control-group",
      "class" => "input-xlarge",
      "required" => "required",
      "label" => array(
        "class" => "control-label",
        "text" => "Votre e-mail : "
      ),
      "between" => "<div class='controls'>",
      "after" => "</div>"
    ));

    echo $this->Form->input("message",array(
      "div" => "control-group",
      "class" => "input-xlarge",
      "required" => "required",
      "label" => array(
        "class" => "control-label",
        "text" => "Votre message : "
      ),
      "between" => "<div class='controls'>",
      "after" => "</div>",
      "type" => "textarea"
    )); ?>

    <div class="controls">
      <?php
        echo $this->Form->end(
          array(
            "label" => "Publier",
            "class" => "btn"
          )
        );
      ?>
    </div>
  </section>
</div>
  