<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.13.1/datatables.min.css"/>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Kursevi stranih jezika</title>
</head>


<body>

    <div class="h1 text-center pt-2">
        KURSEVI STRANIH JEZIKA
    </div>

    <div id="break"></div>


    <div id="content" class="test"></div>

    <div class="modal fade" id="mdlDodaj" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    Dodaj novi kurs
                </div>
                <div class="modal-body">
                    <div class="inputPolje">
                        <label>Jezik</label>
                        <input type="text" id="txtJezik">
                    </div>
                    <div class="inputPolje">
                        <label>Trajanje kursa u mesecima</label>
                        <input type="text" id="txtTrajanje">
                    </div>
                    <div class="inputPolje">
                        <label>Nivo</label>
                        <select id="cbNivo">
                        </select>
                    </div>
                    <div class="inputPolje">
                        <label>Predavac</label>
                        <select id="cbPredavac"></select>
                    </div>
                    <hidden id="flag">
                        <hidden id="kurs-id">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-outline-danger" id="btnOdustani"> Odustani </button>
                    <button class="btn btn-outline-success" id="btnSacuvaj"> Sacuvaj </button>
                </div>
            </div>
        </div>
    </div>


    <div>
        <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
        <script src="js/jquery.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.13.1/datatables.min.js"></script>
        <script src="js/main.js"></script>

    </div>
</body>

</html>