<?php
class UsersController extends AppController{
  
  function signup(){
    if($this->request->is("post")){
      $d = $this->request->data;
      $d["User"]["id"] = null;
      if(!empty($d["User"]["password"])){
        $d["User"]["password"] = Security::hash($d["User"]["password"],null,true);
      }
      if($this->User->save($d,true,array("username","password","mail"))){
        $link = array("controller"=>"users","action"=>"activate",$d["User"]["username"]."-".md5($d["User"]["password"]));
        App::uses("CakeEmail","Network/Email");
        $mail = new CakeEmail("default");
        $mail->from("no-reply@studart.be")
             ->to($d["User"]["mail"])
             ->subject("Votre inscription sur StudArt")
             ->emailFormat("html")
             ->template("signup")
             ->viewVars(array("username"=>$d["User"]["username"],"link"=>$link))
             ->send();
        $this->Session->setFlash("Votre compte a bien été créé. Vérifiez vos mails pour l'activer","notif",array("type" => "alert-success"));
        $this->request->data = array();
      }else{
        $this->Session->setFlash("Il y a des erreurs dans le formualaire","notif",array("type" => "alert-error"));
      }
    }
  }
  
  function login(){
    if($this->request->is("post")){
      if($this->Auth->login()){
        $this->User->id = $this->Auth->user("id");
        $this->User->saveField("lastlogin",date("Y-m-d H:i:s"));
        $this->Session->setFlash("Vous êtes maintenant connecté","notif",array("type" => "alert-success"));
        $this->redirect("/");
      }else{
        $this->Session->setFlash("Identifiants incorrects","notif",array("type" => "alert-error"));
      }
    }
  }
  
  function logout(){
    $this->Auth->logout();
    $this->redirect($this->referer());
  }
  
  function activate($token){
    $token = explode("-",$token);
    $user = $this->User->find("first",array(
      "conditions" => array("username" => $token[0],'MD5(User.password)' => $token[1],"active" => 0)
    ));
    if(!empty($user)){
      $this->User->id = $user["User"]["id"];
      $this->User->saveField("active",1);
      $this->Session->setFlash("Votre compte a bien été activé","notif",array("type" => "alert-success"));
      $this->Auth->login($user["User"]);
    }else{
      $this->Session->setFlash("Ce lien d'activation ne semble pas valide","notif",array("type" => "alert-error"));
    }
    $this->redirect("/");
    die();
  }
  
  function password(){
    if(!empty($this->request->params["named"]["token"])){
      $token = $this->request->params["named"]["token"];
      $token = explode("-",$token);
      $user = $this->User->find("first",array(
        "conditions" => array("id" => $token[0],'MD5(User.password)' => $token[1],"active" => 1)
      ));
      if($user){
        $this->User->id = $user["User"]["id"];
        $password = substr(md5(uniqid(rand(),true)),0,8);
        $this->User->saveField("password",Security::hash($password,null,true));
        $this->Session->setFlash("Votre mot de passe a bien été réinitialisé, le voici : $password","notif",array("type" => "alert-success"));
      }else{
        $this->Session->setFlash("Ce lien ne semble pas valide","notif",array("type" => "alert-error"));
      }
    }
  
    if($this->request->is("post")){
      $v = current($this->request->data);
      $user = $this->User->find("first",array("conditions" => array("mail" => $v["mail"],"active" => 1)));
      if(empty($user)){
        $this->Session->setFlash("Aucun utilisateur ne correspond à cet email","notif",array("type" => "alert-error"));
      }else{
        $link = array("controller"=>"users","action"=>"password","token" => $user["User"]["id"]."-".md5($user["User"]["password"]));
        App::uses("CakeEmail","Network/Email");
        $mail = new CakeEmail("default");
        $mail->from("no-reply@studart.be")
             ->to($user["User"]["mail"])
             ->subject("Récupération de mot de passe")
             ->emailFormat("html")
             ->template("mdp")
             ->viewVars(array("username"=>$user["User"]["username"],"link"=>$link))
             ->send();
        $this->Session->setFlash("Un mail vous a été envoyé avec la procédure à suivre","notif",array("type" => "alert-success"));
      }
    }
  }
  
  function view($id = null) {
    $this->User->id = $id;
    $this->set("user", $this->User->find("first", array("conditions" => array("User.id" => $id), "contain" => array("Post", "Post.Like", "Project", "Project.Post"))));
  }
  
  function edit(){
    $user_id = $this->Auth->user("id");
    if(!$user_id){
      $this->redirect("/");
      die();
    }
    $this->User->id = $user_id;
    $passError = false;
    if($this->request->is("put") || $this->request->is("post")){
      $d = $this->request->data;
      $d["User"]["id"] = $user_id;
      if(!empty($d["User"]["pass1"])){
        if($d["User"]["pass1"]==$d["User"]["pass2"]){
          $d["User"]["password"] = Security::hash($d["User"]["pass1"],null,true);
        }else{
          $passError = true;
        }
      }
      if($this->User->save($d,true,array("firstname","lastname","password","description","local","twitter","facebook","gplus","website","github"))){
        $this->Session->setFlash("Votre compte a bien été édité","notif",array("type" => "alert-success"));
      }else{
        $this->Session->setFlash("Impossible de sauvegarder votre compte","notif",array("type" => "alert-error"));
      }
      if($passError){
        $this->User->validationErrors["pass2"] = array("Les mots de passe de correspondent pas");
      }
    }else{
      $this->request->data = $this->User->read();
    }
    $this->request->data["User"]["pass1"] = $this->request->data["User"]["pass2"] = "";
  }
}