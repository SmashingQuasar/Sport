<!--- Elie Bismuth -->

<div class="container mt-5">
    <h2>Sélectionnez une ville</h2>
    <form autocomplete="off" action="" method="post">
        <div class="form-group">
            <div class="autocomplete">
                <input id="myInput"  class="form-control" type="text" name="maVille" placeholder="Ville">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Envoyer</button>
    </form>
</div>


<!-- On encode en json le tableau contentant toutes les informations   -->
<script id="data"><?= json_encode($data) ?></script>

<script>

var data = document.querySelector('#data').innerHTML;
var values = JSON.parse(data);

autocomplete(document.getElementById("myInput"), values);

/*the autocomplete function takes two arguments,
the text field element and an array of possible autocompleted values:*/

function autocomplete(inp , arr){

    var currentFocus;

    /*execute a function when someone writes in the text field:*/
    inp.addEventListener("input" , function(e) {

        var a , b ,i , val = this.value;

        /*close any already open lists of autocompleted values*/
        closeAllLists();
        if (!val) { 
            return false;
        }
        currentFocus = -1;

        /*create a DIV element that will contain the items (values):*/
    })

    /*close all autocomplete lists in the document, except the one passed as an argument:*/
    function closeAllLists(element) {
        var x = document.getElementsByClassName("autocomplete-items");

        for(var i = 0; i < x.length; i++){
            if(element != x[i] && element != inp){
                x[i].parentNode.removeChild(x[i]);
            }
        }
    }
}

</script>