<?php
namespace App\Controllers;

use App\Models\Gun;
use Sirius\Validation\Validator;

class GunController extends BaseController{

    /**
     * Ruta GET /gun/new que muestra el formulario para añadir un nuevo arma.
     *
     * @return string un render de la web con toda la info
     */
    public function getNew(){
        global $calibreValue, $tipoValue, $balasvalue, $retrocesoValue;

        $errors = array();  // Array donde se guardaran los errores de validación
        $error = false;     // Será true si hay errores de validación.

        $webInfo = [
            'h1'        => 'Añadir arma',
            'submit'    => 'Añadir',
            'method'    => 'POST'
        ];

        // Se construye un array asociativo $gun con todas sus claves vacías
        $gun = array_fill_keys(["name","image", "calibre", "tipo","balas","retroceso"], "");

        return $this->render('formGuns.twig', [
            'calibreValue'  => $calibreValue,
            'tipoValue'     => $tipoValue,
            'balasValue'    => $balasvalue,
            'retrocesoValue'=> $retrocesoValue,
            'gun'           => $gun,
            'errors'        => $errors,
            'webInfo'       => $webInfo
        ]);
    }


    /**
     * Ruta POST /gun/new que procesa el formulario que usamos para añadir un nuevo arma.
     *
     * @return string un render de la web con toda la info
     */
    public function postNew(){
        global $calibreValue, $tipoValue, $balasvalue, $retrocesoValue;

        $webInfo = [
            'h1'        => 'Añadir Arma',
            'submit'    => 'Añadir',
            'method'    => 'POST'
        ];

        if (!empty($_POST)) {
            $validator = new Validator();

            $requiredFieldMessageError = "El {label} es requerido";

            $validator->add('nombre:Nombre', 'required',[],$requiredFieldMessageError);
            $validator->add('calibre:Calibre', 'required', [], $requiredFieldMessageError);
            $validator->add('tipo:Tipo', 'required',[], $requiredFieldMessageError);
            $validator->add('balas:Balas','required',[],$requiredFieldMessageError);
            $validator->add('retroceso:retroceso','required',[],$requiredFieldMessageError);

            // Extraemos los datos enviados por POST
            $gun['nombre'] = htmlspecialchars(trim($_POST['nombre']));
            $gun['imagen'] = htmlspecialchars(trim($_POST['imagen']));
            $gun['calibre'] = htmlspecialchars(trim($_POST['calibre']));
            $gun['balas'] = htmlspecialchars(trim($_POST['balas']));
            $gun['tipo'] = htmlspecialchars(trim($_POST['tipo']));
            $gun['retroceso'] = htmlspecialchars(trim($_POST['retroceso']));

            if ($validator->validate($_POST)) {
                $gun = new Gun([
                    'imagen'         => $gun['imagen'],
                    'nombre'         => $gun['nombre'],
                    'calibre'        => $gun['calibre'],
                    'balas'          => $gun['balas'],
                    'tipo'           => $gun['tipo'],
                    'retroceso'      => $gun['retroceso'],
                ]);
                $gun->save();

                // Si se guarda sin problemas se redirecciona la aplicación a la página de inicio
                header('Location: ' . BASE_URL);
            }else{
                $errors = $validator->getMessages();
            }
        }

        return $this->render('formGuns.twig', [
            'calibreValue'  => $calibreValue,
            'tipoValue'     => $tipoValue,
            'balasValue'    => $balasvalue,
            'retrocesoValue'=> $retrocesoValue,
            'gun'           => $gun,
            'errors'        => $errors,
            'webInfo'       => $webInfo
        ]);
    }

    /**
     * Ruta [GET] /guns/edit/{id} que muestra el formulario de actualización de un nuevo arma.
     *
     * @param id Código del arma.
     *
     * @return string Render de la web con toda la información.
     */
    public function getEdit($id){
        global $calibreValue, $tipoValue, $balasvalue, $retrocesoValue;

        $errors = array();  // Array donde se guardaran los errores de validación

        $webInfo = [
            'h1'        => 'Actualizar Arma',
            'submit'    => 'Actualizar',
            'method'    => 'PUT'
        ];

        // Recuperar datos
        $gun = Gun::find($id);

        if( !$gun ){
            header('Location: home.twig');
        }

        return $this->render('formGuns.twig',[
            'calibreValue'  => $calibreValue,
            'tipoValue'     => $tipoValue,
            'balasValue'    => $balasvalue,
            'retrocesoValue'=> $retrocesoValue,
            'gun'           => $gun,
            'errors'        => $errors,
            'webInfo'       => $webInfo
        ]);
    }

    /**
     * Ruta [PUT] /gun/edit/{id} que actualiza toda la información del arma elegida.
     * Usamos put porque actualizamos todos los campos en la BDD.
     *
     * @param id Código del arma.
     *
     * @return string Render de la web con toda la información.
     */
    public function putEdit($id){
        global $calibreValue, $tipoValue, $balasvalue, $retrocesoValue;

        $errors = array();  // Array donde se guardaran los errores de validación

        $webInfo = [
            'h1'        => 'Actualizar Arma',
            'submit'    => 'Actualizar',
            'method'    => 'PUT'
        ];

        if( !empty($_POST)){
            $validator = new Validator();

            $requiredFieldMessageError = "El {label} es requerido";

            $validator->add('nombre:Nombre', 'required',[],$requiredFieldMessageError);
            $validator->add('calibre:Calibre', 'required', [], $requiredFieldMessageError);
            $validator->add('tipo:Tipo', 'required',[], $requiredFieldMessageError);
            $validator->add('balas:Balas','required',[],$requiredFieldMessageError);
            $validator->add('retroceso:retroceso','required',[],$requiredFieldMessageError);

            // Extraemos los datos enviados por POST
            $gun['id'] = $id;
            $gun['nombre'] = htmlspecialchars(trim($_POST['nombre']));
            $gun['imagen'] = htmlspecialchars(trim($_POST['imagen']));
            $gun['calibre'] = htmlspecialchars(trim($_POST['calibre']));
            $gun['balas'] = htmlspecialchars(trim($_POST['balas']));
            $gun['tipo'] = htmlspecialchars(trim($_POST['tipo']));
            $gun['retroceso'] = htmlspecialchars(trim($_POST['retroceso']));

            if ( $validator->validate($_POST) ){
                $gun = Gun::where('id', $id)->update([
                    'id'             => $gun['id'],
                    'imagen'         => $gun['imagen'],
                    'nombre'         => $gun['nombre'],
                    'calibre'        => $gun['calibre'],
                    'balas'          => $gun['balas'],
                    'tipo'           => $gun['tipo'],
                    'retroceso'      => $gun['retroceso']
                ]);

                // Si se guarda sin problemas se redirecciona la aplicación a la página de inicio
                header('Location: ' . BASE_URL);
            }else{
                $errors = $validator->getMessages();
            }
        }
        return $this->render('formGuns.twig', [
            'calibreValue'  => $calibreValue,
            'tipoValue'     => $tipoValue,
            'balasValue'    => $balasvalue,
            'retrocesoValue'=> $retrocesoValue,
            'gun'           => $gun,
            'errors'        => $errors,
            'webInfo'       => $webInfo,
            'errors'        => $errors,
            'webInfo'       => $webInfo
        ]);
    }


    /**
     * Ruta raíz [GET] /guns para la dirección home de la aplicación. Que muestra la lista de armas.
     *
     * @return string Render de la web con toda la información.
     *
     * Ruta [GET] /guns/{id} que muestra la página de detalle del arma.
     *
     * @param id Código del arma.
     *
     * @return string Render de la web con toda la información.
     */
    public function getIndex($id = null){
        if( is_null($id) ){
            $webInfo = [
                'title' => 'Página de Inicio - GunsADA'
            ];

            $guns = Gun::query()->orderBy('id','desc')->get();

            return $this->render('home.twig', [
                'guns' => $guns,
                'webInfo' => $webInfo
            ]);

        }else{
            // Recuperar datos

            $webInfo = [
                'title' => 'Página de arma - GunsADA'
            ];

            $gun = Gun::find($id);

            if( !$gun ){
                return $this->render('404.twig', ['webInfo' => $webInfo]);
            }

            return $this->render('gun/gun.twig', [
                'gun'    => $gun,
                'webInfo'   => $webInfo,
            ]);
        }

    }


    /**
     * Ruta [DELETE] /guns/delete para eliminar el arma con el código pasado
     */
    public function deleteIndex(){
        $id = $_REQUEST['id'];

        $gun = Gun::destroy($id);

        header("Location: ". BASE_URL);
    }
}