<?php
class Like extends AppModel{

  public $belongsTo = array("User", "Post" => array("counterCache" => true));

  public $actsAs = array("Containable");

}