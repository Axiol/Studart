<?php
class LikesController extends AppController{

  function like() {
    $user_id = $this->Auth->user("id");
    if(!$user_id){
      $this->redirect("/");
      die();
    }
    if ($this->request->is("post")) {
      $d = $this->request->data;
      $d["Like"]["id"] = null;
      if($this->Like->save($d,false,array("post_id","user_id"))){
        $this->redirect($this->referer());
      }
    }
  }

  function unlike() {
    $user_id = $this->Auth->user("id");
    if(!$user_id){
      $this->redirect("/");
      die();
    }
    if ($this->request->is("get")) {
      $this->Like->deleteAll(array("Like.user_id" => $this->params["url"]["user_id"], "Like.post_id" => $this->params["url"]["post_id"]), false);
      $this->redirect($this->referer());
    }
  }

}