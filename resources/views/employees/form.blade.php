@extends('layouts.app')

@section('content')

<h1>{{ isset($employee) ? 'Edit' : 'Add' }}</h1>

<form action="{{isset($employee)? route('employees.update') : route('employees.store')}}" method="POST">
    @csrf
    @if(isset($employee))
        @method('PUT')
    @endif

    <div class="mb-3">
        <label for="first_name" class="form-label">First Name</label>
        <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name" name="first_name" value="{{ old('first_name', $employee->first_name ?? '') }}" required>
        <div class="invalid-feedback">
            @error('first_name')
                {{ $message }}
            @enderror
        </div>
    </div>

    <div class="mb-3">
        <label for="last_name" class="form-label">Last Name</label>
        <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name" name="last_name" value="{{ old('last_name', $employee->last_name ?? '') }}" required>
        <div class="invalid-feedback">
            @error('last_name')
                {{ $message }}
            @enderror
        </div>
    </div>

    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="willing_to_relocate" name="willing_to_relocate" value="1" {{ old('willing_to_relocate', isset($employee) && $employee->willing_to_relocate ? 'checked' : '') }}>
        <label class="form-check-label" for="willing_to_relocate">Willing to Relocate</label>
    </div>

    <div class="mb-3">
        <label for="languages" class="form-label">Languages</label>
        <select multiple class="form-select @error('languages') is-invalid @enderror" id="languages" name="languages[]">
            @foreach($languages as $language)
                <option value="{{ $language->id }}" {{ (collect(old('languages', isset($employee) ? $employee->languages->pluck('id')->toArray() : []))->contains($language->id)) ? 'selected' : '' }}>
                    {{ $language->lanuage_name }}
                </option>
            @endforeach
        </select>
        <div class="invalid-feedback">
            @error('languages')
                {{ $message }}
            @enderror
        </div>

        <button type="submit" class="btn btn-primary mt-3">{{ isset($employee) ? 'Update' : 'Create' }}</button>
</form>
@endsection