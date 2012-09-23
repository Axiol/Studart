<?php
class PostsController extends AppController{

  function index(){
    $this->set("posts", $this->Post->find("all",array("order" => array("Post.created" => "desc"))));
  }
  
  function view($id = null) {
    $post = $this->Post->find("first", array("conditions" => array("Post.id" => $id), "contain" => array("User", "Project", "Project.Post" => array("id", "image", "title"), "Comment", "Comment.User" => array("id", "username", "mail"), "Comment.User.Post" => array("id", "image", "title"))));
    $neighbors = $this->Post->find("neighbors", array("field" => "id", "value" => $id, "conditions" => array("Post.project_id" => $post['Post']['project_id'])));
    $this->set(compact("post", "neighbors"));
  }
  
  function add() {
    $user_id = $this->Auth->user("id");
    if(!$user_id){
      $this->redirect("/");
      die();
    }
    if ($this->request->is("post")) {
      $d = $this->request->data;
      $d["Post"]["id"] = null;
      if($this->Post->save($d,true,array("title","description","visuel","user_id", "project_id"))){
        require("../../lib/imgClass.php");
        $id = $this->Post->id;
        $filename = $id."-".substr(md5(uniqid()),0,8).substr($this->request->data["Post"]["visuel"]["name"],-4);
        move_uploaded_file($this->request->data["Post"]["visuel"]["tmp_name"],IMAGES."posts".DS.$filename);
        $this->Post->saveField("image",$filename);
        Img::creerMin(IMAGES."posts".DS.$filename,IMAGES."posts","thumb-".$filename,270,202);
        $this->Session->setFlash("Votre publication a bien été postée","notif",array("type" => "alert-success"));
        $this->redirect(array('action' => 'index'));
      }else{
        $this->Session->setFlash("Merci de corriger les erreurs","notif",array("type" => "alert-error"));
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
        $this->redirect(array("action" => "index"));
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
    if($this->Post->delete($id)){
      $this->Session->setFlash("Votre post a bien été supprimé","notif",array("type" => "alert-success"));
      $this->redirect("/");
    }
  }
  
}