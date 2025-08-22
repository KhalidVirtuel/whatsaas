<?php
function validate(array $data, array $rules) {
    $out = [];
    foreach ($rules as $field => $ruleStr) {
        $rulesArr = explode('|', $ruleStr);
        $value = $data[$field] ?? null;
        foreach ($rulesArr as $rule) {
            if ($rule === 'required' && ($value === null || $value === '')) {
                json_error("$field required", 422);
            }
            if ($rule === 'email' && $value && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                json_error("$field invalid", 422);
            }
            if ($value && str_starts_with($rule, 'min:') && strlen($value) < (int)substr($rule,4)) {
                json_error("$field too short", 422);
            }
            if ($value && str_starts_with($rule, 'max:') && strlen($value) > (int)substr($rule,4)) {
                json_error("$field too long", 422);
            }
        }
        $out[$field] = is_string($value) ? trim($value) : $value;
    }
    return $out;
}
