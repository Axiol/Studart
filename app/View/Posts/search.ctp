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