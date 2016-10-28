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
        $__internal_7d97697d8ed620db116ded39a9b89e8563485a26e8134c97baa389f4fbeb0a2c = $this->env->getExtension("native_profiler");
        $__internal_7d97697d8ed620db116ded39a9b89e8563485a26e8134c97baa389f4fbeb0a2c->enter($__internal_7d97697d8ed620db116ded39a9b89e8563485a26e8134c97baa389f4fbeb0a2c_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@WebProfiler/Collector/router.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_7d97697d8ed620db116ded39a9b89e8563485a26e8134c97baa389f4fbeb0a2c->leave($__internal_7d97697d8ed620db116ded39a9b89e8563485a26e8134c97baa389f4fbeb0a2c_prof);

    }

    // line 3
    public function block_toolbar($context, array $blocks = array())
    {
        $__internal_d202d3afcfbe01dd17347a514510dbd64f9b89c714cac838bc26f1331446a361 = $this->env->getExtension("native_profiler");
        $__internal_d202d3afcfbe01dd17347a514510dbd64f9b89c714cac838bc26f1331446a361->enter($__internal_d202d3afcfbe01dd17347a514510dbd64f9b89c714cac838bc26f1331446a361_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "toolbar"));

        
        $__internal_d202d3afcfbe01dd17347a514510dbd64f9b89c714cac838bc26f1331446a361->leave($__internal_d202d3afcfbe01dd17347a514510dbd64f9b89c714cac838bc26f1331446a361_prof);

    }

    // line 5
    public function block_menu($context, array $blocks = array())
    {
        $__internal_92d59aab6ea2db814d7fcbc4d1f6f06118c1dd52b80ecb02333e176e1f81a993 = $this->env->getExtension("native_profiler");
        $__internal_92d59aab6ea2db814d7fcbc4d1f6f06118c1dd52b80ecb02333e176e1f81a993->enter($__internal_92d59aab6ea2db814d7fcbc4d1f6f06118c1dd52b80ecb02333e176e1f81a993_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "menu"));

        // line 6
        echo "<span class=\"label\">
    <span class=\"icon\">";
        // line 7
        echo twig_include($this->env, $context, "@WebProfiler/Icon/router.svg");
        echo "</span>
    <strong>Routing</strong>
</span>
";
        
        $__internal_92d59aab6ea2db814d7fcbc4d1f6f06118c1dd52b80ecb02333e176e1f81a993->leave($__internal_92d59aab6ea2db814d7fcbc4d1f6f06118c1dd52b80ecb02333e176e1f81a993_prof);

    }

    // line 12
    public function block_panel($context, array $blocks = array())
    {
        $__internal_0b36c1ffe82857775a1b3e0cd530113da50009edeffc26be592f383b9b71ce27 = $this->env->getExtension("native_profiler");
        $__internal_0b36c1ffe82857775a1b3e0cd530113da50009edeffc26be592f383b9b71ce27->enter($__internal_0b36c1ffe82857775a1b3e0cd530113da50009edeffc26be592f383b9b71ce27_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "panel"));

        // line 13
        echo "    ";
        echo $this->env->getExtension('http_kernel')->renderFragment($this->env->getExtension('routing')->getPath("_profiler_router", array("token" => (isset($context["token"]) ? $context["token"] : $this->getContext($context, "token")))));
        echo "
";
        
        $__internal_0b36c1ffe82857775a1b3e0cd530113da50009edeffc26be592f383b9b71ce27->leave($__internal_0b36c1ffe82857775a1b3e0cd530113da50009edeffc26be592f383b9b71ce27_prof);

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
