<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    public function CheckAuth(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $response = Http::post('https://candidate-testing.api.royal-apps.io/api/v2/token', [
            'email' =>  $email,
            'password' => $password,
        ]);

        if ($response->status() == 200) { // API Auth for api authorization
            $result = $response->body();
            $result = json_decode($result, true);
            $save = User::updateOrCreate(
                ['email' => $result['user']['email']],
                ['apiUserId' => $result['user']['id'], 'firstName' => $result['user']['first_name'], 'lastName' => $result['user']['last_name'], 'email' => $result['user']['email'], 'tokenKey' => $result['token_key'], 'refreshTokenKey' => $result['refresh_token_key'], 'password' => $password]
            );

            if ($save) {
                $cred = $request->only('email', 'password');
                if (Auth::attempt($cred)) { // Web Auth for admin authorization
                    return redirect()->route('listAuthors');
                } else {
                    return 'Db records not found';
                }
            } else {
                return 'something went wrong';
            }
        } else {
            // return redirect()->route('user.login')->with('fail', 'incorrect Credentials');
            die("Bad Api response");
        }
    }

    public function listAuthors()
    {
        $headers = [
            'Authorization' => 'Bearer ' . Auth::user()->tokenKey
        ];
        $response = Http::withHeaders($headers)->get('https://candidate-testing.api.royal-apps.io/api/v2/authors', []);
        $authors = $response->body();
        $authors = json_decode($authors, true)['items'];
        if ($response->status() == 200) {
            return view('authors', compact('authors'));
        }
    }

    public function viewBooks($id)
    {
        $headers = [
            'Authorization' => 'Bearer ' . Auth::user()->tokenKey
        ];
        $response = Http::withHeaders($headers)->get('https://candidate-testing.api.royal-apps.io/api/v2/books', ['author' => $id]);
        $books = $response->body();
        $books = json_decode($books, true)['items'];
        if ($response->status() == 200) {
            return view('viewBooks', compact('books'));
        }
    }

    public function deleteAuthor($id)
    {
        $headers = [
            'Authorization' => 'Bearer ' . Auth::user()->tokenKey
        ];
        $response = Http::withHeaders($headers)->delete('https://candidate-testing.api.royal-apps.io/api/v2/authors/' . $id);
        if ($response->status() == 200) {
            return json_encode(true);
        } else {
            return json_encode(false);
        }
    }

    public function deleteBook($id)
    {
        $headers = [
            'Authorization' => 'Bearer ' . Auth::user()->tokenKey
        ];
        $response = Http::withHeaders($headers)->delete('https://candidate-testing.api.royal-apps.io/api/v2/books/' . $id);
        if ($response->status() == 200) {
            return json_encode(true);
        } else {
            return json_encode(false);
        }
    }

    public function addBook()
    {
        $headers = [
            'Authorization' => 'Bearer ' . Auth::user()->tokenKey
        ];
        $response = Http::withHeaders($headers)->get('https://candidate-testing.api.royal-apps.io/api/v2/authors', []);
        $authors = $response->body();
        $authors = json_decode($authors, true)['items'];
        if ($response->status() == 200) {
            return view('addBook', compact('authors'));
        }
    }
    public function saveBook(Request $request)
    {
        $data = array(
            'author' => array('id' => $request->input('selectAuthor')),
            'title' => $request->input('title'),
            'release_date' => date("Y-m-d H:i:s"),
            'description' => $request->input('description'),
            'isbn' => $request->input('isbn'),
            'format' => $request->input('formate'),
            'number_of_pages' => 1
        );

        $headers = [
            'Authorization' => 'Bearer ' . Auth::user()->tokenKey
        ];
        $response = Http::withHeaders($headers)->post('https://candidate-testing.api.royal-apps.io/api/v2/books', $data);
        if ($response->status() == 200) {
            return redirect()->route('addBook');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
