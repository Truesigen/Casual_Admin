<?php

namespace Kernel\Resources\Http;

class Response
{
    public function redirect(string $url = '/')
    {
        // $this->sendHeader('Location:'.$url);
    }

    public function json(array $data, int $code = 200)
    {
        foreach ($data as &$value) {
            if (! is_array($value) && property_exists($value, 'original')) {
                $value = $value->toJson();
            }

            if (is_array($value)) {
                foreach ($value as &$val) {
                    if (is_object($val) && property_exists($val, 'original')) {
                        $val = $val->toJson();

                    }
                }
            }
        }
        http_response_code($code);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    public function noContent()
    {
        http_response_code(204);
        exit;
    }
}
