<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>MadGoat FingerPrint Lab</title>
  <!-- Bootstrap -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]--> 
  <script src="fingerprint.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <style type="text/css">
    body { padding-top: 70px; }

    .mygrid-wrapper-div {
      overflow: scroll;
      height: 300px;
    }
  </style>
</head>
<body>
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="http://madgoatstd.com/FPex/">MadGoat FingerPrint Lab</a>
      </div>
      <div id="navbar" class="collapse navbar-collapse">
        <ul class="nav navbar-nav">
          <li><a href="http://madgoatstd.com/FPex/">Main-Coded Key</a></li>
          <li><a href="http://madgoatstd.com/FPex/uncoded.php">Uncoded key</a></li>
          <li><a href="http://madgoatstd.com/FPex/evercookie.html">Evercoookie</a></li>
          <li class="active"><a href="http://madgoatstd.com/FPex/user_simulation.php">User System</a></li>
          <li><a href="http://madgoatstd.com/FPex/superduperkey.html">Super Key</a></li>
        </ul>
      </div><!--/.nav-collapse -->
    </div>
  </nav>

  <div class="container">
      <div id="target">
        <div class="row">
          <div class="col-md-4">
            <h1>Generic user-acount system</h1> 
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <form role="form">
              <div class="form-group" id="namediv">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" placeholder="Enter username">
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="this is disabled and not needed, for simplicity " disabled>
              </div>
              <div class="checkbox">
                <label>
                  <input type="checkbox" id = "secure"> This device is personal and I want it to be remembered.
                </label>
              </div>
              <input type='button' value='Submit' class='btn btn-primary' onclick='post();'>
            </form>
          </div>
        </div>
      </div>

      
      
  </div><!-- /.container -->
  <script>
    var fp2 = new Fingerprint({canvas: true});
    function post(){
      var canvas_print= fp2.get();
      var name = $('#username').val();
      var secured = $('#secure').is(':checked');
      if(name){
        $.post('think_user.php',{username:name,secure:secured,canvas:canvas_print},
            function(data){
              $('#target').html(data);
            }
          );
      }
    }



    var canvas = document.getElementById('myCanvas');
      var ctx = canvas.getContext('2d');
      // https://www.browserleaks.com/canvas#how-does-it-work
      var txt = 'qwertyuiopasdfghadsadasdasd';
      ctx.textBaseline = "top";
      ctx.font = "31px 'InexitentFont'";
      ctx.textBaseline = "alphabetic";
      ctx.fillStyle = "#f99";
      ctx.fillRect(125,40,77,39);
      ctx.fillStyle = "#069";
      ctx.fillText(txt, 2, 60);
      ctx.fillStyle = "rgba(102, 204, 0, 0.7)";
      ctx.fillText(txt, 4, 50);

      setTimeout(post(),3000);
  </script>
</body>
</html>

