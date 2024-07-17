<?php 
namespace App\Http\View\Composers;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\View\View;
class UserComposer{

    protected $users;
    public function __construct()
    {

    }
    public function compose(View $view)
    {
        if(auth()->user()){
            $User = auth()->user();
            $view->with('users', $User);
        }
    }
}