<?php $this->set("title_for_layout", "Editer la publication"); ?>

<div class="row">
  <section id="signup" class="span6 offset3">
    <h1>Editer la publication</h1>
    <?php echo $this->Session->flash(); ?>
    <?php
      echo $this->Form->create("Post",array("class" => "form-horizontal","enctype" => "multipart/form-data"));
      
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

        echo $this->Form->input("tags",array(
          "div" => "control-group",
          "class" => "input-xlarge",
          "label" => array(
            "class" => "control-label",
            "text" => "Tags : "
          ),
          "between" => "<div class='controls'>",
          "after" => "</div>"
        ));
    ?>

    <div class="control-group newPro">
      <div class="controls">
        <p>Séparés les par une virgule</p>
        <p>
          <?php foreach ($this->data["Tag"] as $tag): ?>
            <span class="tags delAja"><?php echo $tag["name"]; ?>
              <?php echo $this->Html->link('x', array(
                'action' => 'deltag',
                '?' => array('post_id' => $this->data["Post"]["id"], 'tag_id' => $tag["id"]))
              ); ?>
            </span>
          <?php endforeach; ?>
        </p>
      </div>
    </div>

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