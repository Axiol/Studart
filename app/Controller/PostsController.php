<?php
class PostsController extends AppController{

  public $paginate = array(
    "limit" => 16,
    "order" => array(
     "Post.created" => "desc"
    )
  );

  function index(){
    $posts = $this->Post->find("all",array("order" => array("Post.created" => "desc")));
    $posts = $this->paginate();

    $popu = ClassRegistry::init("Post")->topLikePosts();

    $user_id = $this->Auth->user("id");
    if($user_id){
      $lastComm = $this->Post->Comment->find('all', array(
        "limit" => 4,
        "order" => array("Comment.created" => 'DESC'),
        "conditions" => array("Post.user_id" => $user_id),
        "contain" => array("User", "Post")
      ));
      $lastLike = $this->Post->Like->find('all', array(
        "limit" => 8,
        "order" => array("Like.created" => 'DESC'),
        "conditions" => array("Post.user_id" => $user_id),
        "contain" => array("User", "Post")
      ));
    }
    $this->set(compact("posts", "lastComm", "lastLike", "popu"));
  }
  
  function view($id = null) {
    $post = $this->Post->find("first", array("conditions" => array("Post.id" => $id), "contain" => array("User", "User.Post", "Project", "Project.Post", "Comment", "Comment.User", "Comment.User", "Like", "Like.User", "Tag")));
    $neighbors = $this->Post->find("neighbors", array("field" => "id", "value" => $id, "conditions" => array("Post.project_id" => $post['Post']['project_id'])));
    $likeNot = $this->Post->Like->hasAny(array(
      "user_id" => $this->Auth->user("id"), 
      "post_id" => $post["Post"]["id"]
    ));
    $this->set(compact("post", "neighbors", "likeNot"));
  }
  
  function add() {
    $user_id = $this->Auth->user("id");
    if(!$user_id){
      $this->redirect("/");
      die();
    }
    $this->loadModel("PostTag");
    $tagsSug = $this->PostTag->Tag->find("all");
    $this->set(compact("tagsSug"));
    if ($this->request->is("post")) {
      $d = $this->request->data;
      $d["Post"]["id"] = null;
      if (isset($d["Post"]["visuel"])) {
        if($this->Post->save($d,true,array("title","description","visuel","user_id", "project_id"))){
          require("../../lib/imgClass.php");
          $id = $this->Post->id;
          $filename = $id."-".substr(md5(uniqid()),0,8).substr($this->request->data["Post"]["visuel"]["name"],-4);
          move_uploaded_file($this->request->data["Post"]["visuel"]["tmp_name"],IMAGES."posts".DS.$filename);
          $this->Post->saveField("image",$filename);
          Img::creerMin(IMAGES."posts".DS.$filename,IMAGES."posts","thumb-".$filename,270,202);
          $this->Session->setFlash("Votre publication a bien été postée","notif",array("type" => "alert-success"));
          $this->redirect(array('action' => 'view', $this->Post->id));
        }else{
          $this->Session->setFlash("Merci de corriger les erreurs","notif",array("type" => "alert-error"));
        }
      } elseif (isset($d["Post"]["model"])) {
        move_uploaded_file($d["Post"]["model"]["tmp_name"],IMAGES."posts".DS.$d["Post"]["model"]["name"]);
        $path = IMAGES."posts".DS;
        $pathScript = IMAGES."posts".DS."sketchfab.sh";
        $filename = $d["Post"]["model"]["name"];
        $title = $d["Post"]["title"];
        $output = exec("./sketchfab.sh $path $filename $title");
        unlink(IMAGES."posts".DS.$d["Post"]["model"]["name"]);
        $output = json_decode($output, true);
        if ($output["success"] == true) {
          if($this->Post->save($d,true,array("title","description","visuel","user_id", "project_id"))){
            $this->Post->saveField("model",$output["result"]["id"]);
            $this->Session->setFlash("Votre publication a bien été postée","notif",array("type" => "alert-success"));
            $this->redirect(array('action' => 'view', $this->Post->id));
          }else{
            $this->Session->setFlash("Merci de corriger les erreurs","notif",array("type" => "alert-error"));
          }
        } 
      }
    }
  }
  
  function edit($id = null) {
    $user_id = $this->Auth->user("id");
    if(!$user_id){
      $this->redirect("/");
      die();
    }
    $this->Post->id = $id;
    if($this->request->is("get")) {
      $this->request->data = $this->Post->read();
    }else{
      if($this->Post->save($this->request->data,true,array("title","description"))) {
        $this->Session->setFlash("Votre publication a bien été mise à jour","notif",array("type" => "alert-success"));
        $this->redirect(array("action" => "view", $id));
      }else{
        $this->Session->setFlash("Impossible de mettre à jour votre post","notif",array("type" => "alert-error"));
      }
    }
  }
  
  function delete($id) {
    $user_id = $this->Auth->user("id");
    if(!$user_id){
      $this->redirect("/");
      die();
    }
    $this->Post->Comment->deleteAll(array("Comment.post_id" => $id));
    $this->Post->Like->deleteAll(array("Like.post_id" => $id));
    $delTags = $this->Post->PostTag->find("all",array("conditions" => array("PostTag.post_id" => $id)));
    foreach ($delTags as $tag) {
      $this->Post->PostTag->delete($tag["PostTag"]["id"]);
    }
    if($this->Post->delete($id)){
      $this->Session->setFlash("Votre post a bien été supprimé","notif",array("type" => "alert-success"));
      $this->redirect("/");
    }
  }

  function delTag($id) {
    $this->autoRender = false;
    $this->Post->PostTag->delete($id);
  }

  function tag($name) {
    $this->loadModel("PostTag");
    $this->PostTag->recursive = 2;
    $posts = $this->paginate("PostTag", array("Tag.name" => $name));
    $this->set(compact("posts"));
  }

  function search() {
    $keyword = $this->request->data;
    $keyword = $keyword["Post"]["keyword"];
    // $cond=array("OR"=>array("Post.title LIKE '%$keyword%'","Post.description LIKE '%$keyword%'"));
    $posts = $this->paginate('Post', array(
      'OR' => array(
          'Post.title LIKE' => "%$keyword%",
          'Post.description LIKE' => "%$keyword%"
      )
    ));
    if(count($posts) == 0) {
          $this->loadModel("PostTag");
          $tags = $this->PostTag->Tag->find("all");
          $this->set(compact("posts", "keyword", "tags"));
    } else {
      $this->set(compact("posts", "keyword"));
    }
  }

  function whoLike($id) {
    $post = $this->Post->find("first", array("conditions" => array("Post.id" => $id), "contain" => array("Like", "Like.User", "Like.User.Post" => array("order" => "Post.id desc"))));
    $this->set(compact("post"));
  }
}