<?php

namespace App\Http\Controllers;

use App\Models\ContactQuery;
use Illuminate\Http\Request;

class ContactQueryController extends Controller
{
    /**
     * Display a listing of the contact queries.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $queries  = ContactQuery::all(); // Retrieve all contact queries
        return view('pages.contactQuery.index',compact('queries'));
    }

    /**
     * Show the form for creating a new contact query.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Return view to create a contact query (if using web views)
        return view('contact_queries.create');
    }

    /**
     * Store a newly created contact query in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:250',
            'email' => 'required|string|email|max:250',
            'number' => 'required|string|max:250',
            'company' => 'required|string|max:250',
            'query' => 'required|string',
        ]);

        $contactQuery = ContactQuery::create([
            'name' => $request->name,
            'email' => $request->email,
            'number' => $request->number,
            'company' => $request->company,
            'query' => $request->query,
        ]);

        return response()->json($contactQuery, 201); // Return created contact query with 201 status
    }

    /**
     * Display the specified contact query.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contactQuery = ContactQuery::find($id);

        if (!$contactQuery) {
            return response()->json(['message' => 'Contact query not found'], 404);
        }

        return response()->json($contactQuery);
    }

    /**
     * Show the form for editing the specified contact query.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contactQuery = ContactQuery::find($id);

        if (!$contactQuery) {
            return response()->json(['message' => 'Contact query not found'], 404);
        }

        // Return view to edit contact query (if using web views)
        return view('contact_queries.edit', compact('contactQuery'));
    }

    /**
     * Update the specified contact query in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'sometimes|string|max:250',
            'email' => 'sometimes|string|email|max:250',
            'number' => 'sometimes|string|max:250',
            'company' => 'sometimes|string|max:250',
            'query' => 'sometimes|string',
        ]);

        $contactQuery = ContactQuery::find($id);

        if (!$contactQuery) {
            return response()->json(['message' => 'Contact query not found'], 404);
        }

        $contactQuery->update($request->only([
            'name', 'email', 'number', 'company', 'query'
        ]));

        return response()->json($contactQuery);
    }

    /**
     * Remove the specified contact query from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
        public function destroy($id)
    {
        // Attempt to find the contact query by its ID
        $contactQuery = ContactQuery::find($id);

        // Check if the contact query was not found
        if (!$contactQuery) {
            // Return a JSON response with a 404 status code if not found
            return response()->json(['success' => false, 'message' => 'Contact query not found'], 404);
        }

        // Attempt to delete the contact query
        try {
            $contactQuery->delete();
            // Return a JSON response indicating success
            return response()->json(['success' => true, 'message' => 'Contact query deleted successfully']);
        } catch (\Exception $e) {
            // Return a JSON response with a 500 status code if deletion fails
            return response()->json(['success' => false, 'message' => 'An error occurred while deleting the contact query. Please try again later.'], 500);
        }
    }

}
