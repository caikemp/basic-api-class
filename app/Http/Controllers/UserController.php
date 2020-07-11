<?php

namespace App\Http\Controllers;

use App\Product;
use App\User;
use Illuminate\Http\Request;
use App\Utils\RequestValidator;
use App\Utils\StringValidatorPlus;


class UserController extends Controller
{
    function list(Request $request) {
        return response()->json([
            'users' => User::get(),
            'products' => Product::get(),
        ]);
    }

    public function delete(Request $request) {
        try {
            $validator = RequestValidator::make($request->all(), [
                'id' => 'numeric|required'
            ]);

            if($validator->fails()) {
                return RequestValidator::requestResponse($validator->errors()->all());
            }

            return response()->json([
                'success' => true,
                'users' => User::where('id', '=', $request->id)->delete(),
            ]);

        } catch (\Throwable $e) {
            return RequestValidator::requestResponse($e->getMessage());
        }
    }

    public function save(Request $request)
    {
        try {
            $validator = RequestValidator::make($request->all(), [
                'name' => 'required|string|max:45',
                'email' => 'required|email',
                'lastName' => 'string',
                'cpf' => 'numeric',
            ]);

            if($validator->fails()) {
                return RequestValidator::requestResponse($validator->errors()->all());
            }

            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'lastName' => $request->lastName,
                'birthday' => $request->birthday,
                'cpf' => $request->cpf,
            ];

            if (!empty($request->password)) {
                $data['password'] = bcrypt($request->password);
            }

            User::updateOrCreate(['id' => $request->id], $data);

            $string = new StringValidatorPlus('String Validator plus');

            return response()->json([
                'users' => User::get(),
                'string' => $string->toString()
            ]);

        } catch (\Throwable $e) {
            return RequestValidator::requestResponse($e->getMessage());
        }
    }
}
