<?php
/**
 * Configurations for social network applications
 * @author Khadime Diakhate <xadimjaxate@gmail.com>
 */
/** General configurations */

//Base path of your application. You must give full path!
$conf_main['base_path'] = 'http://yourdomain.com/';
//Default cookie expire time
$conf_main['expire_time'] = time() + 60*60*24*30;//1 month
//Domain name
$conf_main['domain_name'] = 'http://yourdomain.com/';

//DB Configurations
//Db server e.g. 'localhost'
$conf_db['db_server'] = "";
//Db name : e.g. 'CustomerDb'
$conf_db['db_name'] = "";
//Db username : e.g. 'root'
$conf_db['db_username'] = "";
//Db password
$conf_db['db_password'] = "";
//Db table name. e.g. 'tbl_users'
$conf_db['db_user_table_name'] = "tbl_users";
//Id field of user table . e.g. 'id'
$conf_db['db_user_field_id'] = "id_user";
//Name field of user table . e.g. 'name'
$conf_db['db_user_field_name'] = "name";
//Id field of user table . e.g. 'username'
$conf_db['db_user_field_username'] = "username";
//Id field of user table . e.g. 'password'
$conf_db['db_user_field_password'] = "password";
//Id field of user table . e.g. 'email'
$conf_db['db_user_field_email'] = "email";
//Id field of user table . e.g. 'network_type'
$conf_db['db_user_field_social_network_type'] = "network_type";
//Password stored as md5?
$conf_db['password_md5'] = true;



/** Linked configurations */

//Linkedin credentials
$conf_linkedin['linkedin_access'] = 'clwffe3h1t1v';
$conf_linkedin['linkedin_secret'] = 'D2SlOcbWITlUDxlG';
//Callback url for linkedin. e.g. http://teambuktoo.com/linkedin.php
$conf_linkedin['callback_url'] = '';
$conf_linkedin['base_url'] = $conf_main['base_path'];
