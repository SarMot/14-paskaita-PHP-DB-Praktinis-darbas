
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Klientų valdymo sistema</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
     <span class="navbar-toggler-icon"></span>
  </button>
  
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
     
     <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Vartotojas
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Naujas Vartotojas</a>
          <a class="dropdown-item" href="#">Vartotoju sarasas</a>
        </div>
      </li>
    </ul>
  </div>
</nav>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
 <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
  
      <li class="nav-item active">
        <a class="nav-link" href="Klientai.php">Klientai <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="naujasKlientas.php">Naujas Klientas</a>
      </li>
    </ul>  

    <form class="form-inline my-2 my-lg-0" action="Klientai.php" method="get">
      <input class="form-control mr-sm-2" name="search" type="search" placeholder="Klientu paieska" aria-label="Klientu paieska">
      <button class="btn btn-primary my-2 my-sm-0" type="submit" name="search_button">Paieska</button>
    </form>

  </div>
</nav>

  
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      
      <li class="nav-item active">
        <a class="nav-link" href="Imones.php">Imones <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="naujaImone.php">Nauja Imone</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0" action="Imones.php" method="get">
      <input class="form-control mr-sm-2" name="search" type="search" placeholder="Imoniu paieska" aria-label="Imoniu paieska">
      <button class="btn btn-primary my-2 my-sm-0" type="submit" name="search_button">Paieska</button>
    </form>
  </div>
</nav>