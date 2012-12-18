<?php $this->set("title_for_layout", $project["Project"]["title"]); ?>

<?php echo $this->Session->flash(); ?>

<section id="last" class="row">
  <h1><?php echo $project["Project"]["title"] ?> <span class="authPro">par <?php echo $this->Html->link($project["User"]["username"],array("action" => "view","controller" => "users",$project["User"]["id"])); ?></span></h1>
  <p id="descPro"><?php echo $project["Project"]["description"] ?> <?php if($project['Project']['user_id'] == AuthComponent::user("id")){ echo "(".$this->Html->link("Editer", array("action" => "edit", "controller" => "projects", $project["Project"]["id"])).")"; } ?></p>

  <?php foreach ($project["Post"] as $post): ?>
    <article class="post span3">
      <a class="commLink" href="#">&nbsp;</a>
      <a class="linkWrap" href="<?php echo $this->Html->url(array('controller' => 'posts', 'action' => 'view', $post['id']), true); ?>">
        <section>
          <h1><?php echo $post["title"]; ?></h1>
          <p><?php echo substr($post["description"],0,75); ?>...</p>
          <div class="btn-post">
            <?php $likeNot = false;
            if(AuthComponent::user("id")){
              foreach($post["Like"] as $like):
                if ($like["user_id"] == AuthComponent::user("id")){
                  $likeNot = true;
                }
              endforeach;
              if($likeNot == true) { ?>
                <p class="love loveOK"><?php echo $post["like_count"]; ?></p>
              <?php } else { ?>
                <p class="love"><?php echo $post["like_count"]; ?></p>
              <?php }
            } else { ?>
              <p class="love"><?php echo $post["like_count"]; ?></p>
            <?php } ?>
            <p class="comment"><i class="icon-comment icon-white"></i></p>
          </div>
        </section>
        <?php if ($post["image"] != "") { 
          echo $this->Html->image("posts/thumb-".substr($post["image"],0,-4).".jpg", array("alt" => $post["title"]));
        } elseif ($post["model"] != "") { ?>
          <img src="https://sketchfab.com/urls/<?php echo $post["model"] ?>/thumbnail_854.png" alt="<?php echo $post["title"] ?>">
        <?php } ?>
      </a>
    </article>
  <?php endforeach; ?>
</section>