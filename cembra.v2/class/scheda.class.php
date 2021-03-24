<?php
require("db.class.php");
class Scheda extends Db{
  public $scheda;
  function __construct($scheda){ $this->scheda = $scheda; }
  public function getScheda(){
    $sql="select * from viewscheda where id = ".$this->scheda.";";
    $query=$this->simple($sql);
    $info = array_filter(array_diff($query[0], ["-"]));
    $list['dgn_numsch']="<strong>".$info['dgn_numsch']."</strong>";
    $list['path']=$info['path'];
    if (isset($info['dgn_dnogg'])) {
      $list['titolo']=stripslashes($info['dgn_dnogg']);
    }elseif (!isset($info['dgn_dnogg']) && isset($info['sog_titolo'])) {
      $list['titolo']=stripslashes($info['sog_titolo']);
    }else {
      $list['titolo']=stripslashes(substr($info['path'],0,-4));
    }
    $list['sog_titolo']=" ".$info['sog_titolo']." ";
    /* if (isset($info['collezione'])) {
      if (preg_match('/\bCollezione\b/i', $info['collezione'])) {
        $list['collezione'] = stripslashes($info['collezione']);
      }elseif (preg_match('/\bArchivio\b/i', $info['collezione'])) {
        $list['collezione'] = stripslashes($info['collezi$titoloone']);
      }elseif (preg_match('/\bBiblioteca\b/i', $info['collezione'])) {
        $list['collezione'] = 'Archivio '.stripslashes($info['collezione']);
      }else {
        $list['collezione'] = stripslashes($info['collezione']);
      }
    } */
    
    $list['collezione']="<span class='txt10'>".stripslashes($info['collezione'])."</span>";
    $dtc=array();
    if(isset($info['dtc_icol'])){
      switch ($info['dtc_icol']) {
        case 'BN': $colore = 'Bianco e Nero'; break;
        case 'C': $colore = 'Colore'; break;
        case 'V': $colore = 'Viraggio chimico'; break;
        default: $colore = $info['dtc_icol']; break;
      }
      $dtc[0]=$colore;
    }
    if(isset($info['dtc_mattec'])){$dtc[1]=$info['dtc_mattec'];}
    if(isset($info['dtc_ffile'])){$dtc[1]=$dtc[1]." (".$info['dtc_ffile'].")";}
    if(isset($info['dtc_misfd'])){$dtc[2]=strtolower($info['dtc_misfd']);}
    $dtc = implode(", ",$dtc);
    $list['dtc']="<span class='txt12'>".$dtc."</span>";
    $sogg = $info['cro_spec']." ";
    if(isset($info['sog_autore'])){$sogg .= ", autore: ".$info['sog_autore'];}
    if(isset($info['sog_note'])){$sogg .= " (".stripslashes($info['sog_note']).")";}
    $list['sog_autore'] = "<span class='txt12'>".$sogg."</span>";
    
    $list['sog_sogg']="<span class='txt14'>".stripslashes($info['sog_sogg'])."</span>";
    if(isset($info['sog_notestor'])){$list['notestor']= "<span class='txt12'>Note storiche: ".stripslashes($info['sog_notestor'])."</span>";}
    if(isset($info['alt_note'])){ $list['note']= $this->regexp($info['alt_note']); }
    if ($info['idricerca']==70) {
      $ricerca = "<div class='mt-2'>";
      $ricerca .= "<p class='m-0'>Progetto ".$info['ricerca']."</p>";
      $ricerca .= "<img src='img/loghi/logoCaritro.png' class='img-fluid mr-2' />";
      $ricerca .= "<img src='img/loghi/logoEcomuseo.png' class='img-fluid' />";
      $ricerca .= "</div>";
      $list['ricerca']= $ricerca;
    }
    $localita=$this->simple("select id_localita from gallery where id = ".$this->scheda.";");
    $tag['geoTagTitle'] = $this->simple("select initcap(comune.comune) comune, localita.localita from scheda join aree_scheda on aree_scheda.id_scheda = scheda.id join aree on aree_scheda.id_area = aree.nome_area join comune on aree.id_comune = comune.id join localita on aree.id_localita = localita.id where aree.id_localita = ".$localita[0]['id_localita']." and aree_scheda.id_scheda = ".$this->scheda.";");

    $tag['geo']=$this->geoTag($localita);
    $tag['tag']=$this->tag();
    return array("sql"=>$sql,"list"=>$list,"tag"=>$tag);
  }

  private function geoTag($id=array()){
    $locArray = array();
    foreach($id as $key => $value){
      foreach ($value as $k => $v) { if ($v !==5) { $locArray[$k]=$v; } }
    }
    $sql = "select * from gallery ";
    if (count($locArray)>0) { $sql .= "where id_localita = ".$locArray['id_localita']." and id <> ".$this->scheda." "; }
    $sql .= "order by random() limit 12;";
    return $this->simple($sql);
  }

  private function tag(){ return $this->simple("select unnest(tags) tag from tags where scheda = ".$this->scheda." order by tag asc;");
  }

  private function regexp($txt){
    $pattern="/(FOTO[A-Z]+-I{1,3}-\w{4})/";
    return preg_replace($pattern, "<a href='#$1' class='txt14 text-dark animation hyperLink' title='visualizza la scheda $1'>$1</a>", $txt);
  }
}


?>
