@extends('admin.layouts.app')

@section('title', "Cadastrar novo módulo para o curso {$course->name}")

@section('content')
    <h1 class="w-full text-3xl text-black pb-6">Adicionar novo módulo para o curso {{ $course->name }}</h1>
    <div class="flex flex-wrap">
        <div class="w-full my-6 pr-0 lg:pr-2">
            <div class="leading-loose">
                <form class="p-10 bg-white rounded shadow-xl" action="{{ route('modules.store', $course->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @include('admin.courses.modules._partials.form')
                </form>
            </div>
        </div>
    </div>
@endsection
