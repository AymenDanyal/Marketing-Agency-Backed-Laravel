<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Exception;
use App\Mail\JobApplicationMail;
use Illuminate\Support\Facades\Mail;

class JobQueryController extends Controller
{
    /**
     * Display a listing of the contact queries.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $queries  = Job::all(); // Retrieve all contact queries
        return view('pages.contactQuery.job',compact('queries'));
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
                'appliedfor' => 'required|string|max:250',
                'portfolio' => 'required|string|max:250',
                'cv' => 'required|file|mimes:pdf,doc,docx|max:2048', // cv should be a file, max 2MB, and of certain mime types
            ]);
            
            // Handle the CV upload
            if ($request->hasFile('cv')) {
                // Save the CV file to the 'public/cv' folder
                $cvPath = $request->file('cv')->store('cv', 'public');
    
                // Add the path to the validated data
                $validatedData['cv'] = $cvPath;
            }

            
    
            // Create and save the Job entry with the CV path
            $jobQuery = Job::create($validatedData);
            Mail::to('hr@artxpro.com')->send(new JobApplicationMail($validatedData));
            // Return success response
            return response()->json([
                'message' => 'Job query saved successfully!',
                'data' => $jobQuery
            ], 201);
        } catch (ValidationException $e) {
            // Handle validation errors
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (Exception $e) {
            // Log the error for debugging
            Log::error('JobStore Error: ' . $e->getMessage());
    
            // Handle other exceptions
            return response()->json(['message' => 'An error occurred', 'error' => $e->getMessage()], 500);
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
        $job = Job::find($id);

        if (!$job) {
            return response()->json(['message' => 'Contact query not found'], 404);
        }

        return response()->json($job);
    }

    /**
     * Show the form for editing the specified contact query.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $job = Job::find($id);

        if (!$job) {
            return response()->json(['message' => 'Contact query not found'], 404);
        }

        // Return view to edit contact query (if using web views)
        return view('contact_queries.edit', compact('job'));
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

        $job = Job::find($id);

        if (!$job) {
            return response()->json(['message' => 'Contact query not found'], 404);
        }

        $job->update($request->only([
            'name', 'email', 'number', 'company', 'query'
        ]));

        return response()->json($job);
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
        $job = Job::find($id);

        // Check if the contact query was not found
        if (!$job) {
            // Return a JSON response with a 404 status code if not found
            return response()->json(['success' => false, 'message' => 'Contact query not found'], 404);
        }

        // Attempt to delete the contact query
        try {
            $job->delete();
            // Return a JSON response indicating success
            return response()->json(['success' => true, 'message' => 'Contact query deleted successfully']);
        } catch (\Exception $e) {
            // Return a JSON response with a 500 status code if deletion fails
            return response()->json(['success' => false, 'message' => 'An error occurred while deleting the contact query. Please try again later.'], 500);
        }
    }



    



}
