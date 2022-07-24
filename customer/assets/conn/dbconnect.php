<?php
if(!mysql_connect("localhost","root","","nickcarwash"))
{
     die('oops connection problem ! --> '.mysql_error());
}
if(!mysql_select_db("nickcarwash"))
{
     die('oops database selection problem ! --> '.mysql_error());
}
?>