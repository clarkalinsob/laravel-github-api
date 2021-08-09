<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;
use \stdClass;

class GithubController extends Controller
{
    function index() {
        $logMsg = 'Welcome to Laravel-Github-User API';
        Log::info($logMsg);
        return $logMsg;
    }
    function store(Request $request) {
        $logMsg = '';
        $usernames = $request->usernames;
        $githubUsers = array();

        if (count($usernames) > 10) {
            $logMsg = 'maximum of 10 usernames only';
            Log::error($logMsg);
            return $logMsg;
        }
        foreach ($usernames as $name) {
            $username = strtolower($name);
            $key = 'username-' . $username;
            $redis = Redis::get($key);
            if ($redis) {
                $user = json_decode($redis);
                $logMsg = 'GET request from Redis with key username-' . $username;

                Log::info($logMsg);
                array_push($githubUsers, $user);
            } else {
                $url = 'https://api.github.com/users/';
                $response = Http::get($url . $username);
                $res = $response->json();
    
                $logMsg = 'GET request from ' . $url . $username;
                Log::info($logMsg);
                
                if (array_key_exists('id', $res)) {
                    $user = new stdClass();
                    $key = 'username-' . strtolower($res['login']);
                    $expiresIn = 120;
                    
                    $user->name = is_null($res['name']) ? '' : $res['name'];
                    $user->login = is_null($res['login']) ? '' : $res['login'];
                    $user->company = is_null($res['company']) ? '' : $res['company'];
                    $user->followers = is_null($res['followers']) ? 0 : $res['followers'];
                    $user->public_repos = is_null($res['public_repos']) ? 0 : $res['public_repos'];
                    $user->ave_followers_per_repos = $res['public_repos'] === 0 ? 0 : $user->followers / $user->public_repos;
    
                    Redis::set($key, json_encode($user), 'EX', $expiresIn);
                    array_push($githubUsers, $user);
                } else {
                    Log::error($res);
                    return $res;
                }
            }
        }
        usort($githubUsers, function($a, $b) {
            return strcmp($a->name, $b->name);
        });
        return $githubUsers;
    }
}
