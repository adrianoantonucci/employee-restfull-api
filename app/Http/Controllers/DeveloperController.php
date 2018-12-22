<?php

namespace App\Http\Controllers;
use App\Models\Developer;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Validator;
use Log;


class DeveloperController extends Controller
{
    public function index(Request $request){
        $developers = Developer::nome($request->nome)
                                ->sexo($request->sexo)
                                ->idade($request->idade)
                                ->sexo($request->sexo)
                                ->hobby($request->hobby)
                                ->datanascimento($request->datanascimento)
                                ->excluido($request->excluido)
                                ->paginate(10);

        if(!$developers){
            return response()->json([
                'message' => 'Record not found',
            ], 404);
        }

        return response()->json($developers);
    }

    public function show($id)
    {
        try {
            $developer = Developer::select('id','nome','sexo','idade','hobby','datanascimento')->findOrFail($id);
            return response()->json($developer);
        } catch(\Exception $e) {
            return response()->json([
                'message' => 'Record not found',
            ], 404);
        }        
    }

    public function store(Request $request){
        $rule = [
            'nome' => 'required|max:80',
            'sexo' => 'required|max:80',
            'datanascimento' => 'date_format:"d/m/Y"|required',
        ];

        $msg = [
            'name.required' => 'O campo nome é obrigatório',
            'name.max' => 'o Campo nome tem o limite de :max caracteres',
            'sexo.required' => 'O campo sexo é obrigatório',
            'sexo.max' => 'o Campo sexo tem o limite de :max caracteres',
            'datanascimento.require' => 'O campo datanascimento é obrigatório',
            'datanascimento.date_format' => 'O campo datanascimento deve ser no formato dd/mm/yyyy',
        ];

        $validator = Validator::make($request->all(), $rule, $msg);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->getMessages(),
            ], 400);
        }

        try {
            $request['datanascimento'] = Carbon::createFromFormat('d/m/Y', $request['datanascimento'])->format('Y-m-d');
            $developer = Developer::create($request->all());

            return response()->json([
                'message' => 'Successfully created developer',
                'data' => $developer,
            ], 201);
            
        } catch(\Exception $e) {
            Log::error("Error to create new developer. Error: {$e->getMessage()}");
            
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }

    }

    public function update(Request $request, $id){
        try {
            $developer = Developer::findOrFail($id);

            if(isset($request->datanascimento)){
                $request['datanascimento'] = Carbon::createFromFormat('d/m/Y', $request['datanascimento'])->format('Y-m-d');
            }

            $developer->fill($request->all());
            $developer->save();

            return response()->json([
                'message' => 'Developer updated successfully',
                'data' => $developer,
            ], 200);

        } catch(\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 404);
        }
    }

    public function destroy($id){
        try {
            $results = Developer::findOrFail($id);
            $results->delete();

            Log::info("Deleted developer. Developer: { $results->id }");

            return response()->json($results);
        } catch(\Exception $e) {
            Log::error("Error to delete developer. Error: {$e->getMessage()}");
            return response()->json([
                'message' => 'Record not found',
            ], 404);
        }       
    }

}
