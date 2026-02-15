# PopUpJSClient - Professional Pop-ups for WHMCS 🚀

Readme: [Português](README.pt-br.md)

<img src="https://github.com/sr00t3d/PopUpJSClient/blob/docs/322es87b1-3e2b-4791-b714-369e214e6c1.jpg?raw=true" width="700">

![License](https://img.shields.io/github/license/sr00t3d/bindfilter)
![PHP Script](https://img.shields.io/badge/php-script-green)
![PHP Script](https://img.shields.io/badge/javascript-script-green)

**PopUpJSClient** is an addon module for WHMCS that allows administrators to create, manage, and display announcements elegantly through pop-ups in the client area. Ideal for urgent notices, seasonal promotions, or service updates.

## ✨ Key Features

- **Simplified Management**: Intuitive interface in the WHMCS admin panel to create, edit, and delete announcements.
- **Multimedia Support**: Creation of rich announcements with support for images and custom links.
- **Group Targeting**: Display specific announcements only for certain client groups.
- **Priority System**: Ensures that critical information is viewed first.
- **Automatic Scheduling**: Set start and expiration dates to automate your campaigns.
- **Multilingual**: Native support for Portuguese (BR), English, Spanish, and Farsi.
- **Responsive Design**: Pop-ups optimized for desktop and mobile devices.

## 🔥 What’s New

This extended version includes critical improvements for professional use:
- **Smart Content Detection**: Automatically identifies whether the content is text or image for perfect rendering.
- **Display Control (Dismiss 24h)**: Cookie implementation so the client is not bothered by the same pop-up for 24 hours after closing it.
- **Language Standardization**: Fixes in language detection logic to align with WHMCS global standards.
- **Visual Upgrade**: Improvements to the modal interface with new colors, transition effects, and tables following the native WHMCS style.
- **Custom URLs**: Support for external links in image or text announcements (Recommended: Images in 800x600).

## 🚀 Installation

1 **Clone the Repository:**

`git clone https://github.com/sr00t3d/PopUpJSClient/`

2 File Upload: Copy the contents of the `modules/addons/popupjsclient` folder to the corresponding directory in your WHMCS installation.

3 Activation:
- Go to WHMCS Admin at **Settings** > **Addons** > **Addon Modules**.
- Locate **PopUpJSClient** and click **Activate**.
- Configure access permissions for the desired administrative roles.

## 📁 File Structure (Laravel Standard)

The project uses a modern organization to facilitate maintenance:

<pre><code>/modules/addons/popupjsclient
|-- lib
|   |   `-- Model.php
|   |   `-- ModuleController.php
|   |   `-- ModuleView.php
|   |
|-- resources
|   |-- lang
|   |   |-- english.php
|   |   `-- farsi.php
|   |   `-- spanish.php
|   |   `-- portuguese-br.php
|-- popupjsclient.php
|-- hooks.php
</code></pre>

# 🛠️ Requirements
- **WHMCS**: Version 7.0 or higher.
- **PHP**: Version 7.2 or higher.

## 🤝 Contributions and Support

This project is an extended fork based on the original work of **Reza Karimi**. Contributions are welcome!

- **Original Author**: Reza Karimi
- **Improvements and Maintenance**: Percio Andrade

## ⚠️ Legal Notice

> [!WARNING]
> This software is provided "as is". Always make sure to test first in a development environment. The author is not responsible for any misuse, legal consequences, or data impact caused by this tool.

## 📚 Detailed Tutorial

For a complete, step-by-step guide, check out my full article:

👉 [**Create modal popups in WHMCS**](https://perciocastelo.com.br/blog/create-modal-popups-in-whmcs.html)

## License 📄

This project is licensed under the **GNU General Public License v3.0**. See the [LICENSE](LICENSE) file for more details.
