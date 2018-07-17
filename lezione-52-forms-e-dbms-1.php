<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="utf-8">
<title>Lezione 52 - Significato di DBMS, Schema ed Entity e Introduzione a MySQL Workbench - PHP 5.5 ITA da zero ad avanzato - fcamuso</title>
<style type="text/css">
	html, body {
		margin: 0px;
		padding: 0px;
	}

    body {
    	/*background-color:#555555;*/
		font-size: 100%;
		font-family: Arial, sans-serif;
		width: 100%;
	}

    form {border:#a0a0a0 1px solid;margin:0px;padding:5px;}
        
	ol,ul{line-height:1.5em;}
	li {line-height: 3em;}
	li img {margin: 10px 0px;width: 100%;}
	
	h1 {margin: 10px 0px;}
	h2 {color:#ffffff;font-size:2em;background-color:#224488;padding:5px;margin:10px 0px;}
	h3, h4, h5, h6 {margin: 10px 0px;}
	
	p {line-height: 1.5em;margin:0px;padding:0px;}

	table, th, td {border-collapse:collapse;padding:5px;}
	th {border: 1px solid red;text-align:center;}
	td {border: 1px solid grey;text-align:center;}

	pre, .codice {
		background-color:#efefef;
		border:#aaaaaa 1px solid;
		line-height:2em;
		padding:5px;
	}
	
	.codice {
		margin: 15px 0px;
	}
        
	#breadcrumb {
		background:#efefef;
		border-bottom:#afafaf 1px solid;
		margin:0px;
		padding:10px 10px;
	}
		
	.celeste {color:#ffffff;font-size:1.5em;background-color:#44aaee;padding:5px;}
	.esempio {color:#ffffff;font-size:1.2em;background-color:#888888;padding:5px;}
        
	.titolo_paragrafo {color:#224488;font-size:2.5em;}
	.sottotitolo_paragrafo {color:#44aaee;font-size:2em;}
	
	.box_giallo {background-color: yellow;margin:10px 0px;padding:5px;}
</style>
</head>

<body>
    <p id="breadcrumb">
            <a href="index.php" title="indice delle lezioni">Indice</a> / <strong>Lezione 52</strong>
    </p>

    <h1>[52] Significato di DBMS, Schema ed Entity. Introduzione a MySQL Workbench.</h1>
    <p style="font-size:2em;margin-bottom:20px;"><b>Forms e DBMS - Parte 1</b></p>
    
    <ol>
        <li>
            <p><b>Significato dei Termini</b> dei Sistemi di Gestione di Basi di Dati:</p>
            <ul>
                <li><p><strong>DBMS - Database Management System</strong>;</p></li>
                <li><p><strong>Schema</strong>, i singoli Databse contenuti nel DBMS;</p></li>
                <li><p><strong>Entity</strong>, le tabelle contenute in ogni Database, ogni Entity contiene molte Entities;</p></li>
            </ul>
        </li>
        <li>
            <p>Impariamo a conoscere il tool <strong>MySQL Workbench</strong> per la gestione del DBMS Server di MySQL:</p>
            <ol>
                <li><p><strong>Creazione e Gestione di Istanze</strong>, come configurare una connessione al Server MySQL;</p></li>
                <li><p><strong>Creazione del modello concettuale 'quizMaker'</strong>;</p></li>
                <li><p><strong>Schema</strong>, Creazione del Database <b>'quizmaker'</b> utilizzando il modello concettuale;</p></li>
                <li><p><strong>Entity</strong>, Creazione della Tabella <b>'users'</b>.</p></li>
            </ol>
        </li>
    </ol>
    
    <hr />

    <h2 id="termini">Termini</h2>
    <p>Significato dei termini utilizzati per i Sistemi di Gestione di Basi di Dati:</p>
    <ul>
        <li>
            <h3 class="sottotitolo_paragrafo">DBMS</h3>
            <p>DBMS, o meglio RDBMS (Relational DBMS), acronimo di <strong>Database Management System</strong>, o <b>sistema di gestione di basi di dati.</b></p>
            
            <p style="margin: 10px 0px;">Il <strong>Server MySQL</strong> è un <strong>DBMS;</strong></p>
            
            <p class="codice">Approfondimenti: 
                <a href="https://it.wikipedia.org/wiki/Database_management_system" title="DBMS - Database Management System" target="_blank">
                    https://it.wikipedia.org/wiki/Database_management_system</a></p>
        </li>
        <li>
            <h3 class="sottotitolo_paragrafo">Schema</h3>
            <p>Schema o Database sono sinonimi. Un Server DBMS (come il Server MySQL), può contenere molti Database (Schemas);</p>
        </li>
        <li>
            <h3 class="sottotitolo_paragrafo">Entity</h3>
            <p>Il termine con il quale si indicano le tabelle contenute in un Database. Ogni tabella contiene più Entities (records).</p>
        </li>
    </ul>
    
    <hr />
    
    <h2>MySQL Workbench</h2>
    <p>Il MySQL Workbench è un tool ad Interfaccia grafica dedicato alla gestione degli Schema (Database) e delle Entity (Tabelle) del DBMS Server di MySQL. 
        &Egrave; dotato di uno <b>strumento</b> tramite il quale è possibile "disegnare" il <strong>modello concettuale</strong>, da cui 
        <b>è possibile generare in automatico le istruzioni SQL</b> (Structured Query Language) per la creazione (o modifica se esistente) di un Database.</p>

    
	<h3 class="celeste">Configurare la Connessione al Server MySQL Locale</h3>
	<ol>
            <li>
                <p><b>Creare un'Istanza Locale</b> (connessione al DBMS Locale), se non è presente, <b>cliccando sull'icona [+]</b> accanto alla voce <b>MySQL Connections</b>;</p>
                <p><img src="lezione-52/mysql-workbench-dashboard-istanza.png" alt="la dashboard di MySQL Workbench" /></p>
            </li>
            <li>
                <p><b>Gestire i Database dell'Istanza.</b> Una volta creata l'istanza fare doppio click su essa, 
                apparirà una nuova schermata con l'elenco degli Schemas (Database) e relative Entities (Tabelle).</p>
                <p class="box_giallo">Attenzione: <b>Accertarsi sempre di aver selezionato il Database corretto!</b> 
                Per essere sicuri di lavorare sempre sullo stesso Database, <b>nell'elenco SCHEMAS</b>, 
                <b>cliccare sul database con il tasto destro del mouse</b> e selezionare la voce <b>"Set as Default Schema".</b></p>
            </li>
	</ol>
	
	<h3 class="celeste">Creare il Modello Concettuale del Database</h3>
	<ol>
            <li>
                <p><b>Creazione del Modello Concettuale</b> (Grafico) del Database del progetto. Nella Dashboard di MySQL Workbench,   
                <b>Cliccare sul segno [+]</b>, icona posta accanto alla voce <strong>Models</strong> in basso.</p>
                <p><img src="lezione-52/mysql-workbench-models.png" alt="Creazione del modello grafico" style="width: 40%;" /></p>
            </li>
            <li>
                <p>Si apre la finestra (TAB) <strong>MySQL Model</strong></p>
                <p><img src="lezione-52/mysql-model.png" alt="MySQL Model" /></p>
            </li>
            <li>
                <p>Per <strong>creare un Modello Concettuale</strong> (Diagramma), <b>doppio click</b> sull'icona <b>Add Diagram</b> in <b>Model Overview</b> (Box centrale, in alto).</p>
            </li>
            <li>
                <p><strong>Per aggiungere una tabella (Entity)</strong>, cliccare sull'icona 'Place a New Table' (o premere T), settima icona partendo dall'alto accanto al reticolo di disegno.</p>
                <p><img src="lezione-52/place-a-new-table.png" alt="Creare una Tabella" /></p>
            </li>
            <li>
                <p style="margin: 10px 0px;">Cliccare una volta sul reticolo.</p>
            </li>
            <li>
                <p style="margin: 10px 0px;">Doppio click su <b>table1</b>.</p>
                <p><img src="lezione-52/table1.png" alt="Table1" /></p>
            </li>
            <li>
                <p>In Basso, nella TAB <b>'table1 - Table'</b>, nel campo <b>Table name</b> dare il nome <b>users</b> alla tabella.</p>
            </li>
            <li>
                <p><b>Creare le colonne 'iduser', 'email' e 'psw'</b> (cliccando sotto la voce <b>Column Name</b>) come nella <b>immagine sotto riportata</b>:</p>
                <p><img src="lezione-52/tabella-users.png" alt="Tabella users" /></p>
            </li>
            <li>
                <p><b>Salvare il modello concettuale</b>:</p>
                <p>Men&ugrave; <b>File > Save Model</b> (CTRL + S), dando il nome <b>quizMaker.mwb</b> (il suffisso sta per mysql workbench):</p>
                <p><img src="lezione-52/salvare-il-modello.png" alt="SAlvare il modello concettuale" /></p>
                
	</ol>
        
        <h3 class="celeste">Creare il Database dal modello concettuale</h2>
        <ol>
            <li>
                <p>Sempre <b>nella TAB (EER Diagram)</b> del Modello Concettuale attivo, dal men&ugrave; <b>Database</b> selezionare <b>Forward Engineer</b>.</p>
            </li>
            <li>
                <p>Nella finestra che appare (<b>Connection Options</b>) alla voce <b>Stored Connection</b> selezionare la connessione al <b>Server MySQL locale</b>, nella finestra (<b>Forward Engineer to Database</b>) che si è aperta.<br />
                    In seguito, <b>Cliccare</b> sul pulsante <b>Next</b>.</p>
                <p><img src="lezione-52/forward-engineer-to-database.png" alt="Finestra per creazione del Database dal Modello" /></p>
            </li>
            <li>
                <p>Nella finestra successiva (<b>Options</b>), <b>non selezionare alcuna voce e premere</b> nuovamente il pulsante <b>Next</b>.</p>
            </li>
            <li>
                <p>Ora (in <b>Select Objects</b>) <b>spuntare</b> la voce <b>Export MySQL Table Objects</b>.</p>
                <p><img src="lezione-52/select-objects.png" alt="Finestra Select Objects" /></p>
            </li>
            <li>
                <p>Nella finestra <b>Review SQL Script</b> appare il codice delle <b>istruzioni SQL che andranno a creare lo Schema</b> (il Database).<br />
                    <b>Cliccare</b> sul pulsante <b>Next</b>, per procedere con la creazione.</p>
                <p><img src="lezione-52/review-sql-script.png" alt="Finestra Review SQL Script" /></p>
            </li>
            <li>
                <p>Nella finestra successiva (<b>Commit Progress</b>) viene visualizzato il risultato dell'operazione di creazione.</p>
            </li>                
        </ol>
	
</body>
</html>