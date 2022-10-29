!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Velty ▸ Searcher</title>
    <link rel="shortcut icon" href="bdd.png" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
</head>
<body>
      
    <?php
$dir = "x";
$cdb = array();
$num = 0;
$d = dir($dir);

while (false !== ($entry = $d->read())) {
   if($entry != "." and ".."){
     if($entry != ".."){
       $entry = explode(".", $entry);
       $nameondb = $entry[0];
       array_push($cdb, $nameondb);
       ++$num;
     }
   }
}
$d->close();
?>
   
    <div class="x">
        <h1 class="h1">Velty'Searcher 🔍🧟 </h1>
        <h2 class="h2">Le Searcher de haute Génération</h2>
        <i> Chercher les informations de n'importe quel personne à partir de ses informations fuités : "Nom d'utilisateur, Adresse IP , E-mails"</i>
        
    <form action="index.php" method="post">
        
      <p><input class="rechercher" type="text" name="s" value="<?php echo isset($_GET['?']) ? $_GET['s'] : ''; ?>" placeholder=" " />
      </p>
      <p>
          <input class="btn" type="submit" value="Chercher"></p>
    </form>
    </div>  

    </body>
</html>


<?php

if(empty($_GET["d"])){
  $d = dir($dir);
  $stack = array();
  while (false !== ($entry = $d->read())) {
    if($entry != "." and ".."){
      if($entry != ".."){
        $directory = $dir .'/'. $entry;
        echo $directory. "<br/>";
        array_push($stack, $directory);
      }
    }
  }
  $d->close();
  //echo "-----------<br>";
  foreach ($stack as $key=>$item){
      //echo $item ."<br>";
      searchnice($item);
  }
}else{
  $database = $_GET["d"];
  $d = dir($database);
  $stack = array();
  while (false !== ($entry = $d->read())) {
    if($entry != "." and ".."){
      if($entry != ".."){
        $directory = $dir .'/'. $entry;
        //echo $directory. "<br/>";
        array_push($stack, $directory);
      }
    }
  }
  $d->close();
   "-----------<br>";
  foreach ($stack as $key=>$item){
      echo $item ."<br>";
      searchnice($item);
  }
}



function searchnice($direct)
{ 
    //$direct = 'database/FBI.txt';
    if(empty($_POST["s"])){
      echo "";
    }else{
      $searchfor = $_POST["s"];
      if(isset($searchfor)){
        if(strlen($searchfor) > 2) {
            $contents = file_get_contents($direct);
            $pattern = preg_quote($searchfor, '/');
            $pattern = "/^.*$pattern.*\$/m";

            if(preg_match_all($pattern, $contents, $matches)){
                $name = explode("/", $direct)[1];
                $result = $matches[0];
                echo "$name";
                echo "<p>";
                echo implode("<br/></p> ", $result);
                echo "<br/>";
                echo "<h4><p>[ $name ] </p> <h4/>";
                
                echo "</div>";
            }
            else{
                echo "<br/>";
            }
        }
        else{ 
            echo "<br/>";
        }
      }
    }
}
?>