<?php /** @noinspection PhpMissingFieldTypeInspection */

namespace App\Http\Livewire\Auth;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Register extends Component
{

    public $data = [
        "email" => "",
        "password" => "",
        "password_confirmation" => "",
        "policy" => false,
    ];

    /** @noinspection PhpUndefinedFieldInspection
     * @noinspection PhpMissingReturnTypeInspection
     */
    public function handleRegister()
    {
        $this->validate([
            'data.email' => 'required|email|unique:users,email',
            'data.password' => 'required|string|min:8|confirmed|regex:/^[a-zA-Z0-9@$#^&*!]+$/u',
            'data.policy' => 'required',
        ]);
        if ($this->data['policy']) {
            $user = new User();
            $user->email = $this->data['email'];
            $user->name = explode('@', $this->data['email'])[0]; // for name
            $user->lastname = explode('@', $this->data['email'])[0]; // for last name
            $user->password = Hash::make($this->data['password']);
            $user->created_at = Carbon::now();
            $user->updated_at = Carbon::now();
            $user->save();
            $id = $user->id;
            Auth::loginUsingId($id);
            return redirect()->to(route('index-home'));
        } else {
            session::flash('error', "شما باید قوانین سایت را با دقت مطاله و در صورت قبول داشتن تایید نمایید. با تشکر");
        }
        return back();
    }

    public function render(): Factory|View|Application
    {
        return view('livewire.auth.register');
    }
}
