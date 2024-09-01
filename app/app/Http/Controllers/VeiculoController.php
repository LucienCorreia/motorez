<?php

namespace App\Http\Controllers;

use App\Models\Veiculo;
use App\Services\ImportVehicles\Importer;
use Illuminate\Http\Request;


class VeiculoController extends Controller
{

    public function index()
    {
        $marcas = Veiculo::select('marca')->distinct()->get()->pluck('marca');
        $combustiveis = Veiculo::select('combustivel')->distinct()->get()->pluck('combustivel');
        $modelos = Veiculo::select('modelo')->distinct()->get()->pluck('modelo');

        return view('index', compact('marcas', 'combustiveis', 'modelos'));
    }

    public function list(Request $request)
    {
        $draw = intval($request->input('draw'));
        $start = intval($request->input('start'));
        $length = intval($request->input('length'));

        $query = Veiculo::query();

        $orderColumn = $request->input('order.0.column');
        $orderDir = $request->input('order.0.dir');
        $columns = ['fornecedor', 'modelo', 'ano', 'combustivel', 'preco', 'quilometragem', 'marca'];

        if (isset($columns[$orderColumn])) {
            $query->orderBy($columns[$orderColumn], $orderDir);
        }

        if ($request->input('marca')) {
            $query->where('marca', 'like', '%' . $request->input('marca') . '%');
        }

        if ($request->input('modelo')) {
            $query->where('modelo', 'like', '%' . $request->input('modelo') . '%');
        }

        if ($request->input('combustivel')) {
            $query->where('combustivel', 'like', '%' . $request->input('combustivel') . '%');
        }

        if ($request->input('ano_min') && $request->input('ano_max')) {
            $query->whereBetween('ano', [$request->input('ano_min'), $request->input('ano_max')]);
        }

        if ($request->input('quilometragem_min') && $request->input('quilometragem_max')) {
            $query->whereBetween('quilometragem', [$request->input('quilometragem_min'), $request->input('quilometragem_max')]);
        }

        if ($request->input('preco_min') && $request->input('preco_max')) {
            $query->whereBetween('preco', [$request->input('preco_min'), $request->input('preco_max')]);
        }

        $totalRecords = $query->count();

        // Dados da página atual
        $data = $query->skip($start)->take($length)->get();

        $response = [
            "draw"            => $draw,
            "recordsTotal"    => $totalRecords,
            "recordsFiltered" => $totalRecords,
            "data"            => $data
        ];

        return response()->json($response);
    }
    public function import(Request $request)
    {
        $file = $request->file('file');

        $provider = $request->input('provider');

        $importerService = null;

        switch ($provider) {
            case 'webmotors':
                $importerService = new \App\Services\ImportVehicles\WebMotorsImporter();
                break;
            case 'revenda-mais':
                $importerService = new \App\Services\ImportVehicles\RevendaMaisImporter();
                break;
            default:
                return response()->json(['success' => false, 'message' => 'Provider not found']);
        }

        $import = new Importer($importerService);
        $import->import($file->getContent());

        return redirect('/');
    }

    public function export()
    {
        $data = Veiculo::all();

        $filename = 'veiculos_' . date('Y-m-d_H-i-s') . '.csv';

        $handle = fopen(storage_path() . '/' . $filename, 'w+');

        fputcsv($handle, array_keys($data->first()->toArray()));

        foreach ($data as $row) {
            fputcsv($handle, array_values($row->toArray()));
        }

        fclose($handle);

        return response()->download(storage_path() . '/' . $filename, $filename, [
            'Content-Type' => 'text/csv'
        ]);
    }
}
