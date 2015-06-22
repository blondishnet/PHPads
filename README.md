# PHPads
Simple PHP banner ad script that requires no MySQL

Recommended minimum Apache configuration: 

    # Stop people viewing the directory contents
    <Directory "<Insert your root install path here>">
      Options -Indexes
    </Directory>
    # Stop people viewing your config file (accessing password to admin etc)
    <FilesMatch "^ads.dat$">
      Require all denied
    </FilesMatch>
    # Stop people other than you accessing your admin tool
    <FilesMatch "admin.php">
      Order deny,allow
      Deny from all
      Allow from <Insert your IP address here>
    </FilesMatch>
    # Stop people re-installing the application
    <FilesMatch "install.php">
      Require all denied
    </FilesMatch>
    # Stop people viewing the .git history
    <DirectoryMatch "\.git">
      Require all denied
    </DirectoryMatch>
    # Stop people browsing through your old upload files
    <DirectoryMatch "uploads">
      Options -Indexes
    </DirectoryMatch>

