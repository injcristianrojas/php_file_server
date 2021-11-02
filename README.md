# PHP Lightweight file transfer server

As part of my pentesting operations, I developed this PHP server which comes
as a replacement for the classic `python -m SimpleHTTPServer`, which lacks the
ability to upload files.

# Requirements

This has been tested in PHP 7.4 (CLI). Install it before use:

* In RPM-based distros (Fedora, RedHat, CentOS...): sudo dnf install php-cli
* In DEB-based distros (Ubuntu, Debian, **Kali**...): sudo apt install php-cli

# Usage

## Server launch

Launch using `php -c php.ini -S 0.0.0.0:<listening_port>`. If you use a
`listening_port` which value is less than 1024, [you must start the server using
sudo](https://unix.stackexchange.com/questions/16564/why-are-the-first-1024-ports-restricted-to-the-root-user-only).
You can do this for the classic port 80, so you don't need to specify ports
when calling the server URL. The `launch` script is programmed to do just that. 
You can use that for convenience.

## File downloads

You can browse the files using `http://<your_ip>`. All files have the following 
URL: `http://<your_ip>/files/<file_name>`. If you want to download a file using
Powershell, call:

```powershell
(New-Object System.Net.WebClient).DownloadFile(
  'http://<your_ip>/files/<file_name>', '<file_name>')
```

## File uploads

To upload files, call the root of the web server with `multipart/form-data` 
capabilities. For instance, using Powershell's `System.Net.WebClient`:

```powershell
(New-Object System.Net.WebClient).UploadFile('http://<your_ip>/', '<file_name>')
```

Alternatively, you can use:

```powershell
(New-Object System.Net.WebClient).UploadFile('http://<your_ip>/', (Get-Item '<file_name>').FullName)
```
