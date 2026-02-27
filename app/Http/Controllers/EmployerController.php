<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
class EmployerController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */

    use AuthorizesRequests;


    public function create()
    {
        $this->authorize('create', Employer::class);

        return view('employer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->user()->employer()->create($request->validate([
            'company_name' => 'required|string|min:3|unique:employers,company_name,except,id'
        ]));
        return redirect()->route('jobs.index')
        ->with('success', 'Your employer profile was created successfully');
    }

}
