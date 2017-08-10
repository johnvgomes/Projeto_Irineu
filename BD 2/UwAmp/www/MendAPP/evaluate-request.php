<?php

extract($_POST);
extract($_GET);

if(isset($id)) $id = IdentityDecode($id);


?>