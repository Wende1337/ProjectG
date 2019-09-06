
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

    sendA1( dataStringArray ) {
        let form = this.createForm( 'a1' );

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
        });
    }

    sendAufgabe(dataStringArray, tablename){
        let form = this.createForm( tablename );

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

        fetch('inputmask.php', {
            method: 'POST',
            body: form
        }).then( response => {
            return response.text();
        }).then( text => {
            if(tablename === 'd1') {
                //console.log(text);
            }
        });
    }

    createForm( table ) {
        let form = new FormData();
        //these tow post-attributes are necessary'
        form.append('input', 'automatic');
        form.append('table_destination', table);

        return form;
    }

    sendA3( dataStringArray, tablename ) {
        let form = this.createForm( tablename );

        form.append('lektion', dataStringArray[0]);
        form.append('uebungstitel', dataStringArray[1] );
        form.append('type', dataStringArray[2]);
        form.append('beschreibung', dataStringArray[3]);
        form.append('ueberschrift_tabelle1', dataStringArray[5]);
        form.append('ueberschrift_tabelle2', dataStringArray[6]);
        form.append('ueberschrift_tabelle3', dataStringArray[7]);
        form.append('auswahlmoeglichkeiten1', dataStringArray[8]);
        form.append('auswahlmoeglichkeiten2', dataStringArray[9]);
        form.append('auswahlmoeglichkeiten3', dataStringArray[10]);
        form.append('am_reihenfolge_relevanz', (dataStringArray[11] === "Ja") ? "1" : "0");
        form.append('loesung', dataStringArray[12]);
        form.append('loesung_reihenfolge_relevanz', (dataStringArray[13] === "Ja") ? "1" : "0");
        form.append('max_punkte', dataStringArray[14]);
        form.append('schwierigkeitsgrad', dataStringArray[15]);
        form.append('schlagworte', dataStringArray[16]);

        fetch('inputmask.php', {
            method: 'POST',
            body: form
        }).then( response => {
            return response.text();
        }).then( text => {
        });
    }

    sendB2( dataStringArray, tablename ) {
        let form = this.createForm( tablename );

        form.append('lektion', dataStringArray[0]);
        form.append('uebungstitel', dataStringArray[1] );
        form.append('type', dataStringArray[2]);
        form.append('beschreibung', dataStringArray[3]);
        form.append('auswahlmoeglichkeiten', dataStringArray[4]);
        form.append('am_reihenfolge_relevanz', (dataStringArray[5] === "Ja") ? "1" : "0");
        form.append('loesungsvorgabe', dataStringArray[6]);
        form.append('loesung', dataStringArray[7]);
        form.append('loesung_reihenfolge_relevanz', (dataStringArray[8] === "Ja") ? "1" : "0");
        form.append('max_punkte', dataStringArray[9]);
        form.append('schwierigkeitsgrad', dataStringArray[10]);
        form.append('schlagworte', dataStringArray[11]);

        fetch('inputmask.php', {
            method: 'POST',
            body: form
        }).then( response => {
            return response.text();
        }).then( text => {
        });
    }

    sendD1(dataStringArray, tablename){
        let form = this.createForm( tablename );

        form.append('lektion', dataStringArray[0]);
        form.append('uebungstitel', dataStringArray[1] );
        form.append('type', dataStringArray[2]);
        form.append('beschreibung', dataStringArray[3]);
        form.append('auswahlmoeglichkeiten', dataStringArray[4]);
        form.append('am_reihenfolge_relevanz', (dataStringArray[5] === "Ja") ? "1" : "0");
        form.append('loesung', dataStringArray[6]);
        form.append('max_punkte', dataStringArray[7]);
        form.append('schwierigkeitsgrad', dataStringArray[8]);
        form.append('schlagworte', dataStringArray[9]);

        fetch('inputmask.php', {
            method: 'POST',
            body: form
        }).then( response => {
            return response.text();
        }).then( text => {
            if(tablename === 'd1') {
                console.log(text);
            }
        });
    }


}


let up = new uploader();
let dataRows = up.getAllRows( up.getNextTable() );


up.tables.forEach( table => {
    up.getAllRows(table).forEach( row => {
        let dataStringArray = up.getColumnDataArray( row );

        switch( dataStringArray[2] ) {
            case " A1":

                up.sendAufgabe( dataStringArray, 'a1' );
                break;
            case " A2":
                up.sendAufgabe( dataStringArray, 'a2' );
                break;
            case "dA3":
                up.sendA3( dataStringArray, 'a3');
                break;
            case "dA4":
                up.sendAufgabe( dataStringArray, 'a4' );
                break;
            case "dB1":
                up.sendAufgabe( dataStringArray, 'b1');
                break;
            case "dB2":
                up.sendB2( dataStringArray, 'b2' );
                break;
            case "dB3":
                up.sendAufgabe( dataStringArray, 'b3');
                break;
            case "dB4":
                console.log("Type not implemented yet! ");
                break;
            case "D1":
                up.sendD1(dataStringArray, 'd1');
                break;
            case "dD2":
                up.sendAufgabe( dataStringArray, 'd2');
                break;
            case "dD3":
                up.sendAufgabe( dataStringArray, 'd3');
                break;
            case "dD4":
                up.sendAufgabe( dataStringArray, 'd4');
                break;
            case "dD5":
                up.sendAufgabe( dataStringArray, 'd5');
                break;
            case "dD6":
                up.sendAufgabe( dataStringArray, 'd6');
                break;
            default:
                console.log("No type found for input");
                break;
        }
    } );
});

