<?php $this->set("title_for_layout", "Posts avec le tag ".$posts[0]["Tag"]["name"]); ?>

<?php echo $this->Session->flash(); ?>

<section id="last" class="row">
  <h1>Les posts taggés avec "<?php echo $posts[0]["Tag"]["name"] ?>"</h1>
  <div id="lastWrap">
    <?php foreach ($posts as $post):
      echo $this->element("post", array("post" => $post["Post"], "likes" => $post["Post"]["Like"]));
    endforeach; ?>
  </div>
  <?php $span = isset($span) ? $span : 8;
  $page = isset($this->request->params['named']['page']) ? $this->request->params['named']['page'] : 1;
  echo $this->element("navigation", array("span" => $span, "page" => $page)); ?>
</section>