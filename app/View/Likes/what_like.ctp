<?php $this->set("title_for_layout", "Posts likés par ".$likes["0"]["User"]["username"]); ?>

<?php echo $this->Session->flash(); ?>

<section id="last" class="row">
  <h1>Les posts likés par <?php echo $this->Html->link($likes["0"]["User"]["username"], array("controller" => "users", "action" => "view", $likes["0"]["User"]["id"])); ?></h1>
  <div id="lastWrap">
    <?php foreach ($likes as $like):
      echo $this->element("post", array("post" => $like["Post"], "likes" => $like["Post"]["Like"], "user" => $like["Post"]["User"]));
    endforeach; ?>
  </div>
</section>
  