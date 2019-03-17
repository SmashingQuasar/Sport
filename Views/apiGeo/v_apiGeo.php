<!--- Elie Bismuth -->

<div class="container mt-5">
    <h2>Sélectionnez une ville</h2>
    <form autocomplete="off" action="">
        <div class="autocomplete">
            <input id="myInput" type="text" name="maVille" placeholder="Ville">
        </div>
        <button type="submit" class="btn btn-primary">Envoyer</button>
    </form>
</div>


<!-- On encode en json le tableau contentant toutes les informations   -->
<script id="data"><?= json_encode($data) ?></script>

<script>

var data = document.querySelector('#data').innerHTML;
var values = JSON.parse(data);

console.log(values);

</script>