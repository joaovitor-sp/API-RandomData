<?php

namespace App\Http\Controllers;

use App\Http\Controllers;
use App\Models\RandomPeople;
use App\Models\Person;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;


class ApiRandomController extends Controller
{

    public function index()
    {
        // ATENÇÃO: A API random-data-api.com foi descontinuada e não está mais disponível.
        $url = "https://randomuser.me/api/?results=100";
        $response = Http::get($url);

        // Simula o comportamento sem quebrar a aplicação
        $people = collect();

        // Se a API estivesse funcionando:
        if ($response->successful()) {
            $data = $response->json()["results"];
            $people = collect($data)->map(fn($item) => new RandomPeople([
                'id' => $item["login"]['uuid'],
                'uid' => $item["login"]['uuid'],
                'password' => $item["login"]['password'],
                'first_name' => $item["name"]['first'],
                'last_name' => $item["name"]['last'],
                'username' => $item["login"]['username'],
                'email' => $item['email'],
                'avatar' => $item["picture"]['large'],
                'gender' => $item['gender'],
                'phone_number' => $item['phone'],
                'date_of_birth' => $item["dob"]['date'],
            ]));
        }
        // echo $response;

        return view('home', [
            'people' => $people,
            'isStaticPage' => false
        ]);
    }

    public function staticPeople()
    {
        Person::all();
        return view('home', ['people' => Person::all(), 'isStaticPage' => true]);
    }
    public function addPerson(Request $request)
    {
        $person = new Person();
        $person->fill($request->all());
        $person->save();

        return redirect('static-people');
    }
    public function removePerson($id)
    {
        $person = Person::findOrFail($id);
        $person->delete();
        return response()->json(['success' => true]);
    }
}
