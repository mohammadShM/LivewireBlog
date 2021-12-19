<?php /** @noinspection PhpMissingFieldTypeInspection */

namespace App\Http\Livewire\Auth;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{

    public $data = [
        "email" => "",
        "password" => "",
        'remember' => false,
    ];

    public function login()
    {
        $this->validate([
            "data.email" => "required|email",
            "data.password" => "required|string|regex:/^[a-zA-Z0-9@$#^&*!]+$/u",
        ]);
        if (Auth::attempt([
            'email' => $this->data['email'],
            'password' => $this->data['password'],
        ], $this->data['remember'])) {
           if (auth()->user()->is_admin == 1) {
               return redirect()->to(route('index-article',15));
           }else{
               return redirect()->to(route('index-home'));
           }
        }
    }

    public function render(): Factory|View|Application
    {
        return view('livewire.auth.login');
    }
}
