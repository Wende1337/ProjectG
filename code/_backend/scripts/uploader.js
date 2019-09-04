
class uploader {

    constructor() {
        this.tables = [...document.getElementsByTagName("table")];
        this.type_a_counts = 4;
        this.type_b_counts = 3;
        this.type_c_counts = 4;
        this.type_d_counts = 6;
        this.type_e_counts = 2;
        this.tableIndex = 0;
    }

    getNextTable() {
        return this.tables[ this.tableIndex++ ];
    }

    getAllRows( table ) {
        return [...table.getElementsByTagName("tr")];
    }

    getColumnDataArray( tr ) {
        let tdArray = [...tr.getElementsByTagName("td")];
        let resultArray = [];
        tdArray.forEach( td => {
            while( td.hasChildNodes && td.childNodes.length !== 0) {
                td = td.childNodes[0];
            }
            resultArray.push( td.nodeValue );
        });
        return resultArray;
    }

    insertA1( dataStringArray ) {
        let form = new FormData();

        //these tow post-attributes are necessary
        form.append('input', 'automatic');
        form.append('table_destination', 'a1');

        form.append('lektion', dataStringArray[0]);
        form.append('uebungstitel', dataStringArray[1] );
        form.append('type', dataStringArray[2]);
        form.append('beschreibung', dataStringArray[3]);
        form.append('auswahlmoeglichkeiten', dataStringArray[4]);
        form.append('am_reihenfolge_relevanz', (dataStringArray[5] === "Ja") ? "1" : "0");
        form.append('loesung', dataStringArray[6]);
        form.append('loesung_reihenfolge_relevanz', (dataStringArray[7] === "Ja") ? "1" : "0");
        form.append('max_punkte', dataStringArray[8]);
        form.append('schwierigkeitsgrad', dataStringArray[9]);
        form.append('schlagworte', dataStringArray[10]);

        for (let pair of form.entries()) {
            console.log(pair[0]+ ',' + pair[1]);
        }

        fetch('inputmask.php', {
            method: 'POST',
            body: form
        }).then( response => {
            return response.text();
        }).then( text => {
            console.log( text );
        });
    }
}


let up = new uploader();
let dataRows = up.getAllRows( up.getNextTable() );


up.tables.forEach( table => {
    up.getAllRows(table).forEach( row => {
        let dataStringArray = up.getColumnDataArray( row );

        switch( dataStringArray[2] ) {
            case "A1":
                console.log( dataStringArray );
                up.insertA1( dataStringArray );
                break;
            default:
                console.log("No type found for input");
                break;
        }
    } );
});


