<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Route;
use App\Models\Telephone;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()

    {
        $members = Member::with(['telephones', 'route'])->latest()->paginate(5);

        return view('members.index', compact('members'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**

     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function create()
    {
        $routes = Route::all();
        return view('members.create', compact('routes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
  
            $request->validate([
                'full_name' => 'required',
                'email_address' => 'required|regex:/(.+)@(.+)\.(.+)/i|unique:members',
                'telephone' => 'required|digits:10',
                'join_date' => 'required',
                'route_id' => 'required',
                'comments' => 'required',
            ]);

           
            $telephone=Telephone::where('number','=',$request['telephone'])->first();
            if($telephone)
            {
                return redirect()->route('members.index')->with('error', 'Telephone number already exists, please try again.');
            }
            else {
                $member = Member::create($request->all());
                Telephone::create(['member_id' => $member->id, 'number' => $request['telephone']]);
            }
            
      

        return redirect()->route('members.index')->with('success', 'New member created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */

    public function show(Member $member)
    {
        return view('members.show', compact('member'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */

    public function edit(Member $member)
    {
        $routes = Route::all();
        return view('members.edit', compact('member', 'routes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Member $member)
    {
        
            $request->validate([
                'full_name' => 'required',
                'email_address' => 'required|regex:/(.+)@(.+)\.(.+)/i',
                'telephone' => 'required|digits:10',
                'join_date' => 'required',
                'route_id' => 'required',
                'comments' => 'required',
            ]);

            $member->update($request->all());
            Telephone::where('member_id', $member->id)->update(['number' => $request['telephone']]);

        return redirect()->route('members.index')->with('success', 'Member updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */

    public function destroy(Member $member)
    {
        $member->delete();
        return redirect()->route('members.index')->with('success', 'Member deleted successfully');
    }
}
