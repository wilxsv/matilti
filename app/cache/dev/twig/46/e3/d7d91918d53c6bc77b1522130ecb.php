<?php

/* ::matilti-feminista.html.twig */
class __TwigTemplate_46e3d7d91918d53c6bc77b1522130ecb extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'js' => array($this, 'block_js'),
            'css' => array($this, 'block_css'),
            'columna' => array($this, 'block_columna'),
            'contenido' => array($this, 'block_contenido'),
            'columnas' => array($this, 'block_columnas'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE HTML>
<!--
\tAffinity: A responsive HTML5 website template by HTML5Templates.com
\tReleased for free under the Creative Commons Attribution 3.0 license (html5templates.com/license)
\tVisit http://html5templates.com for more great templates or follow us on Twitter @HTML5T
-->
<html>
<head>
<title>";
        // line 9
        $this->displayBlock('title', $context, $blocks);
        echo "</title>
<meta http-equiv=\"content-type\" content=\"text/html; charset=utf-8\" />
<meta name=\"description\" content=\"Sistema de comunicación digital comunitaria es una herramienta desarrollada con visión feminista que facilita comunicación entre las personas registradas y gestiona las denuncias por violencia contra las mujeres, es usado generalmente por defensoras de derechos humanos\" />
<meta name=\"keywords\" content=\"\" />
  <link rel=\"shortcut icon\" href=\"";
        // line 13
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/matiltimensajeria/images/favicon.ico"), "html", null, true);
        echo "\" />
  <link rel=\"stylesheet\" href=\"";
        // line 14
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("css/matilti-feminista/5grid/core.css"), "html", null, true);
        echo "\" type=\"text/css\">
  <link rel=\"stylesheet\" href=\"";
        // line 15
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("css/matilti-feminista/5grid/core-desktop.css"), "html", null, true);
        echo "\" type=\"text/css\">
  <link rel=\"stylesheet\" href=\"";
        // line 16
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("css/matilti-feminista/5grid/core-1200px.css"), "html", null, true);
        echo "\" type=\"text/css\">
  <link rel=\"stylesheet\" href=\"";
        // line 17
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("css/matilti-feminista/5grid/core-noscript.css"), "html", null, true);
        echo "\" type=\"text/css\">
  <link rel=\"stylesheet\" href=\"";
        // line 18
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("css/matilti-feminista/style.css"), "html", null, true);
        echo "\" type=\"text/css\">
  <link rel=\"stylesheet\" href=\"";
        // line 19
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("css/matilti-feminista/style-desktop.css"), "html", null, true);
        echo "\" type=\"text/css\">
  <script src=\"";
        // line 20
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("css/matilti-feminista/5grid/jquery.js"), "html", null, true);
        echo "\" ></script>
  <script src=\"stylesheet\" href=\"";
        // line 21
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("css/matilti-feminista/5grid/init.js?use=mobile,desktop,800px&amp;mobileUI=1&amp;mobileUI.theme=none&amp;mobileUI.openerWidth=52"), "html", null, true);
        echo "\"></script>
  <!--[if IE 9]><link rel=\"stylesheet\" href=\"";
        // line 22
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("css/matilti-feminista/css/style-ie9.css"), "html", null, true);
        echo "\" /><![endif]-->
";
        // line 23
        $this->displayBlock('js', $context, $blocks);
        // line 24
        $this->displayBlock('css', $context, $blocks);
        // line 25
        echo "</head><body>
<div id=\"wrapper\">
\t<div id=\"header-wrapper\">
\t\t<header id=\"header\">
\t\t\t<div class=\"5grid-layout\">
\t\t\t\t<div class=\"row\">
\t\t\t\t\t<div class=\"12u\" id=\"logo\"> <!-- Logo -->
\t\t\t\t\t\t<h1><a href=\"#\" class=\"mobileUI-site-name\"><img src=\"";
        // line 32
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("images/logo.png"), "html", null, true);
        echo "\" alt=\"Sistema de comunicación digital comunitaria\"></a></h1>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t\t<div class=\"5grid-layout\">
\t\t\t\t<div class=\"row\">
\t\t\t\t\t<div class=\"12u\" id=\"menu\">
\t\t\t\t\t\t<div id=\"menu-wrapper\">
\t\t\t\t\t\t\t<nav class=\"mobileUI-site-nav\">
\t\t\t\t\t\t\t\t<ul>
\t\t\t\t\t\t\t\t\t<li><a href=\"";
        // line 42
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("_welcome"), "html", null, true);
        echo "\">Inicio</a></li>
\t\t\t\t\t\t\t\t\t<li><a href=\"";
        // line 43
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("_welcome", array("page" => "functions")), "html", null, true);
        echo "\">Funciones</a></li>
\t\t\t\t\t\t\t\t\t<li><a href=\"";
        // line 44
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("_welcome", array("page" => "project")), "html", null, true);
        echo "\">Proyecto</a></li>
\t\t\t\t\t\t\t\t\t<li class=\"current_page_item\"><a href=\"";
        // line 45
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("reporteria_reportes"), "html", null, true);
        echo "\">Reportes</a></li>
\t\t\t\t\t\t\t\t\t<li><a href=\"";
        // line 46
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("usuarioBundle_homepage"), "html", null, true);
        echo "\">Autenticame</a></li>
\t\t\t\t\t\t\t\t</ul>
\t\t\t\t\t\t\t</nav>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t</header>
\t</div>
\t<div id=\"page-wrapper\" class=\"5grid-layout\">
\t\t<div class=\"row\">
\t\t\t<div class=\"";
        // line 57
        $this->displayBlock('columna', $context, $blocks);
        echo "u\">
\t\t\t\t<div id=\"content\">
\t\t\t\t\t";
        // line 59
        $this->displayBlock('contenido', $context, $blocks);
        // line 94
        echo "\t\t\t\t</div>
\t\t\t</div>
                        ";
        // line 96
        $this->displayBlock('columnas', $context, $blocks);
        // line 122
        echo "\t\t</div>
\t</div>
\t<div class=\"5grid-layout\">
\t\t<div class=\"row\" id=\"footer-content\">
\t\t\t<div class=\"6u\" id=\"box1\">
\t\t\t\t<section>
\t\t\t\t\t<h2>Nuestras cooperantes</h2>
\t\t\t\t\t<div>
\t\t\t\t\t\t<p>Matilti Feminista ha sido apoyada por Horizont 3000, la Cooperación Austríaca para el Desarrollo y el Movimiento de Mujeres católicas de Austria en el marco de la ejecución del Proyecto \"Fortalecimiento de la Alianza de Mujeres Centroamericanas\"</p>
\t\t\t\t\t\t<p><img src=\"";
        // line 131
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("images/red_CACV.jpg"), "html", null, true);
        echo "\" alt=\"Alianza de Mujeres Centroamericanas\"></p>
\t\t\t\t\t</div>
\t\t\t\t</section>
\t\t\t</div>
\t\t\t<div class=\"3u\" id=\"box2\">
\t\t\t\t<section>
\t\t\t\t\t<h2></h2>
\t\t\t\t\t<ul class=\"style4\">
\t\t\t\t\t\t<li class=\"first\"><img src=\"";
        // line 139
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("images/logo_ada.jpg"), "html", null, true);
        echo "\" alt=\"Cooperación Austríaca para el Desarrollo\"></li>
\t\t\t\t\t\t<li class=\"first\"><img src=\"";
        // line 140
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("images/CATOLICAS_MUJERES.png"), "html", null, true);
        echo "\" alt=\"\"></li>
\t\t\t\t\t\t<li class=\"first\"><img src=\"";
        // line 141
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("images/LOGO_HORIZONT.jpg"), "html", null, true);
        echo "\" alt=\"Horizont 3000\"></li>
\t\t\t\t\t</ul>
\t\t\t\t</section>
\t\t\t</div>
\t\t</div>
\t</div>
</div>
<div id=\"copyright\" class=\"5grid-layout\">
\t<section>
\t\t<p>&copy; Matilti Feminista | Desarollado por: <a href=\"http://colectivafeminista.org.sv/\">colectiva feminista</a> | diseño basado en: <a href=\"http://html5templates.com/\">HTML5Templates.com</a></p>
\t</section>
</div>
</body>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-42030209-1', 'colectivafeminista.org.sv');
  ga('send', 'pageview');

</script>
<!-- AddThis Smart Layers BEGIN -->
<!-- Go to http://www.addthis.com/get/smart-layers to customize -->
<script type=\"text/javascript\" src=\"//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-526d655b07eca5be\"></script>
<script type=\"text/javascript\">
  addthis.layers({
    'theme' : 'light',
    'share' : {
      'position' : 'right',
      'numPreferredServices' : 5
    }, 
    'follow' : {
      'services' : [
        {'service': 'facebook', 'id': 'matilti.colectivafeminista'},
        {'service': 'twitter', 'id': 'laradiodetodas'}
      ]
    },   
    'recommended' : {} 
  });
</script>
<!-- AddThis Smart Layers END -->
</html>
";
    }

    // line 9
    public function block_title($context, array $blocks = array())
    {
        echo ".:: Matilti Feminista ::.";
    }

    // line 23
    public function block_js($context, array $blocks = array())
    {
    }

    // line 24
    public function block_css($context, array $blocks = array())
    {
    }

    // line 57
    public function block_columna($context, array $blocks = array())
    {
        echo "9";
    }

    // line 59
    public function block_contenido($context, array $blocks = array())
    {
        // line 60
        echo "\t\t\t\t\t<section>
\t\t\t\t\t\t<div class=\"post\">
\t\t\t\t\t\t\t<h2>Matilti Feminista</h2>
\t\t\t\t\t\t\t<p><a href=\"#\"><iframe src=\"http://player.vimeo.com/video/67407541?loop=1\" width=\"400\" height=\"293\" frameborder=\"0\" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></a></p>
\t\t\t\t\t\t</div>
\t\t\t\t\t</section>
\t\t\t\t\t<section>
\t\t\t\t\t\t<div class=\"post\">
\t\t\t\t\t\t\t<h2>Historia de nuestra herramienta</h2>
\t\t\t\t\t\t\t<p>En el Salvador gran parte de la ciudadanía posee acceso a telefonía móvil, datos consultados en la Superintendencia General de Electricidad y Telecomunicaciones SIGET[1] revelan que el uso de telefonía celular supera en gran proporción a la telefonía fija. Los registros informan que a mediados del año 2012 habían 8,485,684 lineas móviles en operación y que la densidad móvil para el año 2011 era de 134.50, es decir que por cada 100 habitantes se tenían 134 lineas móviles.
Flujo de información de matilti - Sistema de comunicación digital comunitaria

Considerando que el acceso a la telefonía móvil se ha convertido en una realidad y que su uso se ha masificado, la Colectiva de Mujeres para el Desarrollo Local, ha optado por impulsar una alternativa tecnológica que se apoye en la infraestructura de las telecomunicaciones, la cual basa su funcionamiento en un sistema simple que garantice su acceso.

Bajo la premisa de crear una herramienta libre, simple y accesible se concibió Matilti, el cual es un canal de comunicación que posee varias formas de operar, pero que su funcionamiento se basa en la recepción y envió de mensajes de texto para diferentes propósitos. Entre las distintas utilidades tenemos:

    Convocatorias.
    Denuncias.
    Campañas de información.
    Móvil activismo (masivo, estimulo/respuesta y repuestas inteligentes).
    Envío de información a grupos focalizados.
    Envío de encuestas.
    Notificación de alertas

Componentes de software de matilti - Sistema de comunicación digital comunitaria

Con esta herramienta se busca aumentar la participación ciudadana mediante el libre envío de mensajes de texto por teléfonos celulares, esta ventaja permite que todas las personas la usen sin requerir tecnología de uso especifico o con altos requerimientos de recursos, únicamente con un teléfono celular que pueda enviar y recibir mensajes de texto se puede usar y administrar la herramienta.

Gracias a las ventajas del software libre se logro desarrollar esta solución basada en las necesidades de las mujeres organizadas y el código fuente de una herramienta similar se logro construir un medio de comunicación alternativo que comunique a nuestras defensoras de derechos humanos
\t\t\t\t\t\t\t</p>
\t\t\t\t\t\t\t<p class=\"button-style\"><a href=\"http://es.wikipedia.org/wiki/Matilti_%28software%29\">Leer más.</a></p>
\t\t\t\t\t\t</div>
\t\t\t\t\t</section>
\t\t\t\t\t";
    }

    // line 96
    public function block_columnas($context, array $blocks = array())
    {
        // line 97
        echo "\t\t\t<div class=\"3u\">
\t\t\t\t<div id=\"sidebar2\">
\t\t\t\t\t<section>
\t\t\t\t\t\t<div class=\"sbox1\">
\t\t\t\t\t\t\t<h2>Trafico general</h2>
\t\t\t\t\t\t\t<ul class=\"style1\">
\t\t\t\t\t\t\t\t<li><a href=\"#\">Usuaria 453 envio una denuncia</a></li>
\t\t\t\t\t\t\t\t<li><a href=\"#\">Usuaria 34 envio una denuncia</a></li>
\t\t\t\t\t\t\t\t<li><a href=\"#\">Usuario 139 envio una denuncia</a></li>
\t\t\t\t\t\t\t\t<li><a href=\"#\">Usuaria 7 envio una denuncia</a></li>
\t\t\t\t\t\t\t\t<li><a href=\"#\">Usuaria 7 envio una denuncia</a></li>
\t\t\t\t\t\t\t\t<li><a href=\"#\">Usuaria 236 envio una denuncia</a></li>
\t\t\t\t\t\t\t\t<li><a href=\"#\">Usuario 79 envio una denuncia</a></li>
\t\t\t\t\t\t\t\t<li><a href=\"#\">Usuaria 110 envio una denuncia</a></li>
\t\t\t\t\t\t\t</ul>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"sbox2\">
\t\t\t\t\t\t\t<h2>Redes</h2>
\t\t\t\t\t\t\t<a class=\"twitter-timeline\"  href=\"https://twitter.com/laradiodetodas\"  data-widget-id=\"398574018141237248\">Tweets por @laradiodetodas</a>
    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+\"://platform.twitter.com/widgets.js\";fjs.parentNode.insertBefore(js,fjs);}}(document,\"script\",\"twitter-wjs\");</script>
\t\t\t\t\t\t</div>
\t\t\t\t\t</section>
\t\t\t\t</div>
\t\t\t</div>
                        ";
    }

    public function getTemplateName()
    {
        return "::matilti-feminista.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  293 => 97,  290 => 96,  253 => 60,  250 => 59,  244 => 57,  239 => 24,  234 => 23,  228 => 9,  179 => 141,  175 => 140,  171 => 139,  160 => 131,  149 => 122,  147 => 96,  143 => 94,  141 => 59,  136 => 57,  122 => 46,  118 => 45,  114 => 44,  110 => 43,  106 => 42,  93 => 32,  84 => 25,  82 => 24,  76 => 22,  72 => 21,  68 => 20,  64 => 19,  56 => 17,  52 => 16,  44 => 14,  40 => 13,  33 => 9,  23 => 1,  195 => 127,  105 => 39,  80 => 23,  77 => 15,  74 => 14,  69 => 12,  63 => 9,  60 => 18,  54 => 7,  48 => 15,  42 => 5,  35 => 3,  32 => 2,);
    }
}
