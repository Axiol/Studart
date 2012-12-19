<?php
class ContactController extends AppController{

  public function index() {
    if ($this->request->is("post")) {
      $d = $this->request->data;
      App::uses("CakeEmail","Network/Email");
      $mail = new CakeEmail("default");
      $mail->from($d["Post"]["mail"])
           ->to("ad7030@gmail.com")
           ->subject("Contact depuis StudArt")
           ->emailFormat("html")
           ->template("contact")
           ->viewVars(array("nom"=>$d["Post"]["mail"],"message"=>$d["Post"]["message"]))
           ->send();
      $this->Session->setFlash("Votre message a bien été envoyé","notif",array("type" => "alert-success"));
      $this->request->data = array();
    }
  }

}