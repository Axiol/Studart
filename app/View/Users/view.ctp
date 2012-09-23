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
        $this->Html->image("http://maps.googleapis.com/maps/api/staticmap?zoom=10&size=170x150&markers=color:green%7C".$user["User"]["local"]."&sensor=true",array("alt" => "Map de localisation")),
        "https://maps.google.be/maps?q=".$user["User"]["local"],
        array("escape" => false)
      ) ?>
    <?php endif; ?>
    <?php if(AuthComponent::user("id") == $user["User"]["id"]) {
      echo $this->Html->link("Editer mon profile",array("controller" => "users", "action" => "edit"),array("class" => "btn"));
    } ?>
  </section>
  <section id="last" class="span9 offset1">
    <h1>Ses derniers posts</h1>
    <div class="row">
    <?php foreach ($user["Post"] as $post): ?>
      <article class="post span3">
        <section>
          <h1><?php echo substr($post["title"],0,20); ?></h1>
          <p><?php echo substr($post["description"],0,75); ?>...</p>
          <div class="btn-post">
            <a class="love" href="#"><i class="icon-heart icon-white"></i></a>
            <a class="comment" href="#"><i class="icon-comment icon-white"></i></a>
          </div>
        </section>
        <a href="<?php echo $this->Html->url(array('controller' => 'posts', 'action' => 'view', $post['id']), true); ?>"><?php echo $this->Html->image("posts/thumb-".substr($post["image"],0,-4).".jpg", array("alt" => $post["title"])); ?></a>
      </article>
    <?php endforeach; ?>
    </div>
  </section>
</div>