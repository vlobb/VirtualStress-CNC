<?php

function USER($user, $stat) {

    $stat_types = array("username", "ip", "password", "level", "maxtime", "admin", "all");
    if(!in_array($stat, $stat_types)) {
        return "Error, Invalid stat type!";
    }

    $data = file_get_contents("./db/users.db");
    $fix = str_replace("('", "", $data);
    $fix2 = str_replace("')", "", $fix);
    $db = str_replace("','", ",", $fix2);

    $found_check = false;
    $db_user = "";
    $db_ip = "";
    $db_pass = "";
    $db_level = "";
    $db_maxtime = "";
    $db_admin = false;

    $users = explode("\n", $db);
    foreach($users as $usr) {
        if(strpos($usr, $user) !== false) {
            $found_check = true;
            $info = explode(",", $usr);
            $db_user = $info[0];
            $db_ip = $info[1];
            $db_pass = $info[2];
            $db_level = $info[3];
            $db_maxtime = $info[4];
            $db_admin = $info[5];
        }
    }

    if($found_check == false) {
        return "Error, No user fonud!";
    } else {
        switch($stat) {
            case $stat_types[0]:
                return $db_user;
                break;
            case $stat_types[1]:
                return $db_ip;
                break;
            case $stat_types[2]:
                return $db_pass;
                break;
            case $stat_types[3]:
                return $db_level;
                break;
            case $stat_types[4]:
                return $db_maxtime;
                break;
            case $stat_types[5]:
                return $db_admin;
                break;
            case $stat_types[6]:
                return "$db_user,$db_ip,$db_pass,$db_level,$db_maxtime,$db_admin";
                break;
        }
    }
}

function add($usr, $ip, $pw, $level, $maxtime, $admin) {
    if(USER($usr, "all") == "Error, No user fonud!") {
        $db = fopen("../db/users.db", "r");
        $contents = fread($db, filesize("../db/users.db"));
        fclose($db);
        return "[+] Added";
    } else {
        return "[x] Username is taken, Choose another name!";
    }
}

function remove($usr) {
    
}

function log_session($ip, $username) {
    $db = fopen("./db/current.db", "a");
    fwrite($db, "('$username','$ip')\n");
    fclose($db);
}

function remove_session($ip) {
    $old_db = file_get_contents("./db/current.db");
    $old_users = explode("\n", $old_db);

    $new_db = "";
    foreac($old_users as $usrr) {
        
    }
}

?>