<?php

namespace App\Http\Controllers;

use App\Models\ContactQuery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use App\Mail\ContactQueryMail;
use Illuminate\Support\Facades\Mail;
use Exception;

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
        return view('pages.contactQuery.contactUs',compact('queries'));
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
        try {
            // Validate the incoming data
            $validatedData = $request->validate([
                'name' => 'required|string|max:250',
                'email' => 'required|email|max:250',
                'company' => 'required|string|max:250',
                'contact' => 'required|string|max:250',
                'webUrl' => 'required|string|max:250',
                'message' => 'required|string',
            ]);

            // Create and save the ContactQuery entry
            $contactQuery = ContactQuery::create($validatedData);
            Mail::to('contact@artxpro.com')->send(new ContactQueryMail($validatedData));
            return response()->json(['message' => 'Contact query saved successfully!', 'data' => $contactQuery], 201);
        } catch (ValidationException $e) {
            return response()->json(['message' => 'Validation failed', 'errors' => $e->errors()], 422);
        } catch (Exception $e) {
            Log::error('ContactStore Error: ' . $e->getMessage());
            return response()->json(['message' => $e], 500);
        }
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
            'contact' => 'required|string|max:250',
            'company' => 'sometimes|string|max:250',
            'webUrl' => 'required|string|max:250',
            'message' => 'sometimes|string',
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
