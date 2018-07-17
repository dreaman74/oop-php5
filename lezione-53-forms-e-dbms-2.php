<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="utf-8">
<title>Lezione 53 - Come funziona il Protocollo HTTP - PHP 5.5 ITA da zero ad avanzato - fcamuso</title>
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
        p img {margin: 10px 0px;width: 100%;}
	
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

        .box_giallo {background-color: yellow;margin:10px 0px;padding:5px;}
	
        .celeste {color:#ffffff;font-size:1.5em;background-color:#44aaee;padding:5px;}
	.esempio {color:#ffffff;font-size:1.2em;background-color:#888888;padding:5px;}
        
        .evidenziatore_verde {color: white;background-color: green;padding: 5px;}
    
        .sottotitolo_paragrafo {color:#44aaee;font-size:2em;}
	.titolo_paragrafo {color:#224488;font-size:2.5em;}
</style>
</head>

<body>
    <p id="breadcrumb">
        <a href="index.php" title="indice delle lezioni">Indice</a> / <strong>Lezione 53</strong>
    </p>

    <h1>[53] Come funziona il Protocollo HTTP</h1>
    <p style="font-size:2em;margin-bottom:20px;"><b>Forms e DBMS - Parte 2</b></p>
    
    <ol>
        <li>
            <p>Come funziona il Dialogo tra il Server e il Browser.</p>
        </li>
        <li>
            <p>Il Metodo GET</p>
        </li>
        <li>
            <p>Il Metodo POST</p>
        </li>
    </ol>
    
    <div class="codice">
        <p class="sottotitolo_paragrafo">Approfondimenti</p>
        <ul>
            <li><p><a href="http://docs.symfony.it/book/http_fundamentals.html" title="Symfony e fondamenti di HTTP" target="_blank">Symfony e fondamenti di HTTP</a> 
                (http://docs.symfony.it/book/http_fundamentals.html)</p></li>
        </ul>
    </div>
    
    <hr />

    <h2 id="protocollo-http">Il Procollo HTTP</h2>
    <p><img src="lezione-53/come-funziona-il-dialogo-tra-server-e-browser.png" alt="Come dialogano il Server e il Browser" /></p>

    <h3 class="sottotitolo_paragrafo">Come dialogano il Server e il Browser</h3>
    <ol>
        <li><p><strong>Quando nel Browser si digitalizza l'URL</strong> (indirizzo di un sito), esso <b>prepara una Richiesta HTTP (HTTP Request)</b>;</p></li>
        <li><p><strong>HTTP Request</strong> è composta da un pacchetto di dati, formattati in base alle specifiche del protocollo HTTP (attualmente la specifica 1.1);</li>
        <li><p><strong>Il pacchetto di dati contiene gli Headers (Intestazioni).</strong> La prima direttiva specificata è il metodo della richiesta (GET, POST, etc.). 
            Seguono altre direttive: User Agent, il tipo di risorse che accetta il Browser dal Server, etc.</p></li>
        <li><p>Salvo alcune eccezioni per il GET, <b>con il metodo POST la richiesta HTTP contiene un body</b>, un blocco contenete dei dati supplementari.</p></li>
        <li><p><b>Il Server elabora la richiesta e la invia al Browser (HTTP Response).</b></p></li>
        <li><p>La <b>Risposta HTTP</b> è composta dagli Headers, la specifica del Protocollo HTTP, il codice di stato della Risposta (200 OK, elaborazione completata), 
                altre informazioni (Web Server, la Data, etc.) e i Dati Elaborati.</p></li>
    </ol>

    <hr />
    
    <h3 class="sottotitolo_paragrafo">La Richiesta HTTP del Client</h3>
<pre style="color: white;background-color: black;">
GET / HTTP/1.1
Host: xkcd.com
Accept: text/html
User-Agent: Mozilla/5.0 (Macintosh)
</pre>
    
    <p>Questo semplice messaggio comunica ogni cosa necessaria su quale risorsa esattamente il client sta richiedendo.</p>
    
    <h4 class="esempio">Metodo HTTP e URI</h4>
    <p><b>La prima riga di ogni richiesta HTTP è la più importante</b> e contiene due cose: l'<b>URI</b> e il <b>metodo HTTP</b>.

    <p style="margin: 10px 0px;">L'URI (per esempio: <b>/</b>, <b>/contact</b>, etc.) è l’indirizzo univoco o la locazione che identifica la risorsa che il client vuole. 
        Il metodo HTTP (GET nell'esempio) definisce cosa si vuole fare con la risorsa. <b><u>I metodi HTTP sono verbi della richiesta</u> e definiscono i pochi modi comuni in cui 
            si può agire sulla risorsa</b>:</p>
            <ul>
                <li><strong>GET</strong> - Recupera la risorsa dal server;</li>
                <li><strong>POST</strong> - Crea una risorsa sul server;</li>
                <li><strong>PUT</strong> - Aggiorna la risorsa sul server;</li>
                <li><strong>DELETE</strong> - Elimina la risorsa dal server;</li>
            </ul>
    
    <p>Tenendo questo a mente, si può immaginare come potrebbe apparire una richiesta HTTP per cancellare una specifica voce di un blog, per esempio:</p>
<pre style="color: white;background-color: black;">
DELETE /blog/15 HTTP/1.1
</pre>
    
    <p><b>Ci sono in realtà nove metodi HTTP definiti dalla specifica HTTP</b>, ma molti di essi non sono molto usati o supportati. 
        In realtà, molti browser moderni non supportano nemmeno i metodi PUT e DELETE.</p>
    
    <h4 class="esempio">Gli Headers</h4>
    <p><b>In aggiunta alla prima linea, una richiesta HTTP contiene</b> sempre altre linee di informazioni, chiamate <b>Headers (intestazioni)</b>. 
        Gli Headers fornisco molte informazioni, per esempio:</p>
    <ul>
        <li>il nome dell'Host richiesto;</li>
        <li>i formati di risposta accettati dal client (Accept);</li>
        <li>l'applicazione usata dal client per eseguire la richiesta (User-Agent).</li>
    </ul>
    <p>Esistono molti altri Headers che possono essere trovati nella pagina di Wikipedia 
    <a href="http://en.wikipedia.org/wiki/List_of_HTTP_header_fields" title="Lista Headers HTTP" target="_blank">Lista di header HTTP</a>.</p>

    <hr />
    
    <h3 class="sottotitolo_paragrafo">La Risposta HTTP del Server</h3>
    <p>Una volta che il server ha ricevuto la richiesta, sa esattamente la risorsa di cui il client ha bisogno (tramite l'URI) e cosa vuole fare il client con tale risorsa 
        (tramite il metodo). Per esempio, nel caso di una richiesta GET, il server prepara la risorsa e la restituisce in una risposta HTTP.</p>
        
    <h4>Esempio di una risposta HTTP del Server:</h4>
    <p style="text-align: center;"><img src="lezione-53/http-xkcd.png" alt="risposta del server ad una richiesta get" style="width: 50%;"/></p>
    <p>Tradotto in HTTP, la risposta rimandata al browser assomiglierà a questa:</p>
<pre style="color: white;background-color: black;">
HTTP/1.1 200 OK
Date: Sat, 02 Apr 2011 21:05:05 GMT
Server: lighttpd/1.4.19
Content-Type: text/html
    
&lt;html&gt;
&lt;!-- ... HTML della vignetta di xkcd --&gt;
&lt;/html&gt;
</pre>
    <p><b>La risposta HTTP contiene la risorsa richiesta (il contenuto HTML, in questo caso) oltre ad altre informazioni sulla risposta.</b></p>
    <ol>
        <li>
            <p><b>La prima riga</b> è particolarmente importante e <b>contiene il codice di stato della risposta HTTP</b>.</p>
            
            <p>Il codice di stato comunica il risultato globale della richiesta al client. La richiesta è andata a buon fine (200, in questo caso)? C’è stato un errore? 
                Diversi codici di stato indicano successo, errore o che il client deve fare qualcosa (p.e. rimandare a un'altra pagina).</p>
            
            <p style="margin: 10px 0px;">Una lista completa può essere trovata nella pagina di Wikipedia in 
                <a href="https://it.wikipedia.org/wiki/Codici_di_stato_HTTP" title="Elenco dei codici di stato HTTP" target="_blank">Elenco dei codici di stato HTTP</a>.</p>
        </li>
        <li>
            <p>Come la richiesta, <b>una risposta HTTP contiene parti aggiuntive di informazioni</b>, note come <b>Headers</b>.</p>
            
            <p>Per esempio, <b>un importante Header di risposta HTTP è</b> <span class="evidenziatore_verde">Content-Type</span>. Il corpo della risorsa stessa potrebbe essere restituito in molti formati diversi, 
                inclusi HTML, XML o JSON, mentre l'Header Content-Type <b>usa i tipi di media di Internet</b>, 
                come <span class="evidenziatore_verde">text/html</span>, per dire al client quale formato è restituito.</p>
            
            <p style="margin: 10px 0px;">Una lista di tipi di media comuni si può trovare sulla voce di Wikipedia 
                <a href="https://en.wikipedia.org/wiki/Media_type#List_of_common_media_types" title="Media type" target="_blank">Lista di tipi di media comuni</a>.</p>

            <p style="margin: 10px 0px;"><b>Esistono molti altri Headers</b>, alcuni dei quali molto potenti. Per esempio, <b>alcuni Headers possono essere usati per creare 
                    un potente sistema di cache</b>.</p>
        </li>
    </ol>
     
    <hr />
    
    <h3 class="sottotitolo_paragrafo">Il Metodo GET</h3>
        <p><b>I dati vengono inviati tramite querystring</b> e visualizzati nell'URL del Browser. <b>RFC 2616 (Hypertext Transfer Protocol - HTTP/1.1)</b> 
            non pone limiti alla lunghezza della querystring. <b>Però RFC 3986 limita a 255 caratteri la lunghezza dell'hostname</b> a causa delle limitazioni dei DNS.</p>
        
        <p class="codice"><b>Le richieste con il metodo GET (querystring) sono definite richieste <u>idempotenti</u>.</b>.</p>

        <h4 style="color: white;background-color: green;padding: 5px;">Aspetti Positivi</h4>
        <ul>
            <li>Il Server restituisce la stessa pagina se si passano sempre gli stessi parametri;</li>
            <li>Le pagine vengono recuperate dalla cache del Browser, presente sul disco del device dell'utente. Quindi le richieste idempoenti, risultano essere più 
                veloci e non appesantiscono il Web Server;</li>
            <li>La pagina con querystring, sono salvate negli indici dei Motori di Ricerca.</li>
        </ul>
        
        <p style="background-color: yellow;margin: 10px 0px;padding: 5px;">Non utilizzare il Metodo Get con le pagine che presentano, ogni qualvolta le si chiami, un risultato 
            diverso nonostante i parametri passati siano sempre gli stessi.</p>
            
        <h4 style="color: white;background-color: red;padding: 5px;">Aspetti Negativi</h4>
        <ul>
            <li><p>Le coppie chiave-valore, sono visualizzate nell'URL (Location Bar) del Browser;</p></li>
            <li>
                <p>Il numero di caratteri è limitato dal Browser e dalle impostazioni del Web Server.</p>
                <p><b>Limitazioni dei Browser:</b></p>
                <ul>
                    <li><strong>Microsoft Internet Explorer</strong>, 2.083 caratteri</li>
                    <li><strong>Chrome</strong>, sono visualizzati nell'URL 64K caratteri ma ne vengono passati più di 100K</li>
                    <li><strong>Firefox</strong>, vengono visualizzati nell'URL massimo 65.536 caratteri. Tuttavia URL composte da un numero maggiore di caratteri sono accettate, non sono state testate URL con un numero superiore a 100K caratteri.</li>
                    <li><strong>Safari</strong>, sono state testate URL con più di 80K caratteri.</li>
                    <li><strong>Opera</strong>, Testato con URL composte da 190K caratteri.</li>
                </ul>
                <p><b>Limitazioni dei Web Server:</b></p>
                <ul>
                    <li><strong>APACHE</strong>, 4.000 caratteri</li>
                    <li><strong>IIS - Microsoft Internet Information Server</strong>, 16.384 caratteri</li>
                    <li><strong>Perl HTTP::Daemon (Server)</strong>, Restituisce il Codice di Stato 413 ERRORE quando il numero è superiore a 8.000 caratteri. 
                        Questa limitazione può essere facilmente superata, cercando tutte le occorrenze di 16x1024 in Daemon.pm sostituendole con un valore maggiore. 
                        <b>Certo questa soluzione non ti protegge dall'esposizione di denail of service attack.</b></li>
                </ul>
            </li>
        </ul>
    
    <hr />
    
    <h3 class="sottotitolo_paragrafo">Il Metodo POST</h3>
        <p>I dati vengono salvati nel body della Richiesta HTTP.</p>
        <h4 style="color: white;background-color: green;padding: 5px;">Aspetti Positivi</h4>
        <ul>
            <li>Il limite del body è 15 Mega Byte, la dimensione può essere modificata nel file di configurazione del Web Server. 
                Quindi non ci sono limiti alla dimensione del Body.</li>
        </ul>
</body>
</html>