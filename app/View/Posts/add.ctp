<?php $this->set("title_for_layout", "Poster une contribution"); ?>

<?php $proBrut = $this->requestAction(array("controller" => "Projects", "action" => "plist"));
$proTab = array();
foreach ($proBrut as $p){
  $proTab[$p["Project"]["id"]] = $p["Project"]["title"];
} ?>

<div class="row">
  <section id="signup" class="span6 offset3">
    <h1>Poster une contribution</h1>
    <?php echo $this->Session->flash(); ?>
    <div class="tabbable">
      <ul class="nav nav-tabs">
        <li class="active"><a href="#tab1" data-toggle="tab">Image</a></li>
        <li><a href="#tab2" data-toggle="tab">Modèle 3D</a></li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane active" id="tab1">
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
                "autofocus" => "autofocus",
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
                "autofocus" => "autofocus",
                "label" => array(
                  "class" => "control-label",
                  "text" => "Tags : "
                ),
                "between" => "<div class='controls'>",
                "after" => "</div>"
              )); ?>

              <div class="control-group newPro">
                <div class="controls">
                  <p>Séparés les par une virgule</p>
                </div>
              </div>
              
              <?php echo $this->Form->input("visuel",array(
                "div" => "control-group",
                "onchange" => "prevVisu(this);",
                "label" => array(
                  "class" => "control-label",
                  "text" => "Image : "
                ),
                "between" => "<div class='controls'>",
                "after" => "<div id='visuForm'></div></div>",
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
        </div>
        <div class="tab-pane" id="tab2">
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
                "autofocus" => "autofocus",
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
                "autofocus" => "autofocus",
                "label" => array(
                  "class" => "control-label",
                  "text" => "Tags : "
                ),
                "between" => "<div class='controls'>",
                "after" => "</div>"
              )); ?>

              <div class="control-group newPro">
                <div class="controls">
                  <p>Séparés les par une virgule</p>
                </div>
              </div>
              
              <?php echo $this->Form->input("model",array(
                "div" => "control-group",
                "onchange" => "modelPath(this);",
                "label" => array(
                  "class" => "control-label",
                  "text" => "Modèle 3D : "
                ),
                "between" => "<div class='controls'>",
                "after" => "</div>",
                "type" => "file"
              ));
              
              echo $this->Form->hidden("pathModel",array(
                "value" => ""
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
        </div>
      </div>
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
        "id" => "modalTitle",
        "required" => "required",
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
        "id" => "modalDesc",
        "required" => "required",
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

      echo $this->Form->end();
    ?>
    <p id="whatPro">Chaqu'une de vos publications doit être rangée dans un projet. Un peu comme pour organiser vos images par dossier.</p>
  </div>
  <div class="modal-footer">
    <button onclick="if(document.getElementById('modalTitle').value != '' && document.getElementById('modalDesc').value != ''){document.getElementById('ProjectAddForm').submit();}" class="btn btn-primary">Créer</button>
  </div>
</div>