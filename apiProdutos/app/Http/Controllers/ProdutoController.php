<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Produto;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct() // dando acesso a qualquer requisição
     {
       header('Access-Control-Allow-Origin: *');
     }
    public function index()
    {
      $produto = Produto::all(); // retornando todos os produtos do banco
      return response()->json(['data'=>$produto, 'status'=>true]);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $dados = $request->all(); // pegando os dados da minha requisição
        $produto = Produto::create($dados); // setando no banco os dados dessa requisição
        if($produto){
            return response()->json(['data'=>$produto, 'status'=>true]); // retornando uma resposta
        }else{
            return response()->json(['data'=>'Erro ao criar o produto', 'status'=>false]);
       }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $produto = Produto::find($id); // realiza uma busca no banco via id
         if($produto){
             return response()->json(['data'=>$produto, 'status'=>true]);
         }else{
             return response()->json(['data'=>'Não existe esse produto cadastrado', 'status'=>false]);
         }

    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $dados = $request->all();
        $produto = Produto::find($id);
        if($produto){
            $produto->update($dados); // realizando o update de dados, de acordo com aquele id
            return response()->json(['data'=>$produto, 'status'=>true]);
        }else{
            return response()->json(['data'=>'Erro ao editar o produto', 'status'=>false]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $produto = Produto::find($id);
         if($produto){
             $produto->delete();
             return response()->json(['data'=>'Produto removido com sucesso!', 'status'=>true]);
         }else{
             return response()->json(['data'=>'Erro ao remover o produto', 'status'=>false]);
         }
    }
}
