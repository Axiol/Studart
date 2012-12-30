<?php $this->set("title_for_layout", "À Propos"); ?>

<?php echo $this->Session->flash(); ?>

<section id="last" class="row">
  <h1 id="aboutH">À Propos</h1>
  <div class="span6 offset3 aboutC">
    <?php echo $this->Html->image('StudArt.png', array('alt' => 'Logo de StudArt')); ?>
    <p>StudArt est une plateforme permettant aux jeunes graphistes de partager leurs créations. L'idée derrière ce projet est de partager l'évolution des projets des utilisateurs. C'est pour ça que chaque publication est rangée dans un projet, pour inciter l'utilisateur à poster des petits aperçus de son avancement pour ainsi pouvoir recevoir des retours bien précis sur ces travaux.</p>
    <p><?php echo $this->Html->link("Il ne vous reste plus qu'à vous inscrite !", array("controller" => "users", "action" => "signup")) ?></p>
  </div>
</section>
