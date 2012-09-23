<?php
class Project extends AppModel{

  public $belongsTo = "User";
  public $hasMany = "Post";

}