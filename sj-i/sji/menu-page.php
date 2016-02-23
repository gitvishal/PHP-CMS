<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="dropdown">
          <div class="dropdown" style="position:relative">
          <a href="#" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
          Pages 
          <span class="caret"></span>
          </a>
          <ul class="dropdown-menu" id="sj-sukerfish">

          <?php 
          require_once "suckerfish.php";
          echo $tree_page;
          ?>
          </ul>
          </div>
        </li>
      </ul>
      <form class="navbar-form navbar-right" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>
      
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>