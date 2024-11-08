<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ModerationController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request): Response
    {
        // Load documents along with the associated user
        $documents = Document::with('user', 'metadata')->get();

        //filter documents to only ones that are not reviewed
        $documents = $documents->filter(function ($document) {
            return !$document->is_reviewed;
        });

        // Render the view and pass the documents along with their user data
        return Inertia::render('ModerationPage', [
            'filteredDocuments' => $documents
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
