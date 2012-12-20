<?php $this->set("title_for_layout", "Recherche pour ".$keyword); ?>

<?php echo $this->Session->flash(); ?>

<section id="last" class="row">
  <h1>Recherche pour "<?php echo $keyword; ?>"</h1>
    <?php if(count($posts) != 0) { ?>
      <div id="lastWrap">
        <?php foreach ($posts as $post):
          echo $this->element("post", array("post" => $post["Post"], "likes" => $post["Like"]));
        endforeach; ?>
      </div>
      <?php $span = isset($span) ? $span : 8;
      $page = isset($this->request->params['named']['page']) ? $this->request->params['named']['page'] : 1;
      echo $this->element("navigation", array("span" => $span, "page" => $page)); ?>
    <?php } else { ?>
      <section id="noResult">
        <p>Il n'y a aucun résultats pour votre recherche.</p>
        <div>
          <p>Recherchez peut-être parmis les tags</p>
          <?php foreach ($tags as $tag): ?>
            <a class="tagsWrap" href="<?php echo $this->Html->url(array('action' => 'tag', $tag['Tag']['name'])) ?>" title="Voir les autres posts ayant ce tag"><span class="tags"><?php echo $tag['Tag']["name"]." (".$tag['Tag']["count"].")"; ?></span></a>
          <?php endforeach; ?>
        </div>
      </section>
    <?php } ?>
</section>