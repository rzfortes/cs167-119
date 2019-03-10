<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subject;
use App\User;
use App\Assignment;

class AssignmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'content' => 'required'
        ]);

        $assignment = new Assignment;
        $assignment->content = $request->input('content');
        $assignment->user_id = auth()->user()->id;
        $assignment->courseName_id = $request->session()->get('current_courseName_id');

        $assignment->save();

        // return redirect('assignments.index');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $subject = Subject::find($id);
        // Session::set('current_courseName_id', $subject->id);
        session(['current_courseName_id' => $subject->id]);
        $assignments = Assignment::where('user_id', '=', auth()->user()->id)->where('courseName_id', '=', $subject->id)->get();

        return view('assignments.index')->with('assignments', $assignments);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        // find the assignment that needs to be updated

        $assignment = Assignment::find($id);
        if($assignment->done == 0) {
            $assignment->done = 1;
        } else {
            $assignment->done = 0;
        }

        $assignment->save();

        // return redirect('assignments.index');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $assignment = Assignment::find($id);

        // double check that the current user is owner of the assignment
        if(auth()->user()->id !== $assignment->user_id) {
            return redirect()->back()->with('error!');
        }

        $assignment->delete();
        return redirect()->back();
        
    }
}
