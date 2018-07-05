## Introduzione

Tronscan fornisce ai Super Rappresentanti un modo per pubblicare le loro informazioni direttamente nel luogo in cui si trovano gli elettori, su Tronscan!

I Super Rappresentanti possono utilizzare questo template per costruire una pagina statica che verrà mostrata su Tronscan. Il link verrà posizionato nella pagina di panoramica del voto accanto al nome del Super Rappresentante.

I Super Rappresentanti possono gestire i loro contenuti modificando i files nel repository di Github.

## Come utilizzare il template

**Questa guida presuppone che siate già in possesso di un account con lo stato di Super Rappresentante (candidato).**

### Passaggio 1: Copiare/Clonare il template su Github

* Andate su https://github.com/tronscan/tronsr-template
* Clonate il repository  
    ![](https://raw.githubusercontent.com/tronscan/docs/master/images/fork-repo.png)

Dopo aver clonato il repository verrete posizionati nella vostra cartella `tronsr-template` dove potrete effettuare cambiamenti.

## Passaggio 2: Compilare il template

Adesso i template possono essere variati modificando i files su Github.

* Cliccate sul file che volete modificare  
    ![](https://raw.githubusercontent.com/tronscan/docs/master/images/github-open-file.png)
* Aprite la modalità di modifica ![](https://raw.githubusercontent.com/tronscan/docs/master/images/github-edit-file.png)
* Aggiungete alcune informazioni al file ![](https://raw.githubusercontent.com/tronscan/docs/master/images/edit-team-intro.png)

I files vengono scritti nel formato markdown. Un'eccellente introduzione può essere trovata all'indirizzo https://guides.github.com/features/mastering-markdown/

* Aggiornate i file logo.png e banner.png  
    ![](https://raw.githubusercontent.com/tronscan/docs/master/images/github-upload-files.png)  
    Cliccate quindi su "choose your files" e assicuratevi che il logo o il banner che desiderate caricare siano chiamati `logo.png` oppure `banner.jpg` per sovrascrivere le immagini di default.

Dopo aver compilato il template potrete pubblicarlo su https://tronscan.org

## Passaggio 3: Pubblicazione su Tronscan

* Andate all'indirizzo https://tronscan.org
* Entrate nel vostro account. In questo esempio viene mostrato l'utilizzo della chiave privata (private key), ma è possibile utilizzare un altro metodo per effettuare il login.  
    ![](https://raw.githubusercontent.com/tronscan/docs/master/images/login-with-private-key.png)
* Aprite l'account e assicuratevi che l'etichetta "Representative" sia visibile  
    ![](https://raw.githubusercontent.com/tronscan/docs/master/images/open-account.png)
* Scorrete sino in fondo e cliccate su "Set Github Link" ![](https://raw.githubusercontent.com/tronscan/docs/master/images/set-github-link.png)
* Inserite il vostro username di Github e successivamente cliccate su "Link Github"  
    ![](https://raw.githubusercontent.com/tronscan/docs/master/images/input-username.png)
* Visualizzate la vostra nuova pagina!  
    ![](https://raw.githubusercontent.com/tronscan/docs/master/images/view-page.png)

## Esempio

L'esempio mostra quali files sono presentati e in quale punto. Tutte le volte che i files verranno modificati su Github la pagina verrà aggiornata istantaneamente

![](https://raw.githubusercontent.com/tronscan/docs/master/images/example-page.png)

## FAQ

* **Ho modificato un file ma i cambiamenti non sono visibili su tronscan.org, come mai?**  
    I contenuti dal repository vengono forniti utilizzando il CDN di Github che utilizza una funzione di caching aggressiva, pertanto potrebbero essere necessari alcuni minuti prima che i cambiamenti siano riflessi su tronscan.org.
* **Come mai ci sono elementi HTML visibili su Github ma non su tronscan.org?**  
    Tronscan.org filtrerà tutti i tag HTML per ragioni di sicurezza, verranno ammessi solamente i tag di markdown standard del testo.