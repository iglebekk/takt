# Nettsidebeskrivelse: Enkel gratis tjeneste for opprettelse av kalenderfiler

## 1. Formål

Nettsiden skal presentere en svært enkel gratistjeneste som lar brukeren opprette og laste ned en kalenderfil i `.ics`-format. Tjenesten skal oppleves like enkel som funksjonen den tilbyr: legg inn nødvendig informasjon, last ned filen, legg arrangementet i kalenderen.

Nettsiden har to hovedoppgaver:

1. Gjøre det åpenbart hva tjenesten gjør og la brukeren bruke den umiddelbart.
2. Gi enkel og presis dokumentasjon til arrangører og systemer som ønsker å forstå eller ta i bruk løsningen.

Det skal ikke bygges en typisk markedsføringsside med mange påstander, omfattende historiefortelling eller unødvendige funksjoner. Dette er først og fremst et nyttig verktøy.

---

## 2. Overordnet designretning

Uttrykket skal være rent, presist og funksjonelt. Tjenesten skal fremstå troverdig og gjennomarbeidet, men ikke tung eller overdesignet.

Designet bygger på tre referanser:

### Equinor: enkelhet og ro

Fra Equinor hentes den luftige og ryddige presentasjonen:

- Stor og tydelig hovedoverskrift.
- Kort forklaring med få ord.
- God bruk av luft mellom elementer.
- Få valg i navigasjonen.
- Store, rolige innholdsseksjoner fremfor mange små kort og bokser.
- Et profesjonelt uttrykk uten typisk «startup-støy».

### IBM Design Language: system og presisjon

Fra IBM hentes det visuelle systemet:

- Stramt rutenett.
- Tydelig typografisk hierarki.
- Sort, hvitt og nøytrale gråtoner som hovedpalett.
- Én kontrollert aksentfarge for lenker, knapper og aktive elementer.
- Enkle linjeikoner der ikon faktisk tilfører forståelse.
- Tekniske detaljer, eksempler og dokumentasjon fremstilles ryddig og konsekvent.

### Laravel Documentation: dokumentasjon som er enkel å bruke

Fra Laravel hentes prinsippene for dokumentasjonsdelen:

- Dokumentasjonen skal være rask å finne fra toppmenyen.
- Venstremeny på større skjermer.
- Klar innholdsflate med god lesebredde.
- Tydelige overskrifter og kode-/URL-eksempler.
- Aktiv side og aktiv seksjon markeres diskret.
- Dokumentasjonen skal være langt enklere enn Laravel sin, fordi tjenesten er liten.

---

## 3. Prinsipper nettsiden skal følge

### Tjenesten først

Besøkende skal kunne opprette en kalenderfil uten å lese om produktet først. Funksjonen skal ligge høyt på forsiden og være enkel å forstå.

### Ingen unødvendig kompleksitet

Ingen innlogging, ingen dashboard, ingen funksjoner som ikke er nødvendige for å løse oppgaven. Dersom tjenesten kun tilbyr opprettelse av kalenderfil for nedlasting, må nettsiden heller ikke gi inntrykk av mer.

### Teknisk troverdighet

Dokumentasjonen skal være presis nok for brukere som ønsker å bygge lenker eller koble tjenesten inn i egne flater. URL-parametere, format, eksempler og begrensninger skal være lett tilgjengelig.

### Visuell disiplin

Hver seksjon skal ha en klar oppgave. Det skal ikke legges inn innhold bare for at siden skal virke større.

---

## 4. Informasjonsarkitektur

Nettsiden bør bestå av få sider:

| Side | Formål |
| --- | --- |
| Forside | Forklare tjenesten og la brukeren opprette en kalenderfil |
| Dokumentasjon | Forklare bruk, URL-struktur, parametere og eksempler |
| Om tjenesten | Kort informasjon om hvorfor tjenesten finnes og at den er gratis |
| Personvern / vilkår | Kort og konkret, basert på hva løsningen faktisk lagrer eller ikke lagrer |

Dersom det er ønskelig å holde løsningen helt minimal, kan «Om tjenesten» integreres i forsiden og personvern ligge som en enkel underside i footer.

---

## 5. Navigasjon

Toppmenyen skal være enkel og tilgjengelig på alle sider.

### Desktop

Venstre side:

- Logo eller tjenestenavn.

Høyre side:

- Opprett kalenderfil
- Dokumentasjon
- Om
- GitHub, kun dersom kildekoden eller tekniske bidrag faktisk skal være synlige

Primærhandlingen skal være «Opprett kalenderfil». På forsiden kan denne lenken peke til skjemaet lenger ned på samme side.

### Mobil

- Tjenestenavn/logo til venstre.
- Enkel menyknapp til høyre.
- Primærfunksjonen skal fremdeles være synlig umiddelbart på siden, uavhengig av menyen.

Toppmenyen bør være sticky, men lav og lite dominerende.

---

## 6. Forsiden

Forsiden bør være kort. Den skal ikke forsøke å forklare alt, men lede brukeren direkte til riktig handling.

### Seksjon 1: Hero og funksjon

Dette er den viktigste delen av nettsiden. Den bør fylle første skjermbilde på desktop, uten å oppleves massiv.

**Forslag til overskrift:**

> Lag en kalenderfil. Del den hvor du vil.

**Forslag til ingress:**

> Opprett en `.ics`-fil for arrangementet ditt. Gratis, enkelt og uten innlogging.

Under teksten skal selve funksjonen ligge, enten direkte som skjema eller med en svært tydelig knapp til skjemaet. Anbefalingen er at skjemaet ligger direkte i hero-området, fordi dette er hele verdien i tjenesten.

### Skjema for opprettelse

Skjemaet bør inneholde kun nødvendige felter:

- Tittel på arrangement
- Startdato og starttid
- Sluttdato og sluttid
- Tidssone, med fornuftig standardverdi
- Sted, valgfritt
- Beskrivelse, valgfritt
- Lenke, valgfritt

Primærknapp:

> Last ned kalenderfil

Sekundær funksjon kan eventuelt være:

> Kopier lenke

Dette skal kun vises dersom tjenesten faktisk støtter at informasjonen deles gjennom en åpen URL.

Skjemaet skal være ryddig, uten stegvis veiviser. Brukeren skal kunne se hele oppgaven samtidig.

### Seksjon 2: Kort forklaring

Under hovedfunksjonen kan tjenesten forklares med tre korte punkter:

1. Fyll inn arrangementet.
2. Last ned kalenderfilen.
3. Del filen eller legg den i kalenderen din.

Ingen illustrasjoner er nødvendig. Små, enkle linjeikoner kan brukes dersom de understøtter forståelsen.

### Seksjon 3: For arrangører og utviklere

En enkel seksjon som leder til dokumentasjonen:

**Overskrift:**

> Skal kalenderfilen brukes på en nettside eller i et system?

**Tekst:**

> Dokumentasjonen viser hvordan du kan opprette kalenderfiler med URL-parametere og bruke tjenesten fra egne løsninger.

Knapper:

- Les dokumentasjonen
- Se eksempel

### Seksjon 4: Kort om tjenesten

Kun dersom det er behov for å bygge tillit eller forklare prinsippene:

> Tjenesten er gratis og laget for én ting: å gjøre det enkelt å legge arrangementer i kalenderen. Ingen konto. Ingen integrasjon mot kalenderen din. Ingen unødvendige steg.

Dette er en viktig presisering dersom tjenesten ikke har direkte tilgang til brukerens kalender.

### Footer

Footer skal være lavmælt og enkel:

- Tjenestenavn
- Dokumentasjon
- Personvern
- Kontakt eller GitHub, dersom relevant
- Kort informasjon om hvem som står bak, dersom ønskelig

---

## 7. Dokumentasjon

Dokumentasjonen bør være en egen del av nettsiden, med et tydelig annet modus enn forsiden: mindre markedsføring, mer verktøy.

### Layout på desktop

Dokumentasjonssidene bygges med tre kolonner:

1. **Venstre navigasjon:** dokumentasjonens kapitler.
2. **Midtkolonne:** selve teksten og eksemplene.
3. **Høyre side:** innholdsfortegnelse på den aktive siden, kun dersom siden har flere seksjoner.

For en liten tjeneste kan høyrekolonnen utelates inntil dokumentasjonen faktisk blir lang nok til at den er nyttig.

### Layout på mobil

- Venstremeny skjules bak en tydelig «Innhold»-knapp.
- Innholdet bruker full bredde med god marg.
- Kodeeksempler må kunne scrolles horisontalt uten å ødelegge layout.

### Foreslått dokumentasjonsstruktur

#### Kom i gang

Kort forklaring av hva en `.ics`-fil er, hva tjenesten gjør og hvordan en fil opprettes manuelt på forsiden.

#### Opprett kalenderfil

Forklaring av feltene:

- Tittel
- Start og slutt
- Tidssone
- Sted
- Beskrivelse
- Lenke

#### Bruk med lenke

Dersom løsningen støtter URL-baserte forespørsler, beskrives hvordan en lenke kan bygges og brukes.

Eksempel:

```text
https://eksempel.no/create?title=Demo+Day&start=2026-06-10T09:00&end=2026-06-10T12:00
```

Dokumentasjonen må vise hvilke parametere som er obligatoriske, hvilke som er valgfrie og hvordan tekst, tidssoner og spesialtegn håndteres.

#### Eksempler

Vis 3–4 konkrete eksempler:

- Enkelt arrangement med tittel og tidspunkt.
- Arrangement med sted og beskrivelse.
- Heldagsarrangement.
- Arrangement med ekstern lenke.

#### Begrensninger og personvern

Forklar kort og presist:

- Om data lagres eller ikke.
- Om tjenesten har tilgang til brukerens kalender eller ikke.
- Eventuelle begrensninger i feltlengde, tidssone eller format.
- At filen må importeres eller åpnes av brukeren i egen kalenderløsning.

#### Vanlige spørsmål

Kun reelle spørsmål som oppstår. Ikke fyll siden med konstruerte FAQ-er.

Eksempler:

- Fungerer filen i Google Calendar, Outlook og Apple Calendar?
- Lagres informasjonen jeg skriver inn?
- Kan jeg endre et arrangement etter at filen er lastet ned?
- Kan jeg bruke tjenesten på egen nettside?

---

## 8. Visuell utforming

### Fargepalett

Uttrykket skal være nøytralt og teknisk, inspirert av IBM, men ikke kopiere IBM direkte.

Forslag:

| Bruk | Farge |
| --- | --- |
| Bakgrunn | Hvit eller svært lys grå |
| Primær tekst | Nesten sort |
| Sekundær tekst | Mørk grå |
| Linjer og rammer | Lys grå |
| Aksent / lenker / primærknapp | Én tydelig blå eller annen nøktern signalfarge |
| Kodeblokker | Svært lys grå bakgrunn med mørk tekst |

Det bør ikke brukes gradienter, sterke dekorative flater eller flere aksentfarger.

### Typografi

Typografien skal være moderne, presis og svært lesbar.

Anbefaling:

- Sans serif-font med godt uttrykk både i grensesnitt og dokumentasjon.
- Mono-font til kode, URL-er og parameterverdier.
- Store, tydelige overskrifter på forsiden.
- Mer kompakt og funksjonelt hierarki i dokumentasjonen.

Mulige fontvalg:

- IBM Plex Sans og IBM Plex Mono, dersom uttrykket gjerne kan ligge tett på IBM-referansen.
- Inter og Geist Mono, dersom det ønskes et mer nøytralt produktuttrykk.

Typografisk nivå:

| Element | Retning |
| --- | --- |
| H1 forside | Stor og tydelig, kort tekst |
| Ingress | Maks 2–3 linjer |
| H2 | God luft over, tydelig deling av seksjoner |
| Brødtekst | God linjehøyde og begrenset linjelengde |
| Dokumentasjon | Maks ca. 70–75 tegn per linje for god lesbarhet |

### Grid og spacing

- Bruk et konsekvent grid, eksempelvis 12 kolonner på desktop.
- Seksjoner skal ha romslig vertikal avstand.
- Forsiden bør ha stor luft.
- Dokumentasjonen skal være mer kompakt, men aldri tett.
- Alle innrykk, margins og komponentavstander må følge faste steg.

### Komponenter

Nettsiden trenger få komponenter:

- Header
- Primærknapp og sekundærlenke
- Skjemafelt
- Kodeblokk med kopieringsknapp
- Informasjons-/merknadsboks i dokumentasjonen
- Sidebar-navigasjon
- Footer

Komponentene skal være flate og enkle. Unngå store skygger, avrundede «app cards» og visuelle effekter uten funksjon.

---

## 9. Brukeropplevelse for skjemaet

Skjemaet er selve produktet og må behandles deretter.

### Krav

- Brukeren skal forstå alle felter uten hjelpetekst der det er mulig.
- Obligatoriske felt må fremgå tydelig.
- Standardverdier bør redusere behovet for utfylling, særlig tidssone.
- Feilmeldinger vises direkte ved feltet, formulert konkret.
- Nedlasting skal starte umiddelbart etter gyldig utfylling.
- Løsningen må fungere godt med tastatur og på mobil.

### Tilbakemelding etter generering

Etter at filen er opprettet, kan brukeren få en enkel bekreftelse:

> Kalenderfilen er lastet ned.

Under kan det eventuelt tilbys:

- Last ned på nytt
- Opprett ny fil

Det bør ikke bygges en omfattende resultatside med mindre det senere finnes et faktisk behov.

---

## 10. Tone og innhold

Språket skal være kort, konkret og nyttig.

### Bruk

- «Lag en kalenderfil»
- «Last ned `.ics`-filen»
- «Bruk lenken på nettsiden din»
- «Ingen innlogging»
- «Vi lagrer ikke informasjonen», kun dersom dette faktisk er riktig

### Unngå

- «Revolusjonerer kalenderopplevelsen»
- «Sømløs integrasjon», dersom det kun er filnedlasting
- «Alt-i-ett-løsning»
- «Smart», «innovativ» og andre påstander som ikke tilfører informasjon
- Lange tekstavsnitt om hvorfor tjenesten er nødvendig

---

## 11. Tilgjengelighet og teknisk kvalitet

Selv om løsningen er enkel, må den bygges korrekt.

### Tilgjengelighet

- God kontrast i tekst, knapper og aktive navigasjonselementer.
- Alle skjemafelt skal ha synlige labels.
- Tastaturnavigasjon skal fungere uten hinder.
- Fokusmarkeringer må være synlige.
- Ikoner må ikke være eneste bærer av informasjon.
- Kodeblokker og lenker må være lesbare på mobil.

### Ytelse

- Siden bør lastes svært raskt.
- Unngå store bilder og unødvendig JavaScript.
- Ingen animasjoner utover eventuelt diskrete tilstandsendringer.
- Dokumentasjon og forside bør kunne rendres effektivt og være robuste uten komplekst frontend-oppsett.

### SEO og deling

Forsiden skal ha:

- Tydelig sidetittel.
- Kort metabeskrivelse som forklarer funksjonen.
- Open Graph-metadata for deling.
- Strukturert og semantisk HTML.

Dokumentasjonen bør bruke beskrivende URL-er, for eksempel:

```text
/docs
/docs/kom-i-gang
/docs/opprett-kalenderfil
/docs/parametere
/docs/eksempler
/docs/personvern
```

---

## 12. Anbefalt første versjon

Første versjon bør være stram og komplett, ikke bred.

### Skal bygges

- Enkel forside med hero og skjema.
- Generering og nedlasting av `.ics`-fil.
- Dokumentasjon med venstremeny på desktop.
- Sider for kom i gang, parametere, eksempler og personvern.
- Enkel header og footer.
- Responsivt oppsett.
- Tilgjengelig og rask løsning.

### Skal ikke bygges uten dokumentert behov

- Brukerkontoer.
- Lagrede arrangementer.
- Dashboard.
- Direkte kalenderintegrasjoner.
- Visuell builder.
- Blogg eller nyhetsseksjon.
- Omfattende FAQ.
- Animasjoner eller grafiske effekter.
- API eller MCP kun fordi det kan være interessant senere.

Løsningen bør være kompromissløs på enkelhet: opprett fil, last ned, forstå bruken.

---

## 13. Kort bestilling til designer eller kodeagent

Design og bygg en enkel nettside for en gratis tjeneste som oppretter nedlastbare `.ics`-kalenderfiler. Forsiden skal være svært ryddig og luftig, inspirert av enkelheten hos Equinor. Det visuelle systemet skal være presist og teknisk, inspirert av IBM Design Language, med tydelig grid, nøytral fargepalett, én aksentfarge og konsekvent typografi. Selve skjemaet for å opprette kalenderfilen skal ligge sentralt og være tilgjengelig direkte fra første skjermbilde.

Dokumentasjonen skal være inspirert av Laravel Documentation, men betydelig enklere: venstremeny på desktop, tydelig innholdsflate, gode kode- og URL-eksempler og egne sider for kom i gang, parametere, eksempler og personvern. Nettsiden skal oppleves som et lite, presist og troverdig verktøy, ikke som en markedsføringsside. Det skal ikke innføres funksjoner, visuelle elementer eller tekst som ikke hjelper brukeren med å opprette eller forstå kalenderfilen.

---

## 14. Referanser

Retningen er utviklet med utgangspunkt i følgende referanser:

- Laravel Documentation: strukturert og navigerbar teknisk dokumentasjon.  
  https://laravel.com/docs/13.x
- Equinor: ren, luftig og profesjonell presentasjon med tydelig førstesidehierarki.  
  https://www.equinor.com/
- IBM Design Language: grid, typografi, farge, ikonografi og helhetlig designsystem.  
  https://www.ibm.com/design/language/
