<?php

/* usuarioBundle:Default:publico.html.twig */
class __TwigTemplate_e55796ed308e55201658b338eb73cf1f extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("::matilti-feminista.html.twig");

        $this->blocks = array(
            'jquery' => array($this, 'block_jquery'),
            'title' => array($this, 'block_title'),
            'titleH1' => array($this, 'block_titleH1'),
            'tema' => array($this, 'block_tema'),
            'galeria' => array($this, 'block_galeria'),
            'noticias' => array($this, 'block_noticias'),
            'contenido' => array($this, 'block_contenido'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "::matilti-feminista.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    public function block_jquery($context, array $blocks = array())
    {
        // line 3
        echo "  <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("js/jquery-1.4.2.min.js"), "html", null, true);
        echo "\" ></script>
";
    }

    // line 5
    public function block_title($context, array $blocks = array())
    {
        echo " :: Sistema de comunicacion digital comunitaria :: ";
    }

    // line 6
    public function block_titleH1($context, array $blocks = array())
    {
        echo " .:: Matilti ::. ";
    }

    // line 7
    public function block_tema($context, array $blocks = array())
    {
        echo "<h2>Sistema de comunicacion digital comunitaria</h2>";
    }

    // line 8
    public function block_galeria($context, array $blocks = array())
    {
        // line 9
        echo "  <!-- #gallery -->
  <!-- /#gallery -->
";
    }

    // line 12
    public function block_noticias($context, array $blocks = array())
    {
    }

    // line 14
    public function block_contenido($context, array $blocks = array())
    {
        // line 15
        echo "  ";
        if (($this->getContext($context, "page") == "project")) {
            // line 16
            echo "<h2>Metodos de envio</h2>
 
Masivo web
Los usuarios con privilegios podran enviar desde una pagina web mensajes masivos a todos lo telefonos de la red de El Salvador, por sexo, edades y zona geografica (previamente deber�n enviar especificaciones por sms o web).
Masivo movil
Se envia un mensaje a todas las usuarias de la herramienta a partir de un mensaje de texto enviado.
A peticion de la usuario
Las personas pueden solicitar informacion de diferentes temas a traves de un mensaje de texto. Actualmente se puede enviar la palabra .info. al ####-#### y se recibe como respuesta un mensaje de texto con el protocolo de atencion a casos de violencia sexual del ministerio de salud.
          <h2>Dominio</h2>
          <p>
           <b>Usted es libre de:</b><br />
           <ul class=\"list1\"><li>Copiar, Distribuir, Exhibir, y Ejecutar la obra.</li></ul><br />
           Hacer obras derivadas. Bajo las siguientes condiciones:<br />
           <ul class=\"list1\">
            <li><b>Atribucion (BY) - </b>Usted debe atribuir la obra en la forma especificada por el autor.</li>
            <li><b>No Comercial (NC) - </b>Usted no puede usar esta obra con fines comerciales.</li>
            <li><b>Compartir Obras Derivadas Igual (SA) - </b>Si usted altera, transforma, o crea sobre esta obra, solo podra distribuir la obra derivada resultante bajo una licencia identica a esta.</li>
           </ul>
          </p>
<p><h2>Componentes de software de matilti</h2>
Con esta herramienta se busca aumentar la participacion ciudadana mediante el libre envio de mensajes de texto por telefonos celulares, esta ventaja permite que todas las personas la usen sin requerir tecnologi�a de uso especifico o con altos requerimientos de recursos, unicamente con un telefono celular que pueda enviar y recibir mensajes de texto se puede usar y administrar la herramienta.<br />
Gracias a las ventajas del software libre se logro desarrollar esta solucion basada en las necesidades de las mujeres organizadas y el codigo fuente de una herramienta similar se logro construir un medio de comunicaci�n alternativo que comunique a nuestras defensoras de derechos humanos\t\t\t\t\t\t\t</p>
 ";
        } elseif (($this->getContext($context, "page") == "functions")) {
            // line 39
            echo "<h2>Como puedes formar parte de la red de comunicacion.</h2>
          <p>
           Puedes enviar un correo electronico a matilti@colectivafeminista.org.sv con los siguientes datos:<br>
           </p><ul class=\"list1\">
            <li>Nombre completo</li>
            <li>numero de telefono</li>
            <li>Fecha de nacimiento</li>
            <li>Direccion (Para efectos de generacion de reportes geograficos y denuncias mas precisas)</li>
           </ul>
           O puedes mandar un mensaje de texto al <b>## ## ## ##</b> con la palabra <b>registrame</b>  seguido con los nombres del usuario y sus apellidos separados por un guion. La herramienta respondera con un mensaje de incorporacion.<br>
           <b>Ejemplo:      registrame Silvia Estela-Ayala</b><br>
          <p></p>
          <h2>Operaciones que podras hacer siendo mienbra de nuestra red</h2>
          <p>Como mienbra podras realizar todas las siguientes operaciones enviando el parametro correcto en el mensaje de texto.</p>
          <h2>Funcion: DENUNCIA</h2>
          <p>
           La PNC, ISDEMU y la Colectiva Feminista recibiran una alerta sobre el caso, ademas reciben �un correo electronico con la informacion que has enviado, para el seguimiento de tu caso. Para usar esta Funcion se envia la palabra denuncia, seguida por la denuncia que se desea hacer. La herramienta respondera con un numero que identificara de forma unica su denuncia.<br>
           <b>Ejemplo:      denuncia descripcion de la denuncia</b>
          </p>
          <h2>Funcion: REDES SOCIALES</h2>
          <p>
           Renvia el mensaje registrado a todas las redes sociales que esten registradas en la herramienta, sin mencionar a quien la envio.<br>
           <b>Ejemplo:      rs denuncia publica de maltrato laboral en la fabrica XXX</b>
          </p>
          <h2>Funcion: CERRAR</h2>
          <p>
           Cierra una denuncia mediante su identificador. Para usar esta Funcion se envia la palabra cerrar junto con el numero que identifica de forma unica su denuncia.<br>
           <b>Ejemplo:      cerrar 8</b>
          </p>
          <h2>Funcion ESTATUS</h2>
          <p>
           Esta Funcion se activa enviando la palabra estatus, la herramienta env�a un mensaje con el nombre que se registro y cuando se registro y su rol en la herramienta.
           <b>Ejemplo:         estatus</b>
           </p>
          <h2>Funcion DATO</h2>
          <p>
           Recibes informacion sobre los diferentes tipos de violencias, estadistica, etc.
           <b>Ejemplo:         dato</b>
           </p>
          <h2>Funcion CONSEJO</h2>
          <p>
           Recibira informacion sobre como prevenir la violencia contra las mujeres.
           <b>Ejemplo:         consejo</b>
           </p>
          <h2>Funcion ABUSO</h2>
          <p>
           Recibira un mensaje con informacion, sobre protocolo de atencion en caso de violencia sexual, y los pasos a seguir ya sea que quieras poner una denuncia o no.
           <b>Ejemplo:         abuso</b>
           </p>
          <h2>Funcion AYUDA</h2>
          <p>
           recibir�s informacion sobre las diferentes instancias a las que puedes acudir, segun el lugar donde te encuentres o puedes enviar esta informacion a otro telefono agregando el numero al final.
           <b>Ejemplo:         ayuda</b>
           <b>Ejemplo:         ayuda 70839348</b>
           </p>
          <h2>Como contestar a una encuesta</h2>
          <p>
           Envia respuesta a una encuesta. Para usar esta Funcion se envia la letra o palabra que se solicito previamente por un mensaje de texto.<br>
           <b>Ejemplo:       a</b>
           <b>Ejemplo:       si</b>
          </p>
          <h2>Funcion: Encuestas</h2>
          <p>
           Brinda la descripcion de unas o mas encuestas ademas del numero que la identifica y sus resultados. Para usar esta funcion se envia la palabra encuestas; si se envia sin nada mas, respondera con la informacion sobre las ultimas 4 encuestas; si se envia la palabra hoy, los resultados de la encuesta activa; si se envia con el numero que identifica de forma unica a una encuesta muestra los resultados de esa encuesta.<br>
           <b>Ejemplos:<br>
            </b></p><ul class=\"list1\"><b>
             <li>encuestas 13</li>
             <li>encuestas hoy</li>
             <li>encuestas</li>
            </b></ul><b>
           </b>
          <p></p>
          <h2>Funcion: INVITAR</h2>
          <p>
           Realiza una invitacion a un numero determinado para registrarse. Para usar esta Funcion se envia la palabra invitar, seguida por el numero a invitar y si se desea un mensaje personalizado.<br>
           <b>Ejemplos:<br>
            </b></p><ul class=\"list1\"><b>
             <li>invitar 70937743</li>
             <li>invitar 70947743 reg�strate karla a la red de comunicacion digital, nos ayudara a todas a denunciar el maltrato</li>
            </b></ul><b>
           </b>
          <p></p>
          <h2>Funcion: SALIR</h2>
          <p>
           Deshabilita a una usuaria con el numero de donde se envia el mensaje, por lo cual no recibira mas mensajes de la herramienta. Para usar esta Funcion se envia la palabra salir.<br>
           <b>Ejemplo:       salir</b>
          </p>
 ";
        } else {
            // line 127
            echo "          <h2>Nombre Codigo: <span>Matilti Feminista</span></h2>
          <p>
           <b>Sistema de comunicacion digital comunitaria </b>es una herramienta desarrollada con vision feminista que facilita comunicacion entre las personas registradas y gestiona las denuncias por violencia contra las mujeres, es usado generalmente por defensoras de derechos humanos para el ejercicio de defensoria a traves de la tecnologia y en colaboracion con las instituciones del gobierno responsables de velar por la seguridad, el medio principal de comunicacion son los mensajes de texto.
          </p>
<p><iframe src=\"http://player.vimeo.com/video/67407541\" width=\"300\" height=\"220\" frameborder=\"0\" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></p>
          <h2>Utilidades</h2>
          <p>
           <ul class=\"list1\">
            <li>Convocatorias</li>
            <li>Denuncias</li>
            <li>Campanyas de informacion</li>
            <li>Movil activismo (masivo, estimulo/respuesta y repuestas inteligentes)</li>
            <li>Envio de informacion a grupos focalizados</li>
            <li>Sistema de notificacion de alertas tempranas</li>
            <li>Todo lo imajinable que se pueda enviar por mensajes de texto.</li>
           </ul>
          </p>
         <h2>Historia de nuestra herramienta</h2>
\t\t\t\t\t\t\t<p>En el Salvador gran parte de la ciudadani�a posee acceso a telefonia movil, datos consultados en la Superintendencia General de Electricidad y Telecomunicaciones SIGET revelan que el uso de telefonia celular supera en gran proporcion a la telefonia fija. Los registros informan que a mediados del anyo 2012 habi�an 8,485,684 lineas m�viles en operacion y que la densidad movil para el anyo 2011 era de 134.50, es decir que por cada 100 habitantes se tendran 134 lineas moviles.
Flujo de informacion de matilti - Sistema de comunicacion digital comunitaria<br />
Considerando que el acceso a la telefonia movil se ha convertido en una realidad y que su uso se ha masificado, la Colectiva de Mujeres para el Desarrollo Local, ha optado por impulsar una alternativa tecnologica que se apoye en la infraestructura de las telecomunicaciones, la cual basa su funcionamiento en un sistema simple que garantice su acceso.<br />
Bajo la premisa de crear una herramienta libre, simple y accesible se concibio Matilti, el cual es un canal de comunicacion que posee varias formas de operar, pero que su funcionamiento se basa en la recepcion y envio de mensajes de texto para diferentes propositos.
</p>
\t\t\t\t\t\t\t<p class=\"button-style\"><a href=\"http://es.wikipedia.org/wiki/Matilti_%28software%29\">Leer mas.</a></p>
 ";
        }
    }

    public function getTemplateName()
    {
        return "usuarioBundle:Default:publico.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  195 => 127,  105 => 39,  80 => 16,  77 => 15,  74 => 14,  69 => 12,  63 => 9,  60 => 8,  54 => 7,  48 => 6,  42 => 5,  35 => 3,  32 => 2,);
    }
}
