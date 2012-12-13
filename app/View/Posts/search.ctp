<?php $this->set("title_for_layout", "Recherche pour ".$keyword); ?>

<?php echo $this->Session->flash(); ?>

<section id="last" class="row">
  <h1>Recherche pour "<?php echo $keyword; ?>"</h1>
    <?php if(count($posts) != 0) { ?>
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
              <section><?php echo $this->Html->image("posts/thumb-".substr($post["Post"]["image"],0,-4).".jpg", array("alt" => $post["Post"]["title"])); ?></section>
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