<?php $this->set("title_for_layout", $project["Project"]["title"]); ?>

<?php echo $this->Session->flash(); ?>

<section id="last" class="row">
  <h1><?php echo $project["Project"]["title"] ?> <span class="authPro">par <?php echo $this->Html->link($project["User"]["username"],array("action" => "view","controller" => "users",$project["User"]["id"])); ?></span></h1>
  <p id="descPro"><?php echo $project["Project"]["description"] ?></p>

  <?php foreach ($project["Post"] as $post): ?>
    <article class="post span3">
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
              <a class="love loveOK" href="<?php echo $this->Html->url(array('controller' => 'likes', 'action' => 'unlike', '?' => array('user_id' => AuthComponent::user("id"), 'post_id' => $post['id']))) ?>"><i class="icon-heart icon-white"></i></a>
              <script type="text/javascript">console.log("Cool");</script>
            <?php } else {
              echo $this->Form->create("Like", array("url" => array("controller" => "likes", "action" => "like"), "id" => "LikeViewForm".$post["id"]));
              echo $this->Form->hidden("user_id",array(
                "value" => AuthComponent::user("id")
              ));
              echo $this->Form->hidden("post_id",array(
                "value" => $post["id"]
              ));
              echo $this->Form->end(); ?>
              <a class="love" href="#" onclick="event.preventDefault(); document.getElementById('LikeViewForm<?php echo $post["id"] ?>').submit();"><i class="icon-heart icon-white"></i></a>
              <script type="text/javascript">console.log("Pas cool");</script>
            <?php }
          } else { ?>
            <a class="love" href="#" onclick="event.preventDefault();"><i class="icon-heart icon-white"></i></a>
          <?php } ?>
          <a class="comment" href="#"><i class="icon-comment icon-white"></i></a>
        </div>
      </section>
      <a href="<?php echo $this->Html->url(array('controller' => 'posts', 'action' => 'view', $post['id']), true); ?>"><?php echo $this->Html->image("posts/thumb-".substr($post["image"],0,-4).".jpg", array("alt" => $post["title"])); ?></a>
    </article>
  <?php endforeach; ?>
</section>