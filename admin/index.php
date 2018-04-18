<?php include('../inc/head.php'); ?>
<?php

if (isset($_POST["contenu"])){
    $roswellFichier = "".$_POST["file"];
    $roswellFile=fopen($roswellFichier,"w");
    fwrite($roswellFile,$_POST["contenu"]);
    fclose($roswellFile);
}

if (isset($_POST["contenu"])){
    $eraseFile = "".$_POST["erase"];
    $erase=unlink($eraseFile);
}

?>
    <div id="contenu">

        <?php
        $path = realpath('../files');
        $coolPath = substr($path,strlen(realpath("..")));
        $objects = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path), RecursiveIteratorIterator::SELF_FIRST);

        foreach($objects as $name => $object) {
            if ((!(substr($name, -2) === "/." || substr($name, -3) === "/.." || substr($name,-4) ===".jpg" || substr($name,-9) ===".DS_Store")) ) {
                echo '<a href="?f=' . $name . '">';
                echo substr($name, strlen(realpath("../files"))) . " <br/>";
                echo '</a>';

            }
        }





        /*   $roswellDir=opendir("../files/roswell");

           while($roswellFile=readdir($roswellDir)){
               if ($roswellFile!="." && $roswellFile!=".."){
                   echo '<a href="?f='.$roswellFile.'">';
                   echo $roswellFile." -- ";
                   echo '</a>';
               }
       }*/

        ?>
        <?php
        if (isset($_GET["f"])){
            $roswellFichier = "".$_GET["f"];
            $roswellContenu = file_get_contents($roswellFichier);


        ?>
        <form method="post" action="index.php">
            <textarea name="contenu" style="width: 100%;height: 200px;">
                <?php
                echo $roswellContenu;
                ?>
            </textarea>
            <input type="hidden" name="file" value="<?php echo $_GET["f"]; ?>"/>
            <input type="submit" value="Envoyer" />

            <input type="hidden" name="erase" value="<?php echo $_GET["f"]; ?>">
            <input type="submit" value="Supprimer" />
        </form>

        <?php
        }
        ?>
    </div>
<?php include('../inc/foot.php'); ?>