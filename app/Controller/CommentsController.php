<?php
class CommentsController extends AppController{
  
  function add() {
    $user_id = $this->Auth->user("id");
    if(!$user_id){
      $this->redirect("/");
      die();
    }
    if ($this->request->is("post")) {
      $d = $this->request->data;
      $d["Comment"]["id"] = null;
      if($this->Comment->save($d,true,array("content","user_id","post_id"))){
        $this->redirect(array("action" => "view", "controller" => "posts", $d["Comment"]["post_id"]));
      }else{
        $this->Session->setFlash("Votre commentaire ne peut être vide","notif",array("type" => "alert-error"));
        $this->redirect($this->referer());
      }
    }
  }
  
}