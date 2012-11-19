<?php
class Project extends AppModel{

  public $belongsTo = "User";
  public $hasMany = "Post";

  public $actsAs = array("Containable");

}