<?php
class Like extends AppModel{

  public $belongsTo = array("User", "Post");

  public $actsAs = array("Containable");

}