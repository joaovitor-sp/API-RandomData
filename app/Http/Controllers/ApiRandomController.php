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
        // $url = "https://random-data-api.com/api/v2/users?size=100";
        // $response = Http::get($url);

        // Simula o comportamento sem quebrar a aplicação
        $people = collect();

        // Se a API estivesse funcionando, você faria:
        // if ($response->successful()) {
        //     $data = $response->json();
        //     $people = collect($data)->map(fn($item) => new RandomPeople([
        //         'id' => $item['id'],
        //         'uid' => $item['uid'],
        //         'password' => $item['password'],
        //         'first_name' => $item['first_name'],
        //         'last_name' => $item['last_name'],
        //         'username' => $item['username'],
        //         'email' => $item['email'],
        //         'avatar' => $item['avatar'],
        //         'gender' => $item['gender'],
        //         'phone_number' => $item['phone_number'],
        //         'social_insurance_number' => $item['social_insurance_number'],
        //         'date_of_birth' => $item['date_of_birth'],
        //         'employment_title' => $item['employment']['title'],
        //         'employment_key_skill' => $item['employment']['key_skill'],
        //         'address_city' => $item['address']['city'],
        //         'address_street_name' => $item['address']['street_name'],
        //         'address_street_address' => $item['address']['street_address'],
        //         'address_zip_code' => $item['address']['zip_code'],
        //         'address_state' => $item['address']['state'],
        //         'address_country' => $item['address']['country'],
        //         'address_lat' => $item['address']['coordinates']['lat'],
        //         'address_lng' => $item['address']['coordinates']['lng'],
        //         'credit_card_cc_number' => $item['credit_card']['cc_number'],
        //         'subscription_plan' => $item['subscription']['plan'],
        //         'subscription_status' => $item['subscription']['status'],
        //         'subscription_payment_method' => $item['subscription']['payment_method'],
        //         'subscription_term' => $item['subscription']['term'],
        //     ]));
        // }

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
        return redirect('static-people');
    }
}
