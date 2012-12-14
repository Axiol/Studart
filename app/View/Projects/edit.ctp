<?php $this->set("title_for_layout", "Editer le projet"); ?>

<div class="row">
  <section id="signup" class="span6 offset3">
    <h1>Editer le projet</h1>
    <?php echo $this->Session->flash(); ?>
    <?php
      echo $this->Form->create("Project",array("class" => "form-horizontal","enctype" => "multipart/form-data"));
      
        echo $this->Form->input("title",array(
          "div" => "control-group",
          "class" => "input-xlarge",
          "label" => array(
            "class" => "control-label",
            "text" => "Titre : "
          ),
          "between" => "<div class='controls'>",
          "after" => "</div>"
        ));
        
        echo $this->Form->input("description",array(
          "div" => "control-group",
          "class" => "input-xlarge",
          "label" => array(
            "class" => "control-label",
            "text" => "Description : "
          ),
          "between" => "<div class='controls'>",
          "after" => "</div>",
          "type" => "textarea"
        ));
    ?>

    <div class="controls">
      <?php
        echo $this->Form->end(
          array(
            "label" => "Mettre à jour",
            "class" => "btn"
          )
        );
      ?>
    </div>
  </section>
</div>