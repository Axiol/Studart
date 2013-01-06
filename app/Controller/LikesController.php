<?php
class LikesController extends AppController{

  // public $paginate = array(
  //   "limit" => 16,
  //   "order" => array(
  //    "Like.created" => "desc"
  //   )
  // );

  public $paginate = array(
    "Like" => array(
      "limit" => 16,
      "contain" => array("User","Post","Post.User","Post.Like"),
      "order" => array("Like.created" => "desc")
    )
  );

  function like($id) {
    $user_id = $this->Auth->user("id");
    if(!$user_id){
      $this->redirect("/");
      die();
    }
    if ($this->request->is("get")) {
      $d = $this->request->data;
      $d["Like"]["id"] = null;
      $d["Like"]["post_id"] = $id;
      $d["Like"]["user_id"] = $user_id;
      if($this->Like->save($d,false,array("post_id","user_id"))){
        $this->redirect($this->referer());
      }
    }
  }

  function unlike($id) {
    $user_id = $this->Auth->user("id");
    if(!$user_id){
      $this->redirect("/");
      die();
    }
    if ($this->request->is("get")) {
      $unlikeLike = $this->Like->find("first", array("conditions" => array("Like.user_id" => $user_id, "Like.post_id" => $id)));
      $this->Like->delete($unlikeLike["Like"]["id"]);
      $this->redirect($this->referer());
    }
  }

  function whatLike($id) {
    $likes = $this->paginate('Like', array('Like.user_id' => $id));
    $this->set(compact("likes"));
  }
}