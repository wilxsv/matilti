<?php

/* ::crud.files.js.twig */
class __TwigTemplate_57b269bdbbc355d1a966ad3b64cc1201 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'crud' => array($this, 'block_crud'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        $this->displayBlock('crud', $context, $blocks);
    }

    public function block_crud($context, array $blocks = array())
    {
        // line 2
        echo " <script type=\"text/javascript\">
  /*Funcion que limpia los campos del formulario y errores de validacion*/
  jQuery.fn.reset = function () { \$(this).each (function() { this.reset(); }); }
  function cleanForm(){ \$(\"#nuevo\").reset(); }
 /*Funcion que agrega un registro*/
 function crear(strForm, strDivGrid){
  \$(\"#load\").dialog({ autoOpen: true });
  \$(strForm).submit(function() {
   \$.ajax({
    type: 'POST',
    url: \$(this).attr('action'),
    data: \$(this).serialize(),
    error: function(data){
    \$(\"#load\").dialog('close');
    \$(\"#error\").dialog({ autoOpen: true, modal: true });
    },
    success: function(data) {
     \$(strDivGrid).html(data);
     \$(strForm).each (function(){ this.reset(); });
     \$(\"#error\").dialog('close');
     \$(\"#load\").dialog('close');
     \$( \"#ok\" ).dialog({ autoOpen: true });
    }
   });
   \$(\"#load\").dialog('close');
   return false;
  });
 }
 /*Funcion que elimina un registro*/
 function borrar(url_v, strDivGrid){
  \$(\"#load\").dialog({ autoOpen: true });
  \$(\"#delete\").dialog({
   autoOpen: true,
   resizable: false,
   height:200,
   width: 400,
   modal: true,
   buttons: { 
    \"Eliminar registro\": function() {
     \$(\"#delete\").dialog( \"close\" );
     \$.ajax({
      type: 'POST',
      url: url_v,
      data: \$(this).serialize(),
      error: function(data){
       \$(\"#load\").dialog('close');
       \$(\"#error\").dialog({ autoOpen: true, modal: true });
      },
      success: function(data) {
       \$(strDivGrid).html(data);
       \$(\"#error\").dialog('close');
       \$(\"#load\").dialog('close');
       \$( \"#ok\" ).dialog({ autoOpen: true });
      }
     });
    },
    Cancel: function() {
     \$(\"#delete\").dialog( \"close\" );
    }
   }
  });
  \$(\"#load\").dialog('close');
  return false;
 }
 /*Funcion que muestra un registro a editar*/
 function editar(url_v, strDivGrid){
  \$(\"#load\").dialog({ autoOpen: true });
  \$.ajax({
   type: 'POST',
   url: url_v,
   data: \$(this).serialize(),
   error: function(data){
    \$(\"#load\").dialog('close');
    \$(\"#error\").dialog({ autoOpen: true, modal: true });
   },
   success: function(data) {
    \$(strDivGrid).html(data);
    \$(\"#error\").dialog('close');
    \$(\"#load\").dialog('close');
   }
  });
  \$(\"#load\").dialog('close');
  return false;
 }
 /*Funcion que actualiza un registro*/
 function actualizar(strForm, strDivGrid){
  \$(\"#load\").dialog({ autoOpen: true });
  \$(strForm).submit(function() {
   \$.ajax({
    type: 'POST',
    url: \$(this).attr('action'),
    data: \$(this).serialize(),
    error: function(data){
    \$(\"#load\").dialog('close');
    \$(\"#error\").dialog({ autoOpen: true, modal: true });
    },
    success: function(data) {
     \$(strDivGrid).html(data);
     \$('#nuevo').each (function(){ this.reset(); });
     \$(strForm).each (function(){ this.reset(); });
     \$(\"#error\").dialog('close');
     \$(\"#load\").dialog('close');
     \$( \"#ok\" ).dialog({ autoOpen: true });
    }
   });
   \$(\"#load\").dialog('close');
   return false;
  });
 }
 </script>
 <script>
  \$(function() {
   \$( \"#error\" ).dialog({ autoOpen: false });
   \$( \"#ok\" ).dialog({ autoOpen: false, buttons: { \"Ok\": function() { \$(this).dialog(\"close\"); } } });
   \$( \"#load\" ).dialog({ autoOpen: false });
   \$( \"#delete\" ).dialog({ autoOpen: false });
  });
 </script>
";
    }

    public function getTemplateName()
    {
        return "::crud.files.js.twig";
    }

    public function getDebugInfo()
    {
        return array (  18 => 1,  552 => 374,  547 => 372,  543 => 371,  537 => 368,  534 => 367,  531 => 366,  510 => 119,  507 => 118,  358 => 221,  354 => 220,  350 => 219,  346 => 218,  342 => 217,  260 => 137,  258 => 118,  212 => 75,  208 => 74,  200 => 69,  196 => 68,  192 => 67,  188 => 66,  184 => 65,  180 => 64,  176 => 63,  169 => 59,  158 => 50,  155 => 49,  150 => 47,  145 => 46,  140 => 21,  134 => 5,  124 => 366,  122 => 49,  113 => 46,  111 => 45,  107 => 44,  85 => 25,  81 => 24,  77 => 23,  72 => 22,  70 => 21,  66 => 20,  44 => 10,  40 => 9,  34 => 6,  30 => 5,  24 => 2,  191 => 106,  174 => 101,  162 => 91,  149 => 90,  135 => 83,  130 => 80,  127 => 376,  119 => 48,  116 => 47,  57 => 14,  53 => 13,  49 => 12,  45 => 15,  31 => 3,  28 => 2,);
    }
}
