<?php
class ProjectsController extends AppController{

  function plist(){
    return $this->Project->find("all", array("recursive" => -1, "conditions" => array("user_id" => $this->Auth->user("id"))));
  }

  function add(){
    $user_id = $this->Auth->user("id");
    if(!$user_id){
      $this->redirect("/");
      die();
    }
    if ($this->request->is("post")) {
      $d = $this->request->data;
      $d["Project"]["id"] = null;
      if($this->Project->save($d,true,array("title","description","user_id"))){
        $this->redirect($this->referer());
      }
    }
  }

}