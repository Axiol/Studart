<?php $this->set("title_for_layout", "Profil de ".$user["User"]["username"]); ?>

<?php echo $this->Session->flash(); ?>

<div id="profil-intro" class="row">
  <section id="self" class="span2">
    <?php
      $grav_email = $user["User"]["mail"];
      $grav_size = 170;
      $grav_url = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $grav_email ) ) ) . "?s=" . $grav_size;
      echo $this->Html->image($grav_url, array("alt" => "Avatar de ".$user["User"]["username"],"class" => "img-polaroid"));
    ?>
    <h1><?php echo $user["User"]["username"]; ?></h1>
    <?php if($user["User"]["firstname"]): ?><h2><?php if($user["User"]["firstname"]): echo $user["User"]["firstname"]; endif; ?> <?php if($user["User"]["lastname"]): echo $user["User"]["lastname"]; endif; ?></h2><?php endif; ?>
    <?php if($user["User"]["description"]): ?><p><?php echo $user["User"]["description"] ?></p><?php endif; ?>
    <ul class="unstyled">
      <?php if($user["User"]["twitter"]): ?><a href="https://twitter.com/<?php echo $user["User"]["twitter"] ?>"><li><i class="icon-twitter icon-large"></i> Twitter</li></a><?php endif; ?>
      <?php if($user["User"]["facebook"]): ?><a href="https://www.facebook.com/<?php echo $user["User"]["facebook"] ?>"><li><i class="icon-facebook icon-large"></i> Facebook</li></a><?php endif; ?>
      <?php if($user["User"]["gplus"]): ?><a href="https://plus.google.com/<?php echo $user["User"]["gplus"] ?>/posts"><li><i class="icon-google-plus icon-large"></i> Google+</li></a><?php endif; ?>
      <?php if($user["User"]["github"]): ?><a href="https://github.com/<?php echo $user["User"]["github"] ?>"><li><i class="icon-github icon-large"></i> Github</li></a><?php endif; ?>
      <?php if($user["User"]["website"]): ?><a href="<?php echo $user["User"]["website"] ?>"><li><i class="icon-link icon-large"></i> Website</li></a><?php endif; ?>
    </ul>
    <?php if($user["User"]["local"]): ?>
      <?php echo $this->Html->Link(
        $this->Html->image("http://maps.googleapis.com/maps/api/staticmap?zoom=11&size=170x150&markers=color:green%7C".$user["User"]["local"]."&sensor=true",array("alt" => "Map de localisation")),
        "https://maps.google.be/maps?q=".$user["User"]["local"],
        array("escape" => false)
      ) ?>
    <?php endif; ?>
    <?php if(AuthComponent::user("id") == $user["User"]["id"]) {
      echo $this->Html->link("Editer mon profil",array("controller" => "users", "action" => "edit"),array("class" => "btn"));
    } ?>
  </section>
  <section id="last" class="span9 offset1">
    <h1>Ses derniers posts</h1>
    <div id="lastWrap" class="row">
    <?php foreach ($user["Post"] as $post): ?>
      <article class="post span3">
        <a class="commLink" href="#">&nbsp;</a>
        <a class="linkWrap" href="<?php echo $this->Html->url(array('controller' => 'posts', 'action' => 'view', $post['id']), true); ?>">
          <section>
            <h1><?php echo substr($post["title"],0,20); ?></h1>
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
          <?php echo $this->Html->image("posts/thumb-".substr($post["image"],0,-4).".jpg", array("alt" => $post["title"])); ?>
        </a>
      </article>
    <?php endforeach; ?>
    </div>
    <section id="lastPro">
      <h1>Ses projets</h1>
      <div class="row">
      <?php foreach ($user["Project"] as $project): ?>
        <div class="infoPro">
          <h1><?php echo $this->Html->link($project["title"],array("action" => "view","controller" => "projects",$project["id"])); ?></h1>
          <p><?php echo $project["description"] ?></p>
          <p>
            <?php foreach ($project["Post"] as $post): ?>
              <?php 
                echo $this->Html->link(
                  $this->Html->image("posts/thumb-".substr($post["image"],0,-4).".jpg", array("alt" => $post["title"],"class" => "img-polaroid")),
                  array("action" => "view", "controller" => "posts", $post["id"]),
                  array("escape" => false)
                );
              ?>
            <?php endforeach; ?>
          </p>
        </div>
      <?php endforeach; ?>
      </div>
    </section>
  </section>
</div>