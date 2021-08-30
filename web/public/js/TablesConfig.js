$(document).ready(function () {
$('#tableBestDogs').DataTable( {
    language: {
    processing:     "Spracuvavam",
    search:         "Hladat:",
    lengthMenu:    "Zobrazit _MENU_ psov",
    info:           "Zobrazenych od _START_ do _END_ z celkovych _TOTAL_ psov",
    infoEmpty:      "Vasemu vyhladaniu nevyhovel ziaden pes",
    infoFiltered:   "(Prehladanych vsetkych _MAX_ psov)",
    infoPostFix:    "",
    loadingRecords: "Nahravam",
    zeroRecords:    "Ziaden vysledok",
    emptyTable:     "Nemate momentalne zaregistrovanych ziadnych psov",
    paginate: {
        first:      "Posledny",
        previous:   "Predosly",
        next:       "Dalsi",
        last:       "Posledny"
    },
    aria: {
        sortAscending:  ": Zoradit vzostupne",
        sortDescending: ": Zoradit zostupne"
    }
    }
} );});

	$(document).ready(function () {
    $('#tableBestDogs').DataTable();

});

$(document).ready(function () {
    $('#tableDogs').DataTable( {
    language: {
    processing:     "Spracuvavam",
    search:         "Hladat:",
    lengthMenu:    "Zobrazit _MENU_ psov",
    info:           "Zobrazenych od _START_ do _END_ z celkovych _TOTAL_ psov",
    infoEmpty:      "Vasemu vyhladaniu nevyhovel ziaden pes",
    infoFiltered:   "(Prehladanych vsetkych _MAX_ psov)",
    infoPostFix:    "",
    loadingRecords: "Nahravam",
    zeroRecords:    "Ziaden vysledok",
    emptyTable:     "Nemate momentalne zaregistrovanych ziadnych psov",
    paginate: {
        first:      "Posledny",
        previous:   "Predosly",
        next:       "Dalsi",
        last:       "Posledny"
    },
    aria: {
        sortAscending:  ": Zoradit vzostupne",
        sortDescending: ": Zoradit zostupne"
    }
    }
    } );});

$(document).ready(function () {
    $('#tableDogs').DataTable();
});

$(document).ready(function () {
    $('#tableAwards').DataTable( {
        language: {
        processing:     "Spracuvavam",
        search:         "Hladat:",
        lengthMenu:    "Zobrazit _MENU_ cien",
        info:           "Zobrazenych od _START_ do _END_ z celkovych _TOTAL_ cien",
        infoEmpty:      "Vasemu vyhladaniu nevyhovelo ziadne ocenenie",
        infoFiltered:   "(Prehladanych vsetkych _MAX_ cien)",
        infoPostFix:    "",
        loadingRecords: "Nahravam",
        zeroRecords:    "Ziaden vysledok",
        emptyTable:     "Nemate momentalne zaregistrovane ziadne ocenenia",
        paginate: {
            first:      "Posledny",
            previous:   "Predosly",
            next:       "Dalsi",
            last:       "Posledny"
        },
        aria: {
            sortAscending:  ": Zoradit vzostupne",
            sortDescending: ": Zoradit zostupne"
        }
        }
    } );});

$(document).ready(function () {
    if ($(window).width() > 600) {
        $('#tableAwards').DataTable();
        }
});

$(document).ready(function () {
    $('#tableAwardsProfile').DataTable( {
        language: {
        processing:     "Spracuvavam",
        search:         "Hladat:",
        lengthMenu:    "Zobrazit _MENU_ cien",
        info:           "Zobrazenych od _START_ do _END_ z celkovych _TOTAL_ cien",
        infoEmpty:      "Vasemu vyhladaniu nevyhovelo ziadne ocenenie",
        infoFiltered:   "(Prehladanych vsetkych _MAX_ cien)",
        infoPostFix:    "",
        loadingRecords: "Nahravam",
        zeroRecords:    "Ziaden vysledok",
        emptyTable:     "Uzivatel nema momentalne zaregistrovane ziadne ocenenia",
        paginate: {
            first:      "Posledny",
            previous:   "Predosly",
            next:       "Dalsi",
            last:       "Posledny"
        },
        aria: {
            sortAscending:  ": Zoradit vzostupne",
            sortDescending: ": Zoradit zostupne"
        }
        }
    } );});

$(document).ready(function () {
    if ($(window).width() > 600) {
        $('#tableAwardsProfile').DataTable();
        }
});


    $(document).ready(function () {
    $('#tableLeaders').DataTable();

});

    $(document).ready(function () {
        $('#tableAwardsProfilePhone').DataTable( {
            language: {
            processing:     "Spracuvavam",
            search:         "Hladat:",
            lengthMenu:    "Zobrazit _MENU_ cien",
            info:           "Zobrazenych od _START_ do _END_ z celkovych _TOTAL_ cien",
            infoEmpty:      "Vasemu vyhladaniu nevyhovelo ziadne ocenenie",
            infoFiltered:   "(Prehladanych vsetkych _MAX_ cien)",
            infoPostFix:    "",
            loadingRecords: "Nahravam",
            zeroRecords:    "Ziaden vysledok",
            emptyTable:     "Uzivatel nema momentalne zaregistrovane ziadne ocenenia",
            paginate: {
                first:      "Posledny",
                previous:   "Predosly",
                next:       "Dalsi",
                last:       "Posledny"
            },
            aria: {
                sortAscending:  ": Zoradit vzostupne",
                sortDescending: ": Zoradit zostupne"
            }
            }
        } );});