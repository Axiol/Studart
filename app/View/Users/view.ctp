<?php $this->set("title_for_layout", "Profil de ".$user["User"]["username"]); ?>

<?php echo $this->Session->flash(); ?>

<div id="profil-intro" class="row">
  <div itemscope itemtype="http://schema.org/Person">
    <section id="self" class="span2">
      <?php
        $grav_email = $user["User"]["mail"];
        $grav_size = 170;
        $grav_url = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $grav_email ) ) ) . "?s=" . $grav_size;
        echo $this->Html->image($grav_url, array("alt" => "Avatar de ".$user["User"]["username"],"class" => "img-polaroid avatar"));
      ?>
      <h1><?php echo $user["User"]["username"]; ?></h1>
      <?php if($user["User"]["firstname"]): ?><h2><span itemprop="name"><?php if($user["User"]["firstname"]): echo $user["User"]["firstname"]; endif; ?> <?php if($user["User"]["lastname"]): echo $user["User"]["lastname"]; endif; ?></span></h2><?php endif; ?>
      <?php if($user["User"]["description"]): ?><p><span itemprop="description"><?php echo $user["User"]["description"] ?></span></p><?php endif; ?>
      <ul class="unstyled">
        <?php if($user["User"]["twitter"]): ?><a title="Voir son compte Twitter" href="https://twitter.com/<?php echo $user["User"]["twitter"] ?>"><li><i class="icon-twitter icon-large"></i> Twitter</li></a><?php endif; ?>
        <?php if($user["User"]["facebook"]): ?><a title="Voir son compte Facebook" href="https://www.facebook.com/<?php echo $user["User"]["facebook"] ?>"><li><i class="icon-facebook icon-large"></i> Facebook</li></a><?php endif; ?>
        <?php if($user["User"]["gplus"]): ?><a title="Voir son compte Google+" href="https://plus.google.com/<?php echo $user["User"]["gplus"] ?>/posts"><li><i class="icon-google-plus icon-large"></i> Google+</li></a><?php endif; ?>
        <?php if($user["User"]["github"]): ?><a title="Voir son compte GitHub" href="https://github.com/<?php echo $user["User"]["github"] ?>"><li><i class="icon-github icon-large"></i> Github</li></a><?php endif; ?>
        <?php if($user["User"]["website"]): ?><a title="Voir son site Web" href="<?php echo $user["User"]["website"] ?>" itemprop="url"><li><i class="icon-link icon-large"></i> Website</li></a><?php endif; ?>
        <a title="Lui envoyer un mail" href="mailto:<?php echo $user['User']['mail'] ?>"><li><i class="icon-envelope-alt icon-large"></i> Mail</li></a>
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
  </div>
  <section id="last" class="span9 offset1">
    <h1>Ses derniers posts</h1>
    <div id="lastWrap" class="row">
      <?php if (count($posts) > 0) {
        foreach ($posts as $post):
          echo $this->element("post", array("post" => $post["Post"], "likes" => $post["Like"], "user" => $user["User"]));
        endforeach;
      } else { ?>
        <p>Cet utilisateur n'a encore rien posté.</p>
      <?php } ?>
    </div>
  </section>
  <section id="lastPro" class="span9 offset3">
    <h1>Ses projets</h1>
    <div class="row">
    <?php if (count($user["Project"] >0)) {
      foreach ($user["Project"] as $project): ?>
        <section class="infoPro">
          <h1><?php echo $this->Html->link($project["title"],array("action" => "view","controller" => "projects",$project["id"])); ?></h1>
          <p><?php echo $project["description"] ?></p>
          <p>
            <?php foreach ($project["Post"] as $post): ?>
              <?php 
                if ($post["image"] != "") {
                  echo $this->Html->link(
                    $this->Html->image("posts/thumb-".substr($post["image"],0,-4).".jpg", array("alt" => $post["title"],"class" => "img-polaroid")),
                    array("action" => "view", "controller" => "posts", $post["id"]),
                    array("escape" => false)
                  );
                } elseif ($post["model"] != "") {
                  echo $this->Html->link(
                    $this->Html->image("https://sketchfab.com/urls/".$post["model"]."/thumbnail_854.png", array("alt" => $post["title"],"class" => "img-polaroid dddPro")),
                    array("action" => "view", "controller" => "posts", $post["id"]),
                    array("escape" => false)
                  );
                }
              ?>
            <?php endforeach; ?>
          </p>
        </section>
      <?php endforeach;
    } else { ?>
      <p>Cet utilisateur n'as pas encore de projets.</p>
    <?php } ?>
    </div>
  </section>
  <section id="last" class="span9 offset3">
    <h1 id="likesTitle">Ses likes <span>(<?php echo $this->Html->link("les voir tous", array("controller" => "likes", "action" => "whatLike", $user["User"]["id"])); ?>)</span></h1>
    <div id="lastWrap" class="row">
      <?php if (count($likes)) {
        for ($i=0; $i < 3; $i++) { 
          echo $this->element("post", array("post" => $likes[$i]["Post"], "likes" => $likes[$i]["Post"]["Like"], "user" => $likes[$i]["Post"]["User"]));
        }
      } else { ?>
        <p>Cet utilisateur n'a encore liké aucun post.</p>
      <?php } ?>
    </div>
  </section>
</div>