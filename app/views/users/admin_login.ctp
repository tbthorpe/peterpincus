<?php 
echo $form->create('User', array('url' => array('controller' => 'users', 'action' => 'login', 'admin'=>true)));
echo $form->input('username');
echo $form->input('password');
echo $form->submit('Login');
echo $form->end(); 
?>