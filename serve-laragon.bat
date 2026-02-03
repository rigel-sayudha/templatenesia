@echo off
REM ============================================
REM Serve Laravel dengan PHP 8.3 dari Laragon
REM ============================================
REM File ini menggunakan PHP dari Laragon bukan dari XAMPP

setlocal enabledelayedexpansion

REM Set PHP path dari Laragon
set LARAGON_PHP=D:\laragon\bin\php\php-8.3.16-Win32-vs16-x64\php.exe

REM Check apakah PHP executable ada
if not exist "!LARAGON_PHP!" (
    echo.
    echo [ERROR] PHP tidak ditemukan di: !LARAGON_PHP!
    echo.
    pause
    exit /b 1
)

REM Verify PHP version
echo.
echo [INFO] Menggunakan PHP dari Laragon:
"!LARAGON_PHP!" --version
echo.

REM Clear cache dulu
echo [INFO] Clearing cache...
"!LARAGON_PHP!" artisan cache:clear
"!LARAGON_PHP!" artisan view:clear

REM Run Laravel dev server
echo.
echo [INFO] Starting Laravel server at http://127.0.0.1:8000
echo [INFO] Press Ctrl+C to stop the server
echo.

"!LARAGON_PHP!" artisan serve --host=127.0.0.1 --port=8000

pause
