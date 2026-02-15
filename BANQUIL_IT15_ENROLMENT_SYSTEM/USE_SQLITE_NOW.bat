@echo off
title Switch to SQLite (app works without MySQL)
cd /d "%~dp0"

echo.
echo Switching project to SQLite so the app works without MySQL...
echo.

if not exist ".env.mysql-backup" (
    copy .env .env.mysql-backup >nul
    echo Backed up .env to .env.mysql-backup
)

powershell -NoProfile -Command "(Get-Content .env) -replace 'DB_CONNECTION=mysql', 'DB_CONNECTION=sqlite' -replace 'DB_DATABASE=Banquil_it15_enrolment_system', 'DB_DATABASE=database/database.sqlite' | Set-Content .env"

if not exist "database\database.sqlite" (
    type nul > database\database.sqlite
    echo Created database\database.sqlite
)

php artisan config:clear
php artisan migrate --seed --force

echo.
echo Done. Your app now uses SQLite. Run: php artisan serve
echo Then open: http://127.0.0.1:8000
echo.
echo To use MySQL again later: restore .env from .env.mysql-backup and fix MySQL.
echo.
pause
