<?php session_start(); ?>
<div id="header" class="sticky">
  <div class="container">
    <div class="row">
      <div class="col-sm-5 col-md-6 col-lg-8 mainMenuWrap">
        <ul class="mainMenu d-md-inline-block p-0 m-0">
          <li>
            <div class="dropdown">
              <a class="nav-link dropdown-toggle animation" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">HOME</a>
              <div class="dropdown-menu p-0" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item animation scroll mf" href="index.php">HOME</a>
                <a class="dropdown-item animation scroll mf" href="index.php#immagini">IMMAGINI</a>
                <a class="dropdown-item animation scroll mf" href="index.php#luoghi">LUOGHI</a>
                <a class="dropdown-item animation scroll mf" href="index.php#parole">PAROLE</a>
                <a class="dropdown-item animation scroll mf" href="index.php#collezioni">COLLEZIONI</a>
                <a class="dropdown-item animation scroll mf" href="index.php#aboutus">ABOUT US</a>
                <a class="dropdown-item animation scroll mf" href="index.php#download">DOWNLOAD</a>
                <a class="dropdown-item animation scroll mf" href="index.php#credits">CREDITS</a>
              </div>
            </div>
          </li>
          <li>
            <div class="">
              <a href="gallery.php" class="animation mf">GALLERY</a>
            </div>
          </li>
        </ul>
      </div>
      <div class="col-sm-7 col-md-5 col-lg-4 pt-0 pb-2 pt-sm-2" id="headerSearch" >
        <form class="form" action="gallery.php" method="get">
          <div class="input-group input-group-sm">
            <input type="hidden" name="filtro" value="titolo">
            <input type="search" class="form-control" name="tag" id="txtSearch" placeholder="cerca nei titoli e nelle descrizioni" aria-label="cerca" aria-describedby="cercaBtnHeader" title="inserisci una o più parole separate da spazi" required>
            <div class="input-group-append">
              <button class="btn btn-secondary" type="submit" id="cercaBtnHeader"><i class="fas fa-search"></i></button>
            </div>
          </div>
        </form>
      </div>
      <?php if(isset($_SESSION['id_user'])){ ?>
      <div class="usrMenu">
        <ul class="mainMenu d-md-inline-block p-0 m-0">
          <li>
            <div class="toggleSideBar">
              <a href="#" class="animation"><i class="fas fa-bars"></i></a>
            </div>
          </li>
        </ul>
      </div>
    <?php } ?>

    </div>
  </div>
</div>
<!-- Sidebar -->
<?php if(isset($_SESSION['id_user'])){ ?>
<div class="sidebar animation closed">
  <div class="sidebarHeader toggleSideBar">
    <span>&times;</span>
  </div>
  <ul>
    <li><a href="newRecord.php" class="animation">nuova scheda</a></li>
    <li><a href="#" class="animation logoutBtn">logout</a></li>
  </ul>
</div>
<?php } ?>
