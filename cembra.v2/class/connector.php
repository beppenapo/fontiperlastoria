<?php
require($_POST['oop']['file']);
$class=new $_POST['oop']['classe'];
$funzione = $_POST['oop']['func'];
if(isset($funzione) && function_exists($funzione)) {
  $trigger = $funzione($class);
  echo $trigger;
}
## index function ##
function imgWall($class){return json_encode($class->imgWall($_POST['dati']));}
function geotag($class){return json_encode($class->geotag());}
function lazyLoad($class){return json_encode($class->lazyLoad());}
function getIdByNumsch($class){return json_encode($class->getIdByNumsch($_POST['dati']));}
function feedback($class){return json_encode($class->feedback($_POST['dati']));}

function login($class){return json_encode($class->login($_POST['dati']));}

### nuova scheda liste ###
function getListe($class){return json_encode($class->getListe());}
?>
