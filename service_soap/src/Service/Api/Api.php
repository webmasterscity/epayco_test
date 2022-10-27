<?php

namespace App\Service;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

class Api extends ServiceEntityRepository
{
    public function success($msj = "", $data = [])
    {
        $response = [
            'success' => true,
            'cod_error' => "00",
            'message' => $msj,
            'data' => $data
        ];
        return $this->response($response);
    }
    public function error($msj, $cod)
    {
        $response = [
            'success' => false,
            'cod_error' => $cod,
            'message_error' => $msj,
            'data' => []
        ];
        return $this->response($response);
    }

    private function response(array $response)
    {
        return json_encode($response);
    }
}
