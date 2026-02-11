<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LegalController;
use App\Http\Controllers\CnpjController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DirectoryController;
use App\Http\Controllers\RemovalRequestController;
use App\Http\Controllers\ConsultaAvancadaController;



// --- ROTAS DE CNPJ ---
Route::get('/', [HomeController::class, 'index'])->name('home');                                                // PÁGINA PRINCIPAL
Route::get('/politica-de-privacidade', [LegalController::class, 'privacy'])->name('privacidade');               // PÁGINA POLITICA DE PRIVACIDADE
//########################################################################################################################
//########################################################################################################################
// --- ROTAS DE CONSULTA AVANÇADA ---
Route::get('/consulta-avancada', [ConsultaAvancadaController::class, 'index'])->name('consulta_avancada.index');                // MOSTRA A PÁGINA DE CONSULTA AVANÇADA
Route::get('/consulta-avancada/buscar', [ConsultaAvancadaController::class, 'search'])->name('consulta_avancada.search');       // PROCESSA A BUSCA AVANÇADA
//########################################################################################################################
//########################################################################################################################
// --- ROTAS DE CNPJ ---
Route::post('/consultar', [CnpjController::class, 'consultar'])->name('cnpj.consultar');                        // ROTA DO FORMULÁRIO DE CONSULTA
Route::get('/cnpj/{cnpj}', [CnpjController::class, 'show'])->name('cnpj.show');                                 // ROTA DA PÁGINA DO CNPJ
Route::get('/remocao/{cnpj}', [RemovalRequestController::class, 'create'])->name('remocao.show');               // FORMULÁRIO DE REMOÇÃO
Route::post('/remocao/{cnpj}', [RemovalRequestController::class, 'store'])->name('remocao.store');              // ENVIO DE REMOÇÃO
//########################################################################################################################
//########################################################################################################################
// --- ROTAS DO PORTAL DE EMPRESAS ---
Route::prefix('empresas')->name('empresas.')->group(function () {
    Route::get('/', [DirectoryController::class, 'index'])->name('index');                                      // PÁGINA PRINCIPAL DO PORTAL                     
    Route::get('/{uf}', [DirectoryController::class, 'byState'])->name('state');                                // PÁGINA DO ESTADO (UF)
    Route::get('/{uf}/{municipio}', [DirectoryController::class, 'byCity'])->name('city');                      // PÁGINA DO MUNICIPIO                                  
});