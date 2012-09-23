<?php
class User extends AppModel{

  public $hasMany = array("Post", "Comment", "Project");

  public $actsAs = array("Containable");
  
  public $validate = array(
    "username" => array(
      array(
        "rule" => "alphanumeric",
        "required" => true,
        "allowEmpty" => false,
        "message" => "Votre pseudo n'est pas valide"
      ),
      array(
        "rule" => "isUnique",
        "message" => "Ce pseudo est déjà pris"
      )
    ),
    "mail" => array(
      array(
        "rule" => "email",
        "required" => true,
        "allowEmpty" => false,
        "message" => "Votre email n'est pas valide"
      ),
      array(
        "rule" => "isUnique",
        "message" => "Cet email est déjà pris"
      )
    ),
    "password" => array(
      "rule" => "notEmpty",
      "allowEmpty" => false,
      "message" => "Vous devez entrer un mot de passe"
    )
  );
  
}