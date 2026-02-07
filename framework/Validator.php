<?php

namespace Framework;

class Validator
{
    protected $data;
    protected $rules;
    protected $errors = [];

    public function __construct($data, $rules)
    {
        $this->data = $data;
        $this->rules = $rules;
    }

    /**
     * Crea una nueva instancia del validador
     */
    public static function make($data, $rules)
    {
        return new self($data, $rules);
    }

    /**
     * Ejecuta la validación y redirige si falla
     */
    public function validate()
    {
        $this->runValidation();

        if (!empty($this->errors)) {
            SessionManager::flashErrors($this->errors);
            SessionManager::flashOld($this->data);

            // Redirigir de vuelta
            $referer = $_SERVER['HTTP_REFERER'] ?? '/';
            header("Location: $referer");
            exit;
        }

        return true;
    }

    /**
     * Ejecuta la validación sin redirigir
     */
    public function runValidation()
    {
        foreach ($this->rules as $field => $rulesString) {
            $rules = explode('|', $rulesString);
            $value = $this->data[$field] ?? null;

            foreach ($rules as $rule) {
                $this->applyRule($field, $value, $rule);
            }
        }
    }

    /**
     * Aplica una regla de validación
     */
    protected function applyRule($field, $value, $rule)
    {
        // Parsear la regla (ej: "min:3" => rule: "min", parameter: "3")
        $parts = explode(':', $rule);
        $ruleName = $parts[0];
        $parameter = $parts[1] ?? null;

        switch ($ruleName) {
            case 'required':
                if (empty($value) && $value !== '0') {
                    $this->errors[$field][] = "El campo " . $this->getFieldName($field) . " es obligatorio.";
                }
                break;

            case 'min':
                if (strlen($value) < $parameter) {
                    $this->errors[$field][] = "El campo " . $this->getFieldName($field) . " debe tener al menos {$parameter} caracteres.";
                }
                break;

            case 'max':
                if (strlen($value) > $parameter) {
                    $this->errors[$field][] = "El campo " . $this->getFieldName($field) . " no puede tener más de {$parameter} caracteres.";
                }
                break;

            case 'numeric':
                if (!is_numeric($value) && !empty($value)) {
                    $this->errors[$field][] = "El campo " . $this->getFieldName($field) . " debe ser un número.";
                }
                break;

            case 'email':
                if (!filter_var($value, FILTER_VALIDATE_EMAIL) && !empty($value)) {
                    $this->errors[$field][] = "El campo " . $this->getFieldName($field) . " debe ser un email válido.";
                }
                break;

            case 'url':
                if (!filter_var($value, FILTER_VALIDATE_URL) && !empty($value)) {
                    $this->errors[$field][] = "El campo " . $this->getFieldName($field) . " debe ser una URL válida.";
                }
                break;

            case 'unique':
                // Formato: unique:tabla,columna
                $params = explode(',', $parameter);
                $table = $params[0] ?? '';
                $column = $params[1] ?? $field;

                if ($table && $column) {
                    $existing = db()->query(
                        "SELECT id FROM {$table} WHERE {$column} = :value",
                        ['value' => $value]
                    )->first();

                    if ($existing) {
                        $this->errors[$field][] = "Este " . $this->getFieldName($field) . " ya está registrado.";
                    }
                }
                break;
        }
    }

    /**
     * Obtiene el nombre legible del campo
     */
    protected function getFieldName($field)
    {
        $names = [
            'name' => 'nombre',
            'description' => 'descripción',
            'price' => 'precio',
            'sku' => 'SKU',
            'title' => 'título',
            'url' => 'URL',
            'id' => 'ID',
            'username' => 'usuario',
            'password' => 'contraseña',
            'email' => 'email',
        ];

        return $names[$field] ?? $field;
    }

    /**
     * Obtiene los errores
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * Verifica si hay errores
     */
    public function fails()
    {
        return !empty($this->errors);
    }

    /**
     * Verifica si la validación pasó
     */
    public function passes()
    {
        return empty($this->errors);
    }
}