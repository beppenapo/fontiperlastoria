<?php
session_start();
require("db.class.php");
class NuovaScheda extends Db{
  function __construct() { }

  ##### API ####
  public function getListe(){
    $liste = array();
    $liste['dgn_livind'] = $this->dgn_livind();
    $liste['compilatore'] = $this->compilatore();
    $liste['cro_motiv'] = $this->cro_motiv();
    return $liste;
  }
  private function dgn_livind(){
    $sql = "select id, definizione from lista_dgn_livind order by definizione asc;";
    return $this->simple($sql);
  }

  private function compilatore(){
    $sql = "select nome||' '||cognome as compilatore from usr where id_user = ".$_SESSION['id_user'].";";
    return $this->simple($sql);
  }

  private function cro_motiv(){
    $sql = "select * from lista_cro_motiv order by definizione asc;";
    return $this->simple($sql);
  }

}

?>
