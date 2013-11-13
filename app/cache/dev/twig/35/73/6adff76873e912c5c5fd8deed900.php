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
        return array (  25 => 5,  17 => 1,  18 => 1,  406 => 228,  401 => 226,  397 => 225,  391 => 222,  388 => 221,  385 => 220,  364 => 119,  361 => 118,  335 => 198,  331 => 197,  327 => 196,  323 => 195,  319 => 194,  260 => 137,  258 => 118,  212 => 75,  208 => 74,  200 => 69,  196 => 68,  192 => 67,  188 => 66,  184 => 65,  180 => 64,  176 => 63,  158 => 50,  155 => 49,  150 => 47,  145 => 46,  140 => 21,  134 => 5,  127 => 230,  124 => 220,  122 => 49,  119 => 48,  116 => 47,  113 => 46,  111 => 45,  107 => 44,  85 => 25,  81 => 24,  77 => 23,  72 => 22,  70 => 21,  66 => 20,  57 => 14,  53 => 13,  49 => 12,  44 => 10,  40 => 9,  34 => 11,  30 => 5,  24 => 2,  376 => 234,  363 => 231,  359 => 230,  337 => 210,  334 => 209,  274 => 162,  255 => 155,  236 => 148,  214 => 140,  190 => 130,  177 => 124,  172 => 121,  169 => 59,  157 => 111,  154 => 110,  58 => 18,  54 => 17,  50 => 16,  46 => 15,  32 => 3,  29 => 2,);
    }
}
