<?php $this->set("title_for_layout", "Accueil"); ?>

<?php echo $this->Session->flash(); ?>

<section id="last" class="row">
  <h1>Les derniers posts</h1>
  <?php foreach ($posts as $post): ?>
    <article class="post span3">
      <section>
        <h1><?php echo substr($post["Post"]["title"],0,20); ?></h1>
        <p><?php echo substr($post["Post"]["description"],0,75); ?>...</p>
        <div class="btn-post">
          <a class="love" href="#"><i class="icon-heart icon-white"></i></a>
          <a class="comment" href="#"><i class="icon-comment icon-white"></i></a>
        </div>
      </section>
      <a href="<?php echo $this->Html->url(array('controller' => 'posts', 'action' => 'view', $post['Post']['id']), true); ?>"><?php echo $this->Html->image("posts/thumb-".substr($post["Post"]["image"],0,-4).".jpg", array("alt" => $post["Post"]["title"])); ?></a>
    </article>
  <?php endforeach; ?>
</section>