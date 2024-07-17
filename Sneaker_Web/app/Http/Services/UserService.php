<?php

namespace App\Http\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class UserService
{
    public function create(array $data)
    {
        // Validate the data
        $this->validate($data);

        // Hash the password
        $data['password'] = Hash::make($data['password']);

        // Create and save the user
        return User::create($data);
    }

    private function validate(array $data)
    {
        validator($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users|max:255',
            'password' => 'required|string|min:5|max:255',
        ])->validate();
    }
    public function getAll()
    {
        return User::orderByDesc('id')->paginate(15);
    }

    public function update($id, $request)
    {
        try {
            $user = User::findOrFail($id);
            $user->fill($request->input());
            $user->save();
            Session::flash('success', 'Cập nhật thành công');
        } catch (\Exception $e) {
            Session::flash('error', 'Cập nhật thất bại');
            // \Log::info($e->getMessage());
            return false;
        }
        return true;
    }

    public function getShow($id)
    {
        return User::find($id);
    }
    public function delete($request)
    {
        $product = USER::where('id', $request->input('id'))->first();
        if ($product) {
            $product->delete();
            return true;
        }
        return false;
    }

    public function searchAccount($request)
    {
        $key = $request->input('query');

        // Sử dụng paginate trước khi get() để lấy dữ liệu đã phân trang
        return User::where(function ($query) use ($key) {
            $query->where('name', 'like', '%' . $key . '%')
                ->orWhere('email', $key)
                ->orWhere('level', $key);
        })->paginate(15); // Phân trang với mỗi trang 15 sản phẩm
    }


}
