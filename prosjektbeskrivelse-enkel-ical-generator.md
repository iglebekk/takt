# Prosjektbeskrivelse: Enkel iCalendar-generator

## Kort beskrivelse

Dette prosjektet skal bygge et svært enkelt verktøy for å generere `.ics`/iCalendar-filer for nedlasting.

Løsningen skal ikke koble seg til brukerens kalender. Den skal ikke ha innlogging for sluttbrukere. Den skal ikke lagre kalenderhendelser. Den skal kun ta imot strukturert eventdata, validere dataene og returnere en gyldig iCalendar-fil som kan lastes ned og importeres i kalenderklienter som Apple Calendar, Google Calendar, Outlook og andre kalenderverktøy.

Målet er å gjøre det enkelt for arrangører, systemer og AI-agenter å lage kalenderfiler uten å måtte håndtere iCalendar-formatet selv.

## Produktidé

Produktet skal være en lettbeint infrastrukturkomponent for kalenderfiler.

Brukeren eller systemet sender inn eventdata som tittel, beskrivelse, sted, starttidspunkt og sluttidspunkt. Tjenesten returnerer en `.ics`-fil som kan lastes ned og åpnes i kalenderklienter.

Dette er ikke et kalenderprodukt. Det er ikke et bookingsystem. Det er ikke en kalenderintegrasjon. Det er kun en generator for iCalendar-filer.

## Hovedprinsipper

Løsningen skal være enkel, effektiv og lett å forstå.

Den skal:

- Kun generere `.ics`-filer.
- Ikke skrive til kalenderen til noen bruker.
- Ikke be om tilgang til Google Calendar, Outlook, Apple Calendar eller andre kalenderklienter.
- Ikke bruke OAuth for sluttbrukerens kalender.
- Ikke lagre events i database i MVP.
- Ikke ha eventadministrasjon.
- Ikke støtte endring eller sletting av events, siden events ikke lagres.
- Ikke sende e-post.
- Ikke håndtere invitasjoner eller RSVP.
- Ikke håndtere attendees i første versjon.
- Ikke håndtere recurring events i første versjon.
- Ikke ha tracking eller analytics i første versjon.

Alle innganger skal bruke samme interne validering og samme iCalendar-generator.

## Målgruppe

Primære brukere er:

- Arrangører som vil lage en enkel “legg til i kalender”-lenke.
- SaaS-systemer som vil generere kalenderfiler for egne brukere.
- CMS- og nettsideløsninger som vil tilby kalendernedlasting.
- Automatiseringssystemer som Make, Zapier og n8n.
- AI-agenter som Claude, OpenClaw, Codex og lignende, via MCP.

Sluttbrukeren som laster ned `.ics`-filen er ikke den primære kunden. Produktet skal primært levere en enkel kalenderfil til systemer og arrangører.

## Scope for MVP

MVP skal bestå av tre innganger:

1. Åpen URL-basert generator.
2. API-endepunkt for systemer.
3. MCP-tool for AI-agenter.

Alle tre innganger skal kun generere en `.ics`-fil. Ingen events skal lagres.

## Inngang 1: Åpen URL-generator

URL-generatoren skal gjøre det mulig å lage en nedlastbar kalenderfil direkte via query-parametere.

Eksempel:

```txt
GET /create?title=Demo%20Day&start=2026-06-03T12:00:00%2B02:00&end=2026-06-03T15:00:00%2B02:00&location=Kristiansand&description=Pitcher%20og%20nettverk&alarm_minutes=30
```

Responsen skal være en `.ics`-fil med riktige headers:

```txt
Content-Type: text/calendar; charset=utf-8
Content-Disposition: attachment; filename="demo-day.ics"
```

URL-generatoren skal være åpen for alle, men med streng validering og rate limiting.

## Inngang 2: API

API-et skal gjøre det mulig for andre systemer å sende inn eventdata og få tilbake en `.ics`-fil.

Eksempel:

```http
POST /api/ics
Authorization: Bearer <token>
Content-Type: application/json
```

Eksempel payload:

```json
{
  "title": "Demo Day",
  "description": "Pitcher og nettverk",
  "location": "Kristiansand",
  "start": "2026-06-03T12:00:00+02:00",
  "end": "2026-06-03T15:00:00+02:00",
  "timezone": "Europe/Oslo",
  "alarm_minutes": 30,
  "url": "https://example.com/event"
}
```

Responsen skal kunne være direkte `.ics`-fil:

```txt
Content-Type: text/calendar; charset=utf-8
Content-Disposition: attachment; filename="demo-day.ics"
```

Alternativt kan API-et også støtte JSON-respons dersom klienten ber om det eksplisitt, for eksempel med `Accept: application/json`.

Eksempel JSON-respons:

```json
{
  "filename": "demo-day.ics",
  "mime_type": "text/calendar",
  "content": "BEGIN:VCALENDAR\r\nVERSION:2.0..."
}
```

API-et bør bruke Bearer token fra første versjon hvis det skal brukes av eksterne systemer. Dette gjør det mulig å styre volum, misbruk og tilgang uten å gjøre produktet tungt.

## Inngang 3: MCP

MCP-serveren skal gjøre det mulig for AI-agenter å generere iCalendar-filer.

Fordi løsningen ikke lagrer data, ikke aksesserer brukerdata og ikke kobler seg til kalenderen, kan MCP-funksjonen i prinsippet være åpen. Likevel bør den ha rate limiting og tydelige begrensninger.

Første MCP-tool bør være:

```txt
generate_ical_file
```

Input:

```json
{
  "title": "Styremøte",
  "description": "Gjennomgang av investeringer",
  "location": "Kristiansand",
  "start": "2026-06-12T14:00:00+02:00",
  "end": "2026-06-12T16:00:00+02:00",
  "timezone": "Europe/Oslo",
  "alarm_minutes": 30
}
```

Output:

```json
{
  "filename": "styremote.ics",
  "mime_type": "text/calendar",
  "content": "BEGIN:VCALENDAR\r\nVERSION:2.0..."
}
```

MCP-serveren skal ikke ha tools for å hente, oppdatere eller slette events i MVP, fordi events ikke lagres.

## Datamodell internt

Selv om events ikke lagres, bør løsningen ha en intern datastruktur for eventdata.

Eksempel på intern event-struktur:

```txt
CalendarEventData
- title
- description
- location
- start
- end
- timezone
- all_day
- url
- alarm_minutes
```

Alle innganger skal mappe input til denne interne strukturen før `.ics` genereres.

Flyt:

```txt
URL/API/MCP input
→ normalisering
→ validering
→ CalendarEventData
→ IcsGenerator
→ .ics response
```

Det skal ikke være egen iCalendar-logikk i URL-controller, API-controller eller MCP-tool. All generering skal skje i én felles service.

## Obligatoriske felt

Første versjon bør kreve:

```txt
title
start
end
```

Tidssone bør enten oppgis eksplisitt eller være inkludert som offset i `start` og `end`.

Anbefalt format:

```txt
2026-06-03T12:00:00+02:00
```

Alternativt:

```txt
start=2026-06-03T12:00:00
end=2026-06-03T15:00:00
timezone=Europe/Oslo
```

Hvis timezone mangler og tidspunktet ikke har offset, bør requesten avvises.

## Valgfrie felt

Første versjon kan støtte:

```txt
description
location
url
alarm_minutes
all_day
timezone
```

## Felt som ikke bør støttes i MVP

Følgende bør ikke støttes i første versjon:

```txt
attendees
organizer
recurrence
RSVP
calendar feed
event updates
event delete
event storage
email sending
calendar sync
```

Dette bør utsettes for å holde produktet smalt og stabilt.

## Heldagsevents

Løsningen bør støtte heldagsevents med eksplisitt felt:

```txt
all_day=true
start_date=2026-06-03
end_date=2026-06-04
```

For heldagsevents skal iCalendar bruke `VALUE=DATE`.

Viktig: I iCalendar er `DTEND` for heldagsevents normalt eksklusiv. Et event som varer én dag, 3. juni 2026, bør derfor ha:

```txt
DTSTART;VALUE=DATE:20260603
DTEND;VALUE=DATE:20260604
```

Dette bør håndteres internt slik at brukeren ikke trenger å forstå iCalendar-regelen.

## Alarmer

Løsningen kan støtte enkel alarm.

Eksempel:

```txt
alarm_minutes=30
```

Dette skal gi en `VALARM` i `.ics`-filen.

Tillatte verdier bør være whitelistet:

```txt
0
5
10
15
30
60
1440
```

Hvis `alarm_minutes` mangler, skal det ikke legges inn alarm.

## Validering

Løsningen må ha streng validering.

Anbefalte regler:

```txt
title: obligatorisk, maks 120 tegn
description: valgfri, maks 2000 tegn
location: valgfri, maks 200 tegn
url: valgfri, må være gyldig https-url
start: obligatorisk, gyldig ISO 8601
end: obligatorisk, gyldig ISO 8601, må være etter start
timezone: valgfri, men må være gyldig IANA timezone hvis oppgitt
alarm_minutes: valgfri, må være en tillatt verdi
all_day: valgfri boolean
```

URL-generatoren bør også ha maksimal total URL-lengde, for eksempel 4–8 KB.

## Sikkerhet og misbruk

Selv om løsningen ikke har tilgang til brukerens kalender, kan den misbrukes.

Mulig misbruk:

- Phishing-tekst i eventbeskrivelse.
- Skadelige URL-er i eventfelt.
- Forsøk på iCalendar-injection.
- Svært lange parametere for å belaste serveren.
- Automatisk massetrafikk.
- Misbruk av domenet til spam.

Tiltak:

- Streng inputvalidering.
- Korrekt escaping av alle tekstfelter i iCalendar-format.
- Maks lengde på alle felt.
- Kun `https://` i URL-felt.
- Ingen HTML i beskrivelse.
- Ingen attendees i MVP.
- Ingen organizer i MVP.
- Rate limiting på åpne endepunkter.
- API-token for profesjonell API-bruk.
- Generer filnavn selv basert på tittel. Ikke bruk filnavn direkte fra input.
- Ikke lagre events eller persondata i MVP.
- Ikke logg mer eventdata enn nødvendig.

## iCalendar-generering

ICS-filen må være gyldig iCalendar.

Minimumsstruktur:

```txt
BEGIN:VCALENDAR
VERSION:2.0
PRODID:-//Example//Simple iCal Generator//EN
CALSCALE:GREGORIAN
METHOD:PUBLISH
BEGIN:VEVENT
UID:<generated-uid>
DTSTAMP:<current-utc-timestamp>
DTSTART:<start>
DTEND:<end>
SUMMARY:<title>
DESCRIPTION:<description>
LOCATION:<location>
URL:<url>
END:VEVENT
END:VCALENDAR
```

Hvis alarm brukes:

```txt
BEGIN:VALARM
TRIGGER:-PT30M
ACTION:DISPLAY
DESCRIPTION:Reminder
END:VALARM
```

Alle linjer må følge iCalendar-formatet, inkludert korrekt line folding ved lange linjer.

Tekstfelter må escapes korrekt. Komma, semikolon, backslash og linjeskift må håndteres etter iCalendar-reglene.

## UID

Hver genererte `.ics`-fil bør få en unik UID.

Siden events ikke lagres, kan UID genereres ved request.

Eksempel:

```txt
<uuid>@domain.no
```

Hvis samme input genereres flere ganger, er det akseptabelt at UID blir forskjellig i MVP. Alternativt kan man lage deterministisk UID basert på hash av input, men det er ikke nødvendig i første versjon.

## Filnavn

Filnavn skal genereres av systemet basert på tittel.

Eksempel:

```txt
Demo Day → demo-day.ics
Styremøte → styremote.ics
```

Filnavn må normaliseres og renses.

Hvis tittel mangler eller ikke kan brukes:

```txt
event.ics
```

## Laravel-arkitektur

Anbefalt enkel struktur:

```txt
app/
  Data/
    CalendarEventData.php
  Services/
    IcsGenerator.php
    CalendarEventValidator.php
  Http/
    Controllers/
      CreateIcsController.php
      ApiIcsController.php
  Mcp/
    Tools/
      GenerateIcalFileTool.php
```

Alle innganger skal bruke samme service:

```txt
CalendarEventValidator
IcsGenerator
```

Controllerne skal være tynne. De skal kun hente input, sende videre til validering/generering og returnere respons.

## Foreslåtte ruter

```txt
GET /create
POST /api/ics
POST /mcp
```

Hvis Laravel MCP brukes, skal MCP-oppsettet følge Laravel sin offisielle MCP-struktur.

## API-autentisering

URL-generatoren skal være åpen.

API-et bør støtte Bearer token.

MCP kan i første versjon være åpen hvis den kun returnerer ICS-content og ikke lagrer noe. Hvis MCP senere skal kobles til kundekontoer, branding, kvoter eller lagrede events, må OAuth vurderes.

For MVP:

```txt
URL: åpen
API: Bearer token
MCP: åpen eller enkel token, avhengig av distribusjon
```

Dersom mål er full Claude remote MCP-produksjonsbruk senere, bør prosjektet være forberedt på OAuth, men det trengs ikke hvis MCP kun brukes som åpen stateless generator.

## Rate limiting

Anbefalte grenser:

```txt
GET /create: 60 requests/min per IP
POST /api/ics: etter API-plan eller token
MCP: 60 requests/min per IP eller client
```

Ved misbruk bør grenser kunne strammes inn.

## Webgrensesnitt

MVP kan ha et svært enkelt webskjema:

Felter:

```txt
Tittel
Beskrivelse
Sted
Startdato og tid
Sluttdato og tid
Tidssone
Alarm
URL
Heldagsevent
```

Output:

```txt
Last ned .ics
Kopier URL
```

Webskjemaet skal ikke være hovedproduktet, men gjør tjenesten enkel å teste og demonstrere.

## Ikke-funksjonelle krav

Løsningen skal være:

- Enkel å bruke.
- Rask.
- Robust.
- Lett å integrere.
- Dokumentert med konkrete eksempler.
- Testbar.
- Uten unødvendig lagring.
- Uten tung brukeradministrasjon.

## Testing

Det bør lages tester for:

- Gyldig URL-request.
- Gyldig API-request.
- Gyldig MCP-input.
- Manglende tittel.
- Ugyldig startdato.
- Sluttid før starttid.
- Ugyldig timezone.
- For lang tittel.
- For lang description.
- Ugyldig URL.
- Alarm utenfor whitelist.
- Korrekt escaping av tekst.
- Korrekt håndtering av linjeskift.
- Korrekt heldagsevent.
- Korrekte response headers.
- Korrekt filnavn.

## Dokumentasjon

Prosjektet bør ha enkel dokumentasjon med:

- Hva tjenesten gjør.
- Hva tjenesten ikke gjør.
- URL-eksempler.
- API-eksempler.
- MCP-eksempler.
- Feltoversikt.
- Valideringsregler.
- Eksempler på `.ics`-output.
- Begrensninger.

## Fremtidige muligheter

Følgende kan vurderes senere, men skal ikke bygges i MVP:

- Lagrede kalenderlenker.
- Branding for kunder.
- White-label-domene.
- Kalenderfeed/abonnement.
- Flere events i én fil.
- Recurring events.
- Attendees.
- Organizer.
- Analytics.
- Dashboard.
- API-planer og fakturering.
- OAuth for MCP.
- Integrasjoner mot CMS og automasjonsverktøy.

## Endelig avgrensning

MVP skal kun gjøre én ting:

Ta imot eventdata og returnere en gyldig `.ics`-fil.

Alt annet er utenfor scope.
