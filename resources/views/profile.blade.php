@extends('layouts.main')

@section('title', 'Profil Saya - PasarKulo')

@section('content')

<div class="container py-5">
    <div class="row justify-content-center">

        <div class="col-lg-9">
            <div class="card border-0 shadow-lg rounded-4">
                <div class="card-body p-4 p-md-5">

                    <!-- Header Profil -->
                    <div class="d-flex align-items-center mb-4">
                        <img 
                            src="https://ui-avatars.com/api/?name={{ urlencode($profile['name']) }}&background=0d6efd&color=fff&size=120"
                            class="rounded-circle me-4 shadow"
                            alt="Avatar"
                        >

                        <div>
                            <h4 class="fw-bold mb-1">{{ $profile['name'] }}</h4>
                            <p class="text-muted mb-2">{{ $profile['email'] }}</p>
                            <span class="badge bg-primary-subtle text-primary px-3 py-2">
                                Member PasarKulo
                            </span>
                        </div>
                    </div>

                    <hr class="mb-4">

                    <!-- Detail Profil -->
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <div class="border rounded-3 p-3 h-100">
                                <small class="text-muted d-block">Email</small>
                                <strong>{{ $profile['email'] }}</strong>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="border rounded-3 p-3 h-100">
                                <small class="text-muted d-block">No. HP</small>
                                <strong>{{ $profile['phone'] }}</strong>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="border rounded-3 p-3 h-100">
                                <small class="text-muted d-block">Bergabung Sejak</small>
                                <strong>{{ $profile['joined'] }}</strong>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="border rounded-3 p-3 h-100">
                                <small class="text-muted d-block">Status Akun</small>
                                <span class="badge bg-success">Aktif</span>
                            </div>
                        </div>
                    </div>

                    <!-- Action -->
                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary px-4">
                            ← Dashboard
                        </a>

                        <a href="{{ route('profile.edit') }}" class="btn btn-primary px-4">
                            ✏️ Edit Profil
                        </a>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>

@endsection
