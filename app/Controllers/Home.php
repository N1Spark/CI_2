<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        $data["languages"] = [
            "c++", "c#"
        ];

        return view('welcome_message', $data);
    }

    public function registration()
    {
        helper(['form', 'url']);

        if ($this->request->getMethod() === 'post') {
            $name = $this->request->getPost('name');
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            if ($name && $email && $password) {
                $filePath = WRITEPATH . 'registration_data.txt';

                $entry = "Name: $name | Email: $email | Password: $password\n";

                file_put_contents($filePath, $entry, FILE_APPEND);

                return redirect()->to('/registration')->with('success', 'Регистрация прошла успешно!');
            } else {
                return redirect()->to('/registration')->with('error', 'Заполните все поля!');
            }
        }

        return view('welcome_message');
    }
}
