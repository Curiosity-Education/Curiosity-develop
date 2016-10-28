<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class baseStructure extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'command:baseStructure';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Command description.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		//
        
        $nombre_archivo = 'vista_'.$this->argument("name").'.blade.php'; 
        $mensaje = "";
 
        if(file_exists(app_path().'/views/'.$nombre_archivo))
        {
             $this->info("La vista {$nombre_archivo} ya existe en la ruta ".app_path().'/views/');
        }

        else
        {
            switch($this->argument("type")){
                case "general_panel":
                    $mensaje .= "@extends('admin_base') \n";
                    $mensaje .= "@section('title') \n";
                    $mensaje .= "   <!--Titulo de la vista--> \n";
                    $mensaje .= "@stop \n";
                    $mensaje .= "@section('mi_css') \n";
                    $mensaje .= "    <!--Links css--> \n";
                    $mensaje .= "@stop \n";
                    $mensaje .= "@section('titulo_contenido') \n";
                    $mensaje .= "   <!--Titulo del contenido--> \n";
                    $mensaje .= "@stop \n";
                    $mensaje .= "@section('migas') \n";
                    $mensaje .= "   <!--Migas de retorno--> \n";
                    $mensaje .= "@stop \n";
                    $mensaje .= "@section('panel_opcion') \n";
                    $mensaje .= "   <!--Contenido completo--> \n";
                    $mensaje .= "@stop \n";
                    $mensaje .= "@section('mi_js') \n";
                    $mensaje .= "   <!--Script Javascript--> \n";
                    $mensaje .= "@stop \n";
                    break;
                case "layer_juego":
                    break;
            }
           
            
            if($archivo = fopen(app_path().'/views/'.$nombre_archivo, "a"))
            {
                if(fwrite($archivo, $mensaje. "\n"))
                {
                    $this->info("Se ha creado la vista {$nombre_archivo} en la ruta ".app_path().'/views/');
                }
                else
                {
                    $this->info("Ups algo salio mal!, Hubo un problema al crear la vista {$nombre_archivo}");
                }

                fclose($archivo);
            }
        }

        
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			array('name', InputArgument::REQUIRED, 'Name View.'),
			array('type', InputArgument::OPTIONAL, 'Name View.','general_panel'),
		);
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
			array('name', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
		);
	}

}
