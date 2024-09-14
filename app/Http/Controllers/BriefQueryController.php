<?php

namespace App\Http\Controllers;

use App\Models\Brief;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Exception;
use App\Mail\BriefQueryMail;
use Illuminate\Support\Facades\Mail;

class BriefQueryController extends Controller
{
    /**
     * Display a listing of the contact queries.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $queries  = Brief::all(); // Retrieve all contact queries
        return view('pages.contactQuery.brief',compact('queries'));
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
                'contact' => 'required|string|max:250',
                'company' => 'required|string|max:250',
                'budget' => 'required|string|max:250',
                'webUrl' => 'required|string|max:250',
                'date' => 'required|string|max:250',
                'message' => 'required|string',
            ]);
            Mail::to('contact@artxpro.com')->send(new BriefQueryMail($validatedData));
            // Create and save the BriefQuery entry
            $briefQuery = Brief::create($validatedData);

            return response()->json(['message' => 'Brief query saved successfully!', 'data' => $briefQuery], 201);
        } catch (ValidationException $e) {
            return response()->json(['message' => 'Validation failed', 'errors' => $e->errors()], 422);
        } catch (Exception $e) {
            Log::error('BriefStore Error: ' . $e->getMessage());
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
        $brief = Brief::find($id);

        if (!$brief) {
            return response()->json(['message' => 'Contact query not found'], 404);
        }

        return response()->json($brief);
    }

    /**
     * Show the form for editing the specified contact query.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brief = Brief::find($id);

        if (!$brief) {
            return response()->json(['message' => 'Contact query not found'], 404);
        }

        // Return view to edit contact query (if using web views)
        return view('contact_queries.edit', compact('brief'));
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

        $brief = Brief::find($id);

        if (!$brief) {
            return response()->json(['message' => 'Contact query not found'], 404);
        }

        $brief->update($request->only([
            'name', 'email', 'number', 'company', 'query'
        ]));

        return response()->json($brief);
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
        $brief = Brief::find($id);

        // Check if the contact query was not found
        if (!$brief) {
            // Return a JSON response with a 404 status code if not found
            return response()->json(['success' => false, 'message' => 'Contact query not found'], 404);
        }

        // Attempt to delete the contact query
        try {
            $brief->delete();
            // Return a JSON response indicating success
            return response()->json(['success' => true, 'message' => 'Contact query deleted successfully']);
        } catch (\Exception $e) {
            // Return a JSON response with a 500 status code if deletion fails
            return response()->json(['success' => false, 'message' => 'An error occurred while deleting the contact query. Please try again later.'], 500);
        }
    }









}
