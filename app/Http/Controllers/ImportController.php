<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

use Exception;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\MembrosImport;



class ImportController extends Controller
{

    public function __construct()
    {
    }


    public function index()
    {
        return view('import');
    }



    public function upload(Request $request)
    {


        $request->validate([
            'iMembro' => 'required|max:8192|mimes:xls,xlsx'
        ], [
            'iMembro.required' => 'É necessário escolher o arquivo de importação.',
            'iMembro.max' => 'O tamanho máximo permitido para o arquivo é de 8Mb.',
            'iMembro.mimes' => 'Somente é permitido arquivo do Excel.'
        ]);


        try {

            Excel::import(new MembrosImport(), $request->file('iMembro'));

        }
        catch (Exception $ex) {

            $message = "Erro desconhecido, por gentileza, entre em contato com o administrador. " . $ex->getMessage();

            return back()->withErrors($message);
        }

        return redirect()->route('import.index');
    }
}
