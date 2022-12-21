# API-Me
## Opis
API-Me jest aplikacją opartą o REST API, w której możesz utworzyć swoje CV jako interfejs API! Projekt oparty jest o framework Laravel.<br>
### Funkcjonalności
W ramach API-Me możesz za pomocą REST API tworzyć/edytować/wyszukiwać/przeglądać:
- Edukacje */educations*
- Doświadczenie */experiences*
- Hobby */hobbies*
- Projekty */projects*
- Umiejętności */skills*

Aplikacja w aktualnej konfiguracji pozwala na zarejestrowanie się **jednemu użytkownikowi** (pierwsza rejestracja po uruchomieniu aplikacji), który ma możliwość utworzyć swoje API CV.

## Moje demo
Zapraszam do zapoznania się z moją wersją aplikacji :)<br>
**GET** *https://api.pszewczyk.pl/about*

## Dokumentacja
Aby zapoznać sie z pełną dokumentacją interfejsu API niniejszej aplikacji zapraszam do przejrzenia dokumentacji przygotowanej w Postman:<br>
https://documenter.getpostman.com/view/15562537/U16onhmQ

## Uruchomienie
Jeśli chcesz uruchomić aplikację na własnym serwerze, powinieneś posiadać:
- PHP
- Apache
- SQLite/MySQL/PostgreSQL
- Composer
- GIT

Instrukcja:
1. Na początku skopiuj repozytorium z pomocą *git clone https://github.com/pszewczykpl/api-me*
2. Zainstaluj wszystkie zależności *composer install*
3. Przygotuj plik .env z własną konfiguracją (możesz skorzystać z .env.example)
4. Wygeneruj klucz *php artisan key:generate*
5. Uruchom aplikacje *php artisan serve*

## Licencja
MIT