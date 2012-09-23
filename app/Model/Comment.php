<?php
class Comment extends AppModel{
  
  public $belongsTo = array("User", "Post");
  
  public $validate = array(
    "content" => array(
      array(
        "rule" => "notEmpty",
        "required" => true,
        "allowEmpty" => false,
        "message" => "Veuillez entrer un commentaire"
      )
    )
  );
  
}