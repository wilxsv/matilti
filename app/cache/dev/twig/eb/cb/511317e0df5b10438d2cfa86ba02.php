<?php

/* reporteriaBundle::defensora.html.twig */
class __TwigTemplate_ebcb511317e0df5b10438d2cfa86ba02 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("::defensora.html.twig");

        $this->blocks = array(
            'marco' => array($this, 'block_marco'),
            'js' => array($this, 'block_js'),
            'crudMsg' => array($this, 'block_crudMsg'),
            'css' => array($this, 'block_css'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "::defensora.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    public function block_marco($context, array $blocks = array())
    {
        // line 3
        echo "\t<div class=\"span12\"><div id=\"target-1\" class=\"widget\"><div class=\"widget-content\"><h1>Matilti feminista. &#169; &#174; Aqui va copy left</h1></div></div></div>
\t<div class=\"span6\">
\t\t<div class=\"widget widget-nopad\">
\t\t\t<div class=\"widget-header\"><i class=\"icon-list-alt\"></i><h3> Resumen de mensajes registrados [Matilti Feminista]</h3></div>
\t\t\t<!-- /widget-header -->
\t\t\t<div class=\"widget-content\">
\t\t\t\t<div class=\"widget big-stats-container\">
\t\t\t\t\t<div class=\"widget-content\">
\t\t\t\t\t\t<br />
\t\t\t\t\t\t<p>Detalle de todo el trafico que registro la herramienta, en el orden de presentación estan los recibidos, enviados, recibidos fallidos (sintaxis incorrecta) y los filtrados.</p>
\t\t\t\t\t\t<br />
\t\t\t\t\t\t<div id=\"big_stats\" class=\"cf\">
\t\t\t\t\t\t\t<div class=\"stat\"> <i class=\"icon-anchor\"></i> <span class=\"value\">";
        // line 15
        echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "valores"), "Recibidos", array(), "array"), "html", null, true);
        echo "</span> </div>
\t\t\t\t\t\t\t<div class=\"stat\"> <i class=\"icon-thumbs-up-alt\"></i> <span class=\"value\">";
        // line 16
        echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "valores"), "Enviados", array(), "array"), "html", null, true);
        echo "</span> </div>
\t\t\t\t\t\t\t<div class=\"stat\"> <i class=\"icon-twitter-sign\"></i> <span class=\"value\">";
        // line 17
        echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "valores"), "Fallidos", array(), "array"), "html", null, true);
        echo "</span> </div>
\t\t\t\t\t\t\t<div class=\"stat\"> <i class=\"icon-bullhorn\"></i> <span class=\"value\">";
        // line 18
        echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "valores"), "Otros", array(), "array"), "html", null, true);
        echo "</span> </div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t\t<!-- /widget-content --> 
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t\t<!-- /widget -->
\t</div>
\t\t\t\t\t<!-- /span6 -->
\t\t\t\t\t<div class=\"span6\">
\t\t\t\t\t\t<div class=\"widget\"><div class=\"widget-header\"> <i class=\"icon-bookmark\"></i><h3>Enlaces importantes</h3></div>
\t\t\t\t\t\t\t<!-- /widget-header -->
\t\t\t\t\t\t\t<div class=\"widget-content\">
\t\t\t\t\t\t\t\t<div class=\"shortcuts\">
\t\t\t\t\t\t\t\t\t<a href=\"http://colectivafeminista.org.sv/\" class=\"shortcut\"><i class=\"shortcut-icon icon-list-alt\"></i><span class=\"shortcut-label\">Colectiva feminista</span> </a>
\t\t\t\t\t\t\t\t\t<a href=\"http://observatorio.colectivafeminista.org.sv/\" class=\"shortcut\"><i class=\"shortcut-icon icon-bookmark\"></i><span class=\"shortcut-label\">Observatorio de genero</span> </a>
\t\t\t\t\t\t\t\t\t<a href=\"http://colectivafeminista.org.sv/radio-de-todas.html\" class=\"shortcut\"><i class=\"shortcut-icon icon-signal\"></i> <span class=\"shortcut-label\">La radio de todas</span></a>
\t\t\t\t\t\t\t\t\t<a href=\"http://plataforma.colectivafeminista.org.sv/\" class=\"shortcut\"><i class=\"shortcut-icon icon-comment\"></i><span class=\"shortcut-label\">Plataforma feminista</span> </a>
\t\t\t\t\t\t\t\t\t<a href=\"http://www.isdemu.gob.sv/\" class=\"shortcut\"><i class=\"shortcut-icon icon-user\"></i><span class=\"shortcut-label\">Instituto Salvadoreño para el Desarrollo de la Mujer</span> </a>
\t\t\t\t\t\t\t\t\t<a href=\"http://www.salud.gob.sv/\" class=\"shortcut\"><i class=\"shortcut-icon icon-file\"></i><span class=\"shortcut-label\">Ministerio de Salud</span> </a>
\t\t\t\t\t\t\t\t\t<a href=\"http://www.pddh.gob.sv/\" class=\"shortcut\"><i class=\"shortcut-icon icon-picture\"></i> <span class=\"shortcut-label\">Procuraduría para la Defensa de los Derechos Humanos</span> </a>
\t\t\t\t\t\t\t\t\t<a href=\"http://www.pnc.gob.sv/\" class=\"shortcut\"> <i class=\"shortcut-icon icon-tag\"></i><span class=\"shortcut-label\">Policia Nacional Civil - Gobierno de El Salvador</span> </a>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t<!-- /shortcuts -->
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<!-- /widget-content --> 
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<!-- /widget -->
        </div>
        <!-- /span6 --> 
\t<div class=\"span4\">
\t\t<div class=\"widget-header\"><i class=\"icon-bar-chart\"></i><h3>Total de denuncias recibidas</h3></div><div class=\"widget\" id=\"target-3\">
\t\t\t<div class=\"widget-content\">
\t\t\t\t<div id=\"trafico\"></div>
\t\t\t</div> <!-- /widget-content -->
\t\t</div> <!-- /widget -->
\t</div>
\t<div class=\"span4\">
\t\t<div class=\"widget-header\"><i class=\"icon-bar-chart\"></i><h3>Origen de denuncias</h3></div><div class=\"widget\" id=\"target-3\">
\t\t\t<div class=\"widget-content\">
\t\t\t\t<div id=\"dlocalidad\"></div>
\t\t\t</div> <!-- /widget-content -->
\t\t</div> <!-- /widget -->
\t</div>
\t<div class=\"span4\">
\t\t<div class=\"widget-header\"><i class=\"icon-bar-chart\"></i><h3>Instituciones denunciadas</h3></div><div class=\"widget\" id=\"target-3\">
\t\t\t<div class=\"widget-content\">
\t\t\t\t<canvas id=\"dentidad\" class=\"chart-holder\" style=\"width: auto; height: auto;\"> </canvas>
\t\t\t</div>
\t\t</div> <!-- /widget -->
\t</div>
\t
\t<div class=\"span12\"></div>
\t<div class=\"span3\">
\t\t<div class=\"widget-header\"><i class=\"icon-bar-chart\"></i><h3>Origen de denuncias</h3></div><div class=\"widget\" id=\"target-3\">
\t\t\t<div class=\"widget-content\">
\t\t\t\t<h1>Historico de meses</h1>
\t\t\t</div> <!-- /widget-content -->
\t\t</div> <!-- /widget -->
\t</div>
\t<div class=\"span3\">
\t\t<div class=\"widget-header\"><i class=\"icon-bar-chart\"></i><h3>Origen de denuncias</h3></div><div class=\"widget\" id=\"target-3\">
\t\t\t<div class=\"widget-content\">
\t\t\t\t<h1>Día de mayor denuncias</h1>
\t\t\t</div> <!-- /widget-content -->
\t\t</div> <!-- /widget -->
\t</div>
\t<div class=\"span3\">
\t\t<div class=\"widget-header\"><i class=\"icon-bar-chart\"></i><h3>Origen de denuncias</h3></div><div class=\"widget\" id=\"target-3\">
\t\t\t<div class=\"widget-content\">
\t\t\t\t<h1>Hora mas denunciada</h1>
\t\t\t</div> <!-- /widget-content -->
\t\t</div> <!-- /widget -->
\t</div>
\t<div class=\"span3\">
\t\t<div class=\"widget-header\"><i class=\"icon-bar-chart\"></i><h3>Origen de denuncias</h3></div><div class=\"widget\" id=\"target-3\">
\t\t\t<div class=\"widget-content\">
\t\t\t\t<h1>Grafico de radar</h1>
\t\t\t</div> <!-- /widget-content -->
\t\t</div> <!-- /widget -->
\t</div>
\t
\t<div class=\"span12\">
\t\t<div class=\"widget-header\"><i class=\"icon-bar-chart\"></i><h3>Mapa de denuncias</h3></div><div class=\"widget\" id=\"target-3\">
\t\t\t<div class=\"widget-content\">
\t\t\t\t<div id=\"map\"></div>
\t\t\t</div>
\t\t</div> <!-- /widget -->
\t</div>
";
    }

    // line 109
    public function block_js($context, array $blocks = array())
    {
        // line 110
        echo " <link rel=\"stylesheet\" href=\"http://cdn.oesmith.co.uk/morris-0.4.3.min.css\">
 <script src=\"//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js\"></script>
 <script src=\"//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js\"></script>
 <script src=\"http://cdn.oesmith.co.uk/morris-0.4.3.min.js\"></script>
";
    }

    // line 115
    public function block_crudMsg($context, array $blocks = array())
    {
        // line 116
        echo "\t<script>
\t\tMorris.Donut({
\t\t\telement: 'trafico',
\t\t\tdata: [ {label: \"Denuncias\", value: ";
        // line 119
        echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "valores"), "total_denuncias", array(), "array"), "html", null, true);
        echo "}, {label: \"Msg directos\", value: ";
        echo twig_escape_filter($this->env, (($this->getAttribute($this->getContext($context, "valores"), "Recibidos", array(), "array") - $this->getAttribute($this->getContext($context, "valores"), "total_denuncias", array(), "array")) - $this->getAttribute($this->getContext($context, "valores"), "Otros", array(), "array")), "html", null, true);
        echo "}, {label: \"Otros\", value: ";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "valores"), "Otros", array(), "array"), "html", null, true);
        echo "} ]
\t\t});
\t</script>
\t<script>
\t\tMorris.Bar({
\t\t\telement: 'dlocalidad',
\t\t\tdata: [";
        // line 125
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getContext($context, "d_localidad"));
        foreach ($context['_seq'] as $context["_key"] => $context["r"]) {
            echo " {y: '";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "r"), "nombrelocalidad"), "html", null, true);
            echo "', a: ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "r"), "total"), "html", null, true);
            echo " },";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['r'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        echo "],
\t\t\txkey: 'y',
\t\t\tykeys: ['a'],
\t\t\tlabels: ['Total de denuncias'],
\t\t\txLabelAngle: 35,
\t\t});
\t</script>
\t<script>
\t\tMorris.Area({
\t\t\telement: 'dentidad',
\t\t\tdata: [";
        // line 135
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getContext($context, "d_entidad"));
        foreach ($context['_seq'] as $context["_key"] => $context["r"]) {
            echo " {y: '";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "r"), "nombreentidad"), "html", null, true);
            echo "', a: ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "r"), "total"), "html", null, true);
            echo " },";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['r'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        echo "],
\t\t\txkey: 'y',
\t\t\tykeys: ['a'],
\t\t\tlabels: ['Total de denuncias'],
\t\t});
\t</script>
\t<script>
\t\tvar lineChartData = {
\t\t\tlabels: [";
        // line 143
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getContext($context, "d_entidad"));
        foreach ($context['_seq'] as $context["_key"] => $context["r"]) {
            echo "\"";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "r"), "nombreentidad"), "html", null, true);
            echo "\",";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['r'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        echo "],
\t\t\tdatasets: [
\t\t\t\t{
\t\t\t\t    fillColor: \"rgba(151,187,205,0.5)\",
\t\t\t\t    strokeColor: \"rgba(151,187,205,1)\",
\t\t\t\t    pointColor: \"rgba(151,187,205,1)\",
\t\t\t\t    pointStrokeColor: \"#fff\",
\t\t\t\t    data: [";
        // line 150
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getContext($context, "d_entidad"));
        foreach ($context['_seq'] as $context["_key"] => $context["r"]) {
            echo " ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "r"), "total"), "html", null, true);
            echo ",";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['r'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        echo "]
\t\t\t\t},
\t\t\t\t{
\t\t\t\t    fillColor: \"rgba(220,220,220,0.5)\",
\t\t\t\t    strokeColor: \"rgba(220,220,220,1)\",
\t\t\t\t    pointColor: \"rgba(220,220,220,1)\",
\t\t\t\t    pointStrokeColor: \"#fff\",
\t\t\t\t    data: [";
        // line 157
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getContext($context, "d_entidad"));
        foreach ($context['_seq'] as $context["_key"] => $context["r"]) {
            echo " ";
            echo twig_escape_filter($this->env, (($this->getAttribute($this->getContext($context, "r"), "total") / $this->getAttribute($this->getContext($context, "valores"), "total_denuncias", array(), "array")) * 100), "html", null, true);
            echo ",";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['r'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        echo "]
\t\t\t\t},
\t\t\t]

        }

        var myLine = new Chart(document.getElementById(\"dentidad\").getContext(\"2d\")).Line(lineChartData);
\t</script>
";
    }

    // line 166
    public function block_css($context, array $blocks = array())
    {
        // line 167
        echo "\t <script src=\"http://maps.google.com/maps/api/js?sensor=true\"></script>
 <script type=\"text/javascript\" src=\"http://google-maps-utility-library-v3.googlecode.com/svn/trunk/markerclusterer/src/data.json\"></script>
 <script type=\"text/javascript\">
      var script = '<script type=\"text/javascript\" src=\"http://google-maps-utility-library-v3.googlecode.com/svn/trunk/markerclusterer/src/markerclusterer';
      if (document.location.search.indexOf('compiled') !== -1) {
        script += '_compiled';
      }
      script += '.js\"><' + '/script>';
      document.write(script);
    </script>
    <script type=\"text/javascript\">
      function initialize() {
        var center = new google.maps.LatLng(13.933729,-89.02583);
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 14,
          center: center,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        var markers = [];
        ";
        // line 187
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable(range(1, $this->getAttribute($this->getContext($context, "valores"), "total_denuncias", array(), "array")));
        foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
            // line 188
            echo "         var latLng = new google.maps.LatLng( ";
            echo twig_escape_filter($this->env, (13.928652 + ((13.942481 - 13.928652) * (twig_random($this->env, 604) / 604))), "html", null, true);
            echo ", -";
            echo twig_escape_filter($this->env, (89.015536 - ((89.015536 - 89.033818) * (twig_random($this->env, 604) / 604))), "html", null, true);
            echo ");
         var marker = new google.maps.Marker({ position: latLng });
         markers.push(marker);
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 191
        echo "        
        var markerCluster = new MarkerClusterer(map, markers);
      }
      google.maps.event.addDomListener(window, 'load', initialize);
    </script>
\t<style type=\"text/css\">
\t\t#mapa { width : auto; height: 200px; margin: 8px auto; }
\t\t#mapas { width : auto; height: 200px; margin: 8px auto; }
\t\t#map { width: auto; height: 360px; margin: 8px auto; }
\t</style>
";
    }

    public function getTemplateName()
    {
        return "reporteriaBundle::defensora.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  333 => 191,  320 => 188,  316 => 187,  294 => 167,  291 => 166,  269 => 157,  250 => 150,  231 => 143,  209 => 135,  185 => 125,  172 => 119,  167 => 116,  164 => 115,  156 => 110,  153 => 109,  58 => 18,  54 => 17,  50 => 16,  46 => 15,  32 => 3,  29 => 2,);
    }
}
