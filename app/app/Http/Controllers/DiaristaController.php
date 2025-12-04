<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\CleaningQuote;
use Illuminate\Http\Request;

class DiaristaController extends Controller
{
    public function index()
    {
        return view('diarista.index');
    }

    public function storeQuote(Request $request)
    {
        $validated = $request->validate([
            // cliente
            'name'          => ['required', 'string', 'max:255'],
            'email'         => ['required', 'email', 'max:255'],
            'phone'         => ['required', 'string', 'max:30'],
            'address'       => ['required', 'string', 'max:255'],

            // serviço
            'property_type' => ['required', 'string', 'max:100'],
            'rooms'         => ['required', 'integer', 'min:0'],
            'bathrooms'     => ['required', 'integer', 'min:0'],
            'has_pets'      => ['nullable', 'boolean'],
            'service_date'  => ['required', 'date'],
            'frequency'     => ['required', 'string', 'max:50'],
            'details'       => ['nullable', 'string'],
        ]);

        // cria/atualiza cliente pelo e-mail
        $client = Client::updateOrCreate(
            ['email' => $validated['email']],
            [
                'name'    => $validated['name'],
                'phone'   => $validated['phone'],
                'address' => $validated['address'],
            ]
        );

        // cria solicitação de orçamento
        CleaningQuote::create([
            'client_id'     => $client->id,
            'property_type' => $validated['property_type'],
            'rooms'         => $validated['rooms'],
            'bathrooms'     => $validated['bathrooms'],
            'has_pets'      => $request->boolean('has_pets'),
            'service_date'  => $validated['service_date'],
            'frequency'     => $validated['frequency'],
            'details'       => $validated['details'] ?? null,
        ]);

        return redirect()
            ->route('diarista.index')
            ->with('success', 'Orçamento solicitado com sucesso! Em breve entraremos em contato.');
    }
}
