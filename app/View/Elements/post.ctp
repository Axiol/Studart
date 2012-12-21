<article class="post span3">
  <a class="commLink" href="#">&nbsp;</a>
  <a class="linkWrap" href="<?php echo $this->Html->url(array('controller' => 'posts', 'action' => 'view', $post['id']), true); ?>">
    <section>
      <h1><?php echo $post["title"]; ?></h1>
      <p>Un post de <?php echo $user["username"]; ?></p>
      <div class="btn-post">
        <?php $likeNot = false;
        if(AuthComponent::user("id")){
          foreach($likes as $like):
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
    <div class="previsu">
      <?php if ($post["image"] != "") { 
        echo $this->Html->image("posts/thumb-".substr($post["image"],0,-4).".jpg", array("alt" => $post["title"]));
      } elseif ($post["model"] != "") { ?>
        <img src="https://sketchfab.com/urls/<?php echo $post["model"] ?>/thumbnail_854.png" alt="<?php $post["title"] ?>">
      <?php } ?>
      <div class="wrapTexte">
        <p><?php echo $post["description"]; ?></p>
      </div>
    </div>
  </a>
</article>