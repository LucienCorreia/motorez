<?php

namespace App\Http\Controllers;

use App\Models\Veiculo;
use Illuminate\Http\Request;
use SimpleXMLElement;

class VeiculoController extends Controller
{
    public function webmotors()
    {
        $catalogo = Veiculo::all();

        $return = $catalogo->map(function ($veiculo) {
            $stdClass = new \stdClass();

            $stdClass->id = $veiculo->codigo;
            $stdClass->marca = $veiculo->marca;
            $stdClass->modelo = $veiculo->modelo;
            $stdClass->ano = $veiculo->ano;
            $stdClass->versao = $veiculo->versao;
            $stdClass->km = $veiculo->quilometragem;
            $stdClass->combustivel = $veiculo->tipo_combustivel;
            $stdClass->cambio = $veiculo->cambio;
            $stdClass->portas = $veiculo->portas;
            $stdClass->preco = $veiculo->preco_venda;
            $stdClass->data = $veiculo->ultima_atualizacao;
            $stdClass->opcionais = explode(',', $veiculo->opcionais);

            return $stdClass;
        });

        return response()->json(['veiculos' => $return]);
    }

    public function revendaMais()
    {
        $catalogo = Veiculo::all();

        $xml = new SimpleXMLElement('<estoque></estoque>');
        $body = $xml->addChild('veiculos');

        $catalogo->each(function ($veiculo) use ($body) {
            $xmlVeiculo = $body->addChild('veiculo');

            $xmlVeiculo->addChild('codigoVeiculo', $veiculo->codigo);
            $xmlVeiculo->addChild('marca', $veiculo->marca);
            $xmlVeiculo->addChild('modelo', $veiculo->modelo);
            $xmlVeiculo->addChild('ano', $veiculo->ano);
            $xmlVeiculo->addChild('versao', $veiculo->versao);
            $xmlVeiculo->addChild('quilometragem', $veiculo->quilometragem);
            $xmlVeiculo->addChild('tipoCombustivel', $veiculo->tipo_combustivel);
            $xmlVeiculo->addChild('cambio', $veiculo->cambio);
            $xmlVeiculo->addChild('portas', $veiculo->portas);
            $xmlVeiculo->addChild('precoVenda', $veiculo->preco_venda);
            $xmlVeiculo->addChild('ultimaAtualizacao', $veiculo->ultima_atualizacao);
            $xmlOpicionais = $xmlVeiculo->addChild('opcionais');

            foreach (explode(',', $veiculo->opcionais) as $op) {
                $xmlOpicionais->addChild('opcional', $op);
            }
        });

        return response($xml->asXML())->header('Content-Type', 'text/xml');
    }
}
