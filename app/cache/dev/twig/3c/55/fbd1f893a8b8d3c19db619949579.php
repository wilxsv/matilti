<?php

/* ::defensora.html.twig */
class __TwigTemplate_3c55fbd1f893a8b8d3c19db619949579 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'css' => array($this, 'block_css'),
            'crud' => array($this, 'block_crud'),
            'js' => array($this, 'block_js'),
            'body' => array($this, 'block_body'),
            'marco' => array($this, 'block_marco'),
            'crudMsg' => array($this, 'block_crudMsg'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html lang=\"en\"> 
\t<head>
\t\t<meta charset=\"utf-8\">
\t\t<title>";
        // line 5
        $this->displayBlock('title', $context, $blocks);
        echo "</title>
\t\t<link rel=\"shortcut icon\" href=\"";
        // line 6
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("favicon.ico"), "html", null, true);
        echo "\" />
\t\t<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no\">
\t\t<meta name=\"apple-mobile-web-app-capable\" content=\"yes\">
\t\t<link href=\"";
        // line 9
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("css/defensora/css/bootstrap.min.css"), "html", null, true);
        echo "\" rel=\"stylesheet\">
\t\t<link href=\"";
        // line 10
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("css/defensora/css/bootstrap-responsive.min.css"), "html", null, true);
        echo "\" rel=\"stylesheet\">
\t\t<link href=\"http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600\" rel=\"stylesheet\">
\t\t<link href=\"";
        // line 12
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("css/defensora/css/font-awesome.css"), "html", null, true);
        echo "\" rel=\"stylesheet\">
\t\t<link href=\"";
        // line 13
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("css/defensora/css/style.css"), "html", null, true);
        echo "\" rel=\"stylesheet\">
\t\t<link href=\"";
        // line 14
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("css/defensora/css/pages/dashboard.css"), "html", null, true);
        echo "\" rel=\"stylesheet\">
\t\t<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
\t\t<!--[if lt IE 9]>
\t\t<script src=\"http://html5shim.googlecode.com/svn/trunk/html5.js\"></script>
\t\t<![endif]-->
\t\t
\t\t<link type=\"text/css\" rel=\"stylesheet\" href=\"";
        // line 20
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("css/jquery-ui-1.8.20.custom.css"), "html", null, true);
        echo "\">
\t\t";
        // line 21
        $this->displayBlock('css', $context, $blocks);
        // line 22
        echo "\t\t<script src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("js/matilti/jquery-1.5.2.min.js"), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
\t\t<script src=\"";
        // line 23
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("js/matilti/hideshow.js"), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
\t\t<script src=\"";
        // line 24
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("js/matilti/jquery.tablesorter.min.js"), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
\t\t<script type=\"text/javascript\" src=\"";
        // line 25
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("js/matilti/jquery.equalHeight.js"), "html", null, true);
        echo "\"></script>
\t\t<script type=\"text/javascript\">
\t\t\t\$(document).ready(function(){ \$(\".tablesorter\").tablesorter(); } );
\t\t\t\$(document).ready(function() { //When page loads...
\t\t\t\t\$(\".tab_content\").hide(); //Hide all content
\t\t\t\t\$(\"ul.tabs li:first\").addClass(\"active\").show(); //Activate first tab
\t\t\t\t\$(\".tab_content:first\").show(); //Show first tab content
\t\t\t\t//On Click Event
\t\t\t\t\$(\"ul.tabs li\").click(function() {
\t\t\t\t\t\$(\"ul.tabs li\").removeClass(\"active\"); //Remove any \"active\" class
\t\t\t\t\t\$(this).addClass(\"active\"); //Add \"active\" class to selected tab
\t\t\t\t\t\$(\".tab_content\").hide(); //Hide all tab content
\t\t\t\t\tvar activeTab = \$(this).find(\"a\").attr(\"href\"); //Find the href attribute value to identify the active tab + content
\t\t\t\t\t\$(activeTab).fadeIn(); //Fade in the active ID content
\t\t\t\t\treturn false;
\t\t\t\t});
\t\t\t});
\t\t</script>
\t\t<script type=\"text/javascript\">\$(function(){ \$('.column').equalHeight(); });</script>
\t\t<script src=\"";
        // line 44
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("js/jquery-ui.min.js"), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
\t\t";
        // line 45
        $this->env->loadTemplate("::crud.files.js.twig")->display($context);
        // line 46
        echo "\t\t";
        $this->displayBlock('crud', $context, $blocks);
        // line 47
        echo "\t\t";
        $this->displayBlock('js', $context, $blocks);
        // line 48
        echo "\t</head>
\t<body>";
        // line 49
        $this->displayBlock('body', $context, $blocks);
        // line 220
        echo "  ";
        $this->displayBlock('crudMsg', $context, $blocks);
        // line 230
        echo "\t
</body>
</html>
";
    }

    // line 5
    public function block_title($context, array $blocks = array())
    {
        echo "Defensoras - Administracion de Matilti Feminista :: ";
    }

    // line 21
    public function block_css($context, array $blocks = array())
    {
    }

    // line 46
    public function block_crud($context, array $blocks = array())
    {
    }

    // line 47
    public function block_js($context, array $blocks = array())
    {
    }

    // line 49
    public function block_body($context, array $blocks = array())
    {
        // line 50
        echo "\t\t<div class=\"navbar navbar-fixed-top\">
\t\t\t<div class=\"navbar-inner\">
\t\t\t\t<div class=\"container\">
\t\t\t\t\t<a class=\"btn btn-navbar\" data-toggle=\"collapse\" data-target=\".nav-collapse\"><span class=\"icon-bar\"></span><span class=\"icon-bar\"></span><span class=\"icon-bar\"></span> </a>
\t\t\t\t\t<a class=\"brand\" href=\"\">Defensoras - Administracion de Matilti Feminista </a>
\t\t\t\t\t<div class=\"nav-collapse\">
\t\t\t\t\t\t<ul class=\"nav pull-right\">
\t\t\t\t\t\t\t<li class=\"dropdown\"><a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\"><i class=\"icon-cog\"></i> Enlaces de ayuda <b class=\"caret\"></b></a>
\t\t\t\t\t\t\t\t<ul class=\"dropdown-menu\">
\t\t\t\t\t\t\t\t\t<li><a href=\"";
        // line 59
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("_welcome"), "html", null, true);
        echo "\">Sitio en vivo</a></li>
\t\t\t\t\t\t\t\t\t<li><a href=\"http://es.wikipedia.org/wiki/Matilti_(software)\">Ayuda</a></li>
\t\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\t\t<li><a href=\"#\">-----------</a></li>
\t\t\t\t\t\t\t\t\t<li><a href=\"";
        // line 63
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("admin_regla"), "html", null, true);
        echo "\">Reglas de mensajes</a></li>
\t\t\t\t\t\t\t\t\t<li><a href=\"";
        // line 64
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("admin_rol"), "html", null, true);
        echo "\">Catalogo de roles</a></li>
\t\t\t\t\t\t\t\t\t<li><a href=\"";
        // line 65
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("admin_estado"), "html", null, true);
        echo "\">Catalogo de estados</a></li>
\t\t\t\t\t\t\t\t\t<li><a href=\"";
        // line 66
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("mensajeria"), "html", null, true);
        echo "\">Mensajes</a></li>
\t\t\t\t\t\t\t\t\t<li><a href=\"";
        // line 67
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("admin_usuario"), "html", null, true);
        echo "\">Nuevo Usuario</a></li>
\t\t\t\t\t\t\t\t\t<li><a href=\"";
        // line 68
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("admin_usuario"), "html", null, true);
        echo "\">Listar usuarios</a></li>
\t\t\t\t\t\t\t\t\t<li><a href=\"";
        // line 69
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("admin_entidad"), "html", null, true);
        echo "\">Entidades</a></li>
\t\t\t\t\t\t\t\t</ul>
\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t\t<li class=\"dropdown\"><a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\"><i class=\"icon-user\"></i> Sesion de usuaria <b class=\"caret\"></b></a>
\t\t\t\t\t\t\t\t<ul class=\"dropdown-menu\">
\t\t\t\t\t\t\t\t\t<li><a href=\"";
        // line 74
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("modeloBundle_homepage"), "html", null, true);
        echo "\">Sitio de administracion</a></li>
\t\t\t\t\t\t\t\t\t<li><a href=\"";
        // line 75
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("_security_logout"), "html", null, true);
        echo "\">Cerrar session</a></li>
\t\t\t\t\t\t\t\t</ul>
\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t</ul>
\t\t\t\t\t\t<form class=\"navbar-search pull-right\"><input type=\"text\" class=\"search-query\" placeholder=\"Search\"></form>
\t\t\t\t\t</div>
\t\t\t\t\t<!--/.nav-collapse -->
\t\t\t\t</div>
\t\t\t<!-- /container --> 
\t\t</div>
\t\t<!-- /navbar-inner --> 
\t</div>
\t<!-- /navbar -->
\t<div class=\"subnavbar\">
\t\t<div class=\"subnavbar-inner\">
\t\t\t<div class=\"container\">
\t\t\t\t<ul class=\"mainnav\">
\t\t\t\t\t<li class=\"active\"><a href=\"\"><i class=\"icon-dashboard\"></i><span>Analisis</span> </a> </li>
\t\t\t\t\t<li><a href=\"\"><i class=\"icon-list-alt\"></i><span>Denuncias</span> </a> </li>
\t\t\t\t\t<li><a href=\"\"><i class=\"icon-facetime-video\"></i><span>Usuarias</span> </a></li>
\t\t\t\t\t<li><a href=\"\"><i class=\"icon-bar-chart\"></i><span>Instituciones</span> </a> </li>
\t\t\t\t\t<li><a href=\"\"><i class=\"icon-code\"></i><span>Mapas</span> </a> </li>
\t\t\t\t\t<li class=\"dropdown\"><a href=\"javascript:;\" class=\"dropdown-toggle\" data-toggle=\"dropdown\"> <i class=\"icon-long-arrow-down\"></i><span>Reglas</span> <b class=\"caret\"></b></a>
\t\t\t\t\t<ul class=\"dropdown-menu\">
\t\t\t\t\t\t<li><a href=\"\">Icons</a></li>
\t\t\t\t\t\t<li><a href=\"\">FAQ</a></li>
\t\t\t\t\t\t<li><a href=\"\">Pricing Plans</a></li>
\t\t\t\t\t\t<li><a href=\"\">Login</a></li>
\t\t\t\t\t\t<li><a href=\"\">Signup</a></li>
\t\t\t\t\t\t<li><a href=\"\">404</a></li>
\t\t\t\t\t</ul>
\t\t\t\t\t</li>
\t\t\t\t</ul>
\t\t\t</div>
\t\t\t<!-- /container --> 
\t\t</div>
\t\t<!-- /subnavbar-inner --> 
\t</div>
\t<!-- /subnavbar -->
\t<div class=\"main\">
\t\t<div class=\"main-inner\">
\t\t\t<div class=\"container\">
\t\t\t\t<div class=\"row\">
\t\t\t\t\t";
        // line 118
        $this->displayBlock('marco', $context, $blocks);
        // line 137
        echo "      </div>
      <!-- /row --> 
    </div>
    <!-- /container --> 
  </div>
  <!-- /main-inner --> 
</div>
<!-- /main -->
<div class=\"extra\">
  <div class=\"extra-inner\">
    <div class=\"container\">
      <div class=\"row\">
                    <div class=\"span4\">
                        <h4>Matilti esta programada integramente con software libre.</h4>
                        <ul>
                            <li><a href=\"\">GNU/Linux Debian</a></li>
                            <li><a href=\"\">PostgreSQL 9.1</a></li>
                            <li><a href=\"\">Gammu Deamon 1.128</a></li>
                            <li><a href=\"\">PHP 5.3</a></li>
                        </ul>
                    </div>
                    <!-- /span3 -->
                    <div class=\"span4\">
                        <h4></h4>
                        <ul>
                            <li><a href=\"\">Morris js</a></li>
                            <li><a href=\"\">JQuery 1.7</a></li>
                            <li><a href=\"\">Excanvas</a></li>
                            <li><a href=\"\">google maps utility library v3</a></li>
                        </ul>
                    </div>
                    <!-- /span3 -->
                </div>
      <!-- /row --> 
    </div>
    <!-- /container --> 
  </div>
  <!-- /extra-inner --> 
</div>
<!-- /extra -->
<div class=\"footer\">
  <div class=\"footer-inner\">
    <div class=\"container\">
      <div class=\"row\">
        <div class=\"span12\"> Template modificado y basado en  <a href=\"http://www.egrappler.com/\">Bootstrap Responsive Admin Template</a>. </div>
        <!-- /span12 --> 
      </div>
      <!-- /row --> 
    </div>
    <!-- /container --> 
  </div>
  <!-- /footer-inner --> 
</div>
<!-- /footer --> 
<!-- Le javascript
================================================== --> 
<!-- Placed at the end of the document so the pages load faster --> 
<script src=\"";
        // line 194
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("css/defensora/js/jquery-1.7.2.min.js"), "html", null, true);
        echo "\"></script> 
<script src=\"";
        // line 195
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("css/defensora/js/excanvas.min.js"), "html", null, true);
        echo "\"></script> 
<script src=\"";
        // line 196
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("css/defensora/js/chart.min.js"), "html", null, true);
        echo "\" type=\"text/javascript\"></script> 
<script src=\"";
        // line 197
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("css/defensora/js/bootstrap.js"), "html", null, true);
        echo "\"></script>
<script language=\"javascript\" type=\"text/javascript\" src=\"";
        // line 198
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("css/defensora/js/full-calendar/fullcalendar.min.js"), "html", null, true);
        echo "\"></script>
 
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
";
    }

    // line 118
    public function block_marco($context, array $blocks = array())
    {
        // line 119
        echo "\t<div class=\"span6\">
\t\t<div class=\"widget\">
\t\t\t<div class=\"widget-content\">
\t\t\t\t<h1>6 Columns</h1>
\t\t\t\t<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.</p>
\t\t\t</div> <!-- /widget-content -->
\t\t</div> <!-- /widget -->
\t</div>
\t<div class=\"span6\">
\t\t<div class=\"widget\">
\t\t\t<div class=\"widget-content\">
\t\t\t\t<h1>6 Columns</h1>
\t\t\t\t<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.</p>
\t\t\t</div> <!-- /widget-content -->
\t\t</div> <!-- /widget -->
\t</div>

\t\t\t\t\t";
    }

    // line 220
    public function block_crudMsg($context, array $blocks = array())
    {
        // line 221
        echo "   <div id=\"error\" title=\"Estado de registro\">
    <img src=\"";
        // line 222
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("images/etc/process-stop.png"), "html", null, true);
        echo "\" /><b>Error al procesar el registro</b><br />
    Por favor, verifique los datos e intente nuevamente.
   </div>
   <div id=\"load\" title=\"Estado :: \"><img src=\"";
        // line 225
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("images/etc/load.png"), "html", null, true);
        echo "\" /></div>
   <div id=\"ok\" title=\"Estado de registro\"><img src=\"";
        // line 226
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("images/etc/accessories-text-editor.png"), "html", null, true);
        echo "\" height=\"32\" width=\"32\" />Registro procesado con exito.</div>
   <div id=\"delete\" title=\"Eliminar registro ::\">
    <p><img src=\"";
        // line 228
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("images/etc/edit-clear.png"), "html", null, true);
        echo "\" height=\"32\" width=\"32\" />Este registro se eliminará permanentemente. <br /><b>¿Está seguro de hacerlo?</b></p>
   </div>
  ";
    }

    public function getTemplateName()
    {
        return "::defensora.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  406 => 228,  401 => 226,  397 => 225,  391 => 222,  388 => 221,  385 => 220,  364 => 119,  361 => 118,  335 => 198,  331 => 197,  327 => 196,  323 => 195,  319 => 194,  260 => 137,  258 => 118,  212 => 75,  208 => 74,  200 => 69,  196 => 68,  192 => 67,  188 => 66,  184 => 65,  180 => 64,  176 => 63,  158 => 50,  155 => 49,  150 => 47,  145 => 46,  140 => 21,  134 => 5,  127 => 230,  124 => 220,  122 => 49,  119 => 48,  116 => 47,  113 => 46,  111 => 45,  107 => 44,  85 => 25,  81 => 24,  77 => 23,  72 => 22,  70 => 21,  66 => 20,  57 => 14,  53 => 13,  49 => 12,  44 => 10,  40 => 9,  34 => 6,  30 => 5,  24 => 1,  376 => 234,  363 => 231,  359 => 230,  337 => 210,  334 => 209,  274 => 162,  255 => 155,  236 => 148,  214 => 140,  190 => 130,  177 => 124,  172 => 121,  169 => 59,  157 => 111,  154 => 110,  58 => 18,  54 => 17,  50 => 16,  46 => 15,  32 => 3,  29 => 2,);
    }
}
