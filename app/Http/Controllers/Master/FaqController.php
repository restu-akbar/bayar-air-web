<?php

namespace App\Http\Controllers\master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faq;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class FaqController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Faq::get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('created_at', function ($row) {
                    return Carbon::parse($row->created_at)->format('d-m-Y');
                })
                ->addColumn('action', function ($row) {
                    $editUrl = route('master.faq.edit', $row->id);
                    $deleteUrl = route('master.faq.destroy', $row->id);
                    return '
                        <a href="' . $editUrl . '" class="btn btn-sm btn-warning">Edit</a>
                        <form action="' . $deleteUrl . '" method="POST" style="display:inline;" onsubmit="return confirm(\'Are you sure you want to delete this user?\');">
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('master.faq.index');
    }

    public function create()
    {
        return view('master.faq.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'question' => 'required|string|max:255',
            'answear'  => 'required|string',
            'platform' => 'required|string',
        ], [
            'question.required' => 'Pertanyaan wajib diisi.',
            'answear.required'  => 'Jawaban wajib diisi.',
            'platform.required' => 'dimana penempatan nya?',
        ]);

        Faq::create($validated);

        return redirect()
            ->route('master.faq.index')
            ->with('success', 'FAQ berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $faq = faq::findOrFail($id);
        return view('master.faq.edit', compact('faq'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'question' => 'required|string|max:255',
            'answear'  => 'required|string',
            'platform' => 'required|string',
        ], [
            'question.required' => 'Pertanyaan wajib diisi.',
            'answear.required'  => 'Jawaban wajib diisi.',
            'platform.required' => 'dimana penempatan nya?',
        ]);

        $faq = Faq::findOrFail($id);
        $faq->update($validated);

        return redirect()
            ->route('master.faq.index')
            ->with('success', 'FAQ berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $faq = Faq::findOrFail($id);
        $faq->delete();

        return redirect()
            ->route('master.faq.index')
            ->with('success', 'FAQ berhasil dihapus!');
    }
}
