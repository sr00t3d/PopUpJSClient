PopUpJSClient - Beautiful Pop-ups for WHMCS

PopUpJSClient is a WHMCS add-on module that allows administrators to create and manage announcements easily, and display them as stylish pop-ups for users in the client area. The module features a user-friendly admin interface, supports multimedia announcements, and prioritizes the announcements to ensure the most important information reaches users first.

Features

Easy Management: Add, edit, and delete announcements from the WHMCS admin panel.

Multimedia Support: Create multimedia-rich announcements for more engaging communication.

User Group Targeting: Announcements can be displayed based on user groups.

Priority System: Assign priority levels to announcements to ensure the most critical information is shown first.

Expiration Dates: Set start and expiration dates to automate the visibility of announcements.

Multi-Language Support: The module supports both English and Persian languages for flexibility.

Responsive Design: Pop-ups are designed to look great on both desktop and mobile devices.

Installation

Clone the repository:

git clone https://github.com/your-username/whmcs-announcement-popup.git

Upload files: Copy the contents of the modules/addons/whmcs_announcement_popup directory to your WHMCS installation directory.

Activate the Add-on:

Log in to your WHMCS Admin area.

Navigate to Setup > Addons > Addon Modules.

Locate PopUpJSClient and click Activate.

Set Permissions (optional): Configure the permissions as needed for admin roles to manage announcements.

Configuration

After activation, configure the module settings to fit your requirements.

Navigate to Addons > PopUpJSClient.

Use the admin panel to add, edit, and manage announcements.

File Structure

The project follows a Laravel-style structure for better organization:

/modules/addons/whmcs_announcement_popup
|-- app
|   |-- Controllers
|   |   `-- AnnouncementController.php
|   |-- Models
|   |   `-- Announcement.php
|   |-- Views
|   |   `-- AnnouncementView.php
|-- resources
|   |-- lang
|   |   |-- en.php
|   |   `-- fa.php
|-- routes
|   `-- addon.php
|-- whmcs_announcement_popup.php

Usage

Admin Interface: Use the WHMCS admin area to add/edit/delete announcements.

Client Area: Announcements are displayed as pop-ups for clients in the client area. Pop-ups appear based on the announcement's priority, user group, and validity period.

Customization

Languages: You can find the language files in the resources/lang folder. You can add more languages or customize existing translations.

Styling: Pop-up styling can be customized directly in the addon.php file where the JavaScript code for rendering the pop-up is defined.

Requirements

WHMCS version 7.0 or higher.

PHP version 7.2 or higher.

Contributing

Contributions are welcome! Feel free to open an issue or submit a pull request to help make PopUpJSClient even better.

License

This project is licensed under the MIT License. See the LICENSE file for more information.

Contact

Author: Reza Karimi

Email: rzatkv@icloud.com

If you have any questions or feedback, feel free to contact me! 😊

Thank you for using PopUpJSClient! If you find this project useful, please consider giving it a star ⭐ on GitHub!

