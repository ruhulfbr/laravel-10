<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\JoinClause;

class SqlController extends Controller
{
    public function index(Request $request): view
    {
        // This process work for Prevent Sql injection
        $users = DB::select('select * from users where active = ?', [1]);

        $burgers = DB::scalar(
            "select count(case when food = 'burger' then 1 end) as burgers from menu"
        );

        [$options, $notifications] = DB::selectResultSets(
            "CALL get_user_options_and_notifications(?)", $request->user()->id
        );

        // Eta amar khuv Dorkar
        $results = DB::select('select * from users where id = :id', ['id' => 1]);

        DB::insert('insert into users (id, name) values (?, ?)', [1, 'Marc']);

//        Return How many rows are affected
        $affected = DB::update(
            'update users set votes = 100 where name = ?',
            ['Anita']
        );

        $deleted = DB::delete('delete from users');

        DB::statement('drop table users');

        DB::unprepared('update users set votes = 100 where name = "Dries"');

        $users = DB::connection('sqlite')->select(/* ... */);

//        Advanced transaction query
        DB::transaction(function () {
            DB::update('update users set votes = 1');

            DB::delete('delete from posts');
        });








        return view('user.index', ['users' => $users]);
    }

    public  function  home():View
    {

//        Advanced Join
        DB::table('users')
            ->join('contacts', function (JoinClause $join) {
                $join->on('users.id', '=', 'contacts.user_id')->orOn(/* ... */);
            })
            ->get();

        DB::table('users')
            ->join('contacts', function (JoinClause $join) {
                $join->on('users.id', '=', 'contacts.user_id')
                    ->where('contacts.user_id', '>', 5);
            })
            ->get();

        $latestPosts = DB::table('posts')
            ->select('user_id', DB::raw('MAX(created_at) as last_post_created_at'))
            ->where('is_published', true)
            ->groupBy('user_id');

        $users = DB::table('users')
            ->joinSub($latestPosts, 'latest_posts', function (JoinClause $join) {
                $join->on('users.id', '=', 'latest_posts.user_id');
            })->get();


        $first = DB::table('users')
            ->whereNull('first_name');

        $users = DB::table('users')
            ->whereNull('last_name')
            ->union($first)
            ->get();

        $users = DB::table('users')
            ->where('votes', '>', 100)
            ->orWhere(function (Builder $query) {
                $query->where('name', 'Abigail')
                    ->where('votes', '>', 50);
            })
            ->get();

        $users = DB::table('users')
            ->where('name', '=', 'John')
            ->where(function (Builder $query) {
                $query->where('votes', '>', 100)
                    ->orWhere('title', '=', 'Admin');
            })
            ->get();

        $users = DB::table('users')
            ->whereExists(function (Builder $query) {
                $query->select(DB::raw(1))
                    ->from('orders')
                    ->whereColumn('orders.user_id', 'users.id');
            })
            ->get();


    }
}
