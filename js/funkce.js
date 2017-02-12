/**
 * Zobrazi seznam zabookovanych studentu, ktere si ucitel vybral
 *
 * pouzita na karte Moji studenti
 * @param login_id - prichasovaci ID ucitele
 */
function viewMojiStudenti(login_id) {
    $.ajax({
        type: "GET",
        url: "moji_studenti/moji_studenti_server.php?login_id=" + login_id,
        success: function (data) {
            $('tbody').html(data);
        }
    });
}


/**
 * Zajisti odhlaseni (uvolneni) studenta, ktereho si ucitael zapsal pro kontrolu
 *
 * pouzita na karte Moji studenti
 * @param id_studenta - ID studenta, ktery ma byt uciteli odebran
 * @param login_id - prichasovaci ID ucitele
 */
function odhlasitStudenta(id_studenta, login_id) {
    $.ajax({
        type: "GET",
        url: "moji_studenti/moji_studenti_server.php?p=del",
        data: "id="+id_studenta,
        success: function() {
            viewMojiStudenti(login_id);
        }
    });
}


/**
 * Zobrazi studenti, ktere si muze ucitel vybrat - volne studenty
 *
 * pouzita na karte Zapis studentu
 * @param login_id - prichasovaci ID ucitele
 */
function viewVyberStudentu(login_id) {
    $.ajax({
        type: "GET",
        url: "vyber_studentu/vyber_studentu_server.php?login_id=" + login_id ,
        success: function (data) {
            $('tbody').html(data);
        }
    });
}


/**
 * Zajisti zapsani studenta, ktereho si ucitel vybral stiskem tlacitka Zapsat
 *
 * * pouzita na karte Zapis studentu
 * @param id_studenta - ID studenta, ktereho chce ucitel kontrolovat
 * @param login_id - prichasovaci ID ucitele*
 */
function zapsatStudenta(id_studenta, login_id) {
    $.ajax({
        type: "GET",
        url: "vyber_studentu/vyber_studentu_server.php?id_studenta=" + id_studenta + "&p=add",
        data: "login_id="+login_id,
        success: function(){
            viewVyberStudentu(login_id);
        }
    });
}


/**
 * Zajisti aktualizaci dat u studenta
 *
 * * pouzita na karte Zapis studentu
 * @param id_studenta - ID studenta, kteremu budou editovany udaje v databazi (Jmeno, Prijmeni, Poznamka)
 */
function updateData(id_studenta) {
    var jmeno = $('#nm-'+id_studenta).val();
    var prijmeni = $('#em-'+id_studenta).val();
    var poznamka = $('#al-'+id_studenta).val();
    $.ajax({
        type: "POST",
        url: "vyber_studentu/vyber_studentu_server.php?p=edit",
        data: "nm=" + jmeno + "&em=" + prijmeni + "&al=" + poznamka + "&id=" + id_studenta,
        success: function(data){
            viewVyberStudentu();
        }
    });
}

/**
 * Zajisti vytvoreni formulare pro kontrolu studenta. Vystup je ve formatu PDF
 *
 * @param id_studenta
 * @param login_id
 */
function exportStudentToPDF(id_studenta, login_id) {
    var iframe = document.createElement("iframe");
    iframe.src = "pdf_student/create_pdf.php?id_studenta=" + id_studenta + "&login_id=" + login_id;
    iframe.style.display = "none";
    document.body.appendChild(iframe);
//    context.Response.AddHeader("Content-Disposition", "attachment;filename=NasSoubor.pdf");
}







/**


function saveData() {
    var jmeno = $('#nm').val();
    var prijmeni = $('#em').val();
    var poznamka = $('#al').val();
    $.ajax({
        type: "POST",
        url: "vyber_studentu_server.php?p=add",
        data: "nm=" + jmeno + "&em=" + prijmeni + "&al=" + poznamka,
        success: function(data){
            viewData();
        }
    });
}

function updateData(str) {
    var id_student = str;
    var jmeno = $('#nm-'+str).val();
    var prijmeni = $('#em-'+str).val();
    var poznamka = $('#al-'+str).val();
    $.ajax({
        type: "POST",
        url: "vyber_studentu_server.php?p=edit",
        data: "nm=" + jmeno + "&em=" + prijmeni + "&al=" + poznamka + "&id=" + id_student,
        success: function(data){
            viewData();
        }
    });
}



function viewData() {
    $.ajax({
        type: "GET",
        url: "vyber_studentu_server.php",
        success: function (data) {
            $('tbody').html(data);
        }
    });
}


**/


