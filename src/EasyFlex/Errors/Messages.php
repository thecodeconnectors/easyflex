<?php

namespace TheCodeConnectors\EasyFlex\EasyFlex\Errors;

use TheCodeConnectors\EasyFlex\EasyFlex\Exceptions\AuthenticationException;
use TheCodeConnectors\EasyFlex\EasyFlex\Exceptions\InvalidLicenseException;

class Messages
{
    /**
     * 3.1 Exceptions
     * Een exception heeft altijd een code, een message en in sommige gevallen een detailtag waarin detailgegevens
     * staan over de opgetreden exception. Een exception kan in principe altijd voorkomen.
     */
    protected static $error_messages = [
        '39000' => [
            'message'     => 'Licentie bevat een onjuist hashtotaal.',
            'description' => 'De meegestuurde licentie is niet correct. Waarschijnlijk is deze niet goed overgenomen of bevat deze een typfout.',
            'exception'   => InvalidLicenseException::class,
        ],
        '39001' => [
            'message'     => 'Licentie is niet in orde',
            'description' => 'De meegestuurde licentie is niet correct. Waarschijnlijk is deze niet goed overgenomen of bevat deze een typefout.',
            'exception'   => InvalidLicenseException::class,
        ],
        '39002' => [
            'message'     => 'Licentie is niet afgegeven',
            'description' => 'De meegestuurde licentiecode is correct maar bestaat niet (meer).',
            'exception'   => InvalidLicenseException::class,
        ],
        '39003' => [
            'message'     => 'Er is geen toegang tot de webservices',
            'description' => 'De webservices zijn voor uw werkmaatschappij geblokkeerd of het IP-adres waarvandaan de webservices wordt aangeroepen is niet bekend bij Easyflex. Zie detailgegevens van de exception voor meer informatie.',
        ],
        '39011' => [
            'message'     => 'Gebruikersnaam of wachtwoord onjuist',
            'description' => 'De gebruikersnaam of wachtwoord waarmee u als flexwerker of relatie probeert in te loggen is onjuist.',
            'exception'   => AuthenticationException::class,
        ],
        '39021' => [
            'message'     => 'Het maximum aantal pogingen voor inloggen is bereikt. De toegang tijdelijk is geblokkeerd.',
            'description' => 'Er is 3 keer geprobeerd met een verkeerd wachtwoord in te loggen. De toegang is vanaf nu voor de gebruiker geblokkeerd.',
        ],
        '39022' => [
            'message'     => 'Het maximum aantal pogingen voor inloggen is bereikt. De toegang tijdelijk is geblokkeerd.',
            'description' => 'Er is 3 keer achter elkaar geprobeerd met een verkeerd wachtwoord in te loggen. De toegang is vanaf nu voor de gebruiker geblokkeerd.',
        ],
        '39023' => [
            'message'     => 'Het maximum aantal pogingen voor inloggen is bereikt. De toegang tijdelijk is geblokkeerd.',
            'description' => 'Er is 3 keer achter elkaar geprobeerd met een verkeerd wachtwoord in te loggen. De toegang is vanaf nu voor de gebruiker geblokkeerd.',
        ],
        '39031' => [
            'message'     => 'De toegang tot de webservices is geblokkeerd voor flexwerker.',
            'description' => 'Account is geblokkeerd. Er kan niet worden ingelogd.',
        ],
        '39032' => [
            'message'     => 'De toegang tot de webservices is geblokkeerd voor relatie.',
            'description' => 'Account is geblokkeerd. Er kan niet worden ingelogd.',
        ],
        '39033' => [
            'message'     => 'De toegang tot de webservices is geblokkeerd voor relatiegebruiker.',
            'description' => 'Account is geblokkeerd. Er kan niet worden ingelogd.',
        ],
        '39041' => [
            'message'     => 'Request error (Opdracht onbekend)',
            'description' => 'De webservice opdracht die u probeert uit te voeren bestaat niet. Waarschijnlijk is er een typfout gemaakt.',
        ],
        '39042' => [
            'message'     => 'Request error (Aantal parameters)',
            'description' => 'De benodigde parameters voor het request zijn niet allemaal aanwezig. Controleer of u de juiste parameters hebt meegestuurd.',
        ],
        '39043' => [
            'message'     => 'Request niet gehonoreerd (Parameter niet geldig voor deze request)',
            'description' => 'De parameter waarde bevat een onjuiste waarde. (bijvoorbeeld een string i.p.v. een integer) Of valt buiten een gestelde range. Zie detailgegevens van de exception voor meer informatie.',
        ],
        '39045' => [
            'message'     => 'Request niet gehonoreerd (Gebruiker heeft geen toegang)',
            'description' => 'De ingelogde gebruiker heeft geen rechten om de operatie uit te voeren. Een ingelogde flexwerker probeert bijvoorbeeld een RL opdracht uit te voeren.',
        ],
        '39046' => [
            'message'     => 'Request niet gehonoreerd (Limiet aantal requests bereikt)',
            'description' => 'Het limiet voor het aantal keer per dag aanroepen van het request is bereikt. Dit request kan de volgende dag pas weer uitgevoerd worden.',
        ],
        '39047' => [
            'message'     => 'Request niet gehonoreerd (Virus gevonden in document)',
            'description' => 'Er is een virus gevonden in een meegestuurd document.',
        ],
        '39051' => [
            'message'     => 'Result error (Database_actie is mislukt)',
            'description' => 'Er is een systeemfout opgetreden. Neem contact op met de servicedesk.',
        ],
        '39052' => [
            'message'     => 'Result error (Attribuutwaarde niet correct)',
            'description' => 'Er is een systeemfout opgetreden. Neem contact op met de servicedesk.',
        ],
        '39053' => [
            'message'     => 'Result error (Overlapping tijd)',
            'description' => 'De sessie is verlopen. Er dient opnieuw te worden ingelogd.',
        ],
        '39054' => [
            'message'     => 'Result soap_system_error (Er is een systeemfout opgetreden)',
            'description' => 'Er is een systeemfout opgetreden. Neem contact op met de servicedesk.',
        ],
        '39055' => [
            'message'     => 'Result error (Session tag ontbreekt)',
            'description' => 'U probeert een operatie uit te voeren waarvoor ingelogd dient te zijn en de sessietag hiervoor ontbreekt in het SOAP request.',
        ],
        '39056' => [
            'message'     => 'Result error (Session tag is ongeldig)',
            'description' => 'De meegestuurde sessiecode is ongeldig.',
        ],
        '39057' => [
            'message'     => 'Result error (Licentie tag ontbreekt)',
            'description' => 'De licentietag ontbreekt.',
        ],
    ];

    /**
     * @param $code
     *
     * @return array|string[]
     */
    public static function by_code($code): array
    {
        return static::$error_messages[$code] ?? [];
    }

    /**
     * @param $code
     *
     * @return mixed|string|null
     */
    public static function custom_exception($code)
    {
        $message = static::by_code($code);

        return $message && isset($message['exception']) && $message['exception'] ? $message['exception'] : null;
    }
}
