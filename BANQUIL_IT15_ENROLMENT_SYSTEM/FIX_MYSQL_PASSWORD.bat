@echo off
title MySQL - Set root password (skip-grant-tables)
setlocal

set LARAGON_MYSQL=C:\laragon\bin\mysql
if not exist "%LARAGON_MYSQL%" set LARAGON_MYSQL=D:\laragon\bin\mysql
for /d %%D in ("%LARAGON_MYSQL%\mysql-*") do (
    if exist "%%D\bin\mysqld.exe" set MYSQL_BIN=%%D\bin
)
if not defined MYSQL_BIN set MYSQL_BIN=%LARAGON_MYSQL%\mysql-8.4.3-winx64\bin

if not exist "%MYSQL_BIN%\mysqld.exe" (
    echo MySQL NOT FOUND at %MYSQL_BIN%
    pause
    exit /b 1
)

echo.
echo ============================================================
echo   SET MYSQL ROOT PASSWORD (para di na Access denied pag restart)
echo ============================================================
echo.
echo 1. Laragon - click "Stop All", wait 10 seconds
echo 2. Press ENTER here
echo.
set /p DUMMY="Press ENTER after Laragon is STOPPED..."

set "PATH=%MYSQL_BIN%;%PATH%"
cd /d "%MYSQL_BIN%"

echo.
echo 3. MySQL will start in a NEW WINDOW (skip-grant-tables)
echo    Wait until you see "ready for connections"
echo.
start "MySQL skip-grant - LEAVE OPEN until step 5 done" cmd /k "set PATH=%MYSQL_BIN%;%PATH% && cd /d %MYSQL_BIN% && mysqld --defaults-file=..\my.ini --skip-grant-tables --console"

echo.
echo 4. Open a NEW Command Prompt or PowerShell and run:
echo.
echo    cd /d "%MYSQL_BIN%"
echo    mysql -u root
echo.
echo    Then inside mysql type (or copy-paste) one line at a time:
echo.
echo    ALTER USER 'root'@'localhost' IDENTIFIED BY 'root';
echo    FLUSH PRIVILEGES;
echo    exit
echo.
echo 5. After you ran those, CLOSE the MySQL window (the one that says "ready for connections")
echo 6. Laragon - click "Start All"
echo 7. HeidiSQL: user root, password: root
echo 8. In .env set: DB_PASSWORD=root
echo    Then: php artisan config:clear
echo.
pause
