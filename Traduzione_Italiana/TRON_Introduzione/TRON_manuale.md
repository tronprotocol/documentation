# TRON

## Architettura

![](https://raw.githubusercontent.com/ybhgenius/Documentation/master/images/Architecture.png)

TRON adotta un'architettura three-tier costituita dal livello dati, dal livello core e dal livello applicazione.

+ Livello Dati
    
    Il team tecnico di TRON ha progettato un peculiare protocollo di archiviazione dati distribuita, costituito dall'archiviazione dei blocchi e dall'archiviazione degli stati.  
    Il concetto di base di dati a grafo è stato introdotto nella progettazione del livello dati per meglio rispondere all'esigenza di un'archiviazione dati diversificata nel mondo reale.

+ Livello Core
    
    Il modulo smart contract, il modulo gestione account e il modulo consenso sono i tre moduli del livello core. La visione di TRON consiste nel basare le proprie funzionalità su una stacked virtual machine e su un insieme di istruzioni ottimizzate.  
    Al fine di servire in maniera migliore lo sviluppo delle DApps, Java è stato designato come linguaggio per i contratti intelligenti e verrà poi affiancato da altri linguaggi di programmazione ad alto livello.  
    In aggiunta, verranno introdotte innovazioni al consenso di TRON sulla base del modello DPOS per soddisfare le sue particolari esigenze.

+ Livello Applicazione
    
    Gli sviluppatori possono utilizzare le interfacce per la realizzazione di differenti DApps e portafogli personalizzati.  
    Il protocollo di TRON aderisce nella sua interezza a Google Protobuf, il quale supporta intrinsecamente estensioni multi-linguaggio.

## Consenso

+ Meccanismo di Consenso Migliorato basato su DPOS
    
    Un elevato consumo energetico, una scarsa efficienza e un basso TPS risultano essere sempre un problema per il consenso POW (Proof of Work), il che è completamente agli antipodi rispetto ai valori e al progetto di TRON. Sotto la guida della nostra concezione architetturale, abbiamo scelto di adottare il meccanismo POS (Proof of Stake) come base per il consenso di TRON. Dopo aver acquisito conoscenza tramite ricerche e basandoci su idee costruttive nella community blockchain, abbiamo apportato miglioramenti nel meccanismo DPOS (Delegated Proof of Stake) per venire incontro alle nostre esigenze, giungendo pertanto al meccanismo di consenso di TRON.

+ Regole Base del Meccanismo di Consenso
    
    + I possessori di moneta dovranno votare per i nodi, in relazione alla propria quota di possesso, con una scheda elettorale. E i nodi sono eletti per diventare quelli che sono conosciuti come testimoni sulla base del risultato dei voti e di certe altre regole, le quali cercano, per quanto possibile, di raggiungere un equilibrio tra velocità di produzione dei blocchi e il numero di testimoni.
    + Nel frattempo, la compensazione avverrà per i nodi non eletti, per gli elettori dei nodi eletti e di quelli non eletti, al fine di incoraggiarli a partecipare per le prossime elezioni.
    + I Testimoni produrranno blocchi validi in sequenza basati su regole specifiche di distribuzione e di successo da seguire in modo da produrre la massima ricompensa. 
    + La stragrande maggioranza dei testimoni viene scelta attraverso le votazioni mentre la parte restante viene selezionata con la stessa probabilità tramite uno specifico algoritmo.

## Struttura di archiviazione

+ KhaosDB
    
    All'interno della memoria del full-node, TRON prevede un database KhaosDB, il quale può memorizzare tutte le nuove catene di blocchi generate come fork in un determinato periodo di tempo e può supportare i testimoni nel passaggio dalla loro catena attiva ad una nuova catena principale.

+ Level DB
    
    Level DB verrà inizialmente adottato con l'obiettivo primario di soddisfare i requisiti di alta velocità di lettura/scrittura e un rapido sviluppo. Dopo aver lanciato la main net (rete principale), TRON aggiornerà il suo database con uno interamente personalizzato, adatto alle proprie esigenze.

## Modulo Token

+ Configurazione
    
    Gli utenti possono personalizzare i propri token mediante funzioni TKC (configurazione dei token). I parametri personalizzabili comprendono, tra gli altri, il nome del token, l'abbreviazione, il LOGO, la capitalizzazione totale, il tasso di cambio di TRX, la data di inizio, la data di scadenza, il coefficiente di attenuazione, il modello di inflazione controllata, il periodo di inflazione, la descrizione e così via. Gli utenti possono decidere di rimanere con i parametri di default del sistema nel caso in cui non decidano di personalizzarli.

+ Emissione/Distribuzione
    
    Gli utenti possono emettere i loro token dopo aver configurato i parametri (personalizzati manualmente o predefiniti dal sistema). Il sistema è dotato di funzioni e operazioni che consentono agli emittenti di distribuire token digitali, già convalidati e personalizzati. (I token personalizzati e convalidati possono passare alle operazioni di abilitazione per la distribuzione). Il token personalizzato viene distribuito una volta che i testimoni (witness) l’hanno correttamente validato e può essere liberamente distribuito sulla rete TRON. (Una volta convalidato dai testimoni, il token personalizzato è correttamente distribuito ed entra in circolazione online).

+ API
    
    Le API sono utilizzate principalmente per lo sviluppo di terminali client. Con il supporto delle API, la piattaforma di rilascio dei token può essere progettata dagli sviluppatori stessi.

## Smart Contract / Virtual Machine

Il modulo per gli smart contract di TRON permette agli utenti di personalizzare i contratti in base alle loro necessità. TRON prevede la propria virtual macchine, sulla quale operano gli smart contract, consentendo agli sviluppatori di personalizzare funzioni differenti e complesse.

## Applicazioni di terze parti

+ Piattaforma di distribuzione dei token
    
    Agli sviluppatori di terze parti è consentito l'accesso alla rete di TRON per lo sviluppo delle proprie piattaforme. Con l'utilizzo del modulo dei token di TRON, gli utenti di queste piattaforme possono anche personalizzare i propri token.

+ Portafoglio
    
    Con il portafoglio, gli utenti possono controllare il proprio patrimonio di TRX come altri patrimoni, oppure possono iniziare o ricevere transazioni.

+ Blockchain Explorer
    
    Il blockchain explorer è utilizzato per la visualizzazione dei record dei blocchi, della distribuzione dei nodi e delle operazioni in tempo reale di TRON.

## Migrazione Token ERC20

Prima del lancio della rete main net di TRON, la fondazione TRON inizierà la migrazione da ERC20 a TRX, il token ufficiale di TRON. Il tasso di cambio della migrazione è 1:1. Le specifiche della migrazione comprendono maggiori precisazioni, che potrebbero essere riviste prima dell'ufficiale esecuzione.

## Piano della Comunità

La comunità rimane sempre una parte integrante di qualsiasi progetto blockchain, quindi la nostra speranza è quella di evocare la passione dei membri per una piena partecipazione alla costruzione di Tron. Questa è una convinzione che abbiamo tenuto fermamente fin dall'inizio del nostro progetto.

Sono presenti svariati modi con cui i membri della comunità di TRON possono entrare a far parte del progetto, per esempio, tramite la partecipazione in attività di programmazione del sistema principale o con lo sviluppo di applicazioni di terze parti tramite API rese accessibili da TRON. Inoltre, si terrà una vasta gamma di concorsi aperti a tutti gli utenti per il design del LOGO, per la stesura di saggi, per locandine e materiale pubblicitario, competizioni di programmazione e così via.

+ Fornire tipologie di codice
    
    + feat: una nuova funzionalità
    + fix: risoluzione di un bug
    + docs: i file di revisione
    + perf: una modifica al codice che migliora le prestazioni
    + refactor: un cambiamento nel codice che non risolve nessun bug né aggiunge alcuna funzionalità
    + style: un cambiamento nel formato del testo (spazi bianchi di troppo, correzione di bozze, punteggiatura mancante, ecc.)
    + test: aggiunta di test mancanti o correzione di test esistenti

+ Piano delle ricompense
    
    Vorremmo offrire ricompense a coloro che hanno contribuito alla progressione e allo sviluppo della rete e della comunità di TRON. Una speciale commissione è stata istituita da TRON per condurre attente valutazioni sui contributi di tutti i partecipanti, sulla base delle quali verranno offerti token TRX, regali e altre forme di ricompensa.

## Protocollo

TRON si attiene al protocollo Google Protobuf, il quale ricopre diversi aspetti quali gli account, i blocchi e i trasferimenti.

Esistono tre tipologie di account: base (basic), rilascio asset (asset release) e di contratto (contract). Ciascuna di queste tre tipologie ha sei proprietà: nome, tipo, indirizzo, saldo, voti e asset correlati.

Un account base può richiedere di diventare testimone, il quale possiede altri attributi e parametri tra cui statistiche di voto, chiavi pubbliche, URL, storia delle prestazioni, ecc.

Un blocco è tipicamente costituito da diverse transazioni e un blockheader, il quale contiene informazioni di base del blocco stesso, come il timestamp, la radice dell’albero di Merkle, l'hash del blocco genitore e la firma, solo per citarne alcuni.

Esistono otto categorie di transazioni di contratto: il contratto di crezione di un account, il contratto di trasferimento, il contratto per il trasferimento di beni, il contratto di votazione del patrimonio, il contratto di votazione del testimone, il contratto di creazione di testimone, il contratto di assicurazione del patrimonio ed il contratto di distribuzione.

Ogni transazione contiene diversi TXInputs, TXOutputs e altre proprietà.

La firma è richiesta per immissione, transazione e intestazione di blocco.

L'Inventory, il protocollo coinvolto nei trasferimenti, è utilizzato principalmente per informare i nodi destinatari sui dati trasmessi.

Si prega di fare riferimento all'appendice per il protocollo dettagliato. Le specifiche del protocollo sono soggette a cambiamento in seguito ad un aggiornamento del programma; si prega quindi di fare sempre riferimento all'ultima versione disponibile.