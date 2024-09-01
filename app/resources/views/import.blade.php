@extends('base')

@section('content')

    <nav class="flex items-center justify-between px-8 py-4 bg-primary">
        <h1 class="text-3xl font-bol text-secondary">Motorez</h1>
    </nav>

    <section>
        <form action="{{ route('import.post') }}" method="post" enctype="multipart/form-data" class="w-1/3 mx-auto">
            @csrf

            <div class="py-4">
                <input type="file" name="file" required>
            </div>

            <div class="py-4">
                <input type="radio" name="provider" id="webmotors" value="webmotors">
                <label for="webmotors">Web Motors</label>
            </div>
            <div class="py-4">
                <input type="radio" name="provider" id="revenda-mais" value="revenda-mais">
                <label for="revenda-mais">Revenda Mais</label>
            </div>

            <div class="py-4 text-right">
                <button type="submit" class="bg-primary text-secondary p-2">Importar</button>
            </div>
        </form>
    </section>

@endsection
