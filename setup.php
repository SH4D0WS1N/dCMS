<?php
/*
    dCMS - A simple Content Management System
    Copyright (C) 2011  Joshua "SH4D0WS1N" Souza

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/
echo "<html><head><title>Admin Login - ACP" . '<body><form action="auth.php" method="post">
Set a password: <input type="password" name="pass" /><br>
Title of website: <input type="text" name="title" /><br>
The location of this file: <input type="text" name="dir" value="'. dirname(__FILE__) . '"><br>
Database:<br>
Address: <input type="text" name="dbadd" value="localhost"><br>
Username: <input type="text" name="dbusr" value="root"><br>
Password: <input type="password" name="dbpss" value=""><br>
<input type="submit" />
</form></body></html>';
?>
