# Takt iCalendar Generator

Takt er en enkel, stateless Laravel-applikasjon for å generere gyldige `.ics`-filer fra strukturert eventdata.

Prosjektet er ikke et kalenderprodukt, bookingsystem eller kalenderintegrasjon. Det kobler seg ikke til Google Calendar, Outlook, Apple Calendar eller andre kalendertjenester. Det lagrer heller ikke events. Applikasjonen tar kun imot eventdata, validerer og normaliserer input, og returnerer en iCalendar-fil som kan lastes ned eller brukes videre av systemer og AI-agenter.

## Hva prosjektet gjør

- Genererer `.ics` / iCalendar-filer.
- Eksponerer en åpen URL-generator via `GET /create`.
- Eksponerer et åpent JSON API via `POST /api/ics`.
- Eksponerer MCP-tool `generate_ical_file` for AI-agenter.
- Bruker samme validering, normalisering og generator for alle innganger.
- Returnerer enten `.ics`-fil eller JSON med filinnhold.
- Støtter vanlige eventfelter som tittel, start, slutt, sted, beskrivelse, URL, tidssone, alarm og heldagshendelser.

## Hva prosjektet ikke gjør

- Lagrer ikke events i database.
- Har ikke sluttbrukerinnlogging for kalenderbrukere.
- Ber ikke om OAuth-tilgang til kalenderkontoer.
- Sender ikke e-post eller invitasjoner.
- Håndterer ikke attendees, RSVP eller recurring events i MVP.
- Har ikke list, update eller delete for events.

## Støttede felt

Obligatoriske felt:

- `title`
- `start`
- `end`

Valgfrie felt:

- `description`
- `location`
- `url`
- `timezone`
- `alarm_minutes`
- `all_day`

`alarm_minutes` må være en av:

```txt
0, 5, 10, 15, 30, 60, 1440
```

`url` må starte med `https://`.

Hvis `start` eller `end` sendes uten tidssone-offset, må `timezone` oppgis som gyldig IANA-tidssone, for eksempel `Europe/Oslo`.

## HTTP-bruk

### URL-generator

```http
GET /create?title=Demo%20Day&start=2026-06-03T12:00:00%2B02:00&end=2026-06-03T15:00:00%2B02:00&location=Kristiansand&alarm_minutes=30
```

Responsen er en nedlastbar `.ics`-fil:

```txt
Content-Type: text/calendar; charset=utf-8
Content-Disposition: attachment; filename="demo-day.ics"
```

### JSON API

```http
POST /api/ics
Content-Type: application/json
```

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

Som standard returnerer API-et en `.ics`-fil. Hvis klienten sender `Accept: application/json`, returneres JSON:

```json
{
  "filename": "demo-day.ics",
  "mime_type": "text/calendar; charset=utf-8",
  "content": "BEGIN:VCALENDAR\r\nVERSION:2.0..."
}
```

## MCP

Prosjektet registrerer en MCP-server med tool:

```txt
generate_ical_file
```

Input bruker samme felt og validering som HTTP-endepunktene:

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

Tool-responsen er strukturert JSON med:

- `filename`
- `mime_type`
- `content`

MCP-rutene er registrert i `routes/ai.php`.

## Arkitektur

Kjerneflyten er:

```txt
URL/API/MCP input
-> validation
-> normalization
-> CalendarEventData
-> IcsGenerator
-> .ics or JSON response
```

Viktige filer:

- `app/Data/CalendarEventData.php`
- `app/Services/CalendarEventNormalizer.php`
- `app/Services/IcsGenerator.php`
- `app/Http/Controllers/IcsController.php`
- `app/Http/Requests/IcsRequest.php`
- `app/Mcp/Servers/CalendarServer.php`
- `app/Mcp/Tools/GenerateIcalFileTool.php`
- `routes/web.php`
- `routes/api.php`
- `routes/ai.php`

## Lokal utvikling

Installer avhengigheter:

```bash
composer install
npm install
```

Sett opp miljøfil og app key:

```bash
cp .env.example .env
php artisan key:generate
```

Kjør migreringer hvis databasen skal initialiseres:

```bash
php artisan migrate --no-interaction
```

Start utviklingsmiljøet:

```bash
composer run dev
```

Alternativt kan Laravel-serveren startes direkte:

```bash
php artisan serve
```

## Testing og kvalitet

Kjør testene:

```bash
php artisan test --compact
```

Kjør formattering:

```bash
vendor/bin/pint --dirty --format agent
```

Testdekningen inkluderer:

- `GET /create` happy path og validering.
- `POST /api/ics` `.ics`-respons og JSON-respons.
- iCalendar escaping, line folding, UID, filnavn og alarmblokk.
- MCP-tool med gyldig og ugyldig input.

## Lisens

Prosjektet er basert på Laravel og følger lisensen definert i prosjektets Composer-konfigurasjon.
