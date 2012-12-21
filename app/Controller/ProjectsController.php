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

  function view($id = null){
    $project = $this->Project->find("first", array("conditions" => array("Project.id" => $id), "contain" => array("Post", "Post.Like", "Post.User", "User")));
    $this->set("project", $project);
  }

  function edit($id = null) {
    $user_id = $this->Auth->user("id");
    if(!$user_id){
      $this->redirect("/");
      die();
    }
    $this->Project->id = $id;
    if($this->request->is("get")) {
      $this->request->data = $this->Project->read();
    }else{
      if($this->Project->save($this->request->data,true,array("title","description"))) {
        $this->Session->setFlash("Votre projet a bien été mise à jour","notif",array("type" => "alert-success"));
        $this->redirect(array("action" => "view", $id));
      }else{
        $this->Session->setFlash("Impossible de mettre à jour votre project","notif",array("type" => "alert-error"));
      }
    }
  }

}