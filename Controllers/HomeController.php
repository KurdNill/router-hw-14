<?php
namespace Controllers;

class HomeController extends \Core\Controller
{
    public function before(string $action): bool
    {
        if (method_exists($this, $action)) {
            return true;
        }
        return false;
    }

    public function after(string $action): void
    {
//        echo 'Метод викликан';
    }

    public function hello(): array
    {
        return ['code' => 200, 'body' => ['<h1>Здрастуй, користувачу</h1>'], 'errors' => []];
    }

    public function timeOfRequest(): array
    {
        $date = date('d F Y \о H:i:s');
        return ['code' => 200, 'body' => "Запит зроблено $date", 'errors' => []];
    }
}