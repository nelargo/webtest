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
          <li class="active"><a href="http://madgoatstd.com/FPex/">Main-Coded Key</a></li>
          <li><a href="http://madgoatstd.com/FPex/uncoded.php">Uncoded key</a></li>
          <li><a href="http://madgoatstd.com/FPex/evercookie.html">Evercoookie</a></li>
          <li><a href="http://madgoatstd.com/FPex/user_simulation.php">User System</a></li>
          <li><a href="http://madgoatstd.com/FPex/superduperkey.html">Super Key</a></li>
          <li><a href="http://madgoatstd.com/FPex/test.html">test</a></li>
        </ul>
      </div><!--/.nav-collapse -->
    </div>
  </nav>
  <div class="container">

      <div class="row" id="target" >
        <div class="col-md-4">
          <h1>Running Prints...</h1> 
        </div>
        <div class="col-md-4">
          <img src="loading.gif" alt="Getting stuff done" style="width:128px;height:128px">
        </div>
      </div>

      
      <div class="row">
         <canvas id="myCanvas" width="578" height="200"></canvas>
      </div>
      
  </div><!-- /.container -->

  
  
  <script>
    var fp1 = new Fingerprint();
    var fp2 = new Fingerprint({canvas: true});
    var fp3 = new Fingerprint({screen_resolution: true});

    //Ajax Function, Do not fuck up-----------------------------------------------
    function post(){
      var default_print_MD5= fp1.get();
      var resolution_print_MD5= fp3.get();
      var canvas_print_MD5= fp2.get();
	  
	  if(canvas_print_MD5 == default_print_MD5){
	  	canvas_print_MD5 = null;
	  }


      $.post('think.php',{default_MD5:default_print_MD5,resolution_MD5:resolution_print_MD5,canvas_MD5:canvas_print_MD5},
          function(data){
            $('#target').html(data);
          }
        );
    }

    function saveName(){
      var newTag = $('#tag').val();
      var targetid = $('#targetid').val();
      var targetid_canvas = $('#targetid_canvas').val();
      $.post('rethink.php',{new_tag:newTag,target_id:targetid,target_id_canvas:targetid_canvas},
          function(data){
            $('#nameUpdate').html(data);
          }
        );
     
    }

    //-----------------------------------------------------------------------------
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

