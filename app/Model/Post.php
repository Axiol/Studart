<?php
class Post extends AppModel{
  
  public $belongsTo = array("User", "Project");
  public $hasMany = array("Comment", "Like", "PostTag");
  public $hasAndBelongsToMany = array("Tag");
  
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

  public function afterSave($created){
    if(!empty($this->data["Post"]["tags"])){
      $tags = explode(",", $this->data["Post"]["tags"]);
      foreach ($tags as $tag) {
        $tag = trim($tag);
        if(!empty($tag)){
          $d = ($this->Tag->findByName($tag));
          if ($d != false) {
            $this->Tag->id = $d["Tag"]["id"];
          } else {
            $this->Tag->create();
            $this->Tag->save(array(
              "name" => $tag
            ));
          }
          $this->PostTag->create();
          $this->PostTag->save(array(
            "post_id" => $this->id,
            "tag_id" => $this->Tag->id
          ));
        }
      }
      return true;
    }
  }

  function topLikePosts($limit = 4) {
    return $this->find("all", array(
      "order" => "Post.like_count DESC",
      "limit" => $limit
    ));
  }
  
}