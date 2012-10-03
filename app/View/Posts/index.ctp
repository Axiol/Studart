<?php $this->set("title_for_layout", "Accueil"); ?>

<?php echo $this->Session->flash(); ?>

<section id="popu" class="row">
  <h1>Les populaires du mois</h1>
  <?php foreach ($popu as $post): ?>
    <article class="post span3">
      <section>
        <h1><?php echo substr($post["Post"]["title"],0,20); ?></h1>
        <p><?php echo substr($post["Post"]["description"],0,75); ?>...</p>
        <div class="btn-post">
          <?php $likeNot = false;
          if(AuthComponent::user("id")){
            foreach($post["Like"] as $like):
              if ($like["user_id"] == AuthComponent::user("id")){
                $likeNot = true;
              }
            endforeach;
            if($likeNot == true) { ?>
              <a class="love loveOK" href="<?php echo $this->Html->url(array('controller' => 'likes', 'action' => 'unlike', '?' => array('user_id' => AuthComponent::user("id"), 'post_id' => $post['Post']['id']))) ?>"><i class="icon-heart icon-white"></i></a>
              <script type="text/javascript">console.log("Cool");</script>
            <?php } else {
              echo $this->Form->create("Like", array("url" => array("controller" => "likes", "action" => "like"), "id" => "LikeViewForm".$post["Post"]["id"]));
              echo $this->Form->hidden("user_id",array(
                "value" => AuthComponent::user("id")
              ));
              echo $this->Form->hidden("post_id",array(
                "value" => $post["Post"]["id"]
              ));
              echo $this->Form->end(); ?>
              <a class="love" href="#" onclick="event.preventDefault(); document.getElementById('LikeViewForm<?php echo $post["Post"]["id"] ?>').submit();"><i class="icon-heart icon-white"></i></a>
              <script type="text/javascript">console.log("Pas cool");</script>
            <?php }
          } else { ?>
            <a class="love" href="#" onclick="event.preventDefault();"><i class="icon-heart icon-white"></i></a>
          <?php } ?>
          <a class="comment" href="#"><i class="icon-comment icon-white"></i></a>
        </div>
      </section>
      <a href="<?php echo $this->Html->url(array('controller' => 'posts', 'action' => 'view', $post['Post']['id']), true); ?>"><?php echo $this->Html->image("posts/thumb-".substr($post["Post"]["image"],0,-4).".jpg", array("alt" => $post["Post"]["title"])); ?></a>
    </article>
  <?php endforeach; ?>
</section>

<section id="last" class="row">
  <h1>Les derniers posts</h1>
  <?php foreach ($posts as $post): ?>
    <article class="post span3">
      <section>
        <h1><?php echo substr($post["Post"]["title"],0,20); ?></h1>
        <p><?php echo substr($post["Post"]["description"],0,75); ?>...</p>
        <div class="btn-post">
          <?php $likeNot = false;
          if(AuthComponent::user("id")){
            foreach($post["Like"] as $like):
              if ($like["user_id"] == AuthComponent::user("id")){
                $likeNot = true;
              }
            endforeach;
            if($likeNot == true) { ?>
              <a class="love loveOK" href="<?php echo $this->Html->url(array('controller' => 'likes', 'action' => 'unlike', '?' => array('user_id' => AuthComponent::user("id"), 'post_id' => $post['Post']['id']))) ?>"><i class="icon-heart icon-white"></i></a>
              <script type="text/javascript">console.log("Cool");</script>
            <?php } else {
              echo $this->Form->create("Like", array("url" => array("controller" => "likes", "action" => "like"), "id" => "LikeViewForm".$post["Post"]["id"]));
              echo $this->Form->hidden("user_id",array(
                "value" => AuthComponent::user("id")
              ));
              echo $this->Form->hidden("post_id",array(
                "value" => $post["Post"]["id"]
              ));
              echo $this->Form->end(); ?>
              <a class="love" href="#" onclick="event.preventDefault(); document.getElementById('LikeViewForm<?php echo $post["Post"]["id"] ?>').submit();"><i class="icon-heart icon-white"></i></a>
              <script type="text/javascript">console.log("Pas cool");</script>
            <?php }
          } else { ?>
            <a class="love" href="#" onclick="event.preventDefault();"><i class="icon-heart icon-white"></i></a>
          <?php } ?>
          <a class="comment" href="#"><i class="icon-comment icon-white"></i></a>
        </div>
      </section>
      <a href="<?php echo $this->Html->url(array('controller' => 'posts', 'action' => 'view', $post['Post']['id']), true); ?>"><?php echo $this->Html->image("posts/thumb-".substr($post["Post"]["image"],0,-4).".jpg", array("alt" => $post["Post"]["title"])); ?></a>
    </article>
  <?php endforeach; ?>
</section>

<?php if(AuthComponent::user("id")): ?>
  <section id="newActi" class="row">
    <h1>Activités récentes</h1>
    <div class="span8">
      <?php foreach ($lastComm as $comment): ?>
        <div class="comment">
          <?php
            $grav_email = $comment["User"]["mail"];
            $grav_size = 50;
            $grav_url = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $grav_email ) ) ) . "?s=" . $grav_size;
            
            echo $this->Html->image($grav_url, array("alt" => "Avatar de ".$comment["User"]["username"]));
          ?>
          <blockquote>
            <p><?php echo $comment["Comment"]["content"] ?></p>
            <small>par <?php echo $this->Html->link($comment["User"]["username"],array("action" => "view","controller" => "users",$comment["User"]["id"])); ?></small>
          </blockquote>
        </div>
      <?php endforeach; ?>
    </div>
    <div class="span4">
      <?php foreach ($lastLike as $like): ?>
        <p><?php echo $this->Html->link($like["User"]["username"],array("action" => "view","controller" => "users",$like["User"]["id"])); ?> a aimé votre publication <?php echo $this->Html->link($like["Post"]["title"],array("action" => "view","controller" => "posts",$like["Post"]["id"])); ?></p>
      <?php endforeach; ?>
    </div>
  </section>
<?php endif; ?>