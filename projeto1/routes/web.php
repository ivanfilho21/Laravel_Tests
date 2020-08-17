<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


# Redirecionar da raíz para a homepage
Route::redirect('/', 'home');

# Colocar nome na rota para facilitar acesso futuro
Route::get('/home', 'HomeController')->name('home');

Route::get('/home/{var}', function ($var) {
    echo 'Você digitou '.$var;
});

# Teste: Criando rotas encontrar usuário por Id
# A regra (pattern) para o Id encontra-se no arquivo app/providers/RouteServiceProvider.php

Route::get('/usuario/{id}', function ($id) {
    echo 'User id: '.$id;
});

# Exercício:
# criar uma rota com /usuario que receba um nickname.
# nicknames devem conter no mínimo 6 caracteres e podem conter:
# letras maiúsculas e minúsculas (de a à z), números e
# esses dois caracteres especiais: -_

Route::get('/usuario/{nickname}', function ($nickname) {
    echo 'Nome de Usuário: '.$nickname;
})->where('nickname', '[a-zA-Z0-9-_]{6,}');


# Agrupamento de Rotas por meio de prefixo

Route::prefix('/admin')->group(function () {
    # Raiz de /config
    Route::get('/', 'Admin\ConfigController@index')->name('admin');
    Route::post('/', 'Admin\ConfigController@receberDados');

    Route::get('/changeUsername', function () {
        echo 'mudar nome de usuario';
    });
});


# CRUD de Tarefas
Route::prefix('/tarefas')->group(function () {
    Route::get('/', 'TarefasController@listar')->name('tarefas');
    Route::get('/view/{id}', 'TarefasController@visualizar')->name('tarefas.view');
    Route::get('/add', 'TarefasController@adicionar')->name('tarefas.add');
    Route::post('/add', 'TarefasController@adicionarAcao');
    Route::get('/edit/{id}', 'TarefasController@editar')->name('tarefas.edit');
    Route::post('/edit/{id}', 'TarefasController@editarAcao');
    Route::get('/delete/{id}', 'TarefasController@deletar')->name('tarefas.delete');
    Route::get('/check/{id}', 'TarefasController@marcarTarefa')->name('tarefas.toggleCheck');
});

# CRUD de Pets
Route::prefix('/pets')->group(function () {
    Route::get('/', 'PetsController@listar')->name('pets');
    Route::get('/view/{id}', 'PetsController@visualizar')->name('pets.view');
    Route::get('/create', 'PetsController@criar')->name('pets.create');
    Route::post('/create', 'PetsController@salvar');
    Route::get('/update/{id}', 'PetsController@atualizar')->name('pets.update');
    Route::post('/update/{id}', 'PetsController@salvar');
    Route::get('/delete/{id}', 'PetsController@destruir')->name('pets.delete');
});

# CRUD de Posts
Route::resource('posts', 'PostController');

# Fallback deve estar em último
Route::fallback(function () {
    return view('404');
});