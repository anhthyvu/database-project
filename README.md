# Montréal Youth Volleyball Club - Database Management GUI

## Project Description
This project implements a graphical user interface (GUI) to facilitate the management of the database for the Montréal Youth Volleyball Club. The system allows users to efficiently manage and interact with club-related data through an intuitive web-based interface.

## Team Members
| Name                     | Student ID        |
|------------------------- |-------------------|
| **Réa Mourad**           | 40310288          |
| **Elizabeth O'Meara**    | 40065959          |
| **Amani-Myriam Maamar**  | 40191681          |
| **Anh Thy Vu**           | 40270849          |
| **Yani Zahouani**        | 40285973          |


## Requirements
- VS Code (or any other IDE)
- XAMPP (to run PHP and MySQL)
- A web browser (Chrome, Firefox, etc.)

## How to Run the Project

### Step 1: Set Up XAMPP
1. Download and install XAMPP from [here](https://www.apachefriends.org/index.html).
2. Open XAMPP and start the Apache and MySQL services.

### Step 2: Install Composer
1. Download and install Composer from [here](https://getcomposer.org/).
2. Verify the installation by running the following command in your terminal:
   ```sh
   composer --version
   ```

### Step 3: Clone the GitHub Repository into htdocs

#### For Windows
1. Open VS Code (or your preferred IDE).
2. Open a terminal and navigate to the `htdocs` directory:
   ```sh
   cd C:\xampp\htdocs
   ```
3. Clone the GitHub repository directly into htdocs:
   ```sh
   git clone [GitHub Repository URL]
   ```

#### For macOS
1. Open VS Code (or your preferred IDE).
2. Open a terminal and navigate to the `htdocs` directory:
   ```sh
   cd /Applications/XAMPP/xamppfiles/htdocs
   ```
3. Clone the GitHub repository directly into htdocs:
   ```sh
   git clone [GitHub Repository URL]
   ```

### Step 4: Set Up the `.env` File
1. Navigate to the project folder in your terminal:
   ```sh
   cd [Project Folder Name]
   ```
2. Copy the `.env.example` file to create a new `.env` file:
   ```sh
   cp .env.example .env
   ```
3. Open the `.env` file in your preferred text editor and configure the database settings (e.g., SERVERNAME, USEWRNAME, PASSWORD, NAME) to match your XAMPP MySQL configuration.

### Step 5: Run the Project in a Browser
1. Ensure that XAMPP is running (Apache and MySQL services should be started).
2. Open a web browser and go to:
   ```sh
   http://localhost/[Project Folder Name]
   ```
