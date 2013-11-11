<?php

/* usuarioBundle:Default:login.html.twig */
class __TwigTemplate_446fb4dad0e100012df11571166b3376 extends Twig_Template
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
  <title>Acceso a matilti</title>
  <link rel=\"stylesheet\" href=\"";
        // line 6
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("css/login/flexi-background.css"), "html", null, true);
        echo "\" type=\"text/css\"  media=\"screen\" />
  <link rel=\"stylesheet\" href=\"";
        // line 7
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("css/login/styles.css"), "html", null, true);
        echo "\" type=\"text/css\"  media=\"screen\" />
 </head>
 <body>
  <script src=\"";
        // line 10
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("js/flexi-background.js"), "html", null, true);
        echo "\" type=\"text/javascript\" charset=\"utf-8\"></script>
  <div id=\"box\">
   <img src=\"";
        // line 12
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("images/logo.png"), "html", null, true);
        echo "\" class=\"logo\" alt=\"yourlogo\" />
   <h1>Acceso a usuarios Matilti.</h1>
   ";
        // line 14
        if ($this->getContext($context, "error")) {
            // line 15
            echo "    <b> ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "error"), "message"), "html", null, true);
            echo " </b>
   ";
        }
        // line 17
        echo "   <form action=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("_security_check"), "html", null, true);
        echo "\" method=\"POST\">
    <input type=\"text\" id=\"username\" name=\"_username\" value=\"";
        // line 18
        echo twig_escape_filter($this->env, $this->getContext($context, "last_username"), "html", null, true);
        echo "\" />
    <input type=\"password\" id=\"password\" name=\"_password\" />
    <input type=\"checkbox\" id=\"remember\" value=\"Remember\" />
    <div class=\"hover-opacity\"><label for=\"remember\">Remember me</label></div>
    <input type=\"submit\" name=\"login\" value=\"Autenticame\" />
   </form>
  </div>
  <a href=\"http://medialoot.com/item/clear-login-window-template/\" class=\"forgot\">Diseño basado en Medialoot</a>
 </body>
</html>
";
    }

    public function getTemplateName()
    {
        return "usuarioBundle:Default:login.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  57 => 18,  52 => 17,  46 => 15,  44 => 14,  39 => 12,  34 => 10,  28 => 7,  24 => 6,  17 => 1,);
    }
}
