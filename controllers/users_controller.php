<?php
/**
 * Users model
 * ID - Auto increment
 * user_id - slack user id [varchar](60)
 * username - slack username [varchar](255)
 * temporary - has user enabled notifications temporary [boolean]
 * end_date - notifications end date [datetime]
 */
require_once('./dbconnect.php');

/**
 * Insert users to database
 */
function users_insert_to_database($user_id, $username, $temporary, $end_date){
    global $pdo;

    $data = [
        'user_id'   => $user_id,
        'username'  => $username,
        'temporary' => $temporary,
        'end_date'  => $end_date,
    ];
    $sql = "INSERT INTO users (user_id, username, temporary, end_date) VALUES (:user_id, :username, :temporary, :end_date)";
    $pdo->prepare($sql)->execute($data);
}

/**
 * Select all users
 */
function users_select_all() {
    global $pdo;

    $users = $pdo->query("SELECT * FROM users")->fetchAll();

    return $users;
}

/**
 * Select one user by slack id
 */
function users_select_one($user_id){
    global $pdo;

    $stmt = $pdo->prepare("SELECT * FROM users WHERE user_id=:user_id");
    $stmt->execute(['user_id' => $user_id]);
    $user = $stmt->fetch();

    return $user;
}

/**
 * Delete from users by slack id
 */
function users_delete_one($user_id){
    global $pdo;

    $stmt = $pdo->prepare("DELETE FROM users WHERE user_id=:user_id");
    $stmt->execute(['user_id' => $user_id]);
}