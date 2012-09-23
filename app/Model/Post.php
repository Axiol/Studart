<?php
class Post extends AppModel{
  
  public $belongsTo = array("User", "Project");
  public $hasMany = "Comment";
  
  public $actsAs = array("Containable");
  
  public $validate = array(
    "title" => array(
      array(
        "rule" => "notEmpty",
        "required" => true,
        "allowEmpty" => false,
        "message" => "Veuillez entrer un titre"
      ),
      array(
        "rule" => array("maxLength", "40"),
        "message" => "Ce titre est trop long"
      )
    ),
    "description" => array(
      array(
        "rule" => "notEmpty",
        "required" => true,
        "allowEmpty" => false,
        "message" => "Veuillez entrer une description"
      ),
      array(
        "rule" => array("maxLength", "255"),
        "message" => "Cette description est trop longue"
      )
    ),
    "visuel" => array(
      array(
        "rule" => array('extension', array("gif", "png", "jpg")),
        "message" => "Veuillez utiliser un format valide (.gif, .png ou .jpg)"
      )
    ),
    "project_id" => array(
      "notEmpty" => array(
        "rule" => array("notEmpty"),
        "message" => "Veuillez choisir un projet",
        "allowEmpty" => false
      )
    )
  );
  
}