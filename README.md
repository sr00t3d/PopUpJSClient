<h1>PopUpJSClient - Beautiful Pop-ups for WHMCS</h1>

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

<h2>Installation</h2>
<ol>
  <li><strong>Clone the repository</strong>:
    <pre><code>git clone https://github.com/rzatkv/popupjsclient.git</code></pre>
  </li>
  <li><strong>Upload files</strong>: Copy the contents of the <code>modules/addons/whmcs_announcement_popup</code> directory to your WHMCS installation directory.</li>
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
|   |   |-- en.php
|   |   `-- fa.php
|-- popupjsclient.php
|-- hooks.php
</code></pre>

<h2>Usage</h2>
<ul>
  <li><strong>Admin Interface</strong>: Use the WHMCS admin area to add/edit/delete announcements.</li>
  <li><strong>Client Area</strong>: Announcements are displayed as pop-ups for clients in the client area. Pop-ups appear based on the announcement's priority, user group, and validity period.</li>
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
  <li><strong>Author</strong>: Reza Karimi</li>
  <li><strong>Email</strong>: <a href="mailto:rzatkv@icloud.com">rzatkv@icloud.com</a></li>
</ul>
<p>If you have any questions or feedback, feel free to contact me! 😊</p>

<hr>
<p>Thank you for using <strong>PopUpJSClient</strong>! If you find this project useful, please consider giving it a star ⭐ on GitHub!</p>
