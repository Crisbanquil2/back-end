@echo off
title Laragon MySQL - Reset root (no password)
echo.
echo ============================================
echo   RESET LARAGON MYSQL ROOT = NO PASSWORD
echo   (Gawin ito pagkatapos mag-restart kung Access denied)
echo ============================================
echo.

set LARAGON_MYSQL=C:\laragon\bin\mysql
if not exist "%LARAGON_MYSQL%" set LARAGON_MYSQL=D:\laragon\bin\mysql
if not exist "%LARAGON_MYSQL%" set LARAGON_MYSQL=%USERPROFILE%\laragon\bin\mysql

set MYSQL_BIN=
for /d %%D in ("%LARAGON_MYSQL%\mysql-*") do (
    if exist "%%D\bin\mysqld.exe" set MYSQL_BIN=%%D\bin
)
if not defined MYSQL_BIN (
    if exist "%LARAGON_MYSQL%\mysql-8.4.3-winx64\bin\mysqld.exe" set MYSQL_BIN=%LARAGON_MYSQL%\mysql-8.4.3-winx64\bin
)
if not defined MYSQL_BIN (
    if exist "%LARAGON_MYSQL%\mysql-8.0.30-winx64\bin\mysqld.exe" set MYSQL_BIN=%LARAGON_MYSQL%\mysql-8.0.30-winx64\bin
)

if not exist "%MYSQL_BIN%\mysqld.exe" (
    echo MySQL folder NOT FOUND.
    echo Searched: %LARAGON_MYSQL%
    echo.
    echo Edit RESET_LARAGON_MYSQL.bat and set MYSQL_BIN to your path.
    echo Example: C:\laragon\bin\mysql\mysql-8.4.3-winx64\bin
    echo.
    pause
    exit /b 1
)

echo Found MySQL: %MYSQL_BIN%
echo.

set RESET_FILE=%USERPROFILE%\mysql-reset-root-now.txt
(
echo ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY '';
echo FLUSH PRIVILEGES;
) > "%RESET_FILE%"
echo Created: %RESET_FILE%
echo.
echo --- IMPORTANT ---
echo 1. Open LARAGON and click "Stop All"
echo 2. Wait 10 seconds
echo 3. Press ENTER below
echo.
set /p DUMMY="Press ENTER after Laragon is STOPPED..."

echo.
echo Starting MySQL with password reset (new window)...
start "MySQL Reset - CLOSE this when you see 'ready for connections'" cmd /k "cd /d %MYSQL_BIN% && mysqld --defaults-file=..\my.ini --init-file=%RESET_FILE% --console"

echo.
echo 4. In the NEW WINDOW: wait until you see "ready for connections"
echo 5. CLOSE that window
echo 6. Press ENTER here
echo.
set /p DUMMY="Press ENTER after you closed that window..."

del "%RESET_FILE%" 2>nul
echo.
echo 5. In Laragon click "Start All"
echo 6. HeidiSQL: 127.0.0.1, user root, password BLANK
echo 7. In project run: php artisan config:clear
echo.
pause
