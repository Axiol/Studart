<?php $this->set("title_for_layout", "Posts avec le tag ".$posts[0]["Tag"]["name"]); ?>

<?php echo $this->Session->flash(); ?>

<section id="last" class="row">
  <h1>Les posts taggés avec "<?php echo $posts[0]["Tag"]["name"] ?>"</h1>
  <div id="lastWrap">
    <?php foreach ($posts as $post):
      echo $this->element("post", array("post" => $post["Post"], "likes" => $post["Post"]["Like"]));
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
</section>