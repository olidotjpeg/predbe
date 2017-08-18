<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Webpatser\Uuid\Uuid;
use App\Group;
use App\GroupMember;
use App\User;
use App\Tournament;

class GroupsController extends Controller
{
    public function index()
    {
        $groups = Group::all();

        return $groups;
    }

    public function create(Request $request)
    {
        $group = new Group;

        $group->id = Uuid::generate(4);
        $group->tournament_id = $request->tournament_id;
        $group->user_id = $request->user_id;

        $group->save();

        return $group;
    }

    public function single($id)
    {
        $group = Group::where('id', $id)->first();
        $user = Group::find($group->user_id)->user;
        $members = Group::find($id)->GroupMember;
        $tournament = Group::find($group->tournament_id)->Tournament;

        $group->admin = $user;
        $group->members = $members;
        $group->tournament = $tournament;

        return $group;
    }
}