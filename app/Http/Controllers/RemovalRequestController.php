<?php

namespace App\Http\Controllers;

use App\Models\Estabelecimento;
use App\Models\RemovalRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class RemovalRequestController extends Controller
{
    public function create(string $cnpj): View
    {
        $cnpjNumbers = preg_replace('/[^0-9]/', '', $cnpj);
        $cnpjFormatted = $this->formatCnpj($cnpjNumbers);

        return view('pages.remocao.show', [
            'cnpj' => $cnpjNumbers,
            'cnpjFormatted' => $cnpjFormatted,
        ]);
    }

    public function store(Request $request, string $cnpj): RedirectResponse
    {
        $cnpjNumbers = preg_replace('/[^0-9]/', '', $cnpj);

        $validated = $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'vinculo' => ['required', 'string', 'max:255'],
            'motivo' => ['required', 'string'],
            'aceite_lgpd' => ['accepted'],
            'confirmacao_responsavel' => ['accepted'],
            'entende_prazo_buscas' => ['accepted'],
        ]);

        DB::transaction(function () use ($cnpjNumbers, $validated, $request) {
            RemovalRequest::create([
                'cnpj' => $cnpjNumbers,
                'nome' => $validated['nome'],
                'email' => $validated['email'],
                'vinculo' => $validated['vinculo'],
                'motivo' => $validated['motivo'],
                'aceite_lgpd' => $request->boolean('aceite_lgpd'),
                'confirmacao_responsavel' => $request->boolean('confirmacao_responsavel'),
                'entende_prazo_buscas' => $request->boolean('entende_prazo_buscas'),
                'token' => Str::uuid(),
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);

            $cnpjBasico = substr($cnpjNumbers, 0, 8);
            $cnpjOrdem = substr($cnpjNumbers, 8, 4);
            $cnpjDv = substr($cnpjNumbers, 12, 2);

            Estabelecimento::where('cnpj_basico', $cnpjBasico)
                ->where('cnpj_ordem', $cnpjOrdem)
                ->where('cnpj_dv', $cnpjDv)
                ->delete();
        });

        return redirect()
            ->route('home')
            ->with('success', 'O CNPJ foi removido. Você pode realizar uma nova consulta na página inicial.');
    }

    private function formatCnpj(string $cnpj): string
    {
        if (strlen($cnpj) !== 14) {
            return $cnpj;
        }

        return vsprintf('%s.%s.%s/%s-%s', [
            substr($cnpj, 0, 2), substr($cnpj, 2, 3), substr($cnpj, 5, 3),
            substr($cnpj, 8, 4), substr($cnpj, 12, 2)
        ]);
    }
}
