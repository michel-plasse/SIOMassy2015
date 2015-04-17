<?php

class User_m extends CI_Model {

  private $email;

  public function __construct() {
    parent::__construct();
    $this->load->database();
  }

  /** Renvoie un utilisateur ou null, si pas trouvé
   * ATTENTION : fonctionne seulement avec admin/GretaMassy
   */
  public static function getByEmailPassword($email, $pwd) {
    $result = null;
    if ($email === "admin" && $pwd === "GretaMassy") {
      $result = new User_m();
      $result->email = $email;
    }
    return $result;
  }

}
