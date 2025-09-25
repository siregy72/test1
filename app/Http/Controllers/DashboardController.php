<?php

namespace App\Http\Controllers;

use App\Models\Memo;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $memos1 = Memo::where('kind', '1')->orderBy('id', 'desc')->get();
        $memos9 = Memo::where('kind', '9')->orderBy('id', 'desc')->get();
        return Inertia::render('Dashboard', [
            'memos1' => $memos1,
            'memos9' => $memos9,
        ]);
    }

    public function create($kind)
    {
        return Inertia::render('DashboardCreate', [
            'kind' => $kind,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
            'kind' => 'required|string|max:255',
        ]);

        Memo::create([
            'content' => $request->content,
            'kind' => $request->kind,
        ]);

        return redirect()->route('dashboard');
    }

    public function edit($memoId)
    {
        $memo = Memo::findOrFail($memoId);
        return Inertia::render('DashboardEdit', [
            'memoId' => $memoId,
            'memo' => $memo,
        ]);
    }

    public function update($memoId, Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:255',
        ]);

        $memo = Memo::findOrFail($memoId);
        $memo->update([
            'content' => $request->content,
        ]);

        return redirect()->route('dashboard');
    }

    public function destroy($memoId)
    {
        Memo::where('id', $memoId)->delete();
        return redirect()->route('dashboard');
    }

    public function show($memoId)
    {
        $memo = Memo::findOrFail($memoId);
        return Inertia::render('DashboardShow', [
            'memoId' => $memoId,
            'memo' => $memo,
        ]);
    }

    public function search(Request $request)
    {
        $request->validate([
            'keyword' => 'required|string|max:255',
        ]);
    }
}
