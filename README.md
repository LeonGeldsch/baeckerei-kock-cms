# SAE-WBD0321-5100-CMS

## Ordnerstuktur
- **/public** - *Unser Server nutzt den Public Folder als Document Root (Für den Endnutzer erreichbarer Bereich)*
- **/public/.htaccess** - *Datei für Apache Konfiguration (ModRewrite)*  
- **/public/index.php** - *Datei die durch die Konfiguration vom ApacheServer standardmäßig aufgerufen wird und den Anwendungsablauf startet*  
- **/src** - *Unser Source Folder, enthält PHP Dateien mit Klassen, Interfaces und Traits welche über einen Autoloader geladen werden*
- **/src/Controller** - *Ordner für Kontroller*  
- **/src/Model** - *Ordner für Model*  
- **/autoload.php** - *Enthält den Autoloader für unsere Anwendung*
- **/config.php** - *Enthält unsere Konfigurationen für die Anwendung*

## URLstruktur
**/controller/method/argument** - Controller->method( argument ) - *Die URL Struktur bestimmt welchen Kontroller, wir mit welcher Methode aufrufen, und ob und welches Argument wir der Methode übergeben.*

- **/** - Index->index() - *Kontroller und Methode für die Startseite*
- **/login** - Login->index() - *Kontroller und Methode für die Loginseite*
- **/logout** - Logout->index() - *Kontroller und Methode für die Logoutseite*
- **/register** - Register->index() - *Kontroller und Methode für die Registrierungsseite*

## Programmablauf (Application)
- **index.php** - Bindet die Konfiguration und den Autoloader ein und erstellt eine Instanz von Application und ruft die Methode Run auf.
    - **src/Application.php** - *new Application()* - Beim Instanziieren der Klasse wird über den Konstruktur die Anfrage vom Nutzer zerlegt und bereinigt und in einer Klassenvariable gespeichert
    - **src/Application.php** - *Application->run()* - Beim Aufrufen der Methode 'run' wird überprüft ob der Angefragte Kontroller und die angefragte Methode existiert, existieren diese beiden wird eine Instanz vom Kontroller erstellt und die Methode aufgerufen, existieren diese beiden nicht wird ein Error Kontroller instanziiert und aufgerufen.
  
## Installation
```shell
$ cd sae-wbd0321-5100-cms
$ composer update
```
