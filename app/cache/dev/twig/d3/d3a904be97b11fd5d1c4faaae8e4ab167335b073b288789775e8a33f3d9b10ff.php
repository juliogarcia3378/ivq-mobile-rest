<?php

/* @WebProfiler/Collector/router.html.twig */
class __TwigTemplate_9cc1b770badc7ee5506df08e6663673720d5dbc3f3754b4a0da37a3ad6003cc4 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@WebProfiler/Profiler/layout.html.twig", "@WebProfiler/Collector/router.html.twig", 1);
        $this->blocks = array(
            'toolbar' => array($this, 'block_toolbar'),
            'menu' => array($this, 'block_menu'),
            'panel' => array($this, 'block_panel'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "@WebProfiler/Profiler/layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_0fbf20541e553a56f041a68ab9e215e8e6eb5d3592154878fa6526c4c3370618 = $this->env->getExtension("native_profiler");
        $__internal_0fbf20541e553a56f041a68ab9e215e8e6eb5d3592154878fa6526c4c3370618->enter($__internal_0fbf20541e553a56f041a68ab9e215e8e6eb5d3592154878fa6526c4c3370618_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@WebProfiler/Collector/router.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_0fbf20541e553a56f041a68ab9e215e8e6eb5d3592154878fa6526c4c3370618->leave($__internal_0fbf20541e553a56f041a68ab9e215e8e6eb5d3592154878fa6526c4c3370618_prof);

    }

    // line 3
    public function block_toolbar($context, array $blocks = array())
    {
        $__internal_0a057df01895add12c8834a16345e51f68e89267757975755337fca4331aa212 = $this->env->getExtension("native_profiler");
        $__internal_0a057df01895add12c8834a16345e51f68e89267757975755337fca4331aa212->enter($__internal_0a057df01895add12c8834a16345e51f68e89267757975755337fca4331aa212_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "toolbar"));

        
        $__internal_0a057df01895add12c8834a16345e51f68e89267757975755337fca4331aa212->leave($__internal_0a057df01895add12c8834a16345e51f68e89267757975755337fca4331aa212_prof);

    }

    // line 5
    public function block_menu($context, array $blocks = array())
    {
        $__internal_2c004b9b2229ba8b0ce35eaa702d53ac737162a4fd26ed1e065836d21d5ff9bb = $this->env->getExtension("native_profiler");
        $__internal_2c004b9b2229ba8b0ce35eaa702d53ac737162a4fd26ed1e065836d21d5ff9bb->enter($__internal_2c004b9b2229ba8b0ce35eaa702d53ac737162a4fd26ed1e065836d21d5ff9bb_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "menu"));

        // line 6
        echo "<span class=\"label\">
    <span class=\"icon\">";
        // line 7
        echo twig_include($this->env, $context, "@WebProfiler/Icon/router.svg");
        echo "</span>
    <strong>Routing</strong>
</span>
";
        
        $__internal_2c004b9b2229ba8b0ce35eaa702d53ac737162a4fd26ed1e065836d21d5ff9bb->leave($__internal_2c004b9b2229ba8b0ce35eaa702d53ac737162a4fd26ed1e065836d21d5ff9bb_prof);

    }

    // line 12
    public function block_panel($context, array $blocks = array())
    {
        $__internal_3407acc89ed457e5f793bd9d942a123154bd662e11c29361a629aded08c54af6 = $this->env->getExtension("native_profiler");
        $__internal_3407acc89ed457e5f793bd9d942a123154bd662e11c29361a629aded08c54af6->enter($__internal_3407acc89ed457e5f793bd9d942a123154bd662e11c29361a629aded08c54af6_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "panel"));

        // line 13
        echo "    ";
        echo $this->env->getExtension('http_kernel')->renderFragment($this->env->getExtension('routing')->getPath("_profiler_router", array("token" => (isset($context["token"]) ? $context["token"] : $this->getContext($context, "token")))));
        echo "
";
        
        $__internal_3407acc89ed457e5f793bd9d942a123154bd662e11c29361a629aded08c54af6->leave($__internal_3407acc89ed457e5f793bd9d942a123154bd662e11c29361a629aded08c54af6_prof);

    }

    public function getTemplateName()
    {
        return "@WebProfiler/Collector/router.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  73 => 13,  67 => 12,  56 => 7,  53 => 6,  47 => 5,  36 => 3,  11 => 1,);
    }

    public function getSource()
    {
        return "{% extends '@WebProfiler/Profiler/layout.html.twig' %}

{% block toolbar %}{% endblock %}

{% block menu %}
<span class=\"label\">
    <span class=\"icon\">{{ include('@WebProfiler/Icon/router.svg') }}</span>
    <strong>Routing</strong>
</span>
{% endblock %}

{% block panel %}
    {{ render(path('_profiler_router', { token: token })) }}
{% endblock %}
";
    }
}
