<?php
    include('../config.php');
    $id_studenta = $_GET['id_studenta'];
    $login_id = $_GET['login_id'];

    $dotaz = $pdo->prepare("SELECT *
                                    FROM studenti
                                    JOIN tridy ON studenti.trida_id = tridy.id_trida
                                    JOIN firmy ON studenti.firma_id = firmy.id_firma
                                    WHERE id_student = :id_student");
    $vysledek = $dotaz->execute(array(
        ":id_student" => $id_studenta
    ));
    $udaje_studenta = $dotaz->fetch(PDO::FETCH_ASSOC);

    $dotaz = $pdo->prepare("SELECT jmeno, prijmeni FROM ucitele WHERE id_ucitel = :id_ucitel");
    $vysledek = $dotaz->execute(array(
        ":id_ucitel" => $login_id
    ));
    $udaje_ucitele = $dotaz->fetch(PDO::FETCH_ASSOC);






$html = '
    <div id="hlavicka">

        <div id="logo">
            <img src="logo.png">
        </div>
        <div id="nazev">
            <h1>Střední průmyslová škola dopravní, Plzeň, Karlovarská 99</h1>
            <h2>Zápis z kontroly souvislé 14denní praxe žáků</h2>
            <h2>konané ve dnech ____ – ___. __. _______</h2>
        </div>
    </div>

    <div id="box">
        <table>

                <tr>
                    <td><p>Jméno a příjmení kontrolujícího:</p></td>
                    <td><p>' .  $udaje_ucitele['jmeno'] . ' ' . $udaje_ucitele['prijmeni'] . '</p></td>
                </tr>
                <tr>
                    <td><p>Kontrola provedena dne:</p></td>
                    <td><p></p></td>
                </tr>
                <tr>
                    <td><p>Název a adresa firmy:</p></td>
                    <td><p>' . $udaje_studenta['nazev_firmy'] . '<br />' . $udaje_studenta['ulice'] . ' ' . $udaje_studenta['cp'] . '<br />' .
                            $udaje_studenta['mesto'] . ' ' . $udaje_studenta['psc'] . '</p></td>
                </tr>








        </table>
    </div>



';


//==============================================================
//==============================================================
//==============================================================

include("../mpdf/mpdf.php");





$mpdf=new mPDF();

$stylesheet = file_get_contents('../css/pdf_style.css'); // external css

$mpdf->SetDisplayMode('fullpage');

// LOAD a stylesheet



$mpdf->WriteHTML($stylesheet,1);	// The parameter 1 tells that this is css/style only and no body/html/text

$mpdf->WriteHTML($html,2);

$mpdf->Output('NasSoubor.pdf','D');





exit;
//==============================================================
//==============================================================
//==============================================================

?>