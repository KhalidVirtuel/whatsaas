<?php
require_once __DIR__ . '/../config/database.php';

class LeadModel {
    public static function insert(array $data) {
        $pdo = db();
        $stmt = $pdo->prepare('INSERT INTO leads (name,email,phone,message,source_page,ip,user_agent) VALUES (?,?,?,?,?,?,?)');
        $ok = $stmt->execute([
            $data['name'],
            $data['email'],
            $data['phone'] ?? null,
            $data['message'],
            $data['source_page'] ?? null,
            inet_pton($_SERVER['REMOTE_ADDR'] ?? ''),
            $_SERVER['HTTP_USER_AGENT'] ?? '',
        ]);
        return $ok ? $pdo->lastInsertId() : false;
    }
}
