<?php

namespace App\Http\Controllers;

use App\Models\CaseCategory;
use Illuminate\Http\Request;

class CaseCategoryController extends Controller
{
    public function index()
    {
        $categories = CaseCategory::all();
        return view('pages.caseCategories.index', compact('categories'));
    }

    public function create()
    {
        return view('pages.caseCategories.create');
    }

    public function store(Request $request)
    {
        $category = CaseCategory::create($request->all());
        return redirect()->route('case-categories.index');
    }

    public function show($id)
    {
        $category = CaseCategory::findOrFail($id);
        return view('pages.caseCategories.show', compact('category'));
    }

    public function edit($id)
    {
        $category = CaseCategory::findOrFail($id);
        return view('pages.caseCategories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = CaseCategory::findOrFail($id);
        $category->update($request->all());
        return redirect()->route('case-categories.index');
    }

    public function destroy($id)
    {
        $category = CaseCategory::findOrFail($id);
        $category->delete();
        return redirect()->route('case-categories.index');
    }
}
