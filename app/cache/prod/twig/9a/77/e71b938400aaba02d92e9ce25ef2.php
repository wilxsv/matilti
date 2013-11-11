<?php

/* TwigBundle:Exception:error404.html.twig */
class __TwigTemplate_9a77e71b938400aaba02d92e9ce25ef2 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html>
 <head>
  <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
  <title>Matilti :: Recurso no encontrado</title>
  <!--[if IE]>
   <script src=\"http://html5shiv.googlecode.com/svn/trunk/html5.js\"></script>
  <![endif]-->
  <link rel=\"stylesheet\" href=\"";
        // line 9
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("css/styles.css"), "html", null, true);
        echo "\" type=\"text/css\" />
  <script src=\"";
        // line 10
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("js/matilti/jquery-1.5.2.min.js"), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
 </head>
 <body>
  <div id=\"rocket\"></div>
  <hgroup>
   <h1>Tu solicitud no fue procesada.</h1>
   <h2>No hemos podido encontrar lo que estabas buscando.</h2>
   <h2>Oops! Algo pasó - ";
        // line 17
        echo twig_escape_filter($this->env, (isset($context["status_code"]) ? $context["status_code"] : null), "html", null, true);
        echo "  ";
        echo twig_escape_filter($this->env, (isset($context["status_text"]) ? $context["status_text"] : null), "html", null, true);
        echo "</h2>
  </hgroup>
  <script src=\"";
        // line 19
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("js/script.js"), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
  <p class=\"createdBy\"><a href=\"http://tutorialzine.com/2010/08/animated-404-not-found-page-css-jquery/\">Diseño basado en [Tutorialzine]</a></p>
 </body>
</html>
";
    }

    public function getTemplateName()
    {
        return "TwigBundle:Exception:error404.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  48 => 19,  41 => 17,  31 => 10,  27 => 9,  17 => 1,);
    }
}
