<?php $this->set("title_for_layout", "Accueil");

echo $this->Session->flash(); ?>

<?php if(isset($this->request->params['named']['page']) == false) { ?>
  <section id="popu" class="row">
    <h1>Les populaires du mois</h1>
    <?php foreach ($popu as $post):
      echo $this->element("post", array("post" => $post["Post"], "likes" => $post["Like"], "user" => $post["User"]));
    endforeach; ?>
  </section>
<?php } ?>

<section id="last" class="row">
  <h1>Les derniers posts</h1>
  <?php echo $this->Form->create("Post",array("action" => "search", "id" => "searchForm", "class" => "visible-desktop"));
  echo $this->Form->input("keyword",array(
    "label" => array(
      "class" => "hide",
      "text" => "Recherche : "
    ),
    "type" => "search",
    "placeholder" => "Recherche..."
  ));
  echo $this->Form->end(); ?>
  <div id="lastWrap">
    <?php foreach ($posts as $post):
      echo $this->element("post", array("post" => $post["Post"], "likes" => $post["Like"], "user" => $post["User"]));
    endforeach; ?>
  </div>
  <?php $span = isset($span) ? $span : 8;
  $page = isset($this->request->params['named']['page']) ? $this->request->params['named']['page'] : 1;
  echo $this->element("navigation", array("span" => $span, "page" => $page)); ?>
  
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
              <small>par <?php echo $this->Html->link($comment["User"]["username"],array("action" => "view","controller" => "users",$comment["User"]["id"])); ?> sur <?php echo $this->Html->link($comment["Post"]["title"],array("action" => "view","controller" => "posts",$comment["Post"]["id"])); ?></small>
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