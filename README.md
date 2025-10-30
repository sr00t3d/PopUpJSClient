<img src="https://github.com/sr00t3d/PopUpJSClient/blob/docs/322es87b1-3e2b-4791-b714-369e214e6c1.jpg?raw=true" width="700">

<h1>Extendend PopUpJSClient - Beautiful Pop-ups for WHMCS</h1>

<p><strong>PopUpJSClient</strong> is a WHMCS add-on module that allows administrators to create and manage announcements easily, and display them as stylish pop-ups for users in the client area. The module features a user-friendly admin interface, supports multimedia announcements, and prioritizes the announcements to ensure the most important information reaches users first.</p>

<h2>Features</h2>
<ul>
  <li><strong>Easy Management</strong>: Add, edit, and delete announcements from the WHMCS admin panel.</li>
  <li><strong>Multimedia Support</strong>: Create multimedia-rich announcements for more engaging communication.</li>
  <li><strong>User Group Targeting</strong>: Announcements can be displayed based on user groups.</li>
  <li><strong>Priority System</strong>: Assign priority levels to announcements to ensure the most critical information is shown first.</li>
  <li><strong>Expiration Dates</strong>: Set start and expiration dates to automate the visibility of announcements.</li>
  <li><strong>Multi-Language Support</strong>: The module supports both English and Persian languages for flexibility.</li>
  <li><strong>Responsive Design</strong>: Pop-ups are designed to look great on both desktop and mobile devices.</li>
</ul>

<h2>Updates</h2>
<ul>
  <li><strong>Content Type Detection</strong>: It is now possible to determine the type of content, whether it's an image or text.</li>
  <li><strong>Dismiss for 24 Hours</strong>: The dismiss button now sets a cookie to keep the modal dismissed for the next 24 hours.</li>
  <li><strong>Language Improvement</strong>: The language check has been corrected to align with the WHMCS standard.</li>
  <li><strong>Enhanced Display</strong>: Modal display has been improved with new colors and effects.</li>
  <li><strong>Table Layout Update</strong>: Tables now follow the same structure and style as used in WHMCS.</li>
  <li><strong>Custom URL</strong>: Set a custom URL for a image or text annouce. Best fit images in 800x600 example: https://placehold.co/800x600</li>
</ul>


<h2>Installation</h2>
<ol>
  <li><strong>Clone the repository</strong>:
    <pre><code>git clone https://github.com/percioandrade/popupjsclient</code></pre>
  </li>
  <li><strong>Upload files</strong>: Copy the contents of the <code>modules/addons/popupjsclient</code> directory to your WHMCS installation directory.</li>
  <li><strong>Activate the Add-on</strong>:
    <ul>
      <li>Log in to your WHMCS Admin area.</li>
      <li>Navigate to <strong>Setup</strong> &gt; <strong>Addons</strong> &gt; <strong>Addon Modules</strong>.</li>
      <li>Locate <strong>PopUpJSClient</strong> and click <strong>Activate</strong>.</li>
    </ul>
  </li>
  <li><strong>Set Permissions</strong> (optional): Configure the permissions as needed for admin roles to manage announcements.</li>
</ol>

<h2>Configuration</h2>
<p>After activation, configure the module settings to fit your requirements.</p>
<ul>
  <li>Navigate to <strong>Addons</strong> &gt; <strong>PopUpJSClient</strong>.</li>
  <li>Use the admin panel to add, edit, and manage announcements.</li>
</ul>

<h2>File Structure</h2>
<p>The project follows a Laravel-style structure for better organization:</p>
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

<h2>Usage</h2>
<ul>
  <li><strong>Admin Interface</strong>: Use the WHMCS admin area to add/edit/delete announcements.</li>
  <li><strong>Client Area</strong>: Announcements are displayed as pop-ups for clients in the client area. Pop-ups appear based on the announcement's priority, user group, and validity period.</li>
  <li><strong>Image</strong>: For a imagem simple set image url (example: https://placehold.co/800x600) and set content as multimedia and save.
  <li><strong>Custom URL</strong>: For a custom URL set in URL text area</strong></li>
</ul>

<h2>Customization</h2>
<ul>
  <li><strong>Languages</strong>: You can find the language files in the <code>resources/lang</code> folder. You can add more languages or customize existing translations.</li>
  <li><strong>Styling</strong>: Pop-up styling can be customized directly in the <code>addon.php</code> file where the JavaScript code for rendering the pop-up is defined.</li>
</ul>

<h2>Requirements</h2>
<ul>
  <li>WHMCS version 7.0 or higher.</li>
  <li>PHP version 7.2 or higher.</li>
</ul>

<h2>Contributing</h2>
<p>Contributions are welcome! Feel free to open an issue or submit a pull request to help make <strong>PopUpJSClient</strong> even better.</p>

<h2>License</h2>
<p>This project is licensed under the MIT License. See the <a href="LICENSE">LICENSE</a> file for more information.</p>

<h2>Contact</h2>
<ul>
  <li><strong>Author</strong>: Reza Karimi - <a href="mailto:rzatkv@icloud.com">rzatkv@icloud.com</a></li>
  <li><strong>Changes</strong>: Percio Andrade - <a href="mailto:percio@zendev.com.br">percio@zendev.com.br</a></li>
</ul>
<p>If you have any questions or feedback, feel free to contact me! 😊</p>

<hr>
<p>Thank you for using <strong>PopUpJSClient</strong>! If you find this project useful, please consider giving it a star ⭐ on GitHub!</p>
