# Web-Tech Laravel API

This branch contains the Laravel API project for the Web-Tech assignment, merged into the existing `Laravel-API` branch history.

## Project Structure

- `app/`, `bootstrap/`, `config/`, `database/`, `resources/`, `routes/`, `storage/`, `tests/`: Laravel application source
- `public/landing`, `public/signup`, `public/desserts`, `public/drinks`, `public/redeem`: existing branch assets preserved from the original `Laravel-API` branch
- `sql/`: existing SQL files preserved from the original branch
- `src/`: existing PHP database helper preserved from the original branch

## Notes

- Environment-specific secrets such as `.env` are not tracked.
- Composer dependencies in `vendor/` are ignored and should be installed locally with `composer install`.

## Contribution Notes

- Ashutosh: Laravel Eloquent ORM setup, models, relationships, pagination, and CRUD flows across the product UI and API data layer.
- Ryan: Laravel API and authentication flow, REST endpoints, token-based auth, and PowerShell-based endpoint testing workflow.
- No tracked `.ps1` script was found in this repository, so the PowerShell testing contribution is documented here rather than linked to a specific script file.
