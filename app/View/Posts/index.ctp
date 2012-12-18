<?php $this->set("title_for_layout", "Accueil"); ?>

<?php echo $this->Session->flash(); ?>

<?php if(isset($this->request->params['named']['page']) == false) { ?>
  <section id="popu" class="row">
    <h1>Les populaires du mois</h1>
    <?php foreach ($popu as $post): ?>
      <article class="post span3">
        <a class="commLink" href="#">&nbsp;</a>
        <a class="linkWrap" href="<?php echo $this->Html->url(array('controller' => 'posts', 'action' => 'view', $post['Post']['id']), true); ?>">
          <section>
            <h1><?php echo $post["Post"]["title"]; ?></h1>
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
                  <p class="love loveOK"><?php echo $post["Post"]["like_count"]; ?></p>
                <?php } else { ?>
                  <p class="love"><?php echo $post["Post"]["like_count"]; ?></p>
                <?php }
              } else { ?>
                <p class="love"><?php echo $post["Post"]["like_count"]; ?></p>
              <?php } ?>
              <p class="comment"><i class="icon-comment icon-white"></i></p>
            </div>
          </section>
          <?php if ($post["Post"]["image"] != "") { 
            echo $this->Html->image("posts/thumb-".substr($post["Post"]["image"],0,-4).".jpg", array("alt" => $post["Post"]["title"]));
          } elseif ($post["Post"]["model"] != "") { ?>
            <img src="https://sketchfab.com/urls/<?php echo $post["Post"]["model"] ?>/thumbnail_854.png" alt="<?php $post["Post"]["title"] ?>">
          <?php } ?>
        </a>
      </article>
    <?php endforeach; ?>
  </section>
<?php } ?>

<section id="last" class="row">
  <h1>Les derniers posts</h1>
  <?php echo $this->Form->create("Post",array("action" => "search", "id" => "searchForm", "class" => "visible-desktop"));
  echo $this->Form->input("keyword",array(
    "label" => "",
    "type" => "search",
    "placeholder" => "Recherche..."
  ));
  echo $this->Form->end(); ?>
  <div id="lastWrap">
    <?php foreach ($posts as $post): ?>
      <article class="post span3">
        <a class="commLink" href="#">&nbsp;</a>
        <a class="linkWrap" href="<?php echo $this->Html->url(array('controller' => 'posts', 'action' => 'view', $post['Post']['id']), true); ?>">
          <section>
            <h1><?php echo $post["Post"]["title"]; ?></h1>
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
                  <p class="love loveOK"><?php echo $post["Post"]["like_count"]; ?></p>
                <?php } else { ?>
                  <p class="love"><?php echo $post["Post"]["like_count"]; ?></p>
                <?php }
              } else { ?>
                <p class="love"><?php echo $post["Post"]["like_count"]; ?></p>
              <?php } ?>
              <p class="comment"><i class="icon-comment icon-white"></i></p>
            </div>
          </section>
          <?php if ($post["Post"]["image"] != "") { 
            echo $this->Html->image("posts/thumb-".substr($post["Post"]["image"],0,-4).".jpg", array("alt" => $post["Post"]["title"]));
          } elseif ($post["Post"]["model"] != "") { ?>
            <img src="https://sketchfab.com/urls/<?php echo $post["Post"]["model"] ?>/thumbnail_854.png" alt="<?php echo $post["Post"]["title"] ?>">
          <?php } ?>
        </a>
      </article>
    <?php endforeach; ?>
  </div>
  <?php $span = isset($span) ? $span : 8; ?>
  <?php $page = isset($this->request->params['named']['page']) ? $this->request->params['named']['page'] : 1; ?>
  <div class="pagination">
    <ul>
      <?php echo $this->Paginator->prev(
        "<<",
        array(
          'escape' => false,
          'tag' => 'li'
        ),
        '<a onclick="return false;"><<</a>',
        array(
          'class'=>'disabled prev',
          'escape' => false,
          'tag' => 'li'
        )
      );?>
      
      <?php $count = $page + $span; ?>
      <?php $i = $page - $span; ?>
      <?php while ($i < $count): ?>
        <?php $options = ''; ?>
        <?php if ($i == $page): ?>
          <?php $options = ' class="active"'; ?>
        <?php endif; ?>
        <?php if ($this->Paginator->hasPage($i) && $i > 0): ?>
          <li<?php echo $options; ?>><?php echo $this->Html->link($i, array("page" => $i)); ?></li>
        <?php endif; ?>
        <?php $i += 1; ?>
      <?php endwhile; ?>
      
      <?php echo $this->Paginator->next(
        ">>",
        array(
          'escape' => false,
          'tag' => 'li'
        ),
        '<a onclick="return false;">>></a>',
        array(
          'class' => 'disabled next',
          'escape' => false,
          'tag' => 'li'
        )
      );?>
    </ul>
  </div>
</section>

<?php if(AuthComponent::user("id")): ?>
  <?php if(isset($this->request->params['named']['page']) == false): ?>
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
<?php endif; ?>