<?php

/* @WebProfiler/Collector/exception.html.twig */
class __TwigTemplate_cfece1763d5fd770836c554c8829ade174470cc914c9d84d09d12654154acb85 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@WebProfiler/Profiler/layout.html.twig", "@WebProfiler/Collector/exception.html.twig", 1);
        $this->blocks = array(
            'head' => array($this, 'block_head'),
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
        $__internal_36009b5b28c3811f16069bcaf68f9c3270bfefd2e278e12c06a7a755b841aa1e = $this->env->getExtension("native_profiler");
        $__internal_36009b5b28c3811f16069bcaf68f9c3270bfefd2e278e12c06a7a755b841aa1e->enter($__internal_36009b5b28c3811f16069bcaf68f9c3270bfefd2e278e12c06a7a755b841aa1e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@WebProfiler/Collector/exception.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_36009b5b28c3811f16069bcaf68f9c3270bfefd2e278e12c06a7a755b841aa1e->leave($__internal_36009b5b28c3811f16069bcaf68f9c3270bfefd2e278e12c06a7a755b841aa1e_prof);

    }

    // line 3
    public function block_head($context, array $blocks = array())
    {
        $__internal_e24188a9fbd850f2398c7f0bf23790e544538cf6479071fee1bd82d58bc10f96 = $this->env->getExtension("native_profiler");
        $__internal_e24188a9fbd850f2398c7f0bf23790e544538cf6479071fee1bd82d58bc10f96->enter($__internal_e24188a9fbd850f2398c7f0bf23790e544538cf6479071fee1bd82d58bc10f96_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "head"));

        // line 4
        echo "    ";
        if ($this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "hasexception", array())) {
            // line 5
            echo "        <style>
            ";
            // line 6
            echo $this->env->getExtension('http_kernel')->renderFragment($this->env->getExtension('routing')->getPath("_profiler_exception_css", array("token" => (isset($context["token"]) ? $context["token"] : $this->getContext($context, "token")))));
            echo "
        </style>
    ";
        }
        // line 9
        echo "    ";
        $this->displayParentBlock("head", $context, $blocks);
        echo "
";
        
        $__internal_e24188a9fbd850f2398c7f0bf23790e544538cf6479071fee1bd82d58bc10f96->leave($__internal_e24188a9fbd850f2398c7f0bf23790e544538cf6479071fee1bd82d58bc10f96_prof);

    }

    // line 12
    public function block_menu($context, array $blocks = array())
    {
        $__internal_a6a503b0c7926151c05e02ddf68c7629e6f3c458700d240d15f07665f0997e4e = $this->env->getExtension("native_profiler");
        $__internal_a6a503b0c7926151c05e02ddf68c7629e6f3c458700d240d15f07665f0997e4e->enter($__internal_a6a503b0c7926151c05e02ddf68c7629e6f3c458700d240d15f07665f0997e4e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "menu"));

        // line 13
        echo "    <span class=\"label ";
        echo (($this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "hasexception", array())) ? ("label-status-error") : ("disabled"));
        echo "\">
        <span class=\"icon\">";
        // line 14
        echo twig_include($this->env, $context, "@WebProfiler/Icon/exception.svg");
        echo "</span>
        <strong>Exception</strong>
        ";
        // line 16
        if ($this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "hasexception", array())) {
            // line 17
            echo "            <span class=\"count\">
                <span>1</span>
            </span>
        ";
        }
        // line 21
        echo "    </span>
";
        
        $__internal_a6a503b0c7926151c05e02ddf68c7629e6f3c458700d240d15f07665f0997e4e->leave($__internal_a6a503b0c7926151c05e02ddf68c7629e6f3c458700d240d15f07665f0997e4e_prof);

    }

    // line 24
    public function block_panel($context, array $blocks = array())
    {
        $__internal_e49a41f12cf330f8367f6e66a43d446df448e042b3636dda68a1e8542d4c1d73 = $this->env->getExtension("native_profiler");
        $__internal_e49a41f12cf330f8367f6e66a43d446df448e042b3636dda68a1e8542d4c1d73->enter($__internal_e49a41f12cf330f8367f6e66a43d446df448e042b3636dda68a1e8542d4c1d73_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "panel"));

        // line 25
        echo "    <h2>Exceptions</h2>

    ";
        // line 27
        if ( !$this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "hasexception", array())) {
            // line 28
            echo "        <div class=\"empty\">
            <p>No exception was thrown and caught during the request.</p>
        </div>
    ";
        } else {
            // line 32
            echo "        <div class=\"sf-reset\">
            ";
            // line 33
            echo $this->env->getExtension('http_kernel')->renderFragment($this->env->getExtension('routing')->getPath("_profiler_exception", array("token" => (isset($context["token"]) ? $context["token"] : $this->getContext($context, "token")))));
            echo "
        </div>
    ";
        }
        
        $__internal_e49a41f12cf330f8367f6e66a43d446df448e042b3636dda68a1e8542d4c1d73->leave($__internal_e49a41f12cf330f8367f6e66a43d446df448e042b3636dda68a1e8542d4c1d73_prof);

    }

    public function getTemplateName()
    {
        return "@WebProfiler/Collector/exception.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  117 => 33,  114 => 32,  108 => 28,  106 => 27,  102 => 25,  96 => 24,  88 => 21,  82 => 17,  80 => 16,  75 => 14,  70 => 13,  64 => 12,  54 => 9,  48 => 6,  45 => 5,  42 => 4,  36 => 3,  11 => 1,);
    }

    public function getSource()
    {
        return "{% extends '@WebProfiler/Profiler/layout.html.twig' %}

{% block head %}
    {% if collector.hasexception %}
        <style>
            {{ render(path('_profiler_exception_css', { token: token })) }}
        </style>
    {% endif %}
    {{ parent() }}
{% endblock %}

{% block menu %}
    <span class=\"label {{ collector.hasexception ? 'label-status-error' : 'disabled' }}\">
        <span class=\"icon\">{{ include('@WebProfiler/Icon/exception.svg') }}</span>
        <strong>Exception</strong>
        {% if collector.hasexception %}
            <span class=\"count\">
                <span>1</span>
            </span>
        {% endif %}
    </span>
{% endblock %}

{% block panel %}
    <h2>Exceptions</h2>

    {% if not collector.hasexception %}
        <div class=\"empty\">
            <p>No exception was thrown and caught during the request.</p>
        </div>
    {% else %}
        <div class=\"sf-reset\">
            {{ render(path('_profiler_exception', { token: token })) }}
        </div>
    {% endif %}
{% endblock %}
";
    }
}
