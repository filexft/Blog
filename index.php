<?php
include('header.php');
?>
    <div>
        <form method='GET' action="#" class="filtre">
            <label for="title" class="titrefiltre"> Filtre </label><br><br>
            <input type="checkbox" id="filtre1" name="vehicle1" value="Bike">
            <label for="filtre1"> Nature</label><br>
            <input type="checkbox" id="filtre2" name="vehicle2" value="Car">
            <label for="filtre2"> Tech</label><br>
            <input type="checkbox" id="filtre3" name="vehicle3" value="Boat">
            <label for="filtre3"> Sport</label><br>
            <input type="checkbox" id="filtre4" name="vehicle3" value="Boat">
            <label for="filtre4">Science</label><br>
            <input type="submit" value="Valider" class="valboutton">

        </form>
    </div>




<?php
include('footer.php');
?>
