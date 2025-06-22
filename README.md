# Job Portal

## Composer
### Installation
1. Download and install composer  
   Click [here](https://getcomposer.org/Composer-Setup.exe) to download the installer.
3. Run the downloaded file
4. "Installation Option"  
       -> Next
5. "Settings Check"  
       -> Browse the php.exe file in your XAMPP folder  
       -> Check the "Add this PHP to your path?"  
       -> Next
7. "Proxy Settings"  
       -> Next
8. "Ready to Install"  
       -> Install
9. "Information"  
        -> Next
10. Finish
### Check the Installation
1. Check if Composer is installed or not  
        -> Open your Terminal or Command Prompt  
        -> Run
    
        ```
        composer
        ```

## Project Initialization
### Git Installation
1. Download and install Git Bash  
   Click [here](https://github.com/git-for-windows/git/releases/download/v2.50.0.windows.1/Git-2.50.0-64-bit.exe) to download the installer.
2. Open the downloaded file
3. Spam "Next" until installation is started UNLESS you want to change the file location in the 
   
### Cloning project from GitHub (Downloading the project)
1. Go to your File Explorer
2. Make a folder for your project / Where to save this project
3. Click on the url tab
4. Type `cmd` and click Enter
5. Run  
   ```
   git clone https://github.com/avidvesha/fp-job-portal
   ```

### Initializing Composer into the Project
1. After the previous step, run  
   ```
   cd fp-job-portal
   ```
2. Run
   ```
   composer install
   ```
3. Don't close the Command Prompt yet
   
### Migrating Database
1. Open XAMPP
2. Start Apache and MySQL
3. Back to the Terminal
4. Run  
   ```
   php artisan migrate
   ```

### How to Run the project
1. Run
   ```
   php artisan serve
   ```
2. Ctrl + CLick on the Link
