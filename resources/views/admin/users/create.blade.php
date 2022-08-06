@extends('admin.layouts.app')

@section('title', 'Cadastrar novo usuário')

@section('content')
    <h1 class="w-full text-3xl text-black pb-6">Adicionar novo usuário</h1>
    <div class="flex flex-wrap">
        <div class="w-full my-6 pr-0 lg:pr-2">
            <div class="leading-loose">
                <form class="p-10 bg-white rounded shadow-xl" action="{{ route('admin.users.store') }}" method="POST">
                    @csrf
                    @include('admin.users._partials.form')
                </form>
            </div>
        </div>
    </div>
@endsection
