<?php
session_start();
if(isset($_SESSION['id'])){
  header("Location: login.php");
  exit;
}
?>
<!doctype html>
<html lang="it">
  <head>
    <?php require('inc/meta.php'); ?>
    <?php require('inc/css.php'); ?>
    <link rel="stylesheet" href="css/newRecord.css">
  </head>
  <body class="bg-light" id="top">
    <?php require('inc/header.php'); ?>
    <div class="maintitle" id="home">
      <div class="container">
        <div class="row">
          <div class="col text-center my-5">
            <h1 class="text-dark">ARCHIVIO ICONOGRAFICO<br>DEI PAESAGGI DI COMUNITÀ</h1>
            <h6 class="text-dark">COMUNITÀ ALTA VALSUGANA E BERSNTOL TOLGAMOÀSCHÒFT HOA VALZEGÙ ONT BERSNTOL</h6>
          </div>
        </div>
      </div>
    </div>

    <div class="container bg-white p-3 border rounded mb-5">
      <form class="" action="index.html" method="post" enctype="multipart/form-data">
        <div class="row mb-3">
          <div class="col">
            <small class="font-weight-bold">* campi obbligatori</small>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label for="livello" class="font-weight-bold">* LIVELLO</label>
              <select class="form-control form-control-sm" name="livello" id="livello" required>
                <option value="" selected disabled>-- seleziona livello --</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
              </select>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="dgn_numsch" class="font-weight-bold">* NUMERO SCHEDA</label>
              <input type="text"class="form-control form-control-sm" name="dgn_numsch" id="dgn_numsch" value="" placeholder="numero scheda" required>
            </div>
          </div>
          <div class="col-md-5">
            <div class="form-group">
              <label for="dgn_livind" class="font-weight-bold">* LIVELLO INDIVIDUAZIONE DATI</label>
              <select class="form-control form-control-sm" name="dgn_livind" id="dgn_livind" required>
                <option value="" selected disabled>-- seleziona valore --</option>
              </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <div class="form-group">
              <label for="dgn_dnogg" class="font-weight-bold">* DEFINIZIONE OGGETTO</label>
              <input type="text" class="form-control form-control-sm" id="dgn_dnogg" name="dgn_dnogg" value="" placeholder="definizione oggetto" required>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <div class="form-group">
              <label for="note">NOTE</label>
              <textarea name="note" id="note" class="form-control form-control-sm" rows="8" cols="80" placeholder="inserisci note" required></textarea>
            </div>
          </div>
        </div>
        <div class="row mb-3">
          <div class="col-6 col-md-3">
            <small>COMPILATORE:<br /><span id="compilatore"></span></small>
            <input type="hidden" name="compilatore" value="<?php echo $_SESSION['id_user']; ?> ">
          </div>
          <div class="col-6 col-md-3">
            <small>DATA COMPILAZIONE:<br /><span id="compilazione"></span></span></small>
            <input type="hidden" name="compilazione" value="">
          </div>
        </div>

        <div id="accordion" class="mb-3">
          <div class="header animation">
            <h5 class="mb-0" data-toggle="collapse" data-target="#cronologia" aria-expanded="true" aria-controls="cronologia">DETTAGLIO CRONOLOGIA</h5>
          </div>
          <div id="cronologia" class="collapse bodySection" data-parent="#accordion">
            <div class="row">
              <div class="col-12 col-md-6 col-xl-3">
                <div class="form-group">
                  <label for="cro_iniz">CRONOLOGIA INIZIALE</label>
                  <input type="number" class="form-control form-control-sm" name="cro_iniz" id="cro_iniz" value="0" min="0" max="<?php echo date("Y") ?>" step="1">
                </div>
              </div>
              <div class="col-12 col-md-6 col-xl-3">
                <div class="form-group">
                  <label for="cro_fin">CRONOLOGIA FINALE</label>
                  <input type="number" class="form-control form-control-sm" name="cro_fin" id="cro_fin" value="<?php echo date("Y") ?>" min="1" max="<?php echo date("Y") ?>" step="1">
                </div>
              </div>
              <div class="col-12 col-md-6 col-xl-3">
                <div class="form-group">
                  <label for="cro_spec">CRONOLOGIA SPECIFICA</label>
                  <input type="text" class="form-control form-control-sm" name="cro_spec" id="cro_spec" value="" placeholder="cronologia specifica">
                </div>
              </div>
              <div class="col-12 col-md-6 col-xl-3">
                <div class="form-group">
                  <label for="cro_motiv">MOTIVAZIONE CRONOLOGIA</label>
                  <select class="form-control form-control-sm" name="cro_motiv" id="cro_motiv">
                    <option value="20">--seleziona un valore dalla lista--</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label for="cro_note">NOTE CRONOLOGIA</label>
                  <textarea name="cro_note" id="cro_note" class="form-control form-control-sm" rows="8" cols="80" placeholder="inserisci note cronologia"></textarea>
                </div>
              </div>
            </div>
          </div>

          <div class="header animation">
            <h5 class="mb-0" data-toggle="collapse" data-target="#compilazione" aria-expanded="true" aria-controls="compilazione">COMPILAZIONE</h5>
          </div>
          <div id="compilazione" class="collapse show bodySection" data-parent="#accordion">

          </div>

          <div class="header animation">
            <h5 class="mb-0" data-toggle="collapse" data-target="#provenienza" aria-expanded="true" aria-controls="provenienza">PROVENIENZA DATI</h5>
          </div>
          <div id="provenienza" class="collapse bodySection" data-parent="#accordion">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
          </div>

          <div class="header animation">
            <h5 class="mb-0" data-toggle="collapse" data-target="#area" aria-expanded="true" aria-controls="area">AREA DI INTERESSE</h5>
          </div>
          <div id="area" class="collapse bodySection" data-parent="#accordion">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
          </div>

          <div class="header animation">
            <h5 class="mb-0" data-toggle="collapse" data-target="#ubicazione" aria-expanded="true" aria-controls="ubicazione">UBICAZIONE</h5>
          </div>
          <div id="ubicazione" class="collapse bodySection" data-parent="#accordion">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
          </div>

          <div class="header animation">
            <h5 class="mb-0" data-toggle="collapse" data-target="#anagrafica" aria-expanded="true" aria-controls="anagrafica">ANAGRAFICA</h5>
          </div>
          <div id="anagrafica" class="collapse bodySection" data-parent="#accordion">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
          </div>

          <div class="header animation">
            <h5 class="mb-0" data-toggle="collapse" data-target="#consultabilita" aria-expanded="true" aria-controls="consultabilita">CONSULTABILITA'</h5>
          </div>
          <div id="consultabilita" class="collapse bodySection" data-parent="#accordion">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
          </div>

          <div class="header animation">
            <h5 class="mb-0" data-toggle="collapse" data-target="#conservazione" aria-expanded="true" aria-controls="conservazione">STATO DI CONSERVAZIONE</h5>
          </div>
          <div id="conservazione" class="collapse bodySection" data-parent="#accordion">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
          </div>

          <div class="header animation">
            <h5 class="mb-0" data-toggle="collapse" data-target="#schedeCorr" aria-expanded="true" aria-controls="schedeCorr">SCHEDE CORRELATE</h5>
          </div>
          <div id="schedeCorr" class="collapse bodySection" data-parent="#accordion">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
          </div>

          <div class="header animation">
            <h5 class="mb-0" data-toggle="collapse" data-target="#noteGenerali" aria-expanded="true" aria-controls="noteGenerali">NOTE GENERALI</h5>
          </div>
          <div id="noteGenerali" class="collapse bodySection" data-parent="#accordion">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
          </div>

          <div class="header animation">
            <h5 class="mb-0" data-toggle="collapse" data-target="#segnatura" aria-expanded="true" aria-controls="segnatura">SEGNATURA/COLLOCAZIONE</h5>
          </div>
          <div id="segnatura" class="collapse bodySection" data-parent="#accordion">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
          </div>

          <div class="header animation">
            <h5 class="mb-0" data-toggle="collapse" data-target="#descrizione" aria-expanded="true" aria-controls="descrizione">DESCRIZIONE FOTOGRAFIA</h5>
          </div>
          <div id="descrizione" class="collapse bodySection" data-parent="#accordion">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
          </div>

          <div class="header animation">
            <h5 class="mb-0" data-toggle="collapse" data-target="#notizie" aria-expanded="true" aria-controls="notizie">NOTIZIE STORICHE</h5>
          </div>
          <div id="notizie" class="collapse bodySection" data-parent="#accordion">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
          </div>

          <div class="header animation">
            <h5 class="mb-0" data-toggle="collapse" data-target="#datiTecnici" aria-expanded="true" aria-controls="datiTecnici">DATI TECNICI</h5>
          </div>
          <div id="datiTecnici" class="collapse bodySection" data-parent="#accordion">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
          </div>

          <div class="header animation">
            <h5 class="mb-0" data-toggle="collapse" data-target="#altreNote" aria-expanded="true" aria-controls="altreNote">ALTRE NOTE</h5>
          </div>
          <div id="altreNote" class="collapse bodySection" data-parent="#accordion">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
          </div>
        </div>


        <div class="row">
          <div class="col">
            <button type="submit" name="salva" class="btn btn-secondary btn-sm">salva dati</button>
          </div>
        </div>
      </form>
    </div>
    <?php require('inc/footer.php'); ?>
    <?php require('inc/lib.php'); ?>
    <script src="js/newRecord.js" charset="utf-8"></script>
  </body>
</html>
