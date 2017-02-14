<?php
    include('../config.php');
    $id_studenta = $_GET['id_studenta'];
    $login_id = $_GET['login_id'];

    $dotaz = $pdo->prepare("SELECT *
                                    FROM studenti
                                    JOIN tridy ON studenti.trida_id = tridy.id_trida
                                    JOIN firmy ON studenti.firma_id = firmy.id_firma
                                    JOIN obory ON studenti.obor_id = obory.id_obor
                                    WHERE id_student = :id_student");
    $vysledek = $dotaz->execute(array(
        ":id_student" => $id_studenta
    ));
    $udaje_studenta = $dotaz->fetch(PDO::FETCH_ASSOC);

    $dotaz = $pdo->prepare("SELECT titul, jmeno, prijmeni FROM ucitele WHERE id_ucitel = :id_ucitel");
    $vysledek = $dotaz->execute(array(
        ":id_ucitel" => $login_id
    ));
    $udaje_ucitele = $dotaz->fetch(PDO::FETCH_ASSOC);

    $dotaz = $pdo->prepare("SELECT * FROM tridy
                                    JOIN ucitele ON tridy.tridni_ucitel_id = ucitele.id_ucitel
                                    WHERE id_trida = :id_trida");
    $vysledek = $dotaz->execute(array(
        ":id_trida" => $udaje_studenta['trida_id']
    ));
    $udaje_trida = $dotaz->fetch(PDO::FETCH_ASSOC);




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

    <table class="udaje">
        <tr>
            <td>Jméno a příjmení kontrolujícího:</td>
            <td>'. $udaje_ucitele['titul'] .  $udaje_ucitele['jmeno'] . ' ' . $udaje_ucitele['prijmeni'] . '</td>
        </tr>
            <tr>
            <td>Kontrola provedena dne:</td>
        <td>.........................................</td>
        </tr>
        <tr>
            <td style="vertical-align: top;">Název a adresa firmy:</td>
            <td>' . $udaje_studenta['nazev_firmy'] . '<br />' . $udaje_studenta['ulice'] . ' ' . $udaje_studenta['cp'] . '<br />' . $udaje_studenta['mesto'] . ' ' . $udaje_studenta['psc'] . '</td>
        </tr>
        <tr>
            <td>Odpovědný pracovník: ' . $udaje_studenta['kontaktni_osoba'] . '</td>
            <td>Telefon: ' . $udaje_studenta['telefon'] . '</td>
        </tr>
        <tr>
            <td>Jméno a příjmení kontrolovaného žáka: </td>
            <td><b>' . $udaje_studenta['jmeno'] . ' ' . $udaje_studenta['prijmeni'] . '</b></td>
        </tr>
        <tr>
            <td>Třída: ' . $udaje_trida['trida'] . '</td>
            <td>Třídní učitel: '. $udaje_trida['titul'] . $udaje_trida['jmeno'] . ' ' . $udaje_trida['prijmeni'] .'</td>
        </tr>
        <tr>
            <td colspan="2">Obor vzdělání: ' . $udaje_studenta['nazev_oboru'] . '</td>
        </tr>
    </table>




    <p>
        Zjištěné skutečnosti: ....................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................
    </p>


    <table class="podpis">
        <tr>
            <td> </td>
            <td>............................................................</td>
        </tr>
        <tr>
            <td> </td>
            <td>Podpis kontrolujícího</td>
        </tr>
    </table>

    <p>
        Vyjádření odpovědného pracovníka firmy: ....................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................
    </p>

    <table class="razitko">
        <tr>
            <td>............................................................</td>
            <td>............................................................</td>
        </tr>
        <tr>
            <td>Podpis kontrolovaného žáka</td>
            <td>Podpis odpovědného pracovníka <br/> a razítko firmy</td>
        </tr>
    </table>





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