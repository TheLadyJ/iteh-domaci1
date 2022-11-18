function vratiTabelu(result) {
    let x = ``;

    x += `
    <div class="d-flex justify-content-end pt-3 pb-2 px-4">
        <button class="btn btn-success" id="btnDodajKurs">Dodaj kurs jezika</button>
    </div>`;


    x += `
    <table class="table table-light table-hover">
    <thead class="table-dark">
        <th class="text-center align-middle">
            Jezik
        </th>
        <th class="text-center align-middle">
            Trajanje kursa u mesecima
        </th>
        <th class="text-center align-middle">
            Nivo
        </th>
        <th class="text-center align-middle">
            Predavac
        </th>
        <th>
        </th>
        <th>
        </th>
    </thead>
    <tbody>`;

    let filter = $("#filter").val();
    for (i = 0; i < result.length; i++) {
        if (filter == undefined || filter == 0 || filter == result[i]['nivo_id']) {
            x += `
            <tr>
                <td class="text-center align-middle">${result[i]['Jezik']}</td>
                <td class="text-center align-middle">${result[i]["Trajanje kursa u mesecima"]}</td>
                <td class="text-center align-middle">${result[i]["Nivo"]}</td>
                <td class="text-center align-middle">${result[i]["Predavac"]}</td>
                <td class="text-center align-middle">
                    <button class="btn btn-primary btnIzmeni" data-kurs='${JSON.stringify(result[i])}'>Izmeni</button>
                </td>
                <td class="text-center align-middle">
                    <button class="btn btn-danger btnIzbrisi" data-kurs='${JSON.stringify(result[i])}'">Izbrisi</button>
                </td>
            </tr>`;
        }
    }

    x += `
    </tbody>
    </table>`;

    return x;


}

function vratiSveKurseve() {
    $.ajax({
        url: "ajax/indexAJAX.php",
        type: "POST",
        dataType: "JSON",
        data: {
            action: "vratiSveKurseve"
        },
        success: function (result) {
            let html = vratiTabelu(result);
            $("#content").html(html);
            $(".table").DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.1/i18n/sr-SP.json'
                },
                columnDefs: [{
                    targets: [4, 5], // kolone u kojima su dugmici za izmenu i brisanje (indeks krece od 0)
                    orderable: false, // ne moze se sortirati po njima
                }],
                lengthMenu : [ [5, 10, 25, 50, -1], [5, 10, 25, 50, 'Sve']],
                pagingType: 'simple_numbers'
            });
        },
        error: function () {
            alert("Neuspesno ucitavanje kurseva.");
        }
    })
}

function vratiCbNivoa(result) {
    let x = ``;
    for (i = 0; i < result.length; i++) {
        x += `<option value=${result[i]['id']}>${result[i]['Nivo']}</option>`;
    }
    return x;
}

function ucitajCbNivoa() {
    $.ajax({
        url: "ajax/indexAJAX.php",
        type: "POST",
        dataType: "JSON",
        data: {
            action: "ucitajCbNivoa"
        },
        success: function (result) {
            let html = vratiCbNivoa(result);
            $("#cbNivo").html(html);
            html = `
            <option value="0">Svi nivoi</option>
            ` + html;
            $("#filter").html(html);
        },
        error: function () {
            alert("Neuspesno ucitavanje nivoa.");
        }
    })
}

function vratiCbPredavaca(result) {
    let x = ``;
    for (i = 0; i < result.length; i++) {
        x += `<option value=${result[i]['id']}>${result[i]['ime']} ${result[i]['prezime']}</option>`;
    }
    return x;
}

function ucitajCbPredavaca() {
    $.ajax({
        url: "ajax/indexAJAX.php",
        type: "POST",
        dataType: "JSON",
        data: {
            action: "ucitajCbPredavaca"
        },
        success: function (result) {
            let html = vratiCbPredavaca(result);
            $("#cbPredavac").html(html);
        },
        error: function () {
            alert("Neuspesno ucitavanje predavaca.");
        }
    })
}

function validateKurs($jezik, $trajanje, xhr) {
    if ($jezik == null || $jezik.trim() === '' || $jezik === '') {
        alert('Los unos jezika!');
        xhr.abort();
    }
    if ($trajanje == '' || $trajanje < 0 || $trajanje > 99) {
        alert('Los unos trajanja kursa!');
        xhr.abort();
    }
}

function sacuvajKurs($jezik, $trajanje, $nivo, $predavac) {
    $.ajax({
        url: "ajax/indexAJAX.php",
        type: "POST",
        dataType: "JSON",
        data: {
            action: "sacuvajKurs",
            jezik: $jezik,
            trajanje: $trajanje,
            nivo: $nivo,
            predavac: $predavac,
            flag: $flag,
            kursId: $kursId
        },
        beforeSend: function (xhr) {
            validateKurs($jezik, $trajanje, xhr);
        },
        success: function () {
            alert("Kurs je uspesno sacuvan.");
            vratiSveKurseve();
        },
        error: function () {
            alert("Kurs nije uspesno sacuvan.");
        }
    })
}

function izbrisiKurs($kursId) {
    $.ajax({
        url: "ajax/indexAJAX.php",
        type: "POST",
        dataType: "JSON",
        data: {
            action: "izbrisiKurs",
            kursId: $kursId
        },
        success: function () {
            vratiSveKurseve();
            alert("Kurs je uspesno izbrisan.");
        },
        error: function () {
            alert("Kurs nije uspesno izbrisan.");
        }
    })
}

$(document).ready(
    function () {
        vratiSveKurseve();
        ucitajCbNivoa();
        ucitajCbPredavaca();

        $(document).on("click", "#btnDodajKurs", function () {
            $("#flag").val(null);
            $("#kurs-id").val(null);
            $("#mdlDodaj").modal({
                backdrop: 'static',
                keyboard: false,
                show: true
            });
            $("#mdlDodaj").modal('show');
        })

        $(document).on("click", "#btnOdustani", function () {
            $("#mdlDodaj").modal('hide');
        })

        $(document).on("click", "#btnSacuvaj", function () {
            $jezik = $("#txtJezik").val();
            $trajanje = $("#txtTrajanje").val();
            $nivo = $("#cbNivo").val();
            $predavac = $("#cbPredavac").val();
            $flag = $("#flag").val();
            $kursId = $("#kurs-id").val();

            sacuvajKurs($jezik, $trajanje, $nivo, $predavac, $flag, $kursId);
        })

        $(document).on("click", ".btnIzmeni", function () {
            let kurs = $(this).data("kurs");

            $("#flag").val("izmeni");
            $("#kurs-id").val(kurs['id']);

            $("#mdlDodaj").modal({
                backdrop: 'static',
                keyboard: false,
                show: true
            });
            $("#mdlDodaj").modal('show');
            $("#txtJezik").val(kurs['Jezik']);
            $("#txtTrajanje").val(kurs['Trajanje kursa u mesecima']);
            $("#cbNivo").val(kurs['nivo_id']);
            $("#cbPredavac").val(kurs['predavac_id']);
        })

        $(document).on("click", ".btnIzbrisi", function () {
            let kurs = $(this).data("kurs");
            $kursId = kurs['id'];
            let izbrisi = confirm("Da li sigurno zelite da izbrisete kurs?");
            if (izbrisi) {
                izbrisiKurs($kursId);
            }
        })

    }
);