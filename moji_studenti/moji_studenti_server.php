<?php
    include('../config.php');
    $page = isset($_GET['p'])?$_GET['p']:'';
    $login_id = isset($_GET['login_id'])?$_GET['login_id']:'';

    if($page == 'del') {
        $id_student = $_GET['id'];
        $dotaz = $pdo->prepare("UPDATE studenti SET ucitel_id = NULL WHERE id_student = :id_student");
        $vysledek = $dotaz->execute(array(
            ":id_student" => $id_student
        ));
    } else {
        $dotaz = $pdo->prepare("SELECT *
                                FROM studenti
                                JOIN tridy ON studenti.trida_id = tridy.id_trida
                                JOIN firmy ON studenti.firma_id = firmy.id_firma
                                WHERE ucitel_id = :login_id
                                ORDER BY prijmeni ASC ");
        $vysledek = $dotaz->execute(array(
            ":login_id" => $login_id
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
                    <button onclick="odhlasitStudenta(<?php echo $student['id_student'] ?>, <?php echo $login_id ?>)" class="btn btn-sm btn-danger" title="Po kliknutí provede odstranění studenta ze seznamu vybravých studentů."><span class="glyphicon glyphicon-trash"></span></button>

                    <button onclick="exportStudentToPDF(<?php echo $student['id_student']?>, <?php echo $login_id ?>)" class="btn btn-sm btn-info"> <span class="glyphicon glyphicon-save-file"></span></button>
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





