<?php $this->set("title_for_layout", $project["Project"]["title"]); ?>

<?php echo $this->Session->flash(); ?>

<section id="last" class="row">
  <h1 id="projectTile"><?php echo $project["Project"]["title"] ?> <span class="authPro">par <?php echo $this->Html->link($project["User"]["username"],array("action" => "view","controller" => "users",$project["User"]["id"])); ?></span></h1>
  <p id="descPro"><?php echo $project["Project"]["description"] ?> <?php if($project['Project']['user_id'] == AuthComponent::user("id")){ echo "(".$this->Html->link("Editer", array("action" => "edit", "controller" => "projects", $project["Project"]["id"])).")"; } ?></p>
  <p id="ordrePro">Publications de la plus ancienne à la plus récente.</p>

  <?php foreach ($project["Post"] as $post):
    echo $this->element("post", array("post" => $post, "likes" => $post["Like"], "user" => $post["User"]));
  endforeach; ?>
</section>