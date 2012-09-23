<?php $this->set("title_for_layout", "Poster une publication"); ?>

<?php $proBrut = $this->requestAction(array("controller" => "Projects", "action" => "plist"));
$proTab = array();
foreach ($proBrut as $p){
  $proTab[$p["Project"]["id"]] = $p["Project"]["title"];
} ?>

<div class="row">
  <section id="signup" class="span6 offset3">
    <h1>Poster une contribution</h1>
    <?php echo $this->Session->flash(); ?>
    <?php
      echo $this->Form->create("Post",array("class" => "form-horizontal","enctype" => "multipart/form-data"));
      
        echo $this->Form->input("project_id",array(
          "options" => $proTab,
          "empty" => "Sélectionnez un projet",
          "div" => "control-group",
          "class" => "input-xlarge",
          "label" => array(
            "class" => "control-label",
            "text" => "Projet : "
          ),
          "between" => "<div class='controls'>",
          "after" => "</div>"
        )); ?>

        <div class="control-group newPro">
          <div class="controls">
            <a href="#projectModal" role="button" data-toggle="modal">Créer un nouveau projet</a>
          </div>
        </div>

        <?php echo $this->Form->input("title",array(
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
        
        echo $this->Form->input("visuel",array(
          "div" => "control-group",
          "label" => array(
            "class" => "control-label",
            "text" => "Image : "
          ),
          "between" => "<div class='controls'>",
          "after" => "</div>",
          "type" => "file"
        ));
        
        echo $this->Form->hidden("user_id",array(
          "value" => AuthComponent::user("id")
        ));
    ?>
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

<div class="modal" id="projectModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Créer un projet</h3>
  </div>
  <div class="modal-body">
    <?php
      echo $this->Form->create("Project", array("url" => array("controller" => "projects", "action" => "add")));

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

      echo $this->Form->hidden("user_id",array(
        "value" => AuthComponent::user("id")
      ));
    ?>
  </div>
  <div class="modal-footer">
    <button onclick="document.getElementById('ProjectAddForm').submit();" class="btn btn-primary">Créer</button>
  </div>
</div>