<?php
require_once __DIR__ . '/../models/LeadModel.php';
require_once __DIR__ . '/../core/validation.php';
require_once __DIR__ . '/../core/response.php';

class LeadController {
    public static function create($req) {
        csrf_set_cookie();
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            json_error('Method Not Allowed', 405);
        }
        $input = validate($req, [
            'name' => 'required|min:2|max:120',
            'email' => 'required|email',
            'phone' => 'max:40',
            'message' => 'required|min:10|max:4000',
            'source_page' => 'max:255',
        ]);
        $id = LeadModel::insert($input);
        if ($id) {
            json_success(['id' => $id], 201);
        }
        json_error('DB error', 500);
    }
}
