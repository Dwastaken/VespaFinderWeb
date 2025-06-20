# VespaFinderWeb

# Talen gebruikt zijn:

HTML, CSS, Javascript
(tailwindcss voor de css) 
API = MapboxAPI

Contactformulier maakt gebruik van PHPMailer dit werkt niet als het niet op een localhost of server gedraaid word.
Voor testen van de PHPMailer heb ik XAMPP Apache gebruikt.

#PHPmailer
code blok hieronder te vinden in de (send-email.php)

```PHP
try {
   // Server instellingen
   $mail->isSMTP();
   $mail->Host = 'smtp.gmail.com';
   $mail->SMTPAuth = true;
   $mail->Username = 'your_email@gmail.com'; // jouw Gmail
   $mail->Password = 'filgkykajrzppetk'; // App-wachtwoord
   $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
   $mail->Port = 587;
} 
```

in dit code blok kan je bij username invullen welke mail het vanaf verstuurd kan worden. Voor het password moet je voor je google account een 2 staps verifictie aanmaken en

hieronder vind je een stappenplan voor het aanmaken van het wachtwoord: 


Stappen:
1. Ga naar: https://myaccount.google.com/apppasswords

2. Log in met je Google-account (als je dat nog niet bent).

Als je nog geen 2-stapsverificatie hebt ingesteld, word je gevraagd dat eerst te doen.

3. Kies bij App bijvoorbeeld “Mail” en bij Apparaat bijvoorbeeld “Other (Custom name)” → geef het een naam zoals “PHPMailer”.

4. Klik op Genereren.

Google toont je een wachtwoord van 16 tekens (zonder spaties). Gebruik dit wachtwoord in plaats van je gewone wachtwoord in PHPMailer.

5. zet de code in je wachtwoord veld

Voor het aanpassen van de emails naar welke dealers het verstuurd moet worden pas dit stukje code aan (ook te vinden in de send-email.php)
```PHP
// Ontvanger bepalen op basis van land 
$ontvangers = [
    "Nederland" => "your_email@gmail.com",
    "Duitsland" => "your_email@gmail.com",
    "Frankrijk" => "your_email@gmail.com",
    "Engeland" => "your_email@gmail.com",
    "Anders" => "your_email@gmail.com"
];
```

# Mapbox
voor de MapboxAPI en het toevoegen van de pinpoints is Javascript gebruikt.
dit is te doen in de FindDealer pages. (FindDealer.html, FindDealeren.html, FindDealerdu.html, FindDealerfr.html)

hieronder de code voor het toevoegen van een pinpoints
dit stukje code kan je zetten in:
```Javascript
const markers = [] array

{
          lngLat: [6.693807, 52.22567],
          popupContent: `
            <div style="text-align: center;">
              <img src="../Images/robormarker.png" alt="Robor Electronics" style="width: 250px; height: auto; margin-bottom: 10px;" />
              <p>Robor Electronics</p>
              <p>Suetersweg 6A, 7497 MZ Bentelo</p>
              <p>0547292090</p>
              <a href="https://robor.nl"><p>https://robor.nl/</p></a>
            </div>
          `,
        },
```
