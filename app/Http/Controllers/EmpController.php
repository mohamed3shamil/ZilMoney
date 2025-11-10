<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Languages;
use App\Http\Requests\StoreEmpRequest;
use App\Http\Requests\UpdateEmpRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class EmpController extends Controller
{
    //
    public function index(): View
    {
        $employees = Employee::with('languages')->get();
        return view('employees.index', compact('employees'));
    }

    public function create(): View
    {
        $languages = Languages::all();
        return view('employees.create', compact('languages'));
    }

    public function store(StoreEmpRequest $request): RedirectResponse
    {
        $employee = Employee::create($request->only(['first_name', 'last_name', 'willing_to_relocate']));

        if ($request->has('languages')) {
            $employee->languages()->attach($request->input('languages'));
        }

        return redirect()->route('employees.index');
    }

    public function edit(Employee $employee): View
    {
        $languages = Languages::all();
        $employee->load('languages');
        return view('employees.edit', compact('employee', 'languages'));
    }

    public function update(UpdateEmpRequest $request, Employee $employee): RedirectResponse
    {
        $employee->update($request->only(['first_name', 'last_name', 'willing_to_relocate']));

        if ($request->has('languages')) {
            $employee->languages()->sync($request->input('languages'));
        } else {
            $employee->languages()->detach();
        }

        return redirect()->route('employees.index');
    }

    public function destroy(Employee $employee): RedirectResponse
    {
        $employee->languages()->detach();
        $employee->delete();
        return redirect()->route('employees.index');
    }
}
