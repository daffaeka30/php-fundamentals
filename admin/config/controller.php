<?php

// query select data
function select($query)
{
    global $db;

    $result = mysqli_query($db, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

// create category
function store_category($data)
{
    global $db;
    
    $title = sanitize($data['title']);
    $slug = sanitize($data['slug']);

    // query dengan prepare statement 
    $stmt = $db->prepare("INSERT INTO categories (title, slug) VALUES (?, ?)");
    $stmt->bind_param("ss", $title, $slug);
    $stmt->execute();

    return $stmt->affected_rows;
}

// delete category
function delete_category($id)
{
    global $db;

    // query dengan prepare statement 
    $stmt = $db->prepare("DELETE FROM categories WHERE id_category = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    return $stmt->affected_rows;
}

// update category 
function update_category($data)
{
    global $db;

    $id_category = (int)$data['id_category'];
    $title = sanitize($data['title']);
    $slug = sanitize($data['slug']);

    // query dengan prepare statement 
    $stmt = $db->prepare("UPDATE categories SET title = ?, slug = ? WHERE id_category = ?");
    $stmt->bind_param("ssi", $title, $slug, $id_category);
    $stmt->execute();

    return $stmt->affected_rows;
}

// store film
function store_film($data)
{
    global $db;
    
    $url = sanitize($data['url']);
    $title = sanitize($data['title']);
    $slug = sanitize($data['slug']);
    $description = sanitize($data['description']);
    $release_date = sanitize($data['release_date']);
    $studio = sanitize($data['studio']);
    $id_category = sanitize((int)$data['id_category']);

    // query dengan prepare statement 
    $stmt = $db->prepare("INSERT INTO films (url, title, slug, description, release_date, studio, id_category) VALUES(?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssi", $url, $title, $slug, $description, $release_date, $studio, $id_category);
    $stmt->execute();

    return $stmt->affected_rows;
}

// delete film 
function delete_film($id)
{
    global $db;

    // query dengan prepare statement 
    $stmt = $db->prepare("DELETE FROM films WHERE id_film = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    return $stmt->affected_rows;
}

// update film 
function update_film($data)
{
    global $db;

    $id_film = (int)$data['id_film'];
    $url = sanitize($data['url']);
    $title = sanitize($data['title']);
    $slug = sanitize($data['slug']);
    $description = sanitize($data['description']);
    $release_date = sanitize($data['release_date']);
    $studio = sanitize($data['studio']);
    $id_category = (int)$data['id_category'];
    $is_private = (int)$data['is_private'];

    // query dengan prepare statement 
    $stmt = $db->prepare("UPDATE films SET url = ?, title = ?, slug = ?, description = ?, release_date = ?, studio = ?, id_category = ?, is_private = ? WHERE id_film = ?");
    $stmt->bind_param("ssssssiii", $url, $title, $slug, $description, $release_date, $studio, $id_category, $is_private, $id_film);
    $stmt->execute();

    return $stmt->affected_rows;
}

// create users
function store_users($data)
{
    global $db;
    
    $username = sanitize($data['username']);
    $email = sanitize($data['email']);
    $password = sanitize(password_hash($data['password'], PASSWORD_DEFAULT));

    // query dengan prepare statement 
    $stmt = $db->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $password);
    $stmt->execute();

    return $stmt->affected_rows;
}

// delete user
function delete_user($id)
{
    global $db;

    // query dengan prepare statement 
    $stmt = $db->prepare("DELETE FROM users WHERE id_user = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    return $stmt->affected_rows;
}

// update users
function update_users($data)
{
    global $db;

    $id_user = (int)$data['id_user'];
    $username = sanitize($data['username']);
    $email = sanitize($data['email']);
    $password = sanitize(password_hash($data['password'], PASSWORD_DEFAULT));

    // query dengan prepare statement 
    $stmt = $db->prepare("UPDATE users SET username = ?, email = ?, password = ? WHERE id_user = ?");
    $stmt->bind_param("sssi", $username, $email, $password, $id_user);
    $stmt->execute();

    return $stmt->affected_rows;
}