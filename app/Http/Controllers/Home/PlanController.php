<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlanRequest;
use Illuminate\Http\Request;
use App\Models\Plan;
use Illuminate\Support\Facades\Auth;

class PlanController extends HomeController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plans = Plan::where('user_id', Auth::user()->id)->get();

        return view('home.plans.list', [
            'plans' => $plans,
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get()
    {
        $plans = Plan::where('user_id', Auth::user()->id)->get();

        return $plans;
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
    public function store(PlanRequest $request)
    {
        $name = $request->input('name');
        $color = $request->input('color');
        $datetimeRange = $request->input('datetimerange');
        $userId = Auth::user()->id;
        $range = explode(' - ', $datetimeRange);
        $startTime = $range[0];
        $endTime = $range[1];

        $commit = Plan::create([
            'user_id' => $userId,
            'name' => $name,
            'starts_at' => $startTime,
            'ends_at' => $endTime,
            'style' => 'color: ' . $color,
        ]);

        if ($commit) {
            return [
                'status' => true,
                'message' => __('Successfully created'),
                'data' => $commit,
            ];
        } else {
            return [
                'status' => false,
                'message' => __('Failed to create'),
            ];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $plan = Plan::findOrFail($id);

        if (!$plan || $plan->user_id != Auth::user()->id) {
            return [
                'status' => false,
            ];
        }

        return $plan;
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
    public function update(PlanRequest $request, $id)
    {
        $plan = Plan::findOrFail($id);

        if (!$plan || $plan->user_id != Auth::user()->id) {
            return [
                'status' => false,
            ];
        }

        $name = $request->input('name');
        $startsAt = $request->input('starts_at');
        $endsAt = $request->input('ends_at');
        $style = 'color: ' . $request->input('color');
        $commit = $plan->update([
            'name' => $name,
            'style' => $style,
            'starts_at' => $startsAt,
            'ends_at' => $endsAt,
        ]);
        
        if ($commit) {
            return [
                'status' => true,
                'message' => __('Successfully updated'),
                'data' => $plan,
            ];
        } else {
            return [
                'status' => false,
                'message' => __('Failed to update'),
            ];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $plan = Plan::findOrFail($id);

        if (!$plan || $plan->user_id != Auth::user()->id) {
            return [
                'status' => false,
            ];
        }

        if ($plan->delete()) {
            return [
                'status' => true,
                'message' => __('Successfully deleted'),
            ];
        } else {
            return [
                'status' => false,
                'message' => __('Failed to delete'),
            ];
        }
    }
}
