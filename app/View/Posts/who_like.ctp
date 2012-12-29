<?php $this->set("title_for_layout", "Liste des membres qui aiment ".$post["Post"]["title"]);

echo $this->Session->flash(); ?>

<section id="last" class="row">
  <h1 id="listLike">Les membres aimant "<a href="<?php echo $this->Html->url(array("controller" => "posts", "action" => "view", $post["Post"]["id"])); ?>" title="Voir <?php echo $post["Post"]["title"] ?>"><?php echo $post["Post"]["title"] ?></a>"</h1>
  <?php foreach ($post["Like"] as $like) { ?>
    <section class="userLike">
      <div class="whoUser span6">
        <a href="<?php echo $this->Html->url(array("controller" => "users", "action" => "view", $like["User"]["id"])); ?>" title="Voir le profil de <?php echo $like['User']['username'] ?>">
        <?php $grav_email = $like["User"]["mail"];
        $grav_size = 80;
        $grav_url = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $grav_email ) ) ) . "?s=" . $grav_size;
        echo $this->Html->image($grav_url, array("alt" => "Avatar de ".$like["User"]["username"],"class" => "img-polaroid avatar")); ?>
        <h1><?php echo $like["User"]["username"]; ?></h1>
        <?php if($like["User"]["firstname"]): ?><h2><?php if($like["User"]["firstname"]): echo $like["User"]["firstname"]; endif; ?> <?php if($like["User"]["lastname"]): echo $like["User"]["lastname"]; endif; ?></h2><?php endif; ?>
        </a>
      </div>
      <div class="whatUser span6">
        <?php for ($i=0; $i <= 2; $i++) { ?>
          <a href="<?php echo $this->Html->url(array("controller" => "posts", "action" => "view", $like["User"]["Post"][$i]["id"])); ?>" title="<?php echo $like['User']['Post'][$i]['title'] ?>">
            <?php if ($like["User"]["Post"][$i]["image"] != "") { 
              echo $this->Html->image("posts/thumb-".substr($like["User"]["Post"][$i]["image"],0,-4).".jpg", array("alt" => $like["User"]["Post"][$i]["title"], "class" => "img-polaroid"));
            } elseif ($like["User"]["Post"][$i]["model"] != "") { ?>
              <img src="https://sketchfab.com/urls/<?php echo $like["User"]["Post"][$i]["model"] ?>/thumbnail_854.png" alt="<?php $like["User"]["Post"][$i]["title"] ?>" class="img-polaroid">
            <?php } ?>
          </a>
        <?php } ?>
      </div>
    </section>
  <?php } ?>
</section>
  