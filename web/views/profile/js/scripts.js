$(document).ready(function () {
    $('#tableAwardsProfilePhone2').DataTable( {
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