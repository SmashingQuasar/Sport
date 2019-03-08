<!----- Elie Bismuth !-->

<div class="container mt-5">
    <input type="text" id="myInput" onkeyup="searchName()" placeholder="Search for names.."
        title="Type in a name" style="width: 100%;font-size: 16px;padding: 12px 20px 12px 40px;border: 1px solid #ddd; margin-bottom: 12px;">
    
    <table class="table" id="myTable" >
        <thead class="thead-dark">
        <tr>
            <th scope="col">Nom</th>
            <th scope="col">Prenom</th>
            <th scope="col">Date de naissance</th>
            <th scope="col">Genre</th>
        </tr>
        </thead>

        <tbody>
            <?php foreach($tabAdherents as $adherent ): ?>

                <tr>
                    <td><?= ucfirst($adherent['nom']) ?></td>
                    <td><?= ucfirst($adherent['prenom']) ?></td>
                    <td><?= $adherent['date_naissance'] ?></td>
                    <td><?= $adherent['genre'] ?></td>
                </tr>
                
            <?php endforeach; ?>
        </tbody>
    </table>
    
</div>

<script>
        function searchName() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }

</script>



