<div class="nav"><b>pre-installation check</b> &raquo; <b>license</b> &raquo; <b>configuration</b> &raquo; completed</div>
<h2 id="install">General Configuration</h2>
<?php echo ($msg) ?  "<div class=\"error\">{$msg}</div>" : '';?>
<form action="install.php?step=2" method="post">
  <p>Setting up OcimPress to run on your server involves 3 simple steps...Please enter the hostname of the server OcimPress is to be installed on. Enter the MySQL username, password and database name you wish to use with OcimPress.</p>
  <h3>1. MySQL database configuration:</h3>
  <table class="inner-content data">
    <tr>
      <td>MySQL Hostname:</td>
      <td><input type="text" name="dbhost" size="30" value="<?php echo isset($_POST['dbhost']) ? sanitize($_POST['dbhost']) : 'localhost'; ?>" id="t1" />
        <span class="err" id="err1">Please input correct MySQL hostname.</span></td>
    </tr>
    <tr>
      <td>MySQL User Name:</td>
      <td><input type="text" name="dbuser" size="30" value="<?php echo isset($_POST['dbuser']) ? sanitize($_POST['dbuser']) : ''; ?>" id="t2" />
        <span class="err" id="err2">Please input correct MySQL username.</span></td>
    </tr>
    <tr>
      <td>MySQL Password:</td>
      <td><input type="password" name="dbpwd" size="30" value="<?php echo isset($_POST['dbpwd']) ? sanitize($_POST['dbpwd']) : ''; ?>" id="t3"/>
      <span class="err" id="err3">Please input correct MySQL password.</span></td>
    </tr>
    <tr>
      <td>MySQL Database Name:</td>
      <td><input type="text" name="dbname" size="30" value="<?php echo isset($_POST['dbname']) ? sanitize($_POST['dbname']) : ''; ?>" id="t4"/>
        <span class="err" id="err4">Please input correct database name.</span></td>
    </tr>
  </table>
  <input type="hidden" name="db_action" id="db_action" value="1" />
  <h3>2. Common configuration</h3>
  <p>Configure correct paths and URLs to your OcimPress.</p>
  <table class="inner-content data">
    <tr>
      <td>URL:</td>
      <td><input type="text" name="site_url" value="http://<?php echo $_SERVER['SERVER_NAME'];?>" size="30"/></td>
    </tr>
    <tr>
      <td>Site Name:</td>
      <td><input type="text" name="site_name" value="OcimPress" size="30"/></td>
    </tr>
    <tr>
      <td>Site Description:</td>
      <td><input type="text" name="site_description" value="Just Another OcimPress" size="30"/></td>
    </tr>
    <tr>
      <td>Site Email:</td>
      <td><input type="text" name="site_email" value="admin@mail.com" size="30" id="t8"/>
      <span class="err" id="err8">Please input correct database name.</span></td>
    </tr>
  </table>
  <h3>3. Administrator configuration</h3>
  <p>Please set your admin username. It will be used for login to your admin panel.You should input admin password. Make sure your entered passwords match each other. It can be changed in your admin panel later.</p>
  <table class="inner-content data">
    <tr>
      <td>Admin Username:</td>
      <td><input type="text" name="admin_username" value="<?php echo isset($_POST['admin_username']) ? sanitize($_POST['admin_username']) : 'admin'; ?>" size="30" id="t5" />
        <span class="err" id="err5">Please input correct admin username.</span></td>
    </tr>
    <tr>
      <td>Admin Password:</td>
      <td><input type="password" name="admin_password" value="<?php echo isset($_POST['admin_password']) ? sanitize($_POST['admin_password']) : ''; ?>" size="30" id="t6" />
        <span class="err" id="err6">Please input password.</span></td>
    </tr>
    <tr>
      <td>Admin Password[confirm]:</td>
      <td><input type="password" name="admin_password2" value="<?php echo isset($_POST['admin_password']) ? sanitize($_POST['admin_password']) : ''; ?>" size="30" id="t7" />
        <span class="err" id="err7">Entered passwords do not match.</span></td>
    </tr>
  </table>
  <div class="btn lgn">
    <button type="button" onclick="document.location.href='install.php?step=1';" name="back">Back</button>
    &nbsp;&nbsp;
    <button type="submit" name="next">Next</button>
  </div>
</form>