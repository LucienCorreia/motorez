@extends('base')

@push('head-scripts')

<link rel="stylesheet" href="https://cdn.datatables.net/2.1.5/css/dataTables.dataTables.css" />

<script src="https://cdn.datatables.net/2.1.5/js/dataTables.js"></script>

@endpush

@section('content')
    <nav class="flex items-center justify-between px-4 py-4 bg-primary">
        <h1 class="text-3xl font-bol text-secondary">Motorez</h1>

        <ul class="flex items-center space-x-4 text-secondary">
            <li><a href="{{ route('import.get') }}">Importar</a></li>
        </ul>
    </nav>
    <section class="py-4 px-4 flex justify-end items-end bg-secondary text-primary">
        <a href="{{ route('export.get') }}" target="_blank">Exportar</a>
    </section>
    <section class="py-8 flex justify-center items-center">
        <div class="container">
            <div class="flex justify-evenly items-start">
                <div class="py-4">
                    <label for="marca">Marca: </label>
                    <select name="marca" id="marca">
                        <option value="" selected>Todas</option>
                        @foreach ($marcas as $marca)
                            <option value="{{ $marca }}">{{ $marca }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="py-4">
                    <label for="modelo">Modelo: </label>
                    <select name="modelo" id="modelo">
                        <option value="" selected>Todos</option>
                        @foreach ($modelos as $modelo)
                            <option value="{{ $modelo }}">{{ $modelo }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="py-4">
                    <label for="combustivel">Combustível: </label>
                    <select name="combustivel" id="combustivel">
                        <option value="" selected>Todos</option>
                        @foreach ($combustiveis as $combustivel)
                            <option value="{{ $combustivel }}">{{ $combustivel }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="flex justify-evenly items-start">
                <div class="py-4 w-1/3">
                    <label for="quilometragem">Quilometragem: </label>
                    <br>
                    <input type="number" name="quilometragem-min" id="quilometragem-min">
                    <br>
                    <label>até</label>
                    <br>
                    <input type="number" name="quilometragem-max" id="quilometragem-max">
                </div>
                <div class="py-4 w-1/3">
                    <label for="ano">Ano: </label>
                    <br>
                    <input type="number" name="ano-min" id="ano-min">
                    <br>
                    <label>até</label>
                    <br>
                    <input type="number" name="ano-max" id="ano-max">
                </div>
                <div class="py-4 w-1/3">
                    <label for="preco">Preço: </label>
                    <br>
                    <input type="number" name="preco-min" id="preco-min">
                    <br>
                    <label>até</label>
                    <br>
                    <input type="number" name="preco-max" id="preco-max">
                </div>
            </div>
            <table id="table" class="display">
                <thead>
                    <tr>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Ano</th>
                        <th>Quilometragem</th>
                        <th>Preço</th>
                        <th>Combustível</th>
                        <th>Fornecedor</th>
                    </tr>
                </thead>
            </table>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        let table = new DataTable('#table', {
            language: {
                url: 'https://cdn.datatables.net/plug-ins/2.1.5/i18n/pt-BR.json',
            },
            ajax: {
                url: '/vehicles',
                method: 'GET',
                data: function (d) {
                    d.marca = $('#marca').val() ?? '';
                    d.modelo = $('#modelo').val() ?? '';
                    d.combustivel = $('#combustivel').val() ?? '';

                    d.quilometragem_min = $('#quilometragem-min').val() ?? '';
                    d.quilometragem_max = $('#quilometragem-max').val() ?? '';
                    d.ano_min = $('#ano-min').val() ?? '';
                    d.ano_max = $('#ano-max').val() ?? '';
                    d.preco_min = $('#preco-min').val() ?? '';
                    d.preco_max = $('#preco-max').val() ?? '';

                    return d;
                }
            },
            processing: true,
            serverSide: true,
            columns: [
                { data: 'marca', name: 'marca' },
                { data: 'modelo', name: 'modelo' },
                { data: 'ano', name: 'ano' },
                { data: 'quilometragem', name: 'quilometragem' },
                { data: 'preco', name: 'preco' },
                { data: 'combustivel', name: 'combustivel' },
                { data: 'fornecedor', name: 'fornecedor' },
            ],
            paging: true,
            ordering: true,
        });

        $('#marca').on('change', function () {
            table.draw();
        });

        $('#modelo').on('change', function () {
            table.draw();
        });

        $('#combustivel').on('change', function () {
            table.draw();
        });

        $('#quilometragem-min').on('change', function () {
            table.draw();
        });

        $('#quilometragem-max').on('change', function () {
            table.draw();
        });

        $('#ano-min').on('change', function () {
            table.draw();
        });

        $('#ano-max').on('change', function () {
            table.draw();
        });

        $('#preco-min').on('change', function () {
            table.draw();
        });

        $('#preco-max').on('change', function () {
            table.draw();
        });
    </script>
@endpush
