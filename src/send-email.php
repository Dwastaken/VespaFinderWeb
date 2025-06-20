<?php

// Ophalen van formuliergegevens
$naam          = $_POST["naam"]          ?? "";
$telefoonnummer= $_POST["telefoonnummer"]?? "";
$beschrijving  = $_POST["beschrijving"]  ?? "";
$email         = $_POST["email"]         ?? "";
$bedrijf       = $_POST["bedrijf"]       ?? "";
$land          = $_POST["land"]          ?? "";

// ===== VERTAALSYSTEEM VOOR LANDNAMEN =====
$landVertaling = [
    // Duitsland
    "Deutschland"    => "Duitsland",
    "Germany"        => "Duitsland",
    "Duitsland"      => "Duitsland",
    "de"             => "Duitsland",
    "Germanie"       => "Duitsland",
    "Allemagne"      => "Duitsland",

    // Engeland
    "Engeland"        => "Engeland",
    "United kingdom" => "Engeland",
    "uk"             => "Engeland",
    "Groot-brittannië"=> "Engeland",
    "Britain"        => "Engeland",
    "gb"             => "Engeland",
    "en"             => "Engeland",

    // Frankrijk
    "France"         => "Frankrijk",
    "Frankrijk"      => "Frankrijk",
    "Frankreich"     => "Frankrijk",
    "fr"             => "Frankrijk",

    // Nederland
    "Nederland"      => "Nederland",
    "Netherlands"    => "Nederland",
    "Holland"        => "Nederland",
    "nl"             => "Nederland",
    
    // Anders
    "Other"          => "Anders",
    "Overig"         => "Anders",
    "Andere"         => "Anders",
    "Anders"         => "Anders",
    "Sonstige"       => "Anders",
    "Autre"          => "Anders"
];

// ===== DEBUG: maak alle keys lowercase =====
$landVertaling = array_change_key_case($landVertaling, CASE_LOWER);

// ===== DEBUG: Normaliseer landnaam voor matching =====
$normalizedLand = mb_strtolower(trim($land));

// Vertaal naar standaard sleutel of gebruik 'Anders' als onbekend
$landSleutel = $landVertaling[$normalizedLand] ?? "Anders";



// ===== EINDE VERTAALSYSTEEM =====

// Ontvanger bepalen op basis van land 
$ontvangers = [
    "Nederland" => "your_email@gmail.com",
    "Duitsland" => "your_email@gmail.com",
    "Frankrijk" => "your_email@gmail.com",
    "Engeland" => "your_email@gmail.com",
    "Anders" => "your_email@gmail.com"
];

// Taalberichten per land (voor gebruiker)
$berichten = [
    "Nederland" => "Bedankt voor je bericht! We nemen spoedig contact met je op.",
    "Duitsland" => "Danke für Ihre Nachricht! Wir werden uns bald mit Ihnen in Verbindung setzen.",
    "Frankrijk" => "Merci pour votre message ! Nous vous contacterons bientôt.",
    "Engeland" => "Thank you for your message! We will get back to you shortly.",
    "Anders" => "Thank you for your message! We will get back to you shortly."
];

// Introductieberichten voor e-mails naar resellers (in juiste taal)
$emailIntroducties = [
    "Nederland" => "Beste Reseller,\n\nEr is een nieuw bericht ontvangen via het contactformulier. Hieronder vind je de gegevens:\n\n",
    "Duitsland" => "Lieber Reseller,\n\nEine neue Nachricht wurde über das Kontaktformular empfangen. Hier sind die Details:\n\n",
    "Frankrijk" => "Cher Revendeur,\n\nUn nouveau message a été reçu via le formulaire de contact. Voici les détails:\n\n",
    "Engeland" => "Dear Reseller,\n\nA new message has been received via the contact form. Here are the details:\n\n",
    "Anders" => "Dear Reseller,\n\nA new message has been received via the contact form. Here are the details:\n\n"
];

// E-mail afsluitingen per land
$emailAfsluitingen = [
    "Nederland" => "\n\nMet vriendelijke groet,\nRobor Vespa Finder Systeem",
    "Duitsland" => "\n\nMit freundlichen Grüßen,\nRobor Vespa Finder System",
    "Frankrijk" => "\n\nCordialement,\nSystème Robor Vespa Finder",
    "Engeland" => "\n\nBest regards,\nRobor Vespa Finder System",
    "Anders" => "\n\nBest regards,\nRobor Vespa Finder System"
];

// Veldnamen per taal
$veldnamen = [
    "Nederland" => [
        "naam" => "Naam",
        "bedrijf" => "Bedrijf",
        "email" => "E-mail",
        "telefoon" => "Telefoon",
        "land" => "Land",
        "beschrijving" => "Beschrijving"
    ],
    "Duitsland" => [
        "naam" => "Name",
        "bedrijf" => "Unternehmen",
        "email" => "E-Mail",
        "telefoon" => "Telefon",
        "land" => "Land",
        "beschrijving" => "Beschreibung"
    ],
    "Frankrijk" => [
        "naam" => "Nom",
        "bedrijf" => "Entreprise",
        "email" => "E-mail",
        "telefoon" => "Téléphone",
        "land" => "Pays",
        "beschrijving" => "Description"
    ],
    "Engeland" => [
        "naam" => "Name",
        "bedrijf" => "Company",
        "email" => "E-mail",
        "telefoon" => "Phone",
        "land" => "Country",
        "beschrijving" => "Description"
    ],
    "Anders" => [
        "naam" => "Name",
        "bedrijf" => "Company", 
        "email" => "E-mail",
        "telefoon" => "Phone",
        "land" => "Country",
        "beschrijving" => "Description"
    ]
];

// Bedanktpagina's per land
$redirects = [
    "Nederland" => "Bedankt.html",
    "Duitsland" => "bedanktdu.html",
    "Frankrijk" => "bedanktfr.html",
    "Engeland" => "bedankten.html",
    "Anders" => "Bedankt.html"
];

// Bepaal de juiste gegevens op basis van vertaalde land sleutel
$ontvangerEmail = $ontvangers[$landSleutel] ?? $ontvangers["Anders"];
$bericht = $berichten[$landSleutel] ?? $berichten["Anders"];
$emailIntroductie = $emailIntroducties[$landSleutel] ?? $emailIntroducties["Anders"];
$emailAfsluiting = $emailAfsluitingen[$landSleutel] ?? $emailAfsluitingen["Anders"];
$velden = $veldnamen[$landSleutel] ?? $veldnamen["Anders"];
$redirectUrl = $redirects[$landSleutel] ?? $redirects["Anders"];

// === Controleer of PHPMailer is geïnstalleerd ===
$autoloadPath = __DIR__ . '/vendor/autoload.php';
if (!file_exists($autoloadPath)) {
    echo "Fout: PHPMailer is niet geïnstalleerd. Voer eerst 'composer require phpmailer/phpmailer' uit in de projectmap.<br>";
    echo "PHP zoekt naar het bestand op pad: " . $autoloadPath;
    exit;
}

// PHPMailer laden
require $autoloadPath;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

try {
    // Server instellingen
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'your_email@gmail.com'; // jouw Gmail
    $mail->Password = 'your_password'; // App-wachtwoord
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Afzender en ontvanger
    $mail->setFrom($email, $naam);
    $mail->addAddress($ontvangerEmail, 'Reseller');

    // Onderwerp van de mail
    $mail->Subject = 'Nieuw contactformulier van ' . $naam;
    
    // Volledige e-mailinhoud met introductie en afsluiting
    $volledigeEmailInhoud = $emailIntroductie . 
                           $velden["naam"] . ": $naam\n" .
                           $velden["bedrijf"] . ": $bedrijf\n" .
                           $velden["email"] . ": $email\n" .
                           $velden["telefoon"] . ": $telefoonnummer\n" .
                           $velden["land"] . ": $land\n" . // Originele landnaam tonen
                           $velden["beschrijving"] . ": $beschrijving" .
                           $emailAfsluiting;
    
    $mail->Body = $volledigeEmailInhoud;

    $mail->send();

    // Alert en redirect in juiste taal
    echo '<script>alert(' . json_encode($bericht) . ');
    window.location.href = "' . $redirectUrl . '";</script>';
} catch (Exception $e) {
    echo "Er ging iets mis: {$mail->ErrorInfo}";
}
?>