<?php

/* WebProfilerBundle:Profiler:toolbar_js.html.twig */
class __TwigTemplate_35736adff76873e912c5c5fd8deed900 extends Twig_Template
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
        echo "<div id=\"sfwdt";
        echo twig_escape_filter($this->env, $this->getContext($context, "token"), "html", null, true);
        echo "\" style=\"display: none\"></div>
<script type=\"text/javascript\">/*<![CDATA[*/
    (function () {
        var wdt, xhr;
        wdt = document.getElementById('sfwdt";
        // line 5
        echo twig_escape_filter($this->env, $this->getContext($context, "token"), "html", null, true);
        echo "');
        if (window.XMLHttpRequest) {
            xhr = new XMLHttpRequest();
        } else {
            xhr = new ActiveXObject('Microsoft.XMLHTTP');
        }
        xhr.open('GET', '";
        // line 11
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("_wdt", array("token" => $this->getContext($context, "token"))), "html", null, true);
        echo "', true);
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        xhr.onreadystatechange = function(state) {
            if (4 === xhr.readyState && 200 === xhr.status && -1 !== xhr.responseText.indexOf('sf-toolbarreset')) {
                wdt.innerHTML = xhr.responseText;
                wdt.style.display = 'block';
            }
        };
        xhr.send('');
    })();
/*]]>*/</script>
";
    }

    public function getTemplateName()
    {
        return "WebProfilerBundle:Profiler:toolbar_js.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  25 => 5,  17 => 1,  18 => 1,  552 => 374,  547 => 372,  543 => 371,  537 => 368,  534 => 367,  531 => 366,  510 => 119,  507 => 118,  358 => 221,  354 => 220,  350 => 219,  346 => 218,  342 => 217,  260 => 137,  258 => 118,  212 => 75,  208 => 74,  200 => 69,  196 => 68,  192 => 67,  188 => 66,  184 => 65,  180 => 64,  176 => 63,  169 => 59,  158 => 50,  155 => 49,  150 => 47,  145 => 46,  140 => 21,  134 => 5,  124 => 366,  122 => 49,  113 => 46,  111 => 45,  107 => 44,  85 => 25,  81 => 24,  77 => 23,  72 => 22,  70 => 21,  66 => 20,  44 => 10,  40 => 9,  34 => 11,  30 => 5,  24 => 2,  191 => 106,  174 => 101,  162 => 91,  149 => 90,  135 => 83,  130 => 80,  127 => 376,  119 => 48,  116 => 47,  57 => 14,  53 => 13,  49 => 12,  45 => 15,  31 => 3,  28 => 2,);
    }
}
