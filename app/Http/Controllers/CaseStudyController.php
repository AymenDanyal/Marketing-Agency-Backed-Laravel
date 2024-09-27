<?php

// app/Http/Controllers/CaseStudyController.php

namespace App\Http\Controllers;

use App\Models\CaseStudy;

use App\Models\CaseCategory;
use Illuminate\Http\Request;

class CaseStudyController extends Controller
{
    public function index()
    {
        $caseStudies = CaseStudy::with('category')->get();
        return view('pages.caseStudies.index', compact('caseStudies'));
    }

    public function create()
    {
        $cats = CaseCategory::all();
        return view('pages.caseStudies.create', compact('cats'));
    }

    public function store(Request $request)
    {
        CaseStudy::create($request->all());
        return redirect()->route('case-studies.index');
    }

    public function show($id)
    {
        $caseStudy = CaseStudy::findOrFail($id);
        return view('pages.caseStudies.show', compact('caseStudy'));
    }

    public function edit($id)
    {   
        $cats = CaseCategory::all();
        $caseStudy = CaseStudy::findOrFail($id);
        return view('pages.caseStudies.edit', compact('caseStudy','cats'));
    }

    public function update(Request $request, $id)
    {
        $caseStudy = CaseStudy::findOrFail($id);
        $caseStudy->update($request->all());
        return redirect()->route('case-studies.index');
    }

    public function destroy($id)
    {
        $caseStudy = CaseStudy::findOrFail($id);
        $caseStudy->delete();
        return redirect()->route('case-studies.index');
    }
}
