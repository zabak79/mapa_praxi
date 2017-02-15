<?php
include('../config.php');
$page = isset($_GET['p'])?$_GET['p']:'';
$login_id = isset($_GET['login_id'])?$_GET['login_id']:'';

if($page == 'edit') {
    $id_student = (int)$_POST['id'];
    $jmeno = $_POST['nm'];
    $prijmeni = $_POST['em'];
    $poznamka = $_POST['al'];
    $dotaz = $pdo->prepare("UPDATE studenti SET jmeno = :jmeno, prijmeni = :prijmeni, poznamka = :poznamka WHERE id_student = :id_student");
    $vysledek = $dotaz->execute(array(
        ":jmeno" => $jmeno,
        ":prijmeni" => $prijmeni,
        ":poznamka" => $poznamka,
        ":id_student" => $id_student
    ));
    if ($dotaz->execute()) {
        echo "Success update data.";
    } else {
        echo "Fail update data.";
    }
} else if($page == 'add') {
    $id_student = $_GET['id_studenta'];
    if ($id_student  != null) {
        $dotaz = $pdo->prepare("UPDATE studenti SET ucitel_id = :ucitel_id WHERE id_student = :id_student");
        $vysledek = $dotaz->execute(array(
            ":ucitel_id" => $login_id,
            ":id_student" => $id_student
        ));
    }
} else {
    $dotaz = $pdo->prepare("SELECT *
                                            FROM studenti
                                            JOIN tridy ON studenti.trida_id = tridy.id_trida
                                            JOIN firmy ON studenti.firma_id = firmy.id_firma
                                            WHERE ucitel_id IS :ucitel_id
                                            ORDER BY prijmeni ASC ");
    $vysledek = $dotaz->execute(array(
        ":ucitel_id" => NULL
    ));
    $moji_studenti = $dotaz->fetchAll();

    foreach ($moji_studenti as $student) {
        ?>
        <tr>
            <td><?php echo $student['id_student'] ?></td>
            <td><?php echo $student['jmeno'] ?></td>
            <td><?php echo $student['prijmeni'] ?></td>
            <td><?php echo $student['trida'] ?></td>
            <td>
                <?php echo $student['nazev_firmy'] . "</br>" . $student['ulice'] . " " . $student['cp']  . "</br>" . $student['mesto']  . " " . $student['psc']?>
            </td>
            <td><?php echo $student['kontaktni_osoba'] . "</br>" . $student['telefon'] ?></td>
            <td><?php echo $student['poznamka'] ?></td>
            <td>
                <!-- Zobrazi formular pro editaci dat zapsanych u studenta
                    <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#edit-<?php echo $student['id_student'] ?>" title="Po kliknutí na tlačítko bude zobrazen formulář pro úpravu dat studenta."><span class="glyphicon glyphicon-pencil"></span> </button>
                     <div class="modal fade" id="edit-<?php echo $student['id_student'] ?>" tabindex="-1" role="dialog" aria-labelledby="editLabel-<?php echo $student['id_student'] ?>">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="editLabel-<?php echo $student['id_student'] ?>">Editace údajů</h4>
                                </div>
                                <form>
                                    <div class="modal-body">
                                        <input type="hidden" id="<?php echo $student['id_student'] ?>"  value="<?php echo $student['id_student'] ?>">
                                        <div class="form-group">
                                            <label for="nm">Jméno</label>
                                            <input type="text" class="form-control" id="nm-<?php echo $student['id_student'] ?>" value="<?php echo $student['jmeno'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="em">Příjmení</label>
                                            <input type="text" class="form-control" id="em-<?php echo $student['id_student'] ?>"  value="<?php echo $student['prijmeni'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="al">Poznámka</label>
                                            <textarea class="form-control" id="al-<?php echo $student['id_student'] ?>" placeholder="Poznámka"><?php echo $student['poznamka'] ?></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Zavřít</button>
                                        <button type="submit" onclick="updateData(<?php echo $student['id_student'] ?>)" class="btn btn-primary">Upravit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                -->
                <button onclick="zapsatStudenta(<?php echo $student['id_student']?>, <?php echo $login_id ?>)" class="btn btn-sm btn-success" title="Po kliknutí na tlačítko se provede přidání studenta do seznamu kontrolovaných studentů."><span class="glyphicon glyphicon-ok-sign"></span> </button>




            </td>
        </tr>
        <?php
    }
}
?>

<script>
    /**
     * Zajisti zobrazeni bublinkove napovedy nad tlacitkem
     */
    $(document).ready(function(){
        $("button").tooltip({
            delay: { "show": 500, "hide": 100 },
            placement : 'top',
        });
    });
</script>







